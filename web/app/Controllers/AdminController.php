<?php
namespace App\Controllers;

use Src\Services\AuthService;

/**
 * Admin Controller
 */
class AdminController
{
    private $error = null;
    private $errorMessage = null;
    protected $authService = null;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
}
