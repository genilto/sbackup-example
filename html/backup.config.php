<?php

require_once ( __DIR__ . '/../vendor/autoload.php' );

use \genilto\sbackup\SBackup;
use \genilto\sbackup\adapters\SBackupDropbox;
use \genilto\sbackup\store\FileDataStore;
use \genilto\sbackup\logger\SBLogger;

use \Analog\Analog;
use \Analog\Logger;

// Defines the default timezone
Analog::$timezone = 'America/Sao_Paulo';
date_default_timezone_set(Analog::$timezone);

/**
 *  Define the required APP information
 */
define("DROPBOX_CLIENT_ID", getenv("DROPBOX_CLIENT_ID"));
define("DROPBOX_CLIENT_SECRET", getenv("DROPBOX_CLIENT_SECRET"));
define("SBACKUP_CONFIG_DIR", __DIR__ . '/../');

/**
 * Creates the default logger using Analog as Logger class
 * Any other PSR-3 Logger could be used
 * 
 * @return SBLogger
 */
if (!function_exists('createDefaultLogger')) {
    function createDefaultSBackupLogger () {
        // Creates the Default Logger
        $logger = new Logger();

        // Define where to save the logs
        $currentDate = date("Y-m-d");
        $logger->handler (SBACKUP_CONFIG_DIR . "/logs/$currentDate-sbackup.log");
        return new SBLogger($logger, 3); // 3 - Full Logging
    }
}

/**
 * Instantiate all the required configuration classes
 */

// 
$SBDataStore = new FileDataStore(SBACKUP_CONFIG_DIR . "/config/dropbox-config");

// The logger that will me used
$SBLogger = createDefaultSBackupLogger();

// Create the adapter class that will be used. In this example, a Dropbox adapter
$SBUploader = new SBackupDropbox($SBDataStore, $SBLogger, DROPBOX_CLIENT_ID, DROPBOX_CLIENT_SECRET);

// The main SBackup class that will the available to be used
$SBackup = new SBackup($SBUploader, $SBLogger);
