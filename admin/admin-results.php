<?php
require_once '../core/lang.php';

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

// If role is not set or is not 'user' or 'admin', log out
if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], ['user', 'admin'])) {
    header('Location: ../core/logout');
    exit();
}

include '../includes/admin-header.php';
?>
<div class="admin-results-container">

</div>
<script src="../assets/js/utilities/utils.js" defer></script>
<script src="../assets/js/pages/admin-results.js" defer></script>

<?php include '../includes/admin-footer.php'; ?>
