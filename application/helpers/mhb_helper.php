<?php 

function isLoggedIn(){

    $ci = get_instance();
    
    if($ci->session->userdata('user')){
        return true;
    } else {
        return false;
    }
}