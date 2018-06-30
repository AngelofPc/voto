<?php
/**
 * Created by PhpStorm.
 * User: O-Temitayo
 * Date: 30/06/2018
 * Time: 03:25
 */
require_once $_SERVER['DOCUMENT_ROOT'].'/voto/core/init.php';
unset($_SESSION['SBUser']);
header('Location: login.php');