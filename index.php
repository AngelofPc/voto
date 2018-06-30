<?php
require_once "core/init.php";
if(!is_logged_in()){
header('Location: login.php');
    login_error_redirect();
}
    include('includes/head.php');
    include('includes/nav.php');
?>