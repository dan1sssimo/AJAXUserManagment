<?php
include('config/config.php');
include('core/Core.php');
include('core/DB.php');

$core = \core\Core::getInstance();
$core->init();
$core->run();
$core->done();