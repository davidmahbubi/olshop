<?php 

function isLoggedIn(){

    $ci = get_instance();
    
    if($ci->session->userdata('user')){
        return true;
    } else {
        return false;
    }
}


function formatPrice($price, $prefix = 'Rp', $suffix = ',-'){
    return $prefix . '. ' . number_format((float)$price,0, ',' , '.') . $suffix;
}

function convertToKg($val){
    return (int)$val / 1000 . ' KG';
}

function isAdmin(){
    $ci = get_instance();
    if($ci->session->userdata('admin')){
        return true;
    } else{
        return false;
    }
}