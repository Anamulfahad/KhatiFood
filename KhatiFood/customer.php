<?php
if (isset($_POST['logout'])) {
    header("location: Home_Page.php");
}

// include relevant functions
include "customerModule/search.php";
include "customerModule/order.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Khati Food</title>
    <link rel="stylesheet" href="css/Customer.css">
</head>
<body>
<div class="head">
    <div class="column"><img src="img/KhatiFoodlogoround.png" width="300" height="100%"></div>
    <div class="column1">
        <form action="" method="POST">
            <div class="btn">
                <button name="logout" type="submit" style="float: right; color:brown; padding:15px 10px;">Logout
                </button>
            </div>
        </form>
    </div>
</div>

<div class="container">

    <div class="grid1">
        <div class="category">
            <form action="" method="POST">
                <select name="category" id="ctgry" style="width: 200px; height:40px">
                    <option>Search by Category</option>
                    <option value="Rice">Rice</option>
                    <option value="Vegetable">Vegetable</option>
                    <option value="Fish">Fish</option>
                    <option value="Chicken">Chicken</option>
                    <option value="Mutton">Mutton</option>
                    <option value="Beef">Beef</option>
                    <option value="Vorta">
                        <button name="ctgr" type="submit" class="cat_btn">Vorta</button>
                    </option>
                    <option value="Snacks">
                        <button name="ctgr" type="submit" class="cat_btn">Snacks</button>
                    </option>
                    <option value="Native cake">
                        <button name="ctgr" type="submit" class="cat_btn">Native cake</button>
                    </option>
                    <option value="Dessert">
                        <button name="ctgr" type="submit" class="cat_btn">Dessert</button>
                    </option>
                    <option value="Juice">
                        <button name="ctgr" type="submit" class="cat_btn">Juice</button>
                    </option>
                    <option value="Others">
                        <button name="ctgr" type="submit" class="cat_btn">Others</button>
                    </option>
                </select>
                <button name="sbc" type="submit" class="btn1">Search</button>
            </form>
        </div>
        <form action="" method="POST">
            <div class="search">
                <div class="s_bar">
                    <input name="s_bar" type="text" class="input-box" placeholder="Search food" required name="" id="">
                    <button name="srch" type="submit" class="btn2">Search</button>
                </div>
            </div>
        </form>
    </div>
    <div class="ord">
        <form action="" method="POST">
            <?php search(); ?><br>
            <h2>CLick here to see your orders:</h2>
            <button name="morder" type="submit" class="btn2">My Orders</button>
            <?php order(); ?>
            <br><br><label>
                <h2>If you received all orders then press 'All Received'</h2>
            </label>
            <button name="rcv" type="submit" class="btn2">All Received</button>
        </form>
        <form action="" method="POST">
            <label><h2>If you have received a particular order then
                    enter the order id and press the button 'Received'</h2>
            </label>
            <input name="id" type="text" placeholder="Order Id" required name="" id="">
            <button name="rcvp" type="submit" class="btn2">Received</button>
        </form>
    </div>

</div>

<?php include "footer.html"; ?>

</body>
</html> 
