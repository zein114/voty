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

$stmt = $pdo->prepare(
    'SELECT * FROM election',
);
$stmt->execute();
$elections = $stmt->fetchAll(PDO::FETCH_ASSOC);


include '../includes/super-admin-header.php';
?>
<div class="admin-elections-container">
    <div class="header-elections">
        <h1><?php echo t('manage_elections', 'Gérer les candidats'); ?></h1>
        <div class="btn-add-election">
            <button class="add-election" onclick="addElection(<?= '\''.$current_lang.'\''; ?>)"><?php echo t('add_election', 'Ajouter une nouvelle élection'); ?></button>
        </div>
    </div>
    <div class="grid-cards-elections">
        <?php foreach($elections as $election): ?>
            <div class="card-elections">
                <div class="card-election-details">
                    <span class="card-title"><?php echo t('card_title','Élections étudiantes'); ?></span>
                    <span class="election-year"><?= $election['year']; ?></span>
                    <span class="election-organized-by"><?php echo t('oreganized_by','Organisé par :'); ?></span>
                    <span class="organizer"><?= $election[$current_lang.'_organizer']; ?></span>
                    <span class="date"><?php echo t('start_at','Date de début :'); ?><span class="green"><?= $election['start_date']; ?></span></span>
                    <span class="date"><?php echo t('end_at','Date de Fin :'); ?><span class="green"><?= $election['end_date']; ?></span></span>
                </div>
                <div class="card-elections-btns">
                    <?php if( $election['status'] === 1 ): ?>
                        <button class="btn-stop" onclick="stopElection(<?= $election['id']; ?>, <?= '\''.$current_lang.'\''; ?>)"><?php echo t('btn_stop_election','Arrêter les élections'); ?></button>
                    <?php endif ?>
                    <div class="grid-btns-card">
                        <?php if( $election['status'] === 1 ): ?>
                            <button class="btn-card" onclick="addNewCandidate(<?= $election['id']; ?>, <?= '\''.$current_lang.'\''; ?>)"><?php echo t('btn_add_candidate','Ajouter un nouveau candidat'); ?></button>
                        <?php else: ?>
                            <button class="btn-card die"><?php echo t('btn_add_candidate','Ajouter un nouveau candidat'); ?></button>
                        <?php endif ?>
                        <button class="btn-card" onclick="getListOfCandidates(<?= $election['id']; ?>)"><?php echo t('btn_list_candidates','Liste des candidats'); ?></button>
                        <?php if( $election['status'] === 1 ): ?>
                            <button class="btn-card" onclick="addNewPosition(<?= $election['id']; ?>, <?= '\''.$current_lang.'\''; ?>)"><?php echo t('btn_add_position','Ajouter un nouveau poste'); ?></button>
                        <?php else: ?>
                            <button class="btn-card die"><?php echo t('btn_add_position','Ajouter un nouveau poste'); ?></button>
                        <?php endif ?>
                        <button class="btn-card" onclick="getListOfPositions(<?= $election['id']; ?>, <?= '\''.$current_lang.'\''; ?>)"><?php echo t('btn_list_positions','Liste des postes'); ?></button>
                        <?php if( $election['results'] === 'nopublish' ): ?>
                            <button class="btn-card" onclick="publishResults(<?= $election['id']; ?>)"><?php echo t('btn_publish_results','Publier les résultats'); ?></button>
                        <?php else: ?>
                            <button class="btn-card" onclick="stopPublishingResults(<?= $election['id']; ?>)"><?php echo t('btn_stop_publishing_results','Publier les résultats'); ?></button>
                        <?php endif ?>
                        <button class="btn-card" onclick="getResults(<?= $election['id']; ?>)"><?php echo t('btn_view_results','Voir les résultats'); ?></button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="modal" id="modal"></div>
</div>
<script src="../assets/js/utilities/utils.js" defer></script>
<script src="../assets/js/pages/super-admin-elections.js" defer></script>


<?php include '../includes/admin-footer.php'; ?>