<?php
require_once(__DIR__ . '/header.php');
$app = new Bbs\Controller\UserEditDone();
$app->run();
var_dump($_POST['username' . $_POST['id']]);

require_once(__DIR__ . '/footer.php');
