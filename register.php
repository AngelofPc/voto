<?php
/**
 * Created by PhpStorm.
 * User: AngelofPc
 * Date: 6/29/2018
 * Time: 7:41 PM
 */
include "core/init.php";
include "includes/head.php";
if(isset($_POST['submit'])) {
    $name = ((isset($_POST['name'])) ? sanitize($_POST['name']) : '');
    if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $errors[] = 'Only Letters and whitespaces are allowed';
    }
    $email = ((isset($_POST['email'])) ? sanitize($_POST['email']) : '');
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
    $password = ((isset($_POST['password'])) ? sanitize($_POST['password']) : '');
    $confirm = ((isset($_POST['confirm'])) ? sanitize($_POST['confirm']) : '');

    if ($_POST) {
        $emailQuery = $db->query("SELECT * FROM users WHERE email = '$email'");
        $emailCount = mysqli_num_rows($emailQuery);

        if ($emailCount != 0) {
            $errors[] = 'That email already exist in our database.';
        }

        $required = array("name", "email", "password");
        foreach ($required as $r) {
            if (empty($_POST[$r])) {
                $errors[] = 'You must fill out all fields';
                break;
            }
        }
        if (strlen($password) < 6) {
            $errors[] = 'Your password must be at least 6 characters';
        }

        if ($password != $confirm) {
            $errors[] = 'Your password do not match';
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'You must enter a valid email';
        }

        if (!empty($errors)) {
            echo displa_errors($errors);
        } else {
            if (isset($_POST['submit'])) {
                $hashed = password_hash($password, PASSWORD_DEFAULT);
                $db->query = ("INSERT INTO users (name,email,password) VALUES('$name','$email','$password')");
            }
        }
    }
}
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <label for="name">Full Name:</label>
                <input type="text" name="name" class="form-control" id="name">

                <div class="form-group">
                    <label for="email">Email address:</label>
                    <input type="email" name="email" class="form-control" id="email">
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" class="form-control" id="password">
                </div>
                <div class="form-group">
                    <label for="confirm">Password:</label>
                    <input type="password" name="confirm" class="form-control" id="confirm">
                </div>
                <!--<div class="checkbox">
                    <label><input type="checkbox"> Remember me</label>
                </div>-->
                <button type="submit" class="btn btn-default">Submit</button>
            </div>

            <div class="col-md-4"></div>
        </div>
    </div>