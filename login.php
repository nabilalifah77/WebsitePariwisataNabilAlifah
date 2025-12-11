<?php
session_start();
include "koneksi.php";

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    $query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role'];

        if ($row['role'] == 'admin') {
            header("Location: admin/dashboard.php");
        } else {
            header("Location: index.php");
        }
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}

if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    $check = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");
    if (mysqli_num_rows($check) > 0) {
        $error_register = "Username sudah digunakan!";
    } else {
        $insert = mysqli_query($koneksi, "INSERT INTO users (username, password, role) VALUES ('$username', '$password', 'user')");
        if ($insert) {
            $success_register = "Akun berhasil dibuat! Silakan login.";
        } else {
            $error_register = "Gagal membuat akun!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - Pariwisata Jogja</title>
<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:Poppins,sans-serif;}
body{background:linear-gradient(135deg,#0099ff,#00bfff);height:100vh;display:flex;justify-content:center;align-items:center;overflow:hidden;}
.auth-container{width:380px;background:#fff;border-radius:20px;box-shadow:0 0 35px rgba(0,0,0,0.2);position:relative;padding:40px 30px;transition:all 0.6s ease;transform:scale(0.95);opacity:0;animation:fadeInUp 0.8s ease forwards;}
@keyframes fadeInUp{from{opacity:0;transform:translateY(40px) scale(0.95);}to{opacity:1;transform:translateY(0) scale(1);}}
h2{color:#0099ff;text-align:center;margin-bottom:25px;}
.input-box{position:relative;margin-bottom:20px;}
.input-box input{width:100%;padding:12px 10px;border:1px solid #ccc;border-radius:10px;outline:none;font-size:15px;transition:0.3s;}
.input-box input:focus{border-color:#0099ff;box-shadow:0 0 5px rgba(0,153,255,0.3);}
button{width:100%;padding:12px;background:#0099ff;border:none;color:white;border-radius:10px;font-size:16px;cursor:pointer;transition:0.3s;}
button:hover{background:#007acc;}
.toggle-link{color:#007acc;cursor:pointer;font-weight:500;margin-top:10px;display:inline-block;text-align:center;}
.message{text-align:center;margin-bottom:10px;}
.error{color:red;font-size:14px;}
.success{color:green;font-size:14px;}
.hidden{display:none;}
.auth-inner{transition:transform 0.6s;transform-style:preserve-3d;position:relative;}
.form-box{position:absolute;width:100%;backface-visibility:hidden;top:0;left:0;}
.form-box.register{transform:rotateY(180deg);}
</style>
</head>
<body>

<div class="auth-container" id="authContainer">
    <div class="auth-inner" id="authInner">
        <div class="form-box login">
            <h2>Login</h2>
            <div class="message">
                <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
                <?php if (isset($success_register)) echo "<p class='success'>$success_register</p>"; ?>
            </div>
            <form method="post">
                <div class="input-box">
                    <input type="text" name="username" placeholder="Username" required>
                </div>
                <div class="input-box">
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit" name="login">Masuk</button>
            </form>
            <p class="toggle-link" onclick="toggleForm()">Belum punya akun? Daftar</p>
        </div>

        <div class="form-box register">
            <h2>Buat Akun</h2>
            <div class="message">
                <?php if (isset($error_register)) echo "<p class='error'>$error_register</p>"; ?>
            </div>
            <form method="post">
                <div class="input-box">
                    <input type="text" name="username" placeholder="Buat Username" required>
                </div>
                <div class="input-box">
                    <input type="password" name="password" placeholder="Buat Password" required>
                </div>
                <button type="submit" name="register">Daftar</button>
            </form>
            <p class="toggle-link" onclick="toggleForm()">Sudah punya akun? Login</p>
        </div>
    </div>
</div>

<script>
const authInner = document.getElementById("authInner");

function toggleForm() {
    authInner.style.transform = authInner.style.transform === "rotateY(180deg)" ? "rotateY(0deg)" : "rotateY(180deg)";
}

document.addEventListener("DOMContentLoaded", () => {
    const box = document.getElementById("authContainer");
    box.style.opacity = "0";
    setTimeout(() => {
        box.style.transition = "all 0.6s ease";
        box.style.opacity = "1";
    }, 100);
});
</script>

</body>
</html>
