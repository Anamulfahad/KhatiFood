<?php
$conn = null;
include "db_connect.php";

if (isset($_POST['create'])) {
    $page = $_POST['reg_as'];
    $u_name = $_POST['u_name'];
    $p_number = $_POST['p_number'];
    $email = $_POST['email'];
    $f_name = $_POST['f_name'];
    $l_name = $_POST['l_name'];
    $dob = $_POST['dob'];
    $city = $_POST['city'];
    $area = $_POST['area'];
    $location = $_POST['location'];
    $pass = $_POST['pass'];
    $pc = "SELECT * FROM $page WHERE username='$u_name'";


    $count = 0;
    if ($conn != null) {
        $result = $conn->query($pc);
        $count = $result->num_rows;
    }

    if ($count > 0) {
        echo '<script>alert("Username Exist, please enter a unique username")</script>';
    } else {
        $insert = "INSERT INTO $page(`username`, `phone`, `email`, `first_name`, `last_name`, `dob`, `city`, `area`, `location`, `pass_word`)"
            . "VALUES('$u_name',' $p_number','$email', '$f_name','$l_name','$dob','$city','$area','$location','$pass')";
        $res = mysqli_query($conn, $insert);
        if ($res === true) {
            ?>
            <script>
                alert('Registered successfully!');
            </script>
            <?php
        }
    }
}
