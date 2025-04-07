<?php
header('Expires: Sat, 03 Aug 2013 00:00:00 GMT');
header('Last-Modified: ' . gmdate( 'D, d M Y H:i:s') . ' GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');

include './app/config/config.php';
//$pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
$pdo = getDbConnection();
if($_GET['page'] == 'portfolio'){
    require_once __DIR__.'/app/models/Portfolio.php';
    require_once __DIR__.'/app/controllers/PortfolioController.php';


    $portfolioModel = new Portfolio($pdo);
    $portfolioController = new PortfolioController($portfolioModel);

    $id = $_GET['id'] ?? 1; // Замените на необходимый метод получения ID
    if ((int)$id < 0) {
        echo $_GET['tag'];
    } else {
        $portfolioController->show($id);
    }
} elseif ($_GET['page'] == 'login'){
    require_once __DIR__.'/app/models/User.php';
    require_once __DIR__.'/app/controllers/AuthController.php';
    $authController = new AuthController($pdo);
    $authController->login();
} elseif ($_GET['page'] == 'dashboard'){
    require_once __DIR__.'/app/controllers/DashboardController.php';
    $authController = new DashboardController($pdo);
    $authController->show();
} elseif ($_GET['page'] == 'form'){
    if(!isset($_COOKIE["customerUserId"])){
        header("location: /login/fromForm");
    }
    if(isset($_GET['formName']) && $_GET['formName'] != ''){
        require_once __DIR__.'/app/controllers/FormController.php';
        $formController = new FormController($pdo, $_GET['formName']);
        $formController->show($pdo);
    } else {
        header('Location: /');
    }
} else if($_GET['page'] == 'customerSignup'){
    if(isset($_COOKIE["customerUserId"])){
        header('Location: /');
    }
    require_once __DIR__.'/app/controllers/CustomerRegistrationController.php';
    $customerLoginController = new CustomerRegistrationController($pdo);
    $customerLoginController->show();
} else if($_GET['page'] == 'customerLogin'){
    if(isset($_COOKIE["customerUserId"])){
        header('Location: /');
    }
    require_once __DIR__.'/app/controllers/CustomerLoginController.php';
    $customerLoginController = new CustomerLoginController($pdo,  $_GET['redirect'] ?? '');
    $customerLoginController->show();
}