<?php 
// require_once 'db.php'; 

/*
$qr = function ($connect, $sql) {
    return mysqli_query($connect, $sql);
};

function insert($connect, $table) {
    $into = implode(",", array_keys($table));
    $value = implode("','", array_values($table));
    
    $sql = "INSERT INTO $table($into) VALUES ('$value')";
    
    $qr($connect, $sql);
    // Hoặc bạn có thể gán kết quả vào biến khác:
    // $result = $qr($connect, $sql);
}
*/

function insert ($connect, $table ){
    
    $into = implode (",", array_keys ($table));
    $value = implode ("','", array_values($table));
    
    $sql = "INSERT INTO $table($into ) VALUES ('$value')";
    
    
   $qr = mysqli_query($connect, $sql);
}

function allPost($connect, $order = 'DESC'){
     $sql = "SELECT * FROM tittle ORDER BY tittle_id  $order ";
     $qr = mysqli_query($connect, $sql);
     $datas =[];
     while ($f_a =mysqli_fetch_array($qr)){
      $datas[] =$f_a;
      
       }

      return $datas;
}

function createPost($connect, $tieude, $mota){
    $sql = "INSERT INTO tittle (tieude, mota) VALUE ('$tieude', '$mota')";
    $qr = mysqli_query($connect, $sql);
}
function postDetail($connect, $where){
    $sql = "SELECT * FROM tittle WHERE tittle_id = '$where'";
    $qr = mysqli_query($connect, $sql);
    $datas =[];
    while ($f_a = mysqli_fetch_array($qr)){
        $datas[] = $f_a;
    }
    return $datas;
}

function deletePost($connect, $where){
    $sql = "DELETE FROM tittle WHERE tittle_id = '$where'";
    
    $qr = mysqli_query($connect, $sql);
}
function updatePost($connect, $where, $tieude, $mota ){
    $sql = " UPDATE tittle SET tieude = '$tieude', mota = '$mota' WHERE tittle_id = '$where' ";
    $qr = mysqli_query($connect, $sql);
    
}
function createCategory($connect, $categoryTable){
    $into = implode (",", array_keys($categoryTable));
    $value = implode ("','",array_values($categoryTable));
    $sql = "INSERT INTO category ($into) VALUES ('$value')";
    $qr = mysqli_query($connect, $sql);
}

   function allCategory($connect, $where =null ){
       $sql = "SELECT * FROM category ";
   //$qr = mysqli_query($connect, $sql);
       
      
       if($where){
          $sql .= "WHERE category_id = '$where' ";
       }
     $qr = mysqli_query($connect, $sql);
       
       $datas =[];
        while ($f_a = mysqli_fetch_array ($qr)){
           $datas[] = $f_a ;
       }
       return $datas;
   }
?> 
