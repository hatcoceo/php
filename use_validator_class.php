// Khởi tạo validator
$validator = new Validator();

$validator->required("name", $data['name']);
$validator->maxLength("name", $data['name'], 100);
$validator->required("email", $data['email']);
$validator->email("email", $data['email']);
$validator->integerInRange("age", $data['age'], 0, 120);
$validator->positiveNumber("salary", $data['salary']);
$validator->boolean("active", $data['active']);

// Nếu có lỗi, hiển thị và dừng lại
if ($validator->hasErrors()) {
    $validator->displayErrors();
} else {
    try {
        $db = new Database("localhost", "root", "", "test_db");
        $newId = $db->createRecord("users", $data);
        echo "Thêm bản ghi thành công, ID: " . $newId;
    } catch (Exception $e) {
        echo "Lỗi: " . $e->getMessage();
    }
}