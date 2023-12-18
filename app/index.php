<?php


require_once("settings.inc.php");

require_once("ApplicationStart.class.php");

//$whoops = new \Whoops\Run;
//$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
//$whoops->register();

$app = new ApplicationStart();
$app->appStart();

?>
