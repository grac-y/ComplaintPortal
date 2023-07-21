<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <link rel="stylesheet" href="./common.css">
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <?php
        if (isset($_SESSION['register']) && $_SESSION['register'] != '') {
            if ($_SESSION['register'] == "yes") {
    ?>
                <script>
                    swal({
                        title: "Registered Successfully",
                        icon: "success",
                    });
                </script>
            <?php
            }
            if ($_SESSION['register'] == "no") {
            ?>
                <script>
                    swal({
                        text: "Invalid form",
                        icon: "error",
                    });
                </script>
        <?php
            }
            unset($_SESSION['login']);
        }
    ?>
    <div class="imgform">
        <div class="vecimg">
            <img src="./images/stillimage.png" alt="error">
        </div>
        <form id="regForm" action="usersubmit.php" method="post">
            <h1>
                <div class="compstyle">Complaint </div>Registration
            </h1>
            <h3>
                <a href="./complaintStatus.php" class="status">View Complaint Status</a>
            </h3>
            <div class="tab">
                <p><label for="email">Email</label>
                    <input type="email" id="email1" name="emailid" placeholder="abc@gmail.com" oninput="this.className = ''">
                </p>
                <p><label for="username">Name</label>
                    <input type="text" name="uname" id="username1" oninput="this.className = ''">
                </p>
                <p><label for="phone">Phone</label>
                    <input type="number" name="phnno" id="phone1" oninput="this.className = ''">
                </p>
                <p>
                    <label for="pincode">Pincode</label>
                    <input type="text" name="pin" id="pincode1" oninput="this.className = ''">
                </p>
                <p>
                    <label for="state">State</label>
                    <input type="text" name="state" id="state1" oninput="this.className = ''">
                </p>
                <p>
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address1" oninput="this.className = ''">
                </p>
            </div>
            <div class="tab">
                <p>
                    <label for="complainttypes">Frequenty filed complaint types</label>
                    <select name="types" id="complaint" oninput="this.className = ''">
                        <option value="--choose--">--Choose--</option>
                        <option value="Removal of garbage">Removal of garbage</option>
                        <option value="Mosquito menace">Mosquito menace</option>
                        <option value="Street dogs">Street dogs</option>
                        <option value="Staganation of water">Staganation of water</option>
                        <option value="Non burning of street lights">Non burning of street lights</option>
                    </select>
                </p>

                <p>
                    <textarea name="details" id="details" oninput="this.className = ''" cols="60" rows="10" placeholder="details about your complaint"></textarea>

                </p>
                <p>
                    <label for="area">Area </label>
                    <select name="area" id="area" oninput="this.className = ''">
                        <option value="7HBus stand">7HBus stand</option>
                        <option value="vikas colony">Vikas Colony</option>
                        <option value="punjabibagh">Punjabi Bagh</option>
                        <option value="greentown">Urban Estate Phase 1</option>
                        <option value="greentown">Urban Estate Phase 2</option>
                        <option value="greentown">Urban Estate Phase 3</option>
                        <option value="greentown">Urban Estate Phase 4</option>
                        <option value="greentown">Greentown</option>
                        <option value="greentown">Markel Colony</option>
                        <option value="greentown">Ajit Nagar</option>
                        <option value="greentown">SSST Nagar</option>
                        <option value="greentown">Cheema Bagh</option>
                        <option value="greentown">Sunny Enclave</option>
                        <option value="greentown">Green Enclave</option>
                        <option value="greentown">Trikon City</option>
                    </select>
                </p>
                <p>
                    <textarea name="specificloc" id="location" oninput="this.className = ''" cols="60" rows="10" placeholder="specific location"></textarea>
                </p>
            </div>
            <div style="overflow:auto;">
                <div style="float:right;">
                    <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                    <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        var currentTab = 0;
        showTab(currentTab);

        function showTab(n) {
            var x = document.getElementsByClassName("tab");
            x[n].style.display = "block";
            if (n == 0) {
                document.getElementById("prevBtn").style.display = "none";
            } else {
                document.getElementById("prevBtn").style.display = "inline";
            }
            if (n == (x.length - 1)) {
                document.getElementById("nextBtn").innerHTML = "Submit";
            } else {
                document.getElementById("nextBtn").innerHTML = "Next";
            }
            fixStepIndicator(n)
        }

        function nextPrev(n) {
            var x = document.getElementsByClassName("tab");
            if (n == 1 && !validateForm())
                return false;
            x[currentTab].style.display = "none";
            currentTab = currentTab + n;
            if (currentTab >= x.length) {
                document.getElementById("regForm").submit();
                return false;
            }
            showTab(currentTab);
        }

        function validateForm() {
            var x, y, i, valid = true;
            x = document.getElementsByClassName("tab");
            y = x[currentTab].getElementsByTagName("input");
            z = x[currentTab].getElementsByTagName("select");
            for (i = 0; i < y.length; i++) {
                if (y[i].value == "" && y[i].attributes['id'].value != "myfile") {
                    y[i].className += " invalid";
                    valid = false;
                }
            }
            for (i = 0; i < z.length; i++) {
                if (z[i].value == "") {
                    z[i].className += " invalid";
                    valid = false;
                }
            }
            if (valid) {
                document.getElementsByClassName("tab")[currentTab].className += " finish";
            }
            return valid;
        }

        function fixStepIndicator(n) {
            var i, x = document.getElementsByClassName("tab");
            for (i = 0; i < x.length; i++) {
                x[i].className = x[i].className.replace(" active", "");
            }
            x[n].className += " active";
        }
    </script>

</body>

</html>
