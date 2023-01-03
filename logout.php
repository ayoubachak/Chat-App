<?php

// Start the session
session_start();

// Unset the user variable in the session
unset($_SESSION['user']);

// Set the loggedIn variable to false
$_SESSION['loggedIn'] = false;

// Redirect the user back to the login page
header('Location: /');
exit;
