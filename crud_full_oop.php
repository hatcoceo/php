<?php
class Database {
    private $conn;

    public function __construct($host, $user, $pass, $dbname) {
        $this->conn = new mysqli($host, $user, $pass, $dbname);
        if ($this->conn->connect_error) {
            throw new Exception("Kết nối thất bại: " . $this->conn->connect_error);
        }
    }

    private function getParamType($var) {
        return is_int($var) ? "i" : (is_float($var) ? "d" : "s");
    }

    public function createRecord($table, $data) {
        $columns = implode(", ", array_keys($data));
        $placeholders = implode(", ", array_fill(0, count($data), "?"));
        $values = array_values($data);
        $types = implode("", array_map([$this, "getParamType"], $values));

        $stmt = $this->conn->prepare("INSERT INTO {$table} ($columns) VALUES ($placeholders)");
        $stmt->bind_param($types, ...$values);
        $stmt->execute();
        return $stmt->insert_id;
    }

    public function getRecords($table) {
        $result = $this->conn->query("SELECT * FROM {$table}");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function updateRecord($table, $id, $data) {
        $setClause = implode(" = ?, ", array_keys($data)) . " = ?";
        $values = array_values($data);
        $values[] = $id;
        $types = implode("", array_map([$this, "getParamType"], $values)) . "i";

        $stmt = $this->conn->prepare("UPDATE {$table} SET $setClause WHERE id = ?");
        $stmt->bind_param($types, ...$values);
        $stmt->execute();
        return $stmt->affected_rows;
    }

    public function deleteRecord($table, $id) {
        $stmt = $this->conn->prepare("DELETE FROM {$table} WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->affected_rows;
    }
}

// Kết nối database
try {
    $db = new Database("localhost", "root", "", "test_db");

    $action = isset($_GET['action']) ? $_GET['action'] : null;

    if ($action === "create") {
        $data = [
            'name'   => $_POST['name'],
            'email'  => $_POST['email'],
            'age'    => (int)$_POST['age'],
            'salary' => (float)$_POST['salary'],
            'active' => (int)$_POST['active']
        ];
        $newId = $db->createRecord("users", $data);
        echo "Thêm thành công, ID: " . $newId;
    } 
    elseif ($action === "get") {
        $users = $db->getRecords("users");
        echo "<pre>" . print_r($users, true) . "</pre>";
    } 
    elseif ($action === "update") {
        $id = (int)$_POST['id'];
        $data = array_filter([
            'name'   => $_POST['name'] ?? null,
            'email'  => $_POST['email'] ?? null,
            'age'    => $_POST['age'] !== "" ? (int)$_POST['age'] : null,
            'salary' => $_POST['salary'] !== "" ? (float)$_POST['salary'] : null,
            'active' => isset($_POST['active']) ? (int)$_POST['active'] : null
        ], function ($value) { return $value !== null; });

        $updated = $db->updateRecord("users", $id, $data);
        echo "Cập nhật thành công: " . $updated . " bản ghi.";
    } 
    elseif ($action === "delete") {
        $id = (int)$_POST['id'];
        $deleted = $db->deleteRecord("users", $id);
        echo "Đã xóa " . $deleted . " bản ghi.";
    } 
    else {
        echo "Hành động không hợp lệ.";
    }
} catch (Exception $e) {
    echo "Lỗi: " . $e->getMessage();
}
?>
