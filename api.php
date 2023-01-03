<?php
error_reporting(E_ALL ^ E_DEPRECATED);

require_once 'database.php';
require_once 'model/User.php';
require_once 'dao/UserManager.php';
require_once 'model/Message.php';
require_once 'dao/MessageManager.php';
require_once 'functions.php';

// action handler
if(isset($_POST['action']) ){
    $call = $_POST['action'];
    if (function_exists($call)){
      call_user_func($call);
    }

}



function signup(){
    global $db;
    // Validate the form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $profileImage = $_FILES['profile_image']['tmp_name'];
    $dateOfBirth = $_POST['date_of_birth'];

    // Hash the password
    $passwordHash = md5($password);
    $userManager = new UserManager($db);
    $existingUser = $userManager->getByUsername($username);

    if ($existingUser) {
        // Return an error message
        echo json_encode([
            'success' => false,
            'error' => 'Username already exists'
        ]);
    } else {
        // Get the image file's extension
        $imageFileExtension = pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION);

        // Generate a random string for the image file name
        $imageFileName = randomString(32) . '.' . $imageFileExtension;

        // Hash the username to use as the folder name
        $usernameHash = md5($username);

        // make the directory if it doesn't exist
        if (!file_exists("uploads/users/$usernameHash")) {
            mkdir("uploads/users/$usernameHash", 0777, true);
        }

        // Move the image file to the uploads folder
        move_uploaded_file($profileImage, "uploads/users/$usernameHash/$imageFileName");

        $user = new User(null, $username, $passwordHash, "uploads/users/$usernameHash/$imageFileName", null, $dateOfBirth);
        $userManager->create($user);
        logon_user($user);
        // Return a success message
        echo json_encode(['success' => true]);
    }
}

function login(){
    global $db;
    $username = $_POST['username'];
    $password = $_POST['password'];

    $userManager = new UserManager($db);
    $user = $userManager->getByUsernameAndPassword($username, $password);

    if ($user) {
        // Create a session for the user
        logon_user($user);
        // Return a success message
        echo json_encode(['success' => true]);
    } else {
        // Return an error message
        echo json_encode([
            'success' => false,
            'error' => 'Invalid username or password'
        ]);
    }
}

function logout() {
    error_log('logout function called');
    unset($_SESSION['user']);
    $_SESSION['loggedIn'] = false;
    echo json_encode(['success' => true]);
}