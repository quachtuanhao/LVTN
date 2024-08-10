<?php

include '../db/connect.php';

$username = "";
$password = "";
$errors = [];

if (isset($_POST['dangnhap'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Kiểm tra username
    if (empty($username)) {
        $errors['username']['required'] = 'Username không được bỏ trống';
    }

    // Kiểm tra password
    if (empty($password)) {
        $errors['password']['required'] = 'Password không được bỏ trống';
    }

    // Nếu không có lỗi thì tiếp tục đăng nhập
    if (empty($errors)) {
        $pass = md5($password);
        $sql = "SELECT userName, password, hoTen, maCV FROM taikhoan WHERE userName=? AND password=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $username, $pass);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            if ($row['maCV'] == 'CV02') {
                $_SESSION['dangnhap'] = $username;

                // Kiểm tra và phục hồi giỏ hàng nếu có
                if (isset($_SESSION['pending_cart']) && !empty($_SESSION['pending_cart'])) {
                    $_SESSION['cart'] = $_SESSION['pending_cart'];
                    unset($_SESSION['pending_cart']); // Xóa thông tin giỏ hàng tạm thời
                }

                header('Location: index.php');
                exit();
            } elseif ($row['maCV'] == 'CV01') {
                $_SESSION['dangnhapadmin'] = $username;
                header('Location: ../admin/index.php');
                exit();
            }
        } else {
            $errors['login']['failed'] = 'Username hoặc password không chính xác';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
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
            padding-right: 40px;
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

        .submit--login {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
            text-align: center;
        }

        .submit--login:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <form class="form" action="index.php?action=login" method="POST">
        <div class="form-main">
            <div class="form-title">
                <h1>Đăng Nhập</h1>
            </div>
            <div class="form-content">
                <label class="label">Username</label>
                <input class="text" type="text" name="username" value="<?php echo htmlspecialchars($username); ?>">
                <?php echo (!empty($errors['username']['required'])) ? "<span class='message-error'>" . htmlspecialchars($errors['username']['required']) . "</span>" : false ?>
                <label class="label">Password</label>
                <div class="password-wrapper">
                    <input id="password" class="text" type="password" name="password" value="<?php echo htmlspecialchars($password); ?>">
                    <span id="togglePassword" class="toggle-password">
                        <i class="fa fa-eye eye-icon"></i>
                    </span>
                </div>
                <?php echo (!empty($errors['password']['required'])) ? "<span class='message-error'>" . htmlspecialchars($errors['password']['required']) . "</span>" : false ?>
                <?php echo (!empty($errors['login']['failed'])) ? "<span class='message-error'>" . htmlspecialchars($errors['login']['failed']) . "</span>" : false ?>
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
                eyeIcon.className = type === 'password' ? 'fa fa-eye eye-icon' : 'fa fa-eye-slash eye-icon';
            });
        });
    </script>
</body>
</html>
