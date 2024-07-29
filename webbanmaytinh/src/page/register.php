<?php
include '../db/connect.php';
$username = "";
$password = "";
$name = "";
$email = "";
$sdt = "";
$diachi = "";
$errors = [];
$success_message = "";

if (isset($_POST['dangky'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $sdt = trim($_POST['sdt']);
    $diachi = trim($_POST['diachi']);

    // Kiểm tra username
    if (empty($username)) {
        $errors['username']['required'] = 'Username không được bỏ trống';
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
        $errors['username']['invalid'] = 'Username không được chứa ký tự đặc biệt hoặc khoảng trắng';
    } else {
        $sql1 = "SELECT userName FROM taikhoan WHERE userName=?";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bind_param('s', $username);
        $stmt1->execute();
        $result1 = $stmt1->get_result();
        if ($result1->num_rows > 0) {
            $errors['username']['exists'] = 'Username đã tồn tại';
        }
    }

    // Kiểm tra password
    if (empty($password)) {
        $errors['password']['required'] = 'Password không được bỏ trống';
    } elseif (strlen($password) < 6) {
        $errors['password']['min'] = 'Password phải lớn hơn 6 ký tự';
    }

    // Kiểm tra name
    if (empty($name)) {
        $errors['name']['required'] = 'Họ tên không được bỏ trống';
    } elseif (strlen($name) < 6) {
        $errors['name']['min'] = 'Họ tên phải lớn hơn 6 ký tự';
    }

    // Kiểm tra email
    if (empty($email)) {
        $errors['email']['required'] = 'Email không được bỏ trống';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email']['invalid'] = 'Email không hợp lệ';
    }

    // Kiểm tra số điện thoại
    if (empty($sdt)) {
        $errors['sdt']['required'] = 'Số điện thoại không được bỏ trống';
    } elseif (!is_numeric($sdt)) {
        $errors['sdt']['invalid'] = 'Số điện thoại phải là số';
    } elseif (strlen($sdt) < 10) {
        $errors['sdt']['min'] = 'Số điện thoại phải lớn hơn 10 ký tự';
    }

    // Kiểm tra địa chỉ
    if (empty($diachi)) {
        $errors['diachi']['required'] = 'Địa chỉ không được bỏ trống';
    }

    // Nếu không có lỗi, thực hiện đăng ký
    if (empty($errors)) {
        $pass = md5($password);
        $sql = "INSERT INTO taikhoan (userName, password, hoTen, email, sdt, diachi, maCV) VALUES (?, ?, ?, ?, ?, ?, 'CV02')";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssssss', $username, $pass, $name, $email, $sdt, $diachi);
        if ($stmt->execute()) {
            $success_message = "Đăng ký tài khoản thành công!";
        } else {
            $errors['general'] = "Lỗi xảy ra khi đăng ký. Vui lòng thử lại.";
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
    <title>Đăng Ký</title>
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
    <form class="form" action="index.php?action=register" method="POST" enctype="multipart/form-data">
        <div class="form-main">
            <div class="form-title">
                <h1>Đăng Ký</h1>
            </div>
            <div class="form-content">
                <label class="label">Username</label>
                <input class="text" type="text" name="username" value="<?php echo htmlspecialchars($username); ?>">
                <?php echo (!empty($errors['username']['required'])) ? "<span class='message-error'>" . htmlspecialchars($errors['username']['required']) . "</span>" : false ?>
                <?php echo (!empty($errors['username']['invalid'])) ? "<span class='message-error'>" . htmlspecialchars($errors['username']['invalid']) . "</span>" : false ?>
                <?php echo (!empty($errors['username']['exists'])) ? "<span class='message-error'>" . htmlspecialchars($errors['username']['exists']) . "</span>" : false ?>
                <label class="label">Password</label>
                <div class="password-wrapper">
                    <input id="password" class="text" type="password" name="password" value="<?php echo htmlspecialchars($password); ?>">
                    <span id="togglePassword" class="toggle-password">
                        <i class="fa fa-eye eye-icon"></i>
                    </span>
                </div>
                <?php echo (!empty($errors['password']['required'])) ? "<span class='message-error'>" . htmlspecialchars($errors['password']['required']) . "</span>" : false ?>
                <?php echo (!empty($errors['password']['min'])) ? "<span class='message-error'>" . htmlspecialchars($errors['password']['min']) . "</span>" : false ?>
                <label class="label">Họ tên</label>
                <input class="text" type="text" name="name" value="<?php echo htmlspecialchars($name); ?>">
                <?php echo (!empty($errors['name']['required'])) ? "<span class='message-error'>" . htmlspecialchars($errors['name']['required']) . "</span>" : false ?>
                <?php echo (!empty($errors['name']['min'])) ? "<span class='message-error'>" . htmlspecialchars($errors['name']['min']) . "</span>" : false ?>
                <label class="label">Email</label>
                <input class="text" type="text" name="email" value="<?php echo htmlspecialchars($email); ?>">
                <?php echo (!empty($errors['email']['required'])) ? "<span class='message-error'>" . htmlspecialchars($errors['email']['required']) . "</span>" : false ?>
                <?php echo (!empty($errors['email']['invalid'])) ? "<span class='message-error'>" . htmlspecialchars($errors['email']['invalid']) . "</span>" : false ?>
                <label class="label">Số điện thoại</label>
                <input class="text" type="text" name="sdt" value="<?php echo htmlspecialchars($sdt); ?>">
                <?php echo (!empty($errors['sdt']['required'])) ? "<span class='message-error'>" . htmlspecialchars($errors['sdt']['required']) . "</span>" : false ?>
                <?php echo (!empty($errors['sdt']['invalid'])) ? "<span class='message-error'>" . htmlspecialchars($errors['sdt']['invalid']) . "</span>" : false ?>
                <?php echo (!empty($errors['sdt']['min'])) ? "<span class='message-error'>" . htmlspecialchars($errors['sdt']['min']) . "</span>" : false ?>
                <label class="label">Địa chỉ</label>
                <input class="text" type="text" name="diachi" value="<?php echo htmlspecialchars($diachi); ?>">
                <?php echo (!empty($errors['diachi']['required'])) ? "<span class='message-error'>" . htmlspecialchars($errors['diachi']['required']) . "</span>" : false ?>
                <input class="submit--register" type="submit" name="dangky" value="Đăng ký">
            </div>
        </div>
    </form>

    <?php if (!empty($success_message)) { ?>
        <script language="javascript">
            alert("<?php echo htmlspecialchars($success_message); ?>");
            window.location = "index.php?action=login";
        </script>
    <?php } ?>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordField = document.getElementById('password');
            const eyeIcon = document.querySelector('.toggle-password .fa');

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
    </script>
</body>

</html>
