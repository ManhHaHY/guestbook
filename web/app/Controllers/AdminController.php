<?php
namespace App\Controllers;


use App\Models\VisitorMessage;
use App\Models\Admin;

/**
 * Admin Controller
 */
class AdminController
{
	private $message;
	private $admin;

    public function __construct()
    {
    	$this->message = VisitorMessage::getInstance();
    	$this->admin = Admin::getInstance();
    }

    public function getMessage($id)
    {
    	$this->checkAuth();
    	$message = $this->message->getMessage($id);
    	$this->jsonHeader($message);
    }

    public function editMessage($formData)
    {
    	$this->checkAuth();
    	$this->message->update($formData['messageId'], [
    		'visitor_name' => $formData['visitorName'],
    		'message' => $formData['message']
    	]);
    	$this->jsonHeader([
    		'message' => 'Update message success.',
            'status' => 1,
            'messageData' => $formData,
    	]);
    }

    public function deleteMessage($formData)
    {
    	$this->checkAuth();
    	$this->message->delete($formData['messageId']);
    	$this->jsonHeader([
    		'message' => 'Delete message success.',
    		'status' => 1
    	]);
    }

    private function jsonHeader(array $data, $code = 200)
    {
    	header('Content-Type: application/json');
    	http_response_code($code);
    	echo json_encode($data);exit;
    }

    private function checkAuth()
    {
    	if (!isset($_SESSION['username'])){
    		$this->jsonHeader([
    			'error' => 'You need sign in to use this action!!!',
    			'status' => 0
    		], 401);
    	}
    }
}
