<?php if (!defined('FLUX_ROOT')) exit; ?>
<!doctype html><html lang="en"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo htmlspecialchars(Flux::config('SiteTitle')); if(isset($title)) echo ': '.htmlspecialchars($title) ?></title>
<link rel="icon" href="./favicon.ico">
<link rel="stylesheet" href="<?php echo $this->themePath('css/flux.css') ?>">
<link rel="stylesheet" href="<?php echo $this->themePath('css/flux/unitip.css') ?>">
<link rel="stylesheet" href="<?php echo $this->themePath('css/ro-custom.css') ?>?v=20261108-custom-theme-2">
<?php if(Flux::config('EnableReCaptcha')): ?><script src="https://www.google.com/recaptcha/api.js"></script><?php endif ?>
</head><body class="ro-site">
<header class="ro-site-header">
<a class="ro-brand" href="<?php echo $this->basePath ?>"><span class="ro-brand-mark">✦</span><span><strong><?php echo htmlspecialchars(Flux::config('SiteTitle')) ?></strong><small>RUNE MIDGARD COMMUNITY</small></span></a>
<button class="ro-menu-toggle" id="ro-menu-toggle" type="button" aria-expanded="false" aria-controls="ro-main-nav"><i></i><i></i><i></i><b>MENU</b></button>
<nav class="ro-main-nav" id="ro-main-nav" aria-label="Main navigation">
<a class="ro-nav-home" href="<?php echo $this->basePath ?>">Home</a>
<a class="ro-nav-home" href="<?php echo htmlspecialchars($this->basePath) ?>blackjack-preview.php">Blackjack</a>
<?php $menuItems=$this->getMenuItems(); if(!empty($menuItems)): foreach($menuItems as $menuCategory=>$menus): if(!empty($menus)): ?>
<details class="ro-nav-group"><summary><?php echo htmlspecialchars(Flux::message($menuCategory)) ?> <span>⌄</span></summary><div class="ro-nav-dropdown">
<?php foreach($menus as $menuItem): if (($menuItem['module'] ?? '') === 'account' && in_array(($menuItem['action'] ?? ''), array('create','login'), true)) continue; ?><a href="<?php echo htmlspecialchars($menuItem['url'],ENT_QUOTES,'UTF-8') ?>"><?php echo htmlspecialchars(Flux::message($menuItem['name'])) ?></a><?php endforeach ?>
</div></details>
<?php endif; endforeach; endif ?>
<?php $adminMenuItems=$this->getAdminMenuItems(); if(!empty($adminMenuItems) && Flux::config('AdminMenuNewStyle')): ?>
<details class="ro-nav-group"><summary>Administration <span>⌄</span></summary><div class="ro-nav-dropdown">
<?php foreach($adminMenuItems as $menuItem): ?><a href="<?php echo $this->url($menuItem['module'],$menuItem['action']) ?>"><?php echo htmlspecialchars(Flux::message($menuItem['name'])) ?></a><?php endforeach ?>
</div></details><?php endif ?>
</nav></header>
<main class="ro-shell">
<div class="ro-page-topline"><span>✦ ADVENTURE · COMMUNITY · LEGACY</span><span class="ro-site-state">WEBSITE ONLINE · GAME SERVER NOT YET CONNECTED</span></div>
<?php if(Flux::config('DebugMode') && @gethostbyname(Flux::config('ServerAddress'))=='127.0.0.1'): ?><p class="notice">Please change your <strong>ServerAddress</strong> directive in your application config to your server's real address.</p><?php endif ?>
<?php if($message=$session->getMessage()): ?><p class="message"><?php echo htmlspecialchars($message) ?></p><?php endif ?>
<?php include $this->themePath('main/submenu.php',true) ?>
<?php include $this->themePath('main/pagemenu.php',true) ?>
