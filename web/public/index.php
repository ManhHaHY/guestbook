<?php
require('../bootstrap.php');

use App\Services\AuthService;
use App\Controllers\IndexController;
use App\Controllers\AdminController;

$auth = new AuthService();

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
view($viewName, $data);