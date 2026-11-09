<?php
if (!defined('FLUX_ROOT')) exit;

// Authentication is disabled while the site is in public preview mode.
$title = 'Login Temporarily Disabled';
?>
<section class="ro-preview-notice">
  <h2>Login Temporarily Disabled</h2>
  <p>Player login is temporarily unavailable while the Ragnarok game server and login database are being prepared.</p>
  <p>The public website preview remains available. Please check back when account services are enabled.</p>
  <p><a href="<?php echo $this->basePath ?>">Return to homepage</a></p>
</section>
