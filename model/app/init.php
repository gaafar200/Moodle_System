<?php
spl_autoload_register(function ($class_name){
    require "../app/models/" . ucfirst($class_name) . ".class.php" ;
});

include "../app/core/functions.php";
include "../app/core/app.php";
include "../app/core/config.php";
include "../app/core/controller.php";
include "../app/core/database.php";
include "../app/core/Model.php";
include "../app/core/SQuestion.php";
