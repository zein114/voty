<?php
require_once 'core/lang.php'; ?>
<!DOCTYPE html>
<html lang="<?php echo current_lang(); ?>" dir="<?php echo lang_dir(); ?>">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover" />
  <title>Voty</title>
  <link rel="stylesheet" href="assets/css/global.css" />
  <link rel="stylesheet" href="assets/css/utilities/animations.css" />
  <link rel="stylesheet" href="assets/css/utilities/spinner.css" />
  <link rel="stylesheet" href="assets/css/layout/header.css" />
  <link rel="stylesheet" href="assets/css/pages/index.css" />
  <link rel="stylesheet" href="assets/css/pages/profile.css" />
  <link rel="stylesheet" href="assets/css/pages/candidates.css" />
  <link rel="stylesheet" href="assets/css/pages/results.css" />
  <link rel="stylesheet" href="assets/css/pages/vote.css" />
  <link rel="stylesheet" href="assets/css/pages/about.css" />
  <link rel="stylesheet" href="assets/css/pages/contact.css" />
  <link rel="stylesheet" href="assets/css/layout/footer.css" />
  <link rel="icon" type="image/png" href="assets/images/voty.svg" />
  <script src="assets/js/utilities/linkDropdown.js" defer></script>
  <script src="assets/js/layout/header.js" defer></script>
</head>

<body class="page-fade-in">
  <!-- Mobile Header -->
  <header class="mobile-header" role="banner">
    <div class="brand">
      <a href="./"><img src="assets/images/voty.svg" alt="Voty" class="brand-icon" /></a>
    </div>
    <button class="hamburger" aria-label="Menu" aria-expanded="false">
      <span class="hamburger-line"></span>
      <span class="hamburger-line"></span>
      <span class="hamburger-line"></span>
    </button>
  </header>

  <div class="overlay"></div>

  <nav class="mobile-menu" aria-label="Primary">
    <ul class="nav-list">
      <li><a href="./" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>"><?php echo t('home', 'Accueil'); ?></a></li>
      <li><a href="profile.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'profile.php') ? 'active' : ''; ?>"><?php echo t('profile', 'Profile'); ?></a></li>
      <li><a href="candidates.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'candidates.php') ? 'active' : ''; ?>"><?php echo t('candidates', 'Candidats'); ?></a></li>
      <li><a href="results.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'results.php') ? 'active' : ''; ?>"><?php echo t('results', 'Résultats'); ?></a></li>
      <li><a href="about.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'about.php') ? 'active' : ''; ?>"><?php echo t('about', 'À propos'); ?></a></li>
      <li><a href="contact.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'contact.php') ? 'active' : ''; ?>"><?php echo t('contact', 'Contact'); ?></a></li>
      <li><a href="core/logout.php" class="btn-danger"><?php echo t('logout', 'Déconnexion'); ?></a></li>
    </ul>
  </nav>

  <!-- Desktop Header -->
  <header class="app-header" role="banner">
    <div class="brand">
      <a href="./"><img src="assets/images/voty.svg" alt="Voty" class="brand-icon" /></a>
    </div>

    <nav class="primary-nav" aria-label="Primary">
      <ul class="nav-list">
        <li><a href="./" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>"><?php echo t('home', 'Accueil'); ?></a></li>
        <li><a href="candidates.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'candidates.php') ? 'active' : ''; ?>"><?php echo t('candidates', 'Candidats'); ?></a></li>
        <li><a href="results.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'results.php') ? 'active' : ''; ?>"><?php echo t('results', 'Résultats'); ?></a></li>
        <li><a href="about.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'about.php') ? 'active' : ''; ?>"><?php echo t('about', 'À propos'); ?></a></li>
        <li><a href="contact.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'contact.php') ? 'active' : ''; ?>"><?php echo t('contact', 'Contact'); ?></a></li>
      </ul>
    </nav>

    <div class="header-right">
      <div class="profile-dropdown-container link-dropdown-container">
        <button class="avatar profile-trigger link-dropdown-trigger" aria-label="<?php echo t('profile', 'Profil'); ?>" aria-expanded="false"></button>
        
        <div class="profile-dropdown link-dropdown-menu">
          <a href="profile.php" class="dropdown-item">
            <span class="item-icon">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
              </svg>
            </span>
            <span class="item-label"><?php echo t('my_profile', 'Mon profil'); ?></span>
          </a>
          
          <a href="vote.php" class="dropdown-item">
            <span class="item-icon">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
              </svg>
            </span>
            <span class="item-label"><?php echo t('my_votes', 'Mes votes'); ?></span>
          </a>
          
          <a href="core/logout.php" class="dropdown-item dropdown-item-danger" data-loading="true">
            <span class="item-icon">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
              </svg>
            </span>
            <span class="item-label btn-text"><?php echo t('logout', 'Déconnexion'); ?></span>
            <svg class="spinner-svg" viewBox="25 25 50 50">
              <circle r="20" cy="50" cx="50"></circle>
            </svg>
          </a>
        </div>
      </div>
    </div>
  </header>