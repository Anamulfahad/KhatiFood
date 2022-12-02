<?php
include_once "startPage/signUp.php";
include_once "startPage/logIn.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khati Food</title>
    <link rel="stylesheet" href="css/Home_Page.css">
</head>
<body>
<div class="head">
    <div class="img">
        <img src="img/KhatiFoodlogoround.png" width="300" height="90">
    </div>

</div>
<div class="container">
    <div class="card">
        <div class="inner-box" id="card">

            <!-- Log in part -->
            <div class="card-front">
                <h2 style="font-family: cursive; color:white; text-align: center;">khati Food</h2>
                <form action="" method="POST">
                    <!--                    <h2>LOGIN</h2>-->
                    <h5> Login as:
                        <br>
                        <input type="radio" name="login_as"
                            <?php if (isset($login_as) && $login_as == "supplier") echo "checked"; ?>
                               value="supplier">Supplier
                        <input type="radio" name="login_as"
                            <?php if (isset($login_as) && $login_as == "customer") echo "checked"; ?>
                               value="customer">Customer
                        <input type="radio" name="login_as"
                            <?php if (isset($login_as) && $login_as == "delivery") echo "checked"; ?>
                               value="delivery_man">Delivery Man
                    </h5>
                    <form action="" method="POST">
                        <input name="u_name" type="text" class="input-box" placeholder="User Name" required name=""
                               id="">
                        <input name="pass" type="password" class="input-box" placeholder="password" required
                               name="" id="">
                        <button name='login' type="submit" class="submit-btn">logIn</button>

                    </form>
                    <button type="button" class="btn" onclick="openRegister()">Create New Account</button>
                    <a href="">Forgotten password?</a>
            </div>

            <!-- Reg Part -->
            <div class="card-back">
                <form action="" method="POST">
                    <h2>REGISTER</h2>
                    <h5>Register as:
                        <br>
                        <input type="radio" name="reg_as"
                            <?php if (isset($reg_as) && $reg_as == "supplier") echo "checked"; ?>
                               value="supplier">Supplier
                        <input type="radio" name="reg_as"
                            <?php if (isset($reg_as) && $reg_as == "customer") echo "checked"; ?>
                               value="customer">Customer
                        <input type="radio" name="reg_as"
                            <?php if (isset($reg_as) && $reg_as == "delivery") echo "checked"; ?>
                               value="delivery_man">Delivery Man
                    </h5>

                    <input name="u_name" type="text" class="input-box" placeholder="Enter user name" required name=""
                           id="">
                    <input name="f_name" type="text" class="input-box" placeholder="First Name" required name="" id="">
                    <input name="l_name" type="text" class="input-box" placeholder="Last name" required name="" id="">
                    <h5><label for="date" style="color: white">Date of Birth: </label></h5>
                    <input name="dob" type="date" class="input-box" placeholder="Date of Birth" required name="" id="">
                    <input name="p_number" type="text" class="input-box" placeholder="Phone Number" required name=""
                           id="">
                    <input name="email" type="email" class="input-box" placeholder="Enter your email" id="">
                    <h5><label for="address" style="color: white">Address: </label></h5>
                    <input name="city" type="text" class="input-box" placeholder="City" required name="" id="">
                    <input name="area" type="text" class="input-box" placeholder="Area/Thana" required name="" id="">
                    <input name="location" type="text" class="input-box" placeholder="Location" required name="" id="">
                    <input name="pass" type="password" class="input-box" placeholder="Enter your password" required
                           name="" id="">
                    <button name="create" type="submit" class="submit-btn">Create</button>
                    <button type="button" class="btn" onclick="openLogin()">I have an account</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include "footer.html"; ?>

<script>
    let card = document.getElementById("card");

    function openRegister() {
        card.style.transform = "rotateY(-180deg)";
    }

    function openLogin() {
        card.style.transform = "rotateY(0deg)";
    }

    function myFunction() {
        confirm("Invalid User Name or Password");
    }
</script>

</body>
</html> 