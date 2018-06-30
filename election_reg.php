<?php
/**
 * Created by PhpStorm.
 * User: AngelofPc
 * Date: 6/30/2018
 * Time: 8:32 AM
 */


include "core/init.php";
include "includes/head.php";
include "includes/nav.php";

$election_id = rand(10,1000);
$query = $db->query("SELECT * FROM election WHERE user_id = '$user_id'");
$user_data = mysqli_fetch_assoc($query);
echo $user_data['election_email'];


if ($_POST){
    $election_id = md5($election_id);
    $electionName = sanitize($_POST['election_name']);
    $electionEmail = sanitize($_POST['election_email']);
    $electionPolls = sanitize($_POST['gridRadios']);
    $pollStart = pretty_date($_POST['poll_start']);
    $pollStop = pretty_date($_POST['poll_stop']);






    //Validation
    $errors = array();

    if (!filter_var($electionEmail, FILTER_VALIDATE_EMAIL)){
        $errors[] = 'You must enter a valid email';
    }

    if (!empty($errors)){
        display_errors($errors);
    }else{
        $insertSql = $db->query("INSERT INTO election(`election_id`, `user_id`, `election_name`, `election_email`, `election_polls`,`poll_start`, `poll_stop`) 
          VALUES ('$election_id', '$user_id', '$electionName','$electionEmail','$electionPolls','$pollStart','$pollStop')");
        if ($insertSql){
             $electEmail = $electionEmail;
            header("Location:create_poll.php");

        }if(!$insertSql){
            echo "false";
            mysqli_error($insertSql);
            die("An Error Occured");
        }
    }
}



?>
<div class="container">
    <h3>Fill out form Details</h3>
    <hr>
  <form action="election_reg.php" method="post">
    <div class="form-group row">
      <label for="inputText" class="col-sm-2 col-form-label">Election Name</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="election_name" id="inputText" placeholder="Election Name">
      </div>
    </div>
      <div class="form-group row">
          <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
          <div class="col-sm-10">
              <input type="email" class="form-control" name="election_email" id="inputEmail3" placeholder="Email">
          </div>
      </div>
      <div class="col-md-2"></div>
      <div class="form-group col-md-4">
          <label for="dateStart">From:</label>
          <input type="datetime-local" name="poll_start" class="form-control" id="dateStart">
      </div>
      <div class="form-group col-md-4">
          <label for="dateStop">TO:</label>
          <input type="datetime-local" title="MM/DD/YYYY 00:00 AM" name="poll_stop" class="form-control" id="dateStop">
      </div>
      <div class="clearfix"></div>
    <!--<div class="form-group row">
      <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
      <div class="col-sm-10">
        <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
      </div>
    </div>
    --><fieldset class="form-group">
      <div class="row">
        <legend class="col-form-legend col-sm-2">Election polls</legend>
        <div class="col-sm-10">
          <div class="form-check">
            <label class="form-check-label">
              <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="1" checked> One
            </label>
          </div>
          <div class="form-check">
            <label class="form-check-label">
              <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="2"> Two
            </label>
          </div>
          <div class="form-check">
            <label class="form-check-label">
              <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="3"> Three
            </label>
          </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="4"> Four
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="5"> Five
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="6"> Six
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="7"> Seven
                </label>
            </div>
        </div>
      </div>
    </fieldset>

    <div class="form-group row">
      <div class="col-sm-10">
        <button type="submit" class=" pull-right btn btn-primary">Create</button>
      </div>
    </div>
  </form>
</div>