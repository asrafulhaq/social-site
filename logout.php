<?php


// Session Destroy system 
session_start();
session_destroy();
setcookie('login_user_cooke_id',  '', time() - (60 * 60 * 24 * 365 * 7));
header('location:index.php');
