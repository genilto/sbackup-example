<?php

// Validate User Auth
// ...

require_once ( __DIR__ . '/backup.config.php' );

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title><?php echo $SBackup->getAdapterName(); ?> - Authentication</title>
</head>
<body>
    <div style="padding: 50px; text-align: center; max-width: 500px; margin: auto;">
        <h1 style="padding: 20px;">SBackup <small>Configuration</small></h1>
<?php
    /**
     * @var SBackup $SBackup
     */
    $SBackup->authorizationFlow();
?>
    </div>
    <div style="padding: 10px; text-align: center;">
		<a href="index.php">Back</a>
	</div>
</body>
</html>