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
$field = $row['field'];
$query = "SELECT * from complaints where comptype = '$field' AND status = 'Pending'";
$res = mysqli_query($conn, $query);
$rows = mysqli_fetch_all($res, MYSQLI_ASSOC);
$count = mysqli_num_rows($res);
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
    <link rel="stylesheet" href="./officer.css">
    <title>Officer</title>
</head>

<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST['approve']) || empty($_POST['details'])) {
    ?>
            <script>
                swal({
                    text: " Invalid form",
                    icon: "error",
                });
            </script>
            <?php
        } else {
            $approve = $_POST['approve'];
            $details = $_POST['details'];
            $id = $_POST["id"];
            $sql = "UPDATE `complaints` SET `status`='$approve',`solution`='$details' where comp_id = $id";
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
                        text: "Updated successfully",
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
        <div style="float:right;">
            <button type="button" id="logout" name="logout" onclick="document.location.href = './logout.php'">Logout</button>
        </div>
    </div>
    <h2>Officer Id: <?php echo $login_Session; ?></h2>
    <h2>Pending Complaints: <?php echo $count; ?></h2>
    <table>
        <tr>
            <th>Complaint No.</th>
            <th>User Id</th>
            <th>User email</th>
            <th>Complaint type</th>
            <th>Complaint detail</th>
            <th>Area</th>
            <th>Specific location</th>
            <th>Status</th>
            <th>Update Status</th>
        </tr>
        <?php
        foreach ($rows as $row) {
        ?>
            <tr id="<?php echo $row['comp_id'] ?>">
                <td><?php echo $row['comp_id']; ?></td>
                <td><?php echo $row['usercomp_id']; ?></td>
                <?php
                $id = $row['usercomp_id'];
                $query2 = "Select * from users where id = '$id'";
                $res2 = mysqli_query($conn, $query2);
                $r = mysqli_fetch_assoc($res2);
                ?>
                <td><?php echo $r['email']; ?></td>
                <td><?php echo $row['comptype']; ?></td>
                <td><?php echo $row['compdetail']; ?></td>
                <td><?php echo $row['comparea']; ?></td>
                <td><?php echo $row['complocality']; ?></td>
                <td><?php echo $row['status']; ?></td>
                <td><button id="uploadbtn" onclick="show()">Post</button></td>

            </tr>
        <?php
        }
        ?>
    </table>
    <div id="update">
        <div class="innercont">
            <div class="innerclose">
                <h2>Post Complaint Status<span class="close" onclick="update_close()">x</span></h2>
            </div>
            <div class="mainform">
                <form id="postStatus" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                    <input type="hidden" name="id" id="cid" value="">
                    <div class="step">
                        <p><label for="approve">Status</label>
                            <select name="approve" id="complete" oninput="this.className = ''">
                                <option value="--choose--">--Choose--</option>
                                <option value="Completed">Completed</option>
                                <option value="Rejected">Rejected</option>
                            </select>
                        </p>
                    </div>
                    <div class="step">
                        <p><textarea name="details" id="details" oninput="this.className = ''" cols="60" rows="10" placeholder="Details"></textarea>
                        </p>
                    </div>
                    <div style="overflow:auto; text-align:center;">
                        <button type="submit" id="postBtn" name="postbtn">Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        var rowId;

        function show() {
            rowId = event.target.parentNode.parentNode.id;
            document.getElementById("cid").value = rowId;
            console.log(rowId);
            document.getElementById("update").style.display = "flex";
        }

        function update_close() {
            document.getElementById("update").style.display = "none";
        }
    </script>
</body>

</html>