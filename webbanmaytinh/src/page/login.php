<?php
include '../db/connect.php'; // Khởi tạo phiên làm việc

$username = "";
$password = "";
$errors = [];

if (isset($_POST['dangnhap'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $pass = "";

    // Kiểm tra nếu username bị bỏ trống
    if (empty($username)) {
        $errors['username']['required'] = 'Username không được bỏ trống';
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
        $errors['username']['invalid'] = 'Username chỉ có thể chứa chữ cái, số và dấu gạch dưới';
    } else {
        // Kiểm tra username tồn tại trong cơ sở dữ liệu
        $sql1 = "SELECT userName FROM taikhoan WHERE userName=?";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bind_param('s', $username);
        $stmt1->execute();
        $result1 = $stmt1->get_result();
        if ($result1->num_rows === 0) {
            $errors['username']['not_found'] = 'Username không tồn tại';
        }
    }

    // Kiểm tra nếu password bị bỏ trống
    if (empty($password)) {
        $errors['password']['required'] = 'Password không được bỏ trống';
    } else {
        $pass = md5($password);
        // Kiểm tra password
        $sql2 = "SELECT password FROM taikhoan WHERE userName=?";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bind_param('s', $username);
        $stmt2->execute();
        $result2 = $stmt2->get_result();
        $row2 = $result2->fetch_assoc();
        if (!$row2 || $row2['password'] !== $pass) {
            $errors['password']['incorrect'] = 'Password không đúng';
        }
    }

    // Nếu không có lỗi thì tiếp tục đăng nhập
    if (empty($errors)) {
        $sql = "SELECT userName, password, hoTen, maCV FROM taikhoan WHERE userName=? AND password=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $username, $pass);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            if ($row['maCV'] == 'CV02') {
                $_SESSION['dangnhap'] = $username;
                header('Location: index.php');
                exit();
            } elseif ($row['maCV'] == 'CV01') {
                $_SESSION['dangnhapadmin'] = $username;
                header('Location: ../admin/index.php');
                exit();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .form {
            max-width: 400px;
            margin: 0 auto;
        }

        .form-main {
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        .form-title h1 {
            text-align: center;
        }

        .form-content {
            display: flex;
            flex-direction: column;
        }

        .label {
            margin-bottom: 8px;
        }

        .text {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            margin-bottom: 16px;
        }

        .password-wrapper {
            position: relative;
        }

        .password-wrapper input {
            width: 100%;
            padding-right: 40px; /* Cung cấp không gian cho biểu tượng mắt */
            box-sizing: border-box;
        }

        .toggle-password {
            position: absolute;
            right: 10px;
            top: 35%;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .eye-icon {
            font-size: 18px;
        }

        .message-error {
            color: red;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <form class="form" action="index.php?action=login" method="POST" enctype="multipart/form-data">
        <div class="form-main">
            <div class="form-title">
                <h1>Đăng nhập</h1>
            </div>
            <div class="form-content">
                <label class="label">Username</label>
                <input class="text" type="text" name="username" value="<?php echo htmlspecialchars($username); ?>">
                <?php echo (!empty($errors['username']['required'])) ? "<span class='message-error'>" . htmlspecialchars($errors['username']['required']) . "</span>" : false ?>
                <?php echo (!empty($errors['username']['invalid'])) ? "<span class='message-error'>" . htmlspecialchars($errors['username']['invalid']) . "</span>" : false ?>
                <?php echo (!empty($errors['username']['not_found'])) ? "<span class='message-error'>" . htmlspecialchars($errors['username']['not_found']) . "</span>" : false ?>
                <label class="label">Password</label>
                <div class="password-wrapper">
                    <input id="password" class="text" type="password" name="password">
                    <span id="togglePassword" class="toggle-password">
                        <i class="fa fa-eye eye-icon"></i>
                    </span>
                </div>
                <?php echo (!empty($errors['password']['required'])) ? "<span class='message-error'>" . htmlspecialchars($errors['password']['required']) . "</span>" : false ?>
                <?php echo (!empty($errors['password']['short'])) ? "<span class='message-error'>" . htmlspecialchars($errors['password']['short']) . "</span>" : false ?>
                <?php echo (!empty($errors['password']['incorrect'])) ? "<span class='message-error'>" . htmlspecialchars($errors['password']['incorrect']) . "</span>" : false ?>
                <input class="submit--login" type="submit" name="dangnhap" value="Đăng nhập">
            </div>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const passwordField = document.getElementById('password');
            const togglePassword = document.getElementById('togglePassword');
            const eyeIcon = togglePassword.querySelector('.fa');

            togglePassword.addEventListener('click', function () {
                const type = passwordField.type === 'password' ? 'text' : 'password';
                passwordField.type = type;
                // Thay đổi biểu tượng mắt tùy theo trạng thái
                eyeIcon.className = type === 'password' ? 'fa fa-eye eye-icon' : 'fa fa-eye-slash eye-icon';
            });
        });
    </script>
</body>
</html>
