<?php
require_once '../core/lang.php';

$_SESSION['current_lang'] = $current_lang;

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

include '../includes/super-admin-header.php';
?>
<div class="admin-candidates-container" data-edit-label="<?php echo htmlspecialchars(t('edit_candidate', 'Modifier le candidat')); ?>" data-delete-label="<?php echo htmlspecialchars(t('delete', 'Supprimer')); ?>">
    <div class="page-header">
        <h1><?php echo t('manage_candidates', 'Gérer les candidats'); ?></h1>
    </div>

    <div class="candidates-grid" id="candidatesGrid">
        <div class="loading-spinner">
            <svg class="spinner-svg" viewBox="25 25 50 50">
                <circle r="20" cy="50" cx="50"></circle>
            </svg>
        </div>
        
    </div>

    <!-- Modal for Add/Edit Candidate -->
    <div class="modal" id="candidateModal">
        <div class="modal-overlay"></div>
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modalTitle"><?php echo t('add_candidate', 'Ajouter un candidat'); ?></h2>
                <button class="modal-close" id="closeModal">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </button>
            </div>
            
            <form class="modal-body" id="candidateForm" enctype="multipart/form-data">
                <input type="hidden" id="candidateId" name="id">
                
                <!-- Basic Information -->
                <div class="form-section">
                    <h3><?php echo t('basic_information', 'Informations de base'); ?></h3>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <h6><?php echo t('candidate_name_en', 'Nom (English)'); ?> <span class="required">*</span></h6>
                            <input type="text" id="name" name="name" required placeholder="John Doe">
                        </div>
                        
                        <div class="form-group">
                            <h6><?php echo t('candidate_name_ar', 'الاسم (العربية)'); ?> <span class="required">*</span></h6>
                            <input type="text" id="ar_name" name="ar_name" required placeholder="جون دو" dir="rtl">
                        </div>
                    </div>

                    <div class="form-group">
                        <h6><?php echo t('position', 'Poste'); ?></h6>
                        <input type="hidden" id="id_position" name="id_position" value="">
                        <div class="dropdown-container" id="positionDropdown">
                            <button class="dropdown-button" id="positionDropdownButton" type="button" style="width: 22.6rem;">
                                <svg
                                    class="dropdown-icon"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                <span class="dropdown-text" id="positionSelectedText">
                                    <?php echo t('select_position', 'Sélectionner un poste'); ?>
                                </span>
                                <svg
                                  class="dropdown-chevron"
                                  fill="none"
                                  stroke="currentColor"
                                  viewBox="0 0 24 24">
                                  <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div class="dropdown-menu" id="positionDropdownMenu">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Descriptions -->
                <div class="form-section">
                    <h3><?php echo t('descriptions', 'Descriptions'); ?></h3>
                    
                    <div class="form-group">
                        <h6><?php echo t('description_en', 'Description (English)'); ?> <span class="required">*</span></h6>
                        <textarea id="en_description" name="en_description" required rows="4" 
                                placeholder="Enter candidate description in English"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <h6><?php echo t('description_fr', 'Description (Français)'); ?> <span class="required">*</span></h6>
                        <textarea id="fr_description" name="fr_description" required rows="4" 
                                placeholder="Entrez la description du candidat en français"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <h6><?php echo t('description_ar', 'الوصف (العربية)'); ?> <span class="required">*</span></h6>
                        <textarea id="ar_description" name="ar_description" required rows="4" 
                                placeholder="أدخل وصف المرشح بالعربية" dir="rtl"></textarea>
                    </div>
                </div>

                <!-- Party Information -->
                <div class="form-section">
                    <h3><?php echo t('party_information', 'Informations sur le parti'); ?></h3>
                    
                    <div class="form-group">
                        <h6><?php echo t('supporting_party', 'Parti de soutien'); ?> <span class="required">*</span></h6>
                        <input type="text" id="supporting_party" name="supporting_party" required placeholder="UNEM">
                    </div>

                    <div class="form-group">
                        <h6><?php echo t('party_logo', 'Logo du parti'); ?></h6>
                        <div class="file-upload-container">
                            <input type="file" id="party_logo" name="party_logo" accept="image/*" class="file-input">
                            <label for="party_logo" class="file-label">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M21 15V19C21 19.5304 20.7893 20.0391 20.4142 20.4142C20.0391 20.7893 19.5304 21 19 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V15M17 8L12 3M12 3L7 8M12 3V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <span id="partyLogoLabel"><?php echo t('upload_image', 'Télécharger une image'); ?></span>
                            </label>
                            <div class="file-preview" id="partyLogoPreview"></div>
                        </div>
                    </div>
                </div>

                <!-- Candidate Photo -->
                <div class="form-section">
                    <h3><?php echo t('candidate_photo', 'Photo du candidat'); ?></h3>
                    
                    <div class="form-group">
                        <h6><?php echo t('photo', 'Photo'); ?></h6>
                        <div class="file-upload-container">
                            <input type="file" id="photo" name="photo" accept="image/*" class="file-input">
                            <label for="photo" class="file-label">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M21 15V19C21 19.5304 20.7893 20.0391 20.4142 20.4142C20.0391 20.7893 19.5304 21 19 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V15M17 8L12 3M12 3L7 8M12 3V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <span id="photoLabel"><?php echo t('upload_image', 'Télécharger une image'); ?></span>
                            </label>
                            <div class="file-preview" id="photoPreview"></div>
                        </div>
                    </div>
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn-secondary" id="cancelBtn">
                        <?php echo t('cancel', 'Annuler'); ?>
                    </button>
                    <button type="submit" class="btn-primary" id="saveBtn">
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
                <p><?php echo t('delete_candidate_confirm', 'Êtes-vous sûr de vouloir supprimer ce candidat?'); ?></p>
                <div class="modal-actions">
                    <button type="button" class="btn-secondary" id="cancelDeleteBtn">
                        <?php echo t('cancel', 'Annuler'); ?>
                    </button>
                    <button type="button" class="btn-danger" id="confirmDeleteBtn">
                        <span class="btn-text"><?php echo t('delete', 'Supprimer'); ?></span>
                        <svg class="spinner-svg" viewBox="25 25 50 50">
                            <circle r="20" cy="50" cx="50"></circle>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="../assets/js/utilities/utils.js" defer></script>
<script src="../assets/js/pages/super-admin-candidates.js" defer></script>
<script type="module">import '../assets/js/utilities/dropdown.js';</script>

<?php include '../includes/admin-footer.php'; ?>
