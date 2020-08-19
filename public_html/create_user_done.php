<?php
require_once(__DIR__ .'/header.php');
$app = new Bbs\Controller\CreateUser();
$app->run();


require_once(__DIR__ .'/footer.php');