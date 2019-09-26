<?php 

function isLoggedIn(){

    $ci = get_instance();
    
    if($ci->session->userdata('user')){
        return true;
    } else {
        return false;
    }
}

function formatPrice($price, $prefix = 'Rp'){
    return $prefix . '. ' . number_format((float)$price,0, ',' , '.');
}

function convertToKg($val){
    return (int)$val / 1000 . ' KG';
}