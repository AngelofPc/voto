<?php
/**
 * Created by PhpStorm.
 * User: AngelofPc
 * Date: 6/30/2018
 * Time: 12:12 AM
 */

include "core/init.php";
include "includes/head.php";
include "includes/nav.php";

/*$query = $db->query("SELECT * FROM election WHERE user_id = '$user_id'");
$user_data = mysqli_fetch_assoc($query);
echo $user_data['election_email'];
echo $user_data['election_id'];*/




$pullSql = $db->query("SELECT * FROM election WHERE user_id = '$user_id'");

 $row = mysqli_fetch_assoc($pullSql);

     $electionId =  $row['election_id'];
     $b =  $row['election_polls'];

     $countSql = $db->query("SELECT * FROM polls WHERE election_id = '$electionId' AND created = 1");
$pollCount = mysqli_num_rows($countSql);

if ($pollCount > 1) { ?>

    <h2 class="text-center">My Polls</h2>

    <hr>
    <br>

    <table class=" table table-responsive table-striped table-bordered">
        <thead>
        <th></th>
        <th>Poll Name</th>
        <th>Poll Contestants</th>

        </thead>
        <tbody>
        <?php while ($poll = mysqli_fetch_assoc($countSql)) :
            $optionString = $poll['poll_candidates'];
            $optionString = rtrim($optionString,',');
            global $optionsArray;
            $optionsArray = explode(',',$optionString);
            $cArray = array();

             $arrayNo =  count($optionsArray);
            /*foreach($optionsArray as $cc){
                $c = explode(':',$cc);
                $cArray[] = $c[0];*/






            ?>
            <tr>
                <td>
                    <a href="create_poll.php?edit=<?=$row['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
                    <a href="create_poll.php?delete=<?=$product['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove"></span></a>
                </td>
                <td><?=$poll['poll_name']; ?></td>
                <td>
                    <?php
                    for ($i=1;$i<$arrayNo;$i++) {


                        if (empty($optionsArray[$i])){
                            $optionsArray[$i] = '';
                            }

                            ?>
                             &nbsp;<?php echo $optionsArray[$i]; ?> <i class='fa fa-minus'> </i>
                        <?php
                        }
                        ?>
                        </td>

            </tr>
        <?php   endwhile; ?>
        </tbody>
    </table>




    <?php
}
    else {









if (!empty($options)){
    $optionString = sanitize($options);
    $optionString = rtrim($optionString,',');
    $optionsArray = explode(', ',$optionString);
    $cArray = array();

    foreach($optionsArray as $cc){
        $c = explode(':',$cc);
        $cArray[] = $c[0];

    }
}else {
    $optionsArray = array();
}

if ($_POST){
    $options = $_POST['options'];
     $pollName = sanitize($_POST['poll_name']);



    $errors = array();

    if (!empty($errors)){
        display_errors($errors);
    }else{
        $insertSql = $db->query("INSERT INTO polls(`poll_name`, `election_id`,`poll_candidates`) VALUES ('$pollName','$electionId','$options')");
        if ($insertSql){
            echo "True";

        }else{
            echo "false";
            mysqli_error($insertSql);
            die("An Error Vote");
        }
    }
}




?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">

            <h2 class="text-center">Create Your Poll(s)</h2>
            <hr>
            <p>Your Election <h2><?=$row['election_name'];?></h2> has <?=$row['election_polls'];?> polls</p>
            <form method="post" action="create_poll.php" enctype="multipart/form-data">
            <div class="form-group">
                <label for="poll_name">Name of Poll:</label>
                <input type="text" name="poll_name" class="form-control" id="poll_name">
            </div>




                <div class="form-group col-md-9">

                    <button class="form-control btn btn-info" onclick="jQuery('#optionsModal').modal('toggle');return false;">Choose candidates</button>
                </div>
                <div class="form-group col-md-9">
                    <label for="options">Candidates*:</label>
                    <input type="text" id="options" name="options" class="form-control" value="<?=((isset($options))?$options:'');?>" readonly>
                </div>
                <div class="clearfix"></div>
                <input type="submit" value="Login" class="log-btn btn btn-primary">
            </form>
        </div>
    </div>
</div>





<!-- Modal -->
<div class="modal fade" id="optionsModal" tabindex="-1" role="dialog" aria-labelledby="optionsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="optionsModalLabel">Input Candidate Names</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <?php for ($i=1; $i <= 12; $i++) : ?>
                        <div class="form-group col-md-4">
                            <label for="option<?=$i;?>">Candidate:</label>
                            <input type="text" name="option<?=$i;?>" id="option<?=$i;?>" class="form-control" value="<?=((!empty($cArray[$i-1]))?$cArray[$i-1]:'')?>">
                        </div>

                    <?php endfor; ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="updateOptions();jQuery('#optionsModal').modal('toggle'); return false;">Save changes</button>
            </div>
        </div>
    </div>
</div>





<script>


    function updateOptions() {
        var optionString = '';
        for (var i=1;i<=12;i++){
            if (jQuery('#option'+i).val() !== ''){
                optionString += jQuery('#option'+i).val()+', ';
            }
        }
        jQuery('#options').val(optionString);
    }
</script>

<?php } ?>