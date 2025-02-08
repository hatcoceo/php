class Validator {
    private $errors = [];

    // Kiểm tra trường không được để trống
    public function required($field, $value) {
        if (empty($value)) {
            $this->errors[$field] = ucfirst($field) . " không được để trống.";
        }
    }

    // Kiểm tra độ dài chuỗi
    public function maxLength($field, $value, $max) {
        if (!empty($value) && strlen($value) > $max) {
            $this->errors[$field] = ucfirst($field) . " không được dài quá $max ký tự.";
        }
    }

    // Kiểm tra email hợp lệ
    public function email($field, $value) {
        if (!empty($value) && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field] = ucfirst($field) . " không hợp lệ.";
        }
    }

    // Kiểm tra số nguyên trong khoảng
    public function integerInRange($field, $value, $min, $max) {
        if ($value === null || !is_numeric($value) || $value < $min || $value > $max) {
            $this->errors[$field] = ucfirst($field) . " phải trong khoảng $min - $max.";
        }
    }

    // Kiểm tra số dương
    public function positiveNumber($field, $value) {
        if ($value === null || !is_numeric($value) || $value < 0) {
            $this->errors[$field] = ucfirst($field) . " phải là số dương.";
        }
    }

    // Kiểm tra boolean
    public function boolean($field, $value) {
        if (!isset($value) || !is_bool($value)) {
            $this->errors[$field] = ucfirst($field) . " không hợp lệ.";
        }
    }

    // Lấy danh sách lỗi
    public function getErrors() {
        return $this->errors;
    }

    // Kiểm tra xem có lỗi không
    public function hasErrors() {
        return !empty($this->errors);
    }

    // Hiển thị lỗi ra HTML
    public function displayErrors() {
        if ($this->hasErrors()) {
            echo "<ul style='color: red;'>";
            foreach ($this->errors as $error) {
                echo "<li>$error</li>";
            }
            echo "</ul>";
        }
    }
}