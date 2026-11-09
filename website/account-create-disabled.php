<?php
if (!defined('FLUX_ROOT')) exit;

// Registration is intentionally paused while this website is in preview mode.
// This route is blocked server-side as well as hidden from the navigation.
$title = 'Registration Temporarily Disabled';
?>
<section class="ro-preview-notice">
  <h2>Registration Temporarily Disabled</h2>
  <p>Account registration is temporarily unavailable while the Ragnarok game server and login database are being prepared.</p>
  <p>The website preview remains available. Please check back when account services are enabled.</p>
  <p><a href="<?php echo $this->basePath ?>">Return to homepage</a></p>
</section>
