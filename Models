<?php 
 require_once 'db.php'; 


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
    return  mysqli_insert_id($connect);
    
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


  function deletePostCategory($connect, $tittle_id){
      $sql = "DELETE tittle, cate_tit FROM tittle LEFT JOIN cate_tit ON tittle.tittle_id = cate_tit.category_id WHERE tittle.tittle_id = '$tittle_id' ";
      $qr = mysqli_query ($connect, $sql);
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
   function addPostCategory($connect, $tittle_id, $category_id){
       $sql = "INSERT IGNORE INTO cate_tit(tittle_id, category_id) VALUES ('$tittle_id', '$category_id')";
       $qr = mysqli_query($connect, $sql);
   }
   
   function categoryDetail($connect, $categoryId){
       $sql = "SELECT * FROM tittle JOIN cate_tit ON tittle.tittle_id  = cate_tit.tittle_id WHERE category_id = '$categoryId'";
       $qr = mysqli_query($connect, $sql);
       $datas =[];
       while ($f_a = mysqli_fetch_array($qr)){
           $datas[]= $f_a;
       }
       return $datas;
   }
   function postInCategory($connect , $tittle_id ){
       $sql = "SELECT * FROM category JOIN cate_tit ON category.category_id = cate_tit.category_id WHERE tittle_id = '$tittle_id'";
       $qr = mysqli_query($connect, $sql);
       $datas =[];
       while($f_a = mysqli_fetch_array($qr)){
           $datas[] = $f_a;
       }
       return $datas ;
   }
   
    function deleteCategory($connect , $id){
       $sql = "DELETE category, cate_tit FROM category  LEFT JOIN cate_tit ON category.category_id = cate_tit.category_id WHERE category.category_id = '$id'";
       $qr = mysqli_query($connect, $sql);
   }
 function selectCategory($connect,$tittle_id ,$category_ids =[]){
     foreach ($category_ids as $category_id){
        
         
         $sql = "INSERT IGNORE INTO cate_tit(tittle_id, category_id) VALUES ('$tittle_id', '$category_id') ";
         $qr = mysqli_query($connect, $sql);
     }
 }
 function updateSelectCategory($connect, $category_id ){
     $categoryArray = allCategory($connect);
     if(in_array($category_id, $categoryArray)){
         return  "checked";
     }
 }
?> 
