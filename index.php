<?php
require __DIR__ . "/inc/bootstrap.php";

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri);

$validEndPoints = array("login");

// Verify that uri is valid
if (!isset($uri[3]) || !in_array($uri[3], $validEndPoints)) {
    echo($uri[3]);    
    //header("HTTP/1.1 401 Not Found");
    exit();
}

require PROJECT_ROOT_PATH . "/Controller/Api/AuthenticationController.php";

$objFeedController = new AuthenticationController();
switch ($uri[3]) {
    case "login":
        $objFeedController->tryLogin();
        break;
}

?>