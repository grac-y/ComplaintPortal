<?php
    session_start();
    $db_hostname = "127.0.0.1";
    $db_user = "root";
    $db_password = "";
    $db_name = "complaintregistration";

    $conn = mysqli_connect($db_hostname, $db_user, $db_password, $db_name);

    if (!$conn) {
        echo "connection failed! " . mysqli_connect_error();
        exit;
    }
    if (isset($_SESSION['login']) && $_SESSION['login'] != '')
    {
        if ($_SESSION['login'] == "invalid") 
        {
?>
            <script>
                swal({
                    text: " Invalid UserName or Password",
                    icon: "error",
                });
            </script>
<?php
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <link rel="stylesheet" href="./common.css">
    <link rel="stylesheet" href="./login.css">
    <title>Login</title>
</head>

<body>
    <div id="loginForm" class="login-box">
        <form id="login" action="./login_check.php" method="POST">
            <h2>Login Page</h2>
            <div class="input_login">
                <input type="text" name="uname" id="userid" oninput="this.className = ''">
                <label for="uname">UserName</label>
                
            </div>
            <div class="input_login">
                <input type="password" name="psw" id="password" oninput="this.className = ''">
                <label for="psw">Password</label>

            </div>
            <center>
            <button type="submit" id="loginBtn" name="loginbtn"><a>LOGIN<span></span></a></button>
            </center>
        </form>
    </div>
</body>

</html>