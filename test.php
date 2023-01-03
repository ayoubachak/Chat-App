<?php 

# import the datebase connection
require_once 'database.php';
require_once 'model/User.php';
require_once 'model/Message.php';
require_once 'dao/UserManager.php';
require_once 'dao/MessageManager.php';



$um = new UserManager($db);
$mm = new MessageManager($db);

$user = new User(null, 'john', 'password', 'profile.jpg', time(), '1990-01-01');
$um->create($user);

$message = new Message(null, 1, 'Hello, how are you doing?', time());
$mm->create($message);