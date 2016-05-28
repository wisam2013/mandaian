<?php

    session_start();
    // index.php file  
    include_once("/var/www/Menday/mvc/model/model.php");  
    include_once("/var/www/Menday/mvc/controller/router.php");  
    include_once("/var/www/Menday/mvc/view/template.php");
    
    $controller=$_REQUEST['controller'];
    $action=$_REQUEST['action'];
    $id=$_REQUEST['id'];

    /*
    if (isset($controller) &&  isset($action) )
    {
        //echo "_GET var is set!";
        //var_dump($_REQUEST);
    } else
    {
        echo "NO WAY JOSE";
        exit(1);
    }
    */

    $router = new Router($controller, $action, ["id"=>$id]);
    $view = $router ->createView();
    echo $view->render();

?>