<?php 
require 'header.php';

require 'condb.php';

global connect;

$connect = mysqli_connect('localhost', 'id18044425_vinthink1', '241432679vV!', 'id18044425_vinthink');
function create(){
}

function read(){
}

function update($table, $id){

  $sql = "UPDATE $table SET col_a = '$col_a', col_b = '$col_a', col_c = '$col_c' WHERE id = $id ";
  $qr = mysqli_query($connect, $sql);
  header('location:page.php?id='.$id);
}

function delete(){
}

function get_id_post(){
}

function get_id_categories(){

}
 ?>
