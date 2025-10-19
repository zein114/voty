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

$result_is_over = false;

// If role is not set or is not 'user' or 'admin', log out
if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], ['user', 'admin'])) {
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
      <?php if($result_is_over): ?>
        <a href="reults.php" class="view-results-or-list-candidates button"><?php echo t('view_result', 'Voir les résultats des élections');?>
        </a>
      <?php else: ?>
          <a href="canditates.php" class="view-results-or-list-candidates button"><?php echo t('view_list', 'Voir la liste des candidats');?>
        </a>
      <?php endif; ?>
    </div>
    
    <div class="Elected-positions" id="elected-positions">
      <span class="title-elected-positions"><?php echo t('the_elected_positions', 'Les postes élus sont :') ?></span>
      <?php foreach($positions as $position): ?>
        <span class="label-elected-position"><?php echo t($position['name'], $position['name']); ?></span>
      <?php endforeach; ?>
    </div>

    <span class="form-vote-label"><?php echo t('vote_label', 'Votez maintenant !!') ?></span>
    <form action="" method="POST" class="form-vote">
      <div class="grid-select-form" id="grid-select-form">
        <?php foreach($positions as $position): ?>
          <div class="select-vote-input">
            <label for="<?php echo 'position_' . $position['id']; ?>"><?php echo t($position['name'], $position['name']); ?></label>
            <select name="<?php echo 'position_' . $position['id']; ?>" id="<?php echo 'position_' . $position['id']; ?>" class="vote-selected">
              <option value=""><?php echo t('input_select_vote' , 'Veuillez sélectionner votre choix'); ?></option>
              <?php 
              $candidates = get_candidate($pdo, $position['id']);
              foreach ( $candidates as $candidate ): 
              ?>
                <option value="<?php  echo $candidate['id']; ?>"><?php if($current_lang == 'ar') { echo $candidate['ar_name']; } else { echo $candidate['name']; } ?></option>
              <?php endforeach; ?>
              
            </select>
          </div>
        <?php endforeach; ?>
      </div>
      <br>
      <div class="button-form">
        <button type="submit"><?php echo t('vote_button', 'Voter') ?></button>
      </div>
    </form>
  </div>
</div>
<script src="assets/js/utilities/utils.js" defer></script>
<script src="assets/js/pages/index.js" defer></script>
<?php include 'includes/footer.php'; ?>
