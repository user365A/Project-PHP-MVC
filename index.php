
<?php

require_once './Core/Database.php';
require_once './Core/BaseModel.php';
require_once './Core/session.php';
require_once './Core/Request.php';
require_once './Core/BaseController.php';

if(isset($_REQUEST['controller'])){
    $controllerName=ucfirst((strtolower($_REQUEST['controller']).'Controller'));
}
else{
    $controllerName='HomeController';
}

$actionName=$_REQUEST['action'] ?? 'index';

require './Controllers/'.$controllerName.'.php';

$controllerAction= new $controllerName();

$controllerAction->$actionName();


?>




