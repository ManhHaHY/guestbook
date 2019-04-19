<?php
require('../bootstrap.php');

use App\Services\AuthService;
use App\Controllers\IndexController;
use App\Controllers\AdminController;

$auth = new AuthService();
$indexController = new IndexController();
$adminController = new AdminController();

// view data
$data = null;
$viewName = 'home';

// build login page
if (isset($_REQUEST['login']) && (! isset($_SESSION['username']))) {
    $viewName = 'login';
}

if(isset($_REQUEST['submit-login'])){
	$formData = $_POST;
	$authResult = $auth->authUser($formData);
	if($authResult != false && $authResult['success'] == true){
		header('Location: /');
	}
	header('Location: /?login');
}

if (isset($_REQUEST['logout'])) {
    unset($_SESSION['username']);
    header('Location: /');
    die();
}

if (isset($_REQUEST['password_reset'])) {
    $data['thank_you'] = 'You should receive an email with password reset instructions';
}

if($viewName == 'home' && !isset($_REQUEST['page'])){
	$data = $indexController->getMessage();
}

if (isset($_REQUEST['page'])) {
	$page = $_REQUEST['page'];
	if (is_numeric($page) && $_REQUEST['page'] > 0) {
		$data = $indexController->getMessage($page);
	}else{
		$data = $indexController->getMessage();
	}
}

if(isset($_REQUEST['add-message'])) {
	$formData = $_POST;
	$indexController->addMessage($formData);
}

if(isset($_REQUEST['delete-message'])) {
	$formData = $_POST;
	$adminController->deleteMessage($formData);
}

view($viewName, $data);