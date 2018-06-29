<?php
/**
 * Created by PhpStorm.
 * User: O-Temitayo
 * Date: 29/06/2018
 * Time: 20:47
 */
$db = mysqli_connect('127.0.0.1', 'root', '', 'voto');
if(mysqli_connect_errno()){
    echo 'Database connection failed with the following errors: '.mysqli_connect_error();
    die();
}
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/voto/config.php';

if(isset($_SESSION['success_flash'])){
    echo '<div class="bg-success"><p class="text-success text-center">'.$_SESSION['success_flash'].'</p></div>';
    unset($_SESSION['success_flash']);
}
if(isset($_SESSION['error_flash'])){
    echo '<div class="bg-danger"><p class="text-danger text-center">'.$_SESSION['error_flash'].'</p></div>';
    unset($_SESSION['error_flash']);
}
