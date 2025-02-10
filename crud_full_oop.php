<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý người dùng</title>
</head>
<body>
    <h2>Thêm người dùng mới</h2>
    <form action="process.php?action=create" method="post">
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

    <hr>

    <h2>Cập nhật thông tin người dùng</h2>
    <form action="process.php?action=update" method="post">
        <label for="update_id">ID:</label>
        <input type="number" id="update_id" name="id" required>
        <br><br>

        <label for="update_name">Họ và Tên:</label>
        <input type="text" id="update_name" name="name">
        <br><br>

        <label for="update_email">Email:</label>
        <input type="email" id="update_email" name="email">
        <br><br>

        <label for="update_age">Tuổi:</label>
        <input type="number" id="update_age" name="age">
        <br><br>

        <label for="update_salary">Lương:</label>
        <input type="number" id="update_salary" name="salary" step="0.01">
        <br><br>

        <label for="update_active">Hoạt động:</label>
        <select id="update_active" name="active">
            <option value="1">Có</option>
            <option value="0">Không</option>
        </select>
        <br><br>

        <button type="submit">Cập nhật</button>
    </form>

    <hr>

    <h2>Xóa người dùng</h2>
    <form action="process.php?action=delete" method="post">
        <label for="delete_id">ID:</label>
        <input type="number" id="delete_id" name="id" required>
        <br><br>

        <button type="submit">Xóa</button>
    </form>

    <hr>

    <h2>Danh sách người dùng</h2>
    <button onclick="window.location.href='process.php?action=get'">Xem danh sách</button>
</body>
</html>
