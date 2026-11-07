<?php
// The same MariaDB database is used for game and web tables initially.
// rAthena SQL schema must be imported before using account/character modules.
$required = array('DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASSWORD');
foreach ($required as $key) {
    if (getenv($key) === false || getenv($key) === '') {
        throw new RuntimeException($key . ' is required.');
    }
}

$db = array(
    'Hostname'   => getenv('DB_HOST'),
    'Port'       => (int)(getenv('DB_PORT') ?: 3306),
    'Username'   => getenv('DB_USER'),
    'Password'   => getenv('DB_PASSWORD'),
    'Database'   => getenv('DB_NAME'),
    'Persistent' => false,
    'Encoding'   => 'utf8mb4',
);

return array(
    array(
        'ServerName'   => getenv('RO_SERVER_NAME') ?: 'Ragnarok Online',
        'DbConfig'     => $db,
        'LogsDbConfig' => $db,
        'WebDbConfig'  => $db,
        'LoginServer'  => array(
            'Address' => getenv('LOGIN_SERVER_ADDRESS') ?: '127.0.0.1',
            'Port'    => (int)(getenv('LOGIN_SERVER_PORT') ?: 6900),
            'UseMD5'  => false,
            'NoCase'  => true,
            'GroupID' => 0,
        ),
        'CharMapServers' => array(
            array(
                'ServerName'   => getenv('RO_SERVER_NAME') ?: 'Ragnarok Online',
                'Renewal'      => filter_var(getenv('RO_RENEWAL') ?: 'true', FILTER_VALIDATE_BOOLEAN),
                'MaxCharSlots' => 9,
                'ExpRates'     => array('Base' => 100, 'Job' => 100, 'Mvp' => 100),
                'DropRates'    => array(
                    'DropRateCap' => 9000,
                    'Common' => 100, 'CommonBoss' => 100, 'CommonMVP' => 100,
                    'CommonMin' => 1, 'CommonMax' => 10000,
                    'Heal' => 100, 'HealBoss' => 100, 'HealMVP' => 100,
                    'HealMin' => 1, 'HealMax' => 10000,
                    'Useable' => 100, 'UseableBoss' => 100, 'UseableMVP' => 100,
                    'UseableMin' => 1, 'UseableMax' => 10000,
                    'Equip' => 100, 'EquipBoss' => 100, 'EquipMVP' => 100,
                    'EquipMin' => 1, 'EquipMax' => 10000,
                    'Card' => 100, 'CardBoss' => 100, 'CardMVP' => 100,
                    'CardMin' => 1, 'CardMax' => 10000,
                    'MvpItem' => 100, 'MvpItemMin' => 1, 'MvpItemMax' => 10000,
                    'MvpItemMode' => 0,
                ),
                'CharServer' => array(
                    'Address' => getenv('CHAR_SERVER_ADDRESS') ?: '127.0.0.1',
                    'Port' => (int)(getenv('CHAR_SERVER_PORT') ?: 6121),
                ),
                'MapServer' => array(
                    'Address' => getenv('MAP_SERVER_ADDRESS') ?: '127.0.0.1',
                    'Port' => (int)(getenv('MAP_SERVER_PORT') ?: 5121),
                ),
                'WoeDayTimes' => array(),
                'WoeDisallow' => array(),
            ),
        ),
    ),
);
