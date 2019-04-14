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
if (isset($_REQUEST['logout'])) {
    unset($_SESSION['username']);
    header('Location: /');
    die();
}
if (isset($_REQUEST['command']) && ($_REQUEST['command'] == 'register')) {
    $userController->handleRegistrationPost();
    die();
}
if (isset($_REQUEST['thankyou'])) {
    $data['thank_you'] = 'Thank you for your registration!';
}
if (isset($_REQUEST['password_reset'])) {
    $data['thank_you'] = 'You should receive an email with password reset instructions';
}
view($viewName, $data);