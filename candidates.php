<?php
require_once 'core/lang.php';
require_once 'core/config.php';

// Check if user is logged in
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header('Location: auth');
    exit();
}

// If role is not set or is not 'user' or 'admin', log out
if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], ['user', 'admin'])) {
    header('Location: core/logout');
    exit();
}

include 'includes/header.php';
?>
<div class="candidates-container">
    <div class="header">
        <h1><?php echo t('list_of_candidates', 'List of candidates:'); ?><span>:</span></h1>
    </div>

    <?php
    // Fetch positions and candidates
    $stmtPos = $pdo->prepare("SELECT id, name FROM position WHERE status = 1 ORDER BY id");
    $stmtPos->execute();
    $positions = $stmtPos->fetchAll();

    $stmtCand = $pdo->prepare("SELECT * FROM candidates WHERE id_position IS NOT NULL ORDER BY id_position, id");
    $stmtCand->execute();
    $candidates = $stmtCand->fetchAll();

    // Group candidates by position id
    $byPos = [];
    foreach ($candidates as $c) {
        $pid = $c['id_position'];
        if (!isset($byPos[$pid])) $byPos[$pid] = [];
        $byPos[$pid][] = $c;
    }

    foreach ($positions as $pos) {
        $pid = $pos['id'];
        if (empty($byPos[$pid])) continue; // skip positions with no candidates
        $posName = $pos['name'];
        if (current_lang() === 'ar') { $posName = t($posName, $posName); }
        ?>
        <div class="candidates-list">
            <div class="position-header"><?php echo htmlspecialchars($posName); ?><span>:</span></div>

            <?php foreach ($byPos[$pid] as $cand) {
                $photo = $cand['photo_path'] ?: 'assets/images/candidates/profile/candidate-placeholder.png';
                $logo = $cand['path_supporting_party_logo'] ?: 'assets/images/candidates/party/party-placeholder.jpg';
                $party = $cand['Supporting_party'];
                $lang = current_lang();
                if ($lang === 'ar') {
                    $name = $cand['ar_name'] ?: $cand['name'];
                    $bio = $cand['ar_description'] ?: $cand['en_description'];
                } elseif ($lang === 'fr') {
                    $name = $cand['name'];
                    $bio = $cand['fr_description'] ?: $cand['en_description'];
                } else {
                    $name = $cand['name'];
                    $bio = $cand['en_description'];
                }
            ?>
            <div class="candidate-card" onclick="toggleCandidate(this)">
                <div class="candidate-header">
                    <img src="<?php echo htmlspecialchars($photo); ?>" alt="<?php echo htmlspecialchars($name); ?>" class="candidate-photo">
                    <div class="candidate-info">
                        <div class="candidate-name"><?php echo htmlspecialchars($name); ?></div>
                    </div>
                    <div class="candidate-meta">
                        <div class="organization"><?php echo htmlspecialchars($party); ?></div>
                        <img src="<?php echo htmlspecialchars($logo); ?>" alt="<?php echo htmlspecialchars($party); ?>" class="party-logo" style="width:28px;height:28px;object-fit:contain;border-radius:4px;border:1px solid #3a3a3a;" />
                    </div>
                </div>
                <div class="candidate-details">
                    <div class="candidate-details-inner">
                        <div class="candidate-bio"><?php echo htmlspecialchars($bio); ?></div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
        <?php
    }
    ?>
</div>
<script src="assets/js/utilities/utils.js" defer></script>
<script src="assets/js/pages/candidates.js" defer></script>

<?php include 'includes/footer.php'; ?>
