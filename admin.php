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
    $staff_check = $_SESSION['login_staff'];
    $sql = "SELECT * from staff_login where staff_id = '$staff_check' ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $login_Session = $row['staff_id'];
    if (!isset($login_Session)) {
        mysqli_close($conn);
        header('location: ./login.php');
    }
    $query = "SELECT * from complaints";
    $res = mysqli_query($conn,$query);
    $rows = mysqli_fetch_all($res,MYSQLI_ASSOC);

    $query1 = "SELECT status FROM `complaints` WHERE status = 'Pending';";
    $res1 = mysqli_query($conn,$query1);
    $count1 = mysqli_num_rows($res1);

    $query2 = "SELECT status FROM `complaints` WHERE status = 'Completed';";
    $res2 = mysqli_query($conn,$query2);
    $count2 = mysqli_num_rows($res2);

    $query3 = "SELECT status  FROM `complaints` WHERE status = 'Rejected';";
    $res3 = mysqli_query($conn,$query3);
    $count3 = mysqli_num_rows($res3);
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
    <link rel="stylesheet" href="./admin.css">
    <title>Admin</title>
</head>

<body>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST['offname']) || empty($_POST['offemailid']) || empty($_POST['offpsw']) || empty($_POST['offField'])) {
    ?>
                <script>
                    swal({
                        text: " Invalid form",
                        icon: "error",
                    });
                </script>
                <?php
            } else {
                $offid = $_POST['offname'];
                $offemail = $_POST['offemailid'];
                $offpsw = $_POST["offpsw"];
                $offfield = $_POST["offField"];
                $sql = "INSERT INTO `staff_login` (`staff_id`, `email`, `password`, `field`) VALUES ('$offid', '$offemail', '$offpsw', '$offfield')";
                $result = mysqli_query($conn, $sql);
                if (!$result) {
                ?>
                    <script>
                        swal({
                            text: "Failure",
                            icon: "error",
                        });
                    </script>
                <?php
                } else {
                ?>
                    <script>
                        swal({
                            text: "Registered successfully",
                            icon: "success",
                        });
                    </script>
                <?php
                }
            }
        }
    ?>
    <div style="overflow:auto;" class="logout">
        <div class="icon" style="float:left;">
            <a href="./user.php"><i class="fa-solid fa-house"></i></a>
        </div>
        <h1>Admin Panel</h1>
        <div class="lgbtn">
            <button type="button" id="logout" name="logout" onclick="document.location.href = './logout.php'">Logout</button>
        </div>
    </div>
    <div class="reportCont">
    <div class="report">
        <h3>Pending Complaints: <?php echo $count1;?></h3>
        <h3>Completed Complaints: <?php echo $count2;?></h3>
        <h3>Rejected Complaints: <?php echo $count3;?></h3>
    </div>
    </div>
    <button class="regoffbtn" onclick="registerOfficer()">Register an officer</button>
    <table>
        <tr>
            <th>Complaint No.</th>
            <th>User Id</th>
            <th>Complaint type</th>
            <th>Complaint detail</th>
            <th>Area</th>
            <th>Specific location</th>
            <th>Status</th>
        </tr>
        <?php
        foreach ($rows as $row) {
        ?>
            <tr>
            <td><?php echo $row['comp_id']; ?></td>
            <td><?php echo $row['usercomp_id']; ?></td>
            <td><?php echo $row['comptype']; ?></td>
            <td style="text-align:left;"><?php echo $row['compdetail']; ?></td>
            <td><?php echo $row['comparea']; ?></td>
            <td><?php echo $row['complocality']; ?></td>
            <td><?php echo $row['status']; ?></td>
            </tr>
    <?php
        }
        ?>
    </table>
    <div id="registerForm">
        <div class="innercont">
            <div class="innerclose">
                <h2>Register new officer<span class="close" onclick="register_close()">x</span></h2>
            </div>
            <div class="mainform">
                <form id="regform" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                    <div class="tab">
                        <p><label for="offname">Officer Id</label>
                            <input type="text" name="offname" id="staffName" oninput="this.className = ''">
                        </p>
                        <p><label for="offemail">Email</label>
                            <input type="email" id="offemail" name="offemailid" placeholder="abc@gmail.com" oninput="this.className = ''">
                        </p>
                        <p><label for="offpsw">Password</label>
                            <input type="password" name="offpsw" id="staffpsw" oninput="this.className = ''">
                        </p>
                        <p>
                            <label for="offField">Select Field</label>
                            <select name="offField" id="staffField" oninput="this.className = ''">
                                <option value="--choose--">--Choose--</option>
                                <option value="Removal of garbage">Removal of garbage</option>
                                <option value="Mosquito menace">Mosquito menace</option>
                                <option value="Street dogs">Street dogs</option>
                                <option value="Staganation of water">Staganation of water</option>
                                <option value="Non burning of street lights">Non burning of street lights</option>
                            </select>
                        </p>
                    </div>
                    <div style="overflow:auto; text-align:center;">
                        <button type="submit" id="offBtn" name="offbtn">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function registerOfficer() {
            document.getElementById("registerForm").style.display = "flex";
        }
        function register_close(){
            document.getElementById("registerForm").style.display = "none";
        }
    </script>
</body>

</html>