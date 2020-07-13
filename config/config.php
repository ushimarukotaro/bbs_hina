<?php
ini_set("display_errors", 1);
define("DSN", "mysql:host=localhost;charset=utf8;dbname=bbs");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "root");
//define("SITE_URL", "http://" . $_SERVER["HTTP_HOST"] . "/public.html");

define("SITE_URL", "http://" . $_SERVER["HTTP_HOST"] . "/bbs_hina/public_html"); // 栗岩追記：この部分はご自身の環境によって書き換えが必要です。public_htmlまでのパスがどうなっているかによって　$_SERVER["HTTP_HOST"] 以降の記述が変わります。

require_once(__DIR__ . "/../lib/Controller/functions.php");
require_once(__DIR__ . "/autoload.php");
session_start();
$current_uri = $_SERVER["REQUEST_URI"];
$file_name = basename($current_uri);
if(strpos($file_name,'login.php') !== false || strpos($file_name,'signup.php') !== false || strpos($file_name,'index.php') !== false || strpos($file_name,'public_html') !== false) {
  //URL内のファイル名がlogin.php,signup.php,index.php(public.php)のとき
}
else {
  //　それ以外のとき
  if(!isset($_SESSION['me'])) {
    header('Location: ' . SITE_URL . '/login.php');
    exit();
  }
}


// spl_autoload_register(function ($class) {
//   $prefix = "Bbs\"";
//   if (strpos($class, $prefix) === 0) {
//     $className = substr($class, strlen($prefix));
//     $classFilePath = __DIR__ . "/../" . str_replace("\"", "/", $className) . ".php";
//     if (file_exists($classFilePath)) {
//       require $classFilePath;
//     }
//   }
// });
