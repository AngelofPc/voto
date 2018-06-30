<?php
/**
 * Created by PhpStorm.
 * User: O-Temitayo
 * Date: 30/06/2018
 * Time: 00:18
 */
function NewUser(){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = "INSERT INTO users (name,email,password) VALUES ('$name','$email','$password')";
    $data = mysqli_query($query)or die(mysqli_error());
    if($data){
        echo '<div class="bg-success"><p class="text-success text-center">Your registeration is completed</p></div>';
    }
}

function SignUp(){
    if(!empty($_POST['email'])){
        $query = mysqli_query("SELECT * FROM users WHERE email = '$_POST[email]' AND password = '$_POST[password]'") or die(mysqli_error());
        if(!$row = mysqli_fetch_array($query) or die(mysqli_error())){
            newuser();
        }else{
            echo '<div class="bg-danger"><p class="text-danger text-center">Sorry... You are already a registered member</p></div>';
        }
    }
    if(isset($_POST['submit'])){
        SignUp();
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
                <label for="confirm">Confirm Password:</label>
                <input type="password" name="confirm" class="form-control" id="confirm">
            </div>
            <!--<div class="checkbox">
                <label><input type="checkbox"> Remember me</label>
            </div>-->
            <button type="submit" class="btn btn-success">Submit</button>
        </div>

        <div class="col-md-4"></div>
    </div>
</div>
