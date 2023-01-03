<?php


require_once 'database.php';
require_once 'model/User.php';
require_once 'dao/UserManager.php';
require_once 'model/Message.php';
require_once 'dao/MessageManager.php';

function is_user_logged_in(){
    if(!isset($_SESSION)) session_start();
    return isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'];

}

function get_the_user(){
    if(!isset($_SESSION)) session_start();
    return $_SESSION['user'];
}

function logon_user($user){
    if(!isset($_SESSION)) session_start();
    $_SESSION['user'] = $user;
    $_SESSION['loggedIn'] = true;
}

function randomString($n){

    $characters = '0123456789'.'abcdefghijklmnopqrstuvwxyz'.strtoupper('abcdefghijklmnopqrstuvwxyz');
    $str = '';
    for ($i =0 ; $i<$n; $i++){
        $index = rand(0, strlen($characters)-1);
        $str .= $characters[$index];
    }
    return $str;
}