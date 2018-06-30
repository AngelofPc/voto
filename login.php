<?php
/**
 * Created by PhpStorm.
 * User: O-Temitayo
 * Date: 30/06/2018
 * Time: 02:36
 */


require_once $_SERVER['DOCUMENT_ROOT'].'/voto/core/init.php';
include "includes/head.php";
$email = stripslashes((isset($_POST['email']))?sanitize($_POST['email']):'');
$email = trim($email);
$password = stripslashes((isset($_POST['password']))?sanitize($_POST['password']):'');
$password = trim($password);
$errors = array();

if($_POST){
    //form validation
    if(empty($_POST['email']) || empty($_POST['password'])){
        $errors[] = 'You must provide email and password.';
    }

    // validate email
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $errors[] = 'You must enter a valid email';
    }

    // password is more than 6 characters
    if(strlen($password) < 6 ){
        $errors[] = 'Password must be at least 6 characters.';
    }

    // check if email exists in the database
    $query = $db->query("SELECT * FROM users WHERE email = '$email'");
    $user = mysqli_fetch_assoc($query);
    $userCount = mysqli_num_rows($query);
    if($userCount < 1){
        $errors[] = 'That email doesn\'t exist in our database';
    }

    if(!password_verify($password, $user['password'])){
        $errors[] = 'The password does not match our records. Please try again.';
    }

    //check for errors
    if(!empty($errors)){
        echo display_errors($errors);
    }else{
        // log user in
        $user_id = $user['id'];
        login($user_id);
    }
    if(isset($_POST['rememberMe']))
    {
        setcookie('$email',$_POST['email'], time()+30*24*60*60); // 30 days
        setcookie('$password', $_POST['password'],time()+30*24*60*60); // 30 days
        $_SESSION['curemail']=$email;
        $_SESSION['curpassword']=$password;

        $user = $query->fetch_assoc();
        $_SESSION['user_id'] = $user['user_id'];

        header("Location:index.php");
        exit;
    }
    else
    {
        $log1=11;
        $_SESSION['log1'] = $log1;
        $_SESSION['curemail']=$email;
        $_SESSION['curpassword']=$password;

        $user = $query->fetch_assoc();
        $_SESSION['user_id'] = $user['user_id'];

        header("Location:index.php");
        exit;
    }
}
?>
<div class="col-md-4"></div>
<div class="col-md-4" id="login-form">
    <h2 class="text-center">Login Here</h2><hr style="color:blue;">
<form action="login.php" method="post">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" class="form-control" value="<?= $email; ?>">
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" class="form-control" value="<?= $password; ?>">
        </div>
        <div class="checkbox">
            <label><input type="checkbox" name="rememberMe"> Remember me</label>  |
            You don't have an account? Register <a href="register.php">Here</a>
        </div>
        <div class="form-group">
            <input type="submit" value="Login" class="btn btn-success">
        </div>
    </form>
<div class="col-md-4"></div>