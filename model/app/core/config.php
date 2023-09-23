<?php
define("WEBSITE_TITLE" , "  ");
$root = $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["SERVER_NAME"] . $_SERVER["PHP_SELF"];
define("ROOT",str_replace("index.php","",$root));
define("ASSETS", ROOT . "assets/");

define("DB_NAME" , "university_model");
define("DB_USER" , "root");
define("DB_PASS" , "123456");
define("DB_TYPE" , "mysql");
define("DB_HOST" , "db");
define("THEME" , "model/");

