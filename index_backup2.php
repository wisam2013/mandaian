<?php

    session_start();
    // index.php file  
    include_once("/var/www/Menday/mvc/model/model.php");  
    include_once("/var/www/Menday/mvc/controller/controller.php");  
    include_once("/var/www/Menday/mvc/view/template.php");
    
    $model = new model();
    $controller = new Controller($model);
    $controller->invoke();
    $view = new Template($controller);
    echo $view->render('members.inc');
  
?>