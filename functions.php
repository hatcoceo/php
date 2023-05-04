<?php    

global $connect ;

$connect = mysqli_connect('localhost', 'id18044425_vinthink1', '241432679vV!', 'id18044425_vinthink');

function get_url_value($id){
    if(isset ($_GET[$id])){
        $id =$_GET[$id];
        return $id;
    }
}


function get_post_value($name){
    if(isset ($_POST[$name])){
        
            
        $name = $_POST[$name];
        return $name;
        
    }
}


function insert ($table, $userTable){
    global $connect ;
   

$intoUser = implode(",",array_keys ($userTable));
 
$valueUser = implode ("', '", array_values ($userTable));
 $sql = "INSERT INTO $table($intoUser) VALUES ('$valueUser') ";
    
    $qr = mysqli_query ($connect, $sql);
   if($qr){
       echo "lưu thành công";
   }else {
       echo "chưa lưu được ".mysqli_error($connect );
   }
   mysqli_close($connect);
}

  // Function to get the columns of a table in a database
  
function get_columns($table) {
    // Code to connect to the database
   global $connect ;

    // Get the columns of the table
    $sql = "SHOW COLUMNS FROM $table";
    $qr= mysqli_query($connect , $sql);

    $columns = [];
    while ($f_a = mysqli_fetch_array ($qr)) {
        $columns[] = $f_a['Field'];
    }
   mysqli_close($connect);
    
    return $columns;
}


    

?> 
