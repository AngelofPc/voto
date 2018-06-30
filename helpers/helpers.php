<?php
/**
 * Created by PhpStorm.
 * User: O-Temitayo
 * Date: 29/06/2018
 * Time: 23:35
 */
function display_errors($errors){
    $display = '<ul class="bg-danger" style="border-radius: 10px;">';
    foreach($errors as $error){
        $display .= '<li class="text-danger">'.$error.'</li>';
    }
    $display .= '</ul>';
    return $display;
}
function display_success($success)
{
    $displays = '<ul class="bg-danger" style="border-radius: 10px;">';
    foreach ($success as $successe) {
        $displays .= '<li class="text-danger">' . $successe . '</li>';
    }
    $displays .= '</ul>';
    return $displays;
}


function pretty_date($date){
    return date("M d - Y h:i A",strtotime($date));
}
function sanitize($dirty){
    return htmlentities($dirty, ENT_QUOTES, "UTF-8");
}

function login($user_id){
    $_SESSION['SBUser'] = $user_id;

    global $db;
//    $date = date("Y-m-d H:i:s");
//    $db->query("UPDATE users SET last_login = '$date' WHERE id = '$user_id'");
    $_SESSION['success_flash'] = 'You are now logged in!';
    header('Location: index.php');
}

function is_logged_in(){
    if(isset($_SESSION['SBUser']) && $_SESSION['SBUser'] > 0){
        return true;
    }
    return false;
}

function login_error_redirect($url = 'login.php'){
    $_SESSION['error_flash'] = 'You must be logged in to access that page';
    header('Location: '.$url);
}