<?php 


require_once "db.php"; 

require_once 'functions.php' ; 
require_once "model.php" ; 

$view = getUrlvalue('view');
switch ($view){
    
    case "all-post": //1
       
      
      $datas = allPost($connect);
      mysqli_close($connect);
     require_once "Views/header.php"; 
     require_once 'Views/all-post.php'; 
    // require_once "Views/plus.php"; 
     require_once "Views/footer.php"; 
     
     
    break ;
    
    case "post-detail": //2
        $id = getUrlValue("id-tieude");
        
       $datas = postDetail($connect, $id);
       $datas2 = postInCategory($connect, $id);
       mysqli_close($connect);
       
       require_once "Views/header.php"; 
        require_once 'Views/post-detail.php'; 
        
    break ;
    
    case "update-post": //3
      $id = getUrlValue("id-tieude");
        
       $datas = postDetail($connect, $id);
      
        require_once "Views/header.php" ; 
        require_once "Views/update-post.php" ; 
        
        
   
       if(isset($_POST['submit'])){
            
            $tieude = $_POST['tieude'];
            $mota = nl2br($_POST['mota']);
            updatePost ($connect,$id, $tieude, $mota );
            header('location:controller.php?view=all-post');
        }
    break ;
    case "delete-post": // 4
        
        $id = getUrlValue("id-tieude");
        
       // deletePost($connect, $id);
       deletePostCategory($connect, $id);
        header('location:controller.php?view=all-post');
        
    break ;
        case "create-post": // 5
            require_once "Views/header.php" ; 
            require_once "Views/create-post.php" ; 
           
           
          
               if (isset($_POST['submit'])){
               $tieude = ($_POST["tieude"]);
               $mota = nl2br($_POST["mota"]);
          createPost($connect, $tieude, $mota);
       header ('location:controller.php?view=all-post');
       
           }

        break ;
    case "create-category": // 6
        
        require_once "Views/header.php" ; 
        require_once "Views/create-category.php" ; 
        require_once "Views/footer.php" ; 
        if(isset($_POST['submit'])){
         $category =ucfirst($_POST['category']);
       // require_once "db.php" ; 
   $categoryTable =[
   // 'category_id' => isset($category_id) ? $category : null,
    'noidung_danhmuc' => isset ( $category ) ? $category : null
    ];
    
        
        createCategory($connect, $categoryTable );
       header ("location:controller.php?view=all-category");
        }
        
        
    break ;
    case "all-category": // 7
        
        require_once "Views/header.php"; 
        $datas = allCategory($connect );
        require_once "Views/all-category.php" ; 
     break ;
     
     case "category-detail": // 8
         
         require_once "Views/header.php"; 
         $categoryId = getUrlValue("category-id");
         $datas = categoryDetail($connect, $categoryId);
         $categoryName = allCategory($connect, $categoryId);
         require_once "Views/category-detail.php" ; 
         break ;
         
         case "delete-category": // 9
             
             $id = getUrlValue("category-id");
              //echo $id;
            deleteCategory($connect, $id);
             
 header("location:controller.php?view=all-category");


       
             break ;
        case "demo": // 10
            
            require_once "Views/demo.php"; 
            break ;
    case "de": // 11
    // require_once "Views/header.php" ; 
        require_once "Views/de.php"; 
        
       // require_once "Views/footer.php" ; 
    break ;
        
    case "add-post-category": //12
        require_once "Views/header.php" ; 
  
      
        
       $datas = allCategory($connect);
       
       mysqli_close($connect);
    $tittle_id = getUrlValue("id-tieude");
      
        
       
        require_once "Views/add-post-category.php" ; 

      
    if(isset ($_POST['category'])){
        $category_ids  = $_POST['category'];
   
      
      foreach ($category_ids as $category_id){
     addPostCategory($connect, $tittle_id, $category_id);
     header("location:controller.php?view=all-post");
        } 
        
      } 
        break ;
        case "select-category"://13
     $tittle_id = getUrlValue("id-tieude");
    
      $datas = allCategory($connect);
            
            require_once "Views/header.php" ; 
            require_once "Views/select-category.php"; 
            require_once "Views/footer.php" ; 
            if(isset($_POST['submit'])){
                $category_id = $_POST['danhmucs'];
                selectCategory($connect, $tittle_id, $category_id);
                header("location:controller.php?view=post-detail&id-tieude=".$tittle_id);
            }
     break ;
    case "update-category"://14
          require_once "Views/header.php" ; 
          require_once "Views/footer.php"; 
     break ;
       
    default :
        require_once "Views/header.php" ; 
        require_once "Views/header.php" ; 
         require_once "Views/home.php" ; 
    break ;
  
}






?> 
