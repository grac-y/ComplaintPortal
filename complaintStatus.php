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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Complaint Status</title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />

    <link rel="stylesheet" href="./common.css">
    <link rel="stylesheet" href="./compStatusCSS.css">
</head>

<body>
    <div style="overflow:auto;" class="login">
    <div class="icon" style="float:left;" >
        <a href="./user.php"><i class="fa-solid fa-house"></i></a>
    </div>
        <div style="float:right;" class="status-button">
            <button type="button" id="loginBtn" name="login" onclick="document.location.href = './login.php'">Login</button>
        </div>
    </div>
    <div class="container">
        <div  id="status_form">
            <div id="inputForm">
                <form id="compStatus" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                    <h2>Check Your Complaint Status</h2>
                    <div class="input_comp_no">
                        <input type="number" name="c_id" id="comId" oninput="this.className = ''">
                        <label for="email">Enter Complaint Number</label>
                        
                    </div>
                    <center>
                        <button type="submit" id="goBtn" name="gobtn"><a>GO<span></span></a></button>
                    </center>
                </form>
            </div>
            <div id="detail">
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (empty($_POST['c_id'])) {
                ?>
                        <script>
                            swal({
                                text: " Invalid Complaint Number",
                                icon: "error",
                            });
                        </script>
                        <?php
                        unset($_SESSION['status_check']);
                    } else {
                        $c_id = $_POST['c_id'];

                        $query1 = "Select * from complaints where comp_id = '$c_id'";
                        $result1 = mysqli_query($conn, $query1);
                        if ($result1->num_rows == 0) {
                        ?>
                            <script>
                                swal({
                                    text: "Complaint Number does not exist",
                                    icon: "error",
                                });
                            </script>
                        <?php
                            unset($_SESSION['status_check']);
                        } else {
                            $row1 = mysqli_fetch_assoc($result1);
                            $comptype = $row1['comptype'];
                            $compdetail = $row1['compdetail'];
                            $user_id = $row1['usercomp_id'];
                            $area = $row1['comparea'];
                            $loc = $row1['complocality'];
                            $status = $row1['status'];

                            $query2 = "Select * from users where id = '$user_id'";
                            $result2 = mysqli_query($conn, $query2);
                            $row2 = mysqli_fetch_assoc($result2);
                            $name = $row2['name'];
                            $email = $row2['email'];
                            $address = $row2['address'];
                        ?>
                            <script>
                                document.getElementById("inputForm").style.display = "none";
                            </script>
                            <h2>Complainent Details</h2>
                            <p>Name : <?php echo $name; ?></p>
                            <p>Email Id : <?php echo $email; ?></p>
                            <p>Address : <?php echo $address; ?></p>
                            <h2>Complaint Details</h2>
                            <p>Complaint No. : <?php echo $c_id; ?> </p>
                            <p>Complaint Type : <?php echo $comptype; ?></p>
                            <p>Complaint Details : <?php echo $compdetail; ?></p>
                            <p>Area : <?php echo $area; ?></p>
                            <p>Locality : <?php echo $loc; ?></p>
                            <h3>Status : <span><?php echo $status; ?></span></h3>
                            <center>
                                    <button class="back" type="button" name="gobtn" onclick="document.location.href = './complaintStatus.php'"><a>BACK<span></span></a></button>
                            </center>
                <?php
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>