<?php
class Database {
    private $conn;

    public function __construct($host, $user, $pass, $dbname) {
        $this->conn = new mysqli($host, $user, $pass, $dbname);
        if ($this->conn->connect_error) {
            throw new Exception("Kết nối thất bại: " . $this->conn->connect_error);
        }
    }

    // Hàm xác định kiểu dữ liệu của biến (s = string, i = integer, d = double)
    private function getParamType($var) {
        if (is_int($var)) {
            return "i"; // Kiểu số nguyên
        } elseif (is_float($var)) {
            return "d"; // Kiểu số thực
        } else {
            return "s"; // Kiểu chuỗi
        }
    }

    // Hàm tạo bản ghi, tự động xác định kiểu dữ liệu
    public function createRecord($table, $data) {
        if (empty($data)) {
            throw new Exception("Dữ liệu không hợp lệ.");
        }

        $columns = implode(", ", array_keys($data));
        $placeholders = implode(", ", array_fill(0, count($data), "?"));
        $values = array_values($data);
        $types = implode("", array_map([$this, "getParamType"], $values));

        $stmt = $this->conn->prepare("INSERT INTO {$table} ($columns) VALUES ($placeholders)");
        if (!$stmt) {
            throw new Exception("Lỗi SQL: " . $this->conn->error);
        }

        $stmt->bind_param($types, ...$values);
        if (!$stmt->execute()) {
            throw new Exception("Lỗi thực thi: " . $stmt->error);
        }

        return $stmt->insert_id;
    }

    // Hàm lấy tất cả bản ghi của bảng
    public function getRecords($table) {
        $result = $this->conn->query("SELECT * FROM {$table}");
        if (!$result) {
            throw new Exception("Lỗi SQL: " . $this->conn->error);
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Hàm lấy bản ghi theo ID
    public function getRecordById($table, $id) {
        $stmt = $this->conn->prepare("SELECT * FROM {$table} WHERE id = ?");
        if (!$stmt) {
            throw new Exception("Lỗi SQL: " . $this->conn->error);
        }

        $stmt->bind_param("i", $id);
        if (!$stmt->execute()) {
            throw new Exception("Lỗi thực thi: " . $stmt->error);
        }

        return $stmt->get_result()->fetch_assoc();
    }

    // Hàm cập nhật bản ghi
    public function updateRecord($table, $id, $data) {
        if (empty($data)) {
            throw new Exception("Dữ liệu cập nhật không hợp lệ.");
        }

        $setClause = implode(" = ?, ", array_keys($data)) . " = ?";
        $values = array_values($data);
        $values[] = $id;
        $types = implode("", array_map([$this, "getParamType"], $values)) . "i";

        $stmt = $this->conn->prepare("UPDATE {$table} SET $setClause WHERE id = ?");
        if (!$stmt) {
            throw new Exception("Lỗi SQL: " . $this->conn->error);
        }

        $stmt->bind_param($types, ...$values);
        if (!$stmt->execute()) {
            throw new Exception("Lỗi thực thi: " . $stmt->error);
        }

        return $stmt->affected_rows;
    }

    // Hàm xóa bản ghi
    public function deleteRecord($table, $id) {
        $stmt = $this->conn->prepare("DELETE FROM {$table} WHERE id = ?");
        if (!$stmt) {
            throw new Exception("Lỗi SQL: " . $this->conn->error);
        }

        $stmt->bind_param("i", $id);
        if (!$stmt->execute()) {
            throw new Exception("Lỗi thực thi: " . $stmt->error);
        }

        return $stmt->affected_rows;
    }

    public function __destruct() {
        $this->conn->close();
    }
}

// Lấy dữ liệu từ form và kiểm tra kiểu dữ liệu
$data = [
    'name'  => isset($_POST['name']) ? trim($_POST['name']) : null,
    'email' => isset($_POST['email']) ? trim($_POST['email']) : null,
    'age'   => isset($_POST['age']) ? (int) $_POST['age'] : null, // Chuyển thành số nguyên
    'salary'=> isset($_POST['salary']) ? (float) $_POST['salary'] : null, // Chuyển thành số thực
    'active'=> isset($_POST['active']) ? (bool) $_POST['active'] : null // Chuyển thành boolean
];

// Kiểm tra nếu dữ liệu hợp lệ thì thêm vào database
try {
    $db = new Database("localhost", "root", "", "test_db");
    $newId = $db->createRecord("users", $data);
    echo "Thêm bản ghi thành công, ID: " . $newId;
} catch (Exception $e) {
    echo "Lỗi: " . $e->getMessage();
}
?>