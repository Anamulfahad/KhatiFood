<?php
$conn = null;
include "db_connect.php";

if (isset($_POST['login'])) {
    $count = 0;
    $page = $_POST['login_as'];
    $u_name = $_POST['u_name'];
    $pass = $_POST['pass'];

    $var_userName = false;
    $var_password = false;

//    $pc = "SELECT * FROM $page WHERE username='$u_name' and pass_word='$pass'";
    $pc = "SELECT * FROM $page WHERE username='$u_name'";

    $count = 0;
    if ($conn != null) {
        $result = $conn->query($pc);
        $count = $result->num_rows;
    }

//    checks if userName exits or not
    if ($count > 0)
        $var_userName = true;

    $pc = "SELECT * FROM $page WHERE username='$u_name' and pass_word='$pass'";

    $count = 0;
    if ($conn != null) {
        $result = $conn->query($pc);
        $count = $result->num_rows;
    }

//    checks if the password is correct or not
    if ($count > 0)
        $var_password = true;


    if ($var_userName && $var_password) {
        if ($page === 'supplier') {
            header("location: supplier.php?uname=$u_name");
        } else if ($page === 'customer') {
            header("location: customer.php?uname=$u_name");
        } else if ($page === 'delivery_man') {
            header("location: delivery_man.php?uname=$u_name");
        }
    } else if (!$var_userName) {
        echo '<script>alert("userName does not exits!!")</script>';
    } else {
        echo '<script>alert("wrong password!!")</script>';
    }
}