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