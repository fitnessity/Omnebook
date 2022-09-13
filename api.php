<?php
error_reporting(1);
/*require_once('buddy/wp-load.php');
global $wpdb;
if($_POST){
   
 $s = wp_create_user( $_POST['user_login'], $_POST['buddy_key'],'');

 if($_POST['role']=='business'){
$role = 2;
 }else{
    $role = 1;
 }
 $table_name = $wpdb->prefix.'users';
$data_update = array('custom_role' => $role );
$data_where = array('ID' => $s);
$wpdb->update($table_name , $data_update, $data_where);
return $s;
}*/