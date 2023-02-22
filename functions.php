<?php 
require_once  'header.php';

require_once 'condb.php';

global $connect;


function qr($sql){
  
}

function create(){
}

function read(){
}

function update($table, $id){
  global $connect;
  $sql = "UPDATE $table SET col_a = '$col_a', col_b = '$col_a', col_c = '$col_c' WHERE id = $id ";
  $qr = mysqli_query($connect, $sql);
  header('location:page.php?id='.$id);
}

function delete(){
}
function get_id_url($id){
    if(isset ($_GET[$id])){
        $id = $_GET[$id];
        echo $id;
    }
}

function get_id_categories(){

}

function get_id_title(){

}
function get_id_user(){
}

function show_all_table(){
global $connect ;
// Lấy danh sách các bảng trong cơ sở dữ liệu
$qr= mysqli_query($connect, "SHOW TABLES");
if (!$qr) {
    die("Lỗi truy vấn cơ sở dữ liệu: " . mysqli_error($connect ));
}

// In tên các bảng
while ($f_a = mysqli_fetch_array($qr)) {
    echo $f_a[0] . "<br>";
  
}

}
function show_column(){
// Lấy tên các cột trong bảng
global $connect ;
$result = mysqli_query($connect, "DESCRIBE chat");


// In tên các cột
while ($row = mysqli_fetch_array($result)) {
    echo $row['Field'] . "<br>";
}
}

function get_row_relations_table($column, $table, $join, $on, $where){
    global $connect ;
    $sql = "SELECT $column * FROM $table JOIN $join  ON $on WHERE $where  ";
    $qr = mysqli_query($connect, $sql) ;
    while ($f_a = mysqli_fetch_array ($qr)){
        echo $f_a['name'].'<br>';
    }
} 
function create_table($table){
    global $connect ;
$sql = "CREATE TABLE $table (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
)";
$qr = mysqli_query($connect, $sql);
if($qr){
    echo "tạo bảng thành công ";
}else {
    echo "tạo bảng thất bại ";
}
}

function current_url(){
$currentUrl = (isset ($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
echo $currentUrl;
}
 ?>

