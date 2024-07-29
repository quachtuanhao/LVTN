<?php
include '../db/connect.php';

$password = "";
$newPassword = "";
$confirmPassword = "";

if (isset($_POST['doi'])) {
    $username = $_SESSION['dangnhap'];
    $password = trim($_POST['password']);
    $newPassword = trim($_POST['newPassword']);
    $confirmPassword = trim($_POST['confirmPassword']);
    $errors = [];
    $pass = "";
    $newPass = "";
    $checkNewPass = "";

    // Kiểm tra mật khẩu hiện tại
    if (empty($password)) {
        $errors['password']['required'] = 'Password không được bỏ trống';
    } else {
        $pass = md5($password);
        $sql2 = "SELECT password FROM taikhoan WHERE userName=?";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bind_param('s', $username);
        $stmt2->execute();
        $result2 = $stmt2->get_result();
        $row2 = $result2->fetch_assoc();
        $checkNewPass = $row2['password'];
        if (!empty($row2)) {
            if ($row2['password'] !== $pass) {
                $errors['password']['trung'] = 'Password không đúng';
            }
        }
    }

    // Kiểm tra mật khẩu mới
    if (empty($newPassword)) {
        $errors['newPassword']['required'] = 'Mật khẩu mới không được bỏ trống';
    } elseif (md5($newPassword) == $checkNewPass) {
        $errors['newPassword']['change'] = 'Mật khẩu mới trùng với mật khẩu cũ';
    }

    // Kiểm tra xác nhận mật khẩu
    if (empty($confirmPassword)) {
        $errors['confirmPassword']['required'] = 'Không được bỏ trống';
    } elseif ($newPassword !== $confirmPassword) {
        $errors['confirmPassword']['trung'] = 'Mật khẩu xác nhận không chính xác';
    }

    // Nếu không có lỗi, thực hiện đổi mật khẩu
    if (count($errors) == 0) {
        $newPass = md5($newPassword);
        $sql = "UPDATE taikhoan SET password=? WHERE userName=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $newPass, $username);
        if ($stmt->execute()) {
            mysqli_close($conn);
            unset($_SESSION['dangnhap']);
?>
            <script>
                alert("Thay đổi mật khẩu thành công!");
                window.location.replace("index.php?action=login");
            </script>
<?php
        } else {
            $errors['general'] = "Lỗi xảy ra khi thay đổi mật khẩu. Vui lòng thử lại.";
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
    <title>Đổi Mật Khẩu</title>
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
            top: 35%; /* Xích lên một chút so với giữa */
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
    <form class="form" action="./index.php?action=doimatkhau" method="POST" enctype="multipart/form-data">
        <div class="form-main">
            <div class="form-title">
                <h1>Đổi mật khẩu</h1>
            </div>
            <div class="form-content">
                <label class="label">Mật khẩu hiện tại</label>
                <div class="password-wrapper">
                    <input id="password" class="text" type="password" name="password" value="<?php echo htmlspecialchars($password); ?>">
                    <span id="togglePassword" class="toggle-password">
                        <i class="fa fa-eye eye-icon"></i>
                    </span>
                </div>
                <?php echo (!empty($errors['password']['required'])) ? "<span class='message-error'>" . htmlspecialchars($errors['password']['required']) . "</span>" : false ?>
                <?php echo (!empty($errors['password']['trung'])) ? "<span class='message-error'>" . htmlspecialchars($errors['password']['trung']) . "</span>" : false ?>
                <label class="label">Mật khẩu mới</label>
                <div class="password-wrapper">
                    <input id="newPassword" class="text" type="password" name="newPassword" value="<?php echo htmlspecialchars($newPassword); ?>">
                    <span id="toggleNewPassword" class="toggle-password">
                        <i class="fa fa-eye eye-icon"></i>
                    </span>
                </div>
                <?php echo (!empty($errors['newPassword']['required'])) ? "<span class='message-error'>" . htmlspecialchars($errors['newPassword']['required']) . "</span>" : false ?>
                <?php echo (!empty($errors['newPassword']['change'])) ? "<span class='message-error'>" . htmlspecialchars($errors['newPassword']['change']) . "</span>" : false ?>
                <label class="label">Xác nhận mật khẩu</label>
                <div class="password-wrapper">
                    <input id="confirmPassword" class="text" type="password" name="confirmPassword" value="<?php echo htmlspecialchars($confirmPassword); ?>">
                    <span id="toggleConfirmPassword" class="toggle-password">
                        <i class="fa fa-eye eye-icon"></i>
                    </span>
                </div>
                <?php echo (!empty($errors['confirmPassword']['required'])) ? "<span class='message-error'>" . htmlspecialchars($errors['confirmPassword']['required']) . "</span>" : false ?>
                <?php if (empty($errors['confirmPassword']['required'])) echo (!empty($errors['confirmPassword']['trung'])) ? "<span class='message-error'>" . htmlspecialchars($errors['confirmPassword']['trung']) . "</span>" : false ?>
                <input class="submit--update" type="submit" name="doi" value="Lưu thay đổi">
            </div>
        </div>
    </form>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordField = document.getElementById('password');
            const eyeIcon = document.querySelector('#togglePassword .fa');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        });

        document.getElementById('toggleNewPassword').addEventListener('click', function () {
            const newPasswordField = document.getElementById('newPassword');
            const eyeIcon = document.querySelector('#toggleNewPassword .fa');

            if (newPasswordField.type === 'password') {
                newPasswordField.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                newPasswordField.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        });

        document.getElementById('toggleConfirmPassword').addEventListener('click', function () {
            const confirmPasswordField = document.getElementById('confirmPassword');
            const eyeIcon = document.querySelector('#toggleConfirmPassword .fa');

            if (confirmPasswordField.type === 'password') {
                confirmPasswordField.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                confirmPasswordField.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        });
    </script>
</body>

</html>
