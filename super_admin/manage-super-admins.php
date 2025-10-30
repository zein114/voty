<?php
require_once '../core/lang.php';
require_once '../core/config.php';

// Check if user is logged in
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header('Location: ../auth');
    exit();
}

// Check if user has user role (redirect to user page)
if (isset($_SESSION['role']) && $_SESSION['role'] === 'user') {
    header('Location: ../');
    exit();
}

// Check if user has admin role (redirect to user page)
if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    header('Location: ../admin/dashboard');
    exit();
}

// If role is not set or is not 'user', 'admin' or 'super_admin', log out
if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], ['user', 'admin', 'super_admin'])) {
    header('Location: ../core/logout');
    exit();
}

// Handle AJAX requests
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    header('Content-Type: application/json');
    
    try {
        switch ($_POST['action']) {
            case 'add':
                $username = trim($_POST['username']);
                $user_id = trim($_POST['user_id']);
                $password = trim($_POST['password']);
                
                if (empty($username) || empty($user_id) || empty($password)) {
                    throw new Exception(t('all_fields_required', 'Tous les champs sont requis'));
                }
                
                // Check if user_id already exists
                $stmt = $pdo->prepare('SELECT id FROM users WHERE user_id_hmac = ?');
                $stmt->execute([$user_id]);
                if ($stmt->fetch()) {
                    throw new Exception(t('user_id_exists', 'Cet ID utilisateur existe déjà'));
                }
                
                // Check if username already exists
                $stmt = $pdo->prepare('SELECT id FROM users WHERE username = ?');
                $stmt->execute([$username]);
                if ($stmt->fetch()) {
                    throw new Exception(t('username_exists', 'Ce nom d\'utilisateur existe déjà'));
                }
                
                $password_hash = password_hash($password, PASSWORD_DEFAULT);
                
                $stmt = $pdo->prepare('INSERT INTO users (user_id_hmac, username, password_hash, role) VALUES (?, ?, ?, ?)');
                $stmt->execute([$user_id, $username, $password_hash, 'super_admin']);
                
                echo json_encode(['success' => true, 'message' => t('super_admin_added', 'Super administrateur ajouté avec succès')]);
                break;
                
            case 'edit':
                $id = (int)$_POST['id'];
                $username = trim($_POST['username']);
                $user_id = trim($_POST['user_id']);
                $password = trim($_POST['password']);
                
                if (empty($username) || empty($user_id)) {
                    throw new Exception(t('username_user_id_required', 'Le nom d\'utilisateur et l\'ID utilisateur sont requis'));
                }
                
                // Check if user_id already exists for other users
                $stmt = $pdo->prepare('SELECT id FROM users WHERE user_id_hmac = ? AND id != ?');
                $stmt->execute([$user_id, $id]);
                if ($stmt->fetch()) {
                    throw new Exception(t('user_id_exists', 'Cet ID utilisateur existe déjà'));
                }
                
                // Check if username already exists for other users
                $stmt = $pdo->prepare('SELECT id FROM users WHERE username = ? AND id != ?');
                $stmt->execute([$username, $id]);
                if ($stmt->fetch()) {
                    throw new Exception(t('username_exists', 'Ce nom d\'utilisateur existe déjà'));
                }
                
                if (!empty($password)) {
                    $password_hash = password_hash($password, PASSWORD_DEFAULT);
                    $stmt = $pdo->prepare('UPDATE users SET user_id_hmac = ?, username = ?, password_hash = ? WHERE id = ? AND role = ?');
                    $stmt->execute([$user_id, $username, $password_hash, $id, 'super_admin']);
                } else {
                    $stmt = $pdo->prepare('UPDATE users SET user_id_hmac = ?, username = ? WHERE id = ? AND role = ?');
                    $stmt->execute([$user_id, $username, $id, 'super_admin']);
                }
                
                echo json_encode(['success' => true, 'message' => t('super_admin_updated', 'Super administrateur mis à jour avec succès')]);
                break;
                
            case 'delete':
                $id = (int)$_POST['id'];
                
                // Prevent deleting the current user
                if ($id == $_SESSION['user_id']) {
                    throw new Exception(t('cannot_delete_self', 'Vous ne pouvez pas supprimer votre propre compte'));
                }
                
                $stmt = $pdo->prepare('DELETE FROM users WHERE id = ? AND role = ?');
                $stmt->execute([$id, 'super_admin']);
                
                echo json_encode(['success' => true, 'message' => t('super_admin_deleted', 'Super administrateur supprimé avec succès')]);
                break;
                
            case 'search':
                $search = trim($_POST['search']);
                $stmt = $pdo->prepare('SELECT id, user_id_hmac, username FROM users WHERE role = ? AND (username LIKE ? OR user_id LIKE ?) ORDER BY username');
                $stmt->execute(['super_admin', "%$search%", "%$search%"]);
                $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                echo json_encode(['success' => true, 'users' => $users]);
                break;
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
    exit();
}

// Fetch super admins
$stmt = $pdo->prepare('SELECT id, user_id_hmac, username FROM users WHERE role = ? ORDER BY username');
$stmt->execute(['super_admin']);
$super_admins = $stmt->fetchAll(PDO::FETCH_ASSOC);

include '../includes/super-admin-header.php';
?>
<link rel="stylesheet" href="../assets/css/pages/manage-users.css">

<div class="manage-users-container">
    <div class="page-header">
        <div class="header-left">
            <a href="admin-settings.php" class="back-btn">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 12H5M12 19L5 12L12 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <?php echo t('back_to_settings', 'Retour aux paramètres'); ?>
            </a>
            <h1><?php echo t('manage_super_admins', 'Gérer les super administrateurs'); ?></h1>
        </div>
        <button class="btn-primary" id="addUserBtn">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 5V19M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
            <?php echo t('add_super_admin', 'Ajouter un super administrateur'); ?>
        </button>
    </div>

    <!-- Search Section -->
    <div class="search-section">
        <div class="search-box">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="2"/>
                <path d="M21 21L16.65 16.65" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <input type="text" id="searchInput" placeholder="<?php echo t('search_super_admins', 'Rechercher des super administrateurs...'); ?>">
        </div>
    </div>

    <!-- Users Table -->
    <div class="users-section">
        <div class="users-table-container">
            <table class="users-table" id="usersTable">
                <thead>
                    <tr>
                        <th><?php echo t('username', 'Nom d\'utilisateur'); ?></th>
                        <th><?php echo t('actions', 'Actions'); ?></th>
                    </tr>
                </thead>
                <tbody id="usersTableBody">
                    <?php if(empty($super_admins)): ?>
                        <tr class="empty-row">
                            <td colspan="2">
                                <div class="empty-state">
                                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 2L15.09 8.26L22 9L17 14L18.18 21L12 17.77L5.82 21L7 14L2 9L8.91 8.26L12 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <h3><?php echo t('no_super_admins', 'Aucun super administrateur'); ?></h3>
                                    <p><?php echo t('add_first_super_admin', 'Commencez par ajouter votre premier super administrateur'); ?></p>
                                </div>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach($super_admins as $user): ?>
                            <tr data-id="<?php echo $user['id']; ?>">
                                <td><?php echo htmlspecialchars($user['username']); ?></td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="icon-btn edit-btn" data-id="<?php echo $user['id']; ?>" data-username="<?php echo htmlspecialchars($user['username']); ?>">
                                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M11 4H4C3.46957 4 2.96086 4.21071 2.58579 4.58579C2.21071 4.96086 2 5.46957 2 6V20C2 20.5304 2.21071 21.0391 2.58579 21.4142C2.96086 21.7893 3.46957 22 4 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V13M18.5 2.5C18.8978 2.1022 19.4374 1.87868 20 1.87868C20.5626 1.87868 21.1022 2.1022 21.5 2.5C21.8978 2.8978 22.1213 3.43739 22.1213 4C22.1213 4.56261 21.8978 5.1022 21.5 5.5L12 15L8 16L9 12L18.5 2.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <?php echo t('edit', 'Modifier'); ?>
                                        </button>
                                        <button class="icon-btn delete-btn" data-id="<?php echo $user['id']; ?>">
                                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M3 6H5H21M19 6V20C19 20.5304 18.7893 21.0391 18.4142 21.4142C18.0391 21.7893 17.5304 22 17 22H7C6.46957 22 5.96086 21.7893 5.58579 21.4142C5.21071 21.0391 5 20.5304 5 20V6M8 6V4C8 3.46957 8.21071 2.96086 8.58579 2.58579C8.96086 2.21071 9.46957 2 10 2H14C14.5304 2 15.0391 2.21071 15.4142 2.58579C15.7893 2.96086 16 3.46957 16 4V6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <?php echo t('delete', 'Supprimer'); ?>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal for Add/Edit User -->
    <div class="modal" id="userModal">
        <div class="modal-overlay"></div>
        <div class="modal-content modal-small">
            <div class="modal-header">
                <h2 id="userModalTitle"><?php echo t('add_super_admin', 'Ajouter un super administrateur'); ?></h2>
                <button class="modal-close" id="closeUserModal">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </button>
            </div>
            <form class="modal-body" id="userForm">
                <input type="hidden" id="user_id_hidden" name="id">
                
                <div class="form-section">
                    <h3><?php echo t('user_information', 'Informations utilisateur'); ?></h3>
                    
                    <div class="form-group">
                        <h6><?php echo t('username', 'Nom d\'utilisateur'); ?> <span class="required">*</span></h6>
                        <input type="text" id="username" name="username" required>
                    </div>

                    <div class="form-group">
                        <h6><?php echo t('user_id', 'ID utilisateur'); ?> <span class="required">*</span></h6>
                        <input type="text" id="user_id" name="user_id" required>
                    </div>

                    <div class="form-group">
                        <h6 id="passwordLabel"><?php echo t('password', 'Mot de passe'); ?> <span class="required">*</span></h6>
                        <input type="password" id="password" name="password" required>
                        <small id="passwordHelp" style="display: none; color: #999; font-size: 0.8rem;">
                            <?php echo t('leave_empty_keep_current', 'Laissez vide pour conserver le mot de passe actuel'); ?>
                        </small>
                    </div>
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn-secondary" id="cancelUserBtn">
                        <?php echo t('cancel', 'Annuler'); ?>
                    </button>
                    <button type="submit" class="btn-primary" id="saveUserBtn">
                        <span class="btn-text"><?php echo t('save', 'Enregistrer'); ?></span>
                        <svg class="spinner-svg" viewBox="25 25 50 50">
                            <circle r="20" cy="50" cx="50"></circle>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal" id="deleteModal">
        <div class="modal-overlay"></div>
        <div class="modal-content modal-small">
            <div class="modal-header">
                <h2><?php echo t('confirm_delete', 'Confirmer la suppression'); ?></h2>
                <button class="modal-close" id="closeDeleteModal">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <p style="color: #ccc; text-align: center; margin-bottom: 2rem;">
                    <?php echo t('delete_super_admin_confirm', 'Êtes-vous sûr de vouloir supprimer ce super administrateur ?'); ?>
                </p>
                <div class="modal-actions">
                    <button type="button" class="btn-secondary" id="cancelDeleteBtn">
                        <?php echo t('cancel', 'Annuler'); ?>
                    </button>
                    <button type="button" class="btn-danger" id="confirmDeleteBtn">
                        <?php echo t('delete', 'Supprimer'); ?>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Toast Container -->
<div class="toast-container" id="toastContainer"></div>

<script src="../assets/js/utilities/utils.js" defer></script>
<script src="../assets/js/utilities/toast.js" defer></script>
<script src="../assets/js/pages/manage-super-admins.js" defer></script>

<?php include '../includes/admin-footer.php'; ?>
