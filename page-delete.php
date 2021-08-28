<?php
/*
Template Name: Шаблон страницы удаления
Template Post Type: page
*/

if( isset( $_POST['product_id']) & isset( $_POST['home'])) {
    $id = $_POST['product_id']; 
    wp_delete_post($id);
    wp_redirect( $_POST['home']);  
    exit;
} else {
    wp_redirect( get_home_url('/'));  
    exit;
}