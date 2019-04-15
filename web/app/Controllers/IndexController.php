<?php
namespace App\Controllers;

use App\Models\VisitorMessage;

/**
 * Index Controller
 */
class IndexController
{
	private $message;

    public function __construct()
    {
        $this->message = new VisitorMessage();
    }


    public function getMessage($page = 1)
    {
    	$messages = $this->message->getMessages($page);
    	return $messages;
    }
}
