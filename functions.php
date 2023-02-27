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
function show_column($table){
// Lấy tên các cột trong bảng
global $connect ;
$qr = mysqli_query($connect, "DESCRIBE $table");


// In tên các cột
while ($f_a = mysqli_fetch_array($qr)) {
    echo $f_a['Field'] . "<br>";
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
function create_table($table ){
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

function create_form($button_name, $input_name){
    echo '<form action ="" method ="POST">
    <input type ="text" name ="'.$input_name.'">
    <button type ="submit" name ="'.$button_name.'">gửi</button>
    </form>';
    // mã dưới là tải lại trang tự động sau 5 giây.
//header("Refresh:5");
}

function form_foreach(){
$fields = array(
    "username" => "Tên đăng nhập",
    "password" => "Mật khẩu",
    "confirm_password" => "Xác nhận mật khẩu",
    "email" => "Địa chỉ email",
    "phone" => "Số điện thoại",
    "vinh" => "anh vinh"
);




 ?>
<form method="post" action="submit.php">
    <?php foreach ($fields as $key => $value): ?>
        <div>
            <label for="<?php echo $key; ?>"><?php echo $value; ?>:</label>
            <input type="<?php echo $key == 'password' || $key == 'confirm_password' ? 'password' : 'text'; ?>" 
                id="<?php echo $key; ?>" name="<?php echo $key; ?>" />
        </div>
    <?php endforeach; ?>
    <button type="submit">Đăng ký</button>
</form>

 </div>
 
<?php }
function create_table_UI(){?>
<table border=1>
  <?php
    // Định nghĩa số hàng và số cột của bảng
    $num_rows = 5;
    $num_cols = 3;
    
    // Vòng lặp tạo hàng của bảng
    for ($i = 1; $i <= $num_rows; $i++) {
      echo "<tr>";
      
      // Vòng lặp tạo cột của bảng
      for ($j = 1; $j <= $num_cols; $j++) {
        echo "<td>" . $i . "-" . $j . "</td>";
      }
      
      echo "</tr>";
    } ?>
</table>

<?php }


function remove_dau_tieng_viet ($str){
        $unicode = array(
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd'=>'đ',
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i'=>'í|ì|ỉ|ĩ|ị',
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
			'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'D'=>'Đ',
            'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
            'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        );
        
       foreach($unicode as $nonUnicode=>$uni){
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
       }
		return $str;
    }

function translate_en_to_vi($text) {
   $en_to_vi = array(
      "hello" => "xin chào",
      "how are you" => "bạn có khỏe không",
      "goodbye" => "tạm biệt", 
      "buổi sáng" => "uống cà phê"
   );
   $translated_text = $en_to_vi[$text];
   return $translated_text;
}



function loadJSON($url) {
    $response = file_get_contents($url);
    $data = json_decode($response, true);
    return $data;
}

// Sử dụng hàm để lấy dữ liệu JSON từ đường dẫn "example.json"
//$data = loadJSON("example.json");

// In ra dữ liệu JSON
//print_r($data);
?>

 

