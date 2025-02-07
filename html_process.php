<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm người dùng</title>
</head>
<body>
    <h2>Thêm người dùng mới</h2>
    <form action="process.php" method="post">
        <label for="name">Họ và Tên:</label>
        <input type="text" id="name" name="name" required>
        <br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br><br>

        <label for="age">Tuổi:</label>
        <input type="number" id="age" name="age" required>
        <br><br>

        <label for="salary">Lương:</label>
        <input type="number" id="salary" name="salary" step="0.01" required>
        <br><br>

        <label for="active">Hoạt động:</label>
        <select id="active" name="active">
            <option value="1">Có</option>
            <option value="0">Không</option>
        </select>
        <br><br>

        <button type="submit">Thêm người dùng</button>
    </form>
</body>
</html>