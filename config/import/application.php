<?php
// Railway deployment overrides. Secrets are read only from process environment.
$installerPassword = getenv('CP_INSTALLER_PASSWORD');
if (!$installerPassword || strlen($installerPassword) < 24) {
    throw new RuntimeException('CP_INSTALLER_PASSWORD must be set to a unique value of at least 24 characters.');
}

return array(
    'ServerAddress'       => getenv('CP_SERVER_ADDRESS') ?: 'localhost',
    'BaseURI'             => '',
    'ForceHTTPS'          => true,
    'InstallerPassword'   => $installerPassword,
    'RequireOwnership'    => false,
    'SiteTitle'           => getenv('CP_SITE_TITLE') ?: 'Ragnarok Online',
    'ThemeName'           => array('default', 'bootstrap', 'custom_theme'),
    'DefaultLanguage'     => 'en_us',
    'DateDefaultTimezone' => 'Asia/Manila',
    'DebugMode'           => false,
    'UseCleanUrls'        => false,
    'UseCaptcha'          => false,
    'UseLoginCaptcha'     => false,
    'AcceptDonations'     => false,
);
