<?php
/**
 * Created by PhpStorm.
 * User: AngelofPc
 * Date: 6/29/2018
 * Time: 7:41 PM
 */

include "includes/head.php";
?>


<div class="container-fluid">
    <div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
<form action="register.php" method="post">
    <div class="form-group">
        <label for="name">Full Name:</label>
        <input type="text" name="name" class="form-control" id="name">
    </div>

    <div class="form-group">
        <label for="email">Email address:</label>
        <input type="email" name="email" class="form-control" id="email">
    </div>
    <div class="form-group">
        <label for="pwd">Password:</label>
        <input type="password" name="password" class="form-control" id="pwd">
    </div>
    <!--<div class="checkbox">
        <label><input type="checkbox"> Remember me</label>
    </div>-->
    <button type="submit" class="btn btn-default">Submit</button>
</form>
</div>

<div class="col-md-4"></div>
    </div>
</div>