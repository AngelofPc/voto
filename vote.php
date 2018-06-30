<?php
/**
 * Created by PhpStorm.
 * User: O-Temitayo
 * Date: 30/06/2018
 * Time: 07:19
 */

require_once $_SERVER['DOCUMENT_ROOT'].'/voto/core/init.php';
include 'includes/head.php';
if(isset($_POST['submit'])) {
    $username = ((isset($_POST['username']))? sanitize($_POST['username']): '');
    $poll_name = ((isset($_POST['poll_name']))? sanitize($_POST['poll_name']): '');
    $candidate = ((isset($_POST['candidate']))? sanitize($_POST['candidate']): '');
}
?>

<div class="col-md-4"></div>
<div class="col-md-4">
    <form action="vote.php" method="post" class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username" id="username">
        <label for="poll_name">Poll Name</label>
        <input type="text" class="form-control" name="poll_name" id="poll_name">
        <label for="candidates">Candidates</label><br>
        <input type="checkbox" name="candidate" id="poll_name"><br>
        <input type="submit" class="btn btn-success" name="submit">
    </form>
</div>
<div class="col-md-4"></div>