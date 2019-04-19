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
        $this->message = VisitorMessage::getInstance();
    }

    public function getMessage($page = 1)
    {
    	$limitItems = 9;
        $starting_limit = ($page - 1 ) * $limitItems;
    	$messages = $this->message->getMessages($starting_limit, $limitItems);
    	$totalResults = $this->message->countPagenumber();
        $totalPages = ceil($totalResults / $limitItems);
        $nextPage = ($page == $totalPages ? '' : $page + 1);
        $prevPage = ($page <= 1 ? '' : $page - 1);
    	return [
    		'messages' => $messages,
    		'totalPages' => $totalPages,
    		'currentPage' => $page,
    		'nextPage' => $nextPage,
    		'prevPage' => $prevPage
    	];
    }

    public function addMessage($formData)
    {
        $this->message->create($formData);
        $this->jsonHeader([
            'message' => 'Create new message success.',
            'status' => 1
        ]);
    }

    private function jsonHeader(array $data, $code = 200)
    {
        header('Content-Type: application/json');
        http_response_code($code);
        echo json_encode($data);exit;
    }
}
