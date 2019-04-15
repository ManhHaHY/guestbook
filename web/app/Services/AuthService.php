<?php
namespace App\Services;

use App\Models\Admin;

class AuthService
{
    private $adminModel;

    public function __construct()
    {
        $this->adminModel = new Admin();
    }

    public function authUser($formData)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = $this->adminModel->checkAuthentication($formData['email'], md5($formData['password']));
            if (!empty($auth) && isset($auth['username'])) {
                $_SESSION['username'] = $auth['username'];
                $result['success'] = true;
                return $result;
            }else{
                return false;
            }
        }
    }

    public function resetPassword($userId)
    {
    }
}