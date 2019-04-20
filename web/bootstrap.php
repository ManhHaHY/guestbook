<?php
// include the Composer autoloader
require_once __DIR__ . '/vendor/autoload.php';
// include config
require_once '../config.php';
// Start session
session_start();

function view($title, $data = null)
{
    $filename = __DIR__ . '/app/views/' . $title . '.php';
    if (file_exists($filename)) {
        include($filename);
    } else {
        throw new Exception('View ' . $title . ' not found!');
    }
}