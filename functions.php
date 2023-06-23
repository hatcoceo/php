<?php   

function geturlvalue($name){
  if(isset ($_GET[$name])){
       $name =  $_GET[$name];
       return $name;
    }
      
}
function getPostvalue($name){
    if (isset($_POST[$name])){
        $name = $_POST[$name];
        return $name;
    }

}

function limitWords($title, $limit) {
  $words = explode(' ', $title); // Tách tiêu đề thành các từ
  $wordCount = count($words); // Đếm số từ

  if ($wordCount > $limit) {
    $limitedWords = array_slice($words, 0, $limit); // Lấy $limit từ đầu tiên
    $limitedTitle = implode(' ', $limitedWords); // Kết hợp các từ lại với nhau
    return $limitedTitle . '...'; // Thêm dấu chấm ba chấm vào cuối
  }

  return $title; // Trả về tiêu đề gốc nếu không cần giới hạn
}


function formatlink($notes) {
    $pattern = '/(https?:\/\/[^\s]+)/i'; 

    $formatLink = preg_replace($pattern, '<a href="$1">$1</a>', $notes);
    
    return $formatLink;
}
function showExtension(){
print_r (get_loaded_extensions());
 
}
// show function extension 
function showFunEx($ex){

$a =get_extension_funcs($ex);
print_r($a);
}
/*
 function checkedCategory($allCategory =[], $checkedCategory = []){
     foreach ($allCategory as $category ){
         if(in_array($category, $checkedCategory)){
             return "checked";
         }
         
     }
     return '';
 }
*/
function isChecked($category, $checked) {
    return in_array($category, $checked) ? 'checked' : '';
}

?> 
