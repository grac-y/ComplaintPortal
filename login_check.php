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

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        if (isset($_POST['loginbtn']))
        {
            if (empty($_POST['uname'] || $_POST['psw'])) 
            {
                $_SESSION['login'] = "invalid";
                header("location: ./login.php");
                exit;
            } 
            else 
            {
                $staffid = $_POST['uname'];
                $psw = $_POST['psw'];
                $query = "SELECT * from staff_login where staff_id = '$staffid' AND password = '$psw'";
                $result = mysqli_query($conn, $query);
                $rows = mysqli_num_rows($result);
                if($rows == 1) 
                {
                    $_SESSION['login'] = "login";
                    $_SESSION['login_staff'] = $staffid;
                    $row = mysqli_fetch_assoc($result);
                    $dept = $row['department'];
                    $field = $row['field'];
                    if($dept == "admin")
                    {
                        header("location: ./admin.php");
                    }
                    else
                    {
                        $_SESSION['field']=$field;
                        header("location: ./officer.php");
                    }
                }
                else 
                {
                    $_SESSION['login'] = "invalid";
                    header("location: ./login.php");  
                }
            }
        }
    }