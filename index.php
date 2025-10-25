<?php
require_once 'core/config.php';
require_once 'core/lang.php';


$stmt = $pdo->prepare(
    'SELECT * FROM position WHERE `status` = 1',
);
$stmt->execute();
$positions = $stmt->fetchAll(PDO::FETCH_ASSOC);

function get_candidate($pdo, $id_position){
  $stmt = $pdo->prepare(
    'SELECT * FROM candidates WHERE `id_position` = ?',
  );
  $stmt->execute([$id_position]);
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Check if user is logged in
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header('Location: auth');
    exit();
}


// If role is not set or is not 'user', 'admin' or 'super_admin', log out
if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], ['user', 'admin', 'super_admin'])) {
    header('Location: core/logout');
    exit();
}


include 'includes/header.php';
?>

<div class="index-container">
  <div class="index-content">
    <div class="logo">
      <span class="logo-text-white"><?php echo t('logo_text', 'Sécurité et transparence dans votre vote...') ?></span>
      <span class="logo-text-green"><?php echo t('logo_text_technic', 'Propulsé par le Web3') ?></span>
    </div>
    <?php if(count($positions) > 0): ?>
      <div class="Elected-positions" id="elected-positions">
        <span class="title-elected-positions"><?php echo t('the_elected_positions', 'Les postes élus sont :') ?></span>
        <?php foreach($positions as $position): ?>
          <span class="label-elected-position" data-id="<?= $position['id']; ?>" onclick="showCandidateList(<?= $position['id']; ?>, <?= '\''.$current_lang.'\''; ?>, <?= $_SESSION['user_id'] ?>)"><?php echo $position[$current_lang.'_name']; ?></span>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <span class="any-election"><?php echo t('any_position', 'Sécurité et transparence dans votre vote...') ?></span>
    <?php endif; ?>

    <div class="list-vote-modal" id="list-vote-modal">
      <span class="form-vote-label"><?php echo t('vote_label', 'Votez maintenant !!') ?></span>
        <ul id="list-vote">
          
        </ul>
      <br>
      <div class="button-form" id="btn-form">
        <button id="vote-btn"><?php echo t('vote_button', 'Voter') ?></button>
      </div>
    </div>
  </div>
</div>
<script src="assets/js/utilities/utils.js" defer></script>
<script src="assets/js/pages/index.js" defer></script>
<?php include 'includes/footer.php'; ?>
