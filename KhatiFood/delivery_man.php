<?php
function fnc()
{
    $uname = $_GET['uname'];
    include "db_connect.php";
    if (isset($_POST['morder'])) {
        $qry = "SELECT q1.fo_name, q1.user_first_name, q1.user_last_name, q1.user_phone, q1.user_city, q1.user_area, q1.user_location, q1.c_first_name, q1.c_last_name, q1.c_phone, q1.c_city, q1.c_area, q1.c_location
      FROM (SELECT t2.username, t2.first_name as user_first_name, t2.last_name as user_last_name, t2.phone as user_phone, t2.city as user_city, t2.area as user_area, t2.location as user_location, t1.o_id, t1.f_id, t1.fo_name, t1.category, t1.first_name as c_first_name, t1.last_name as c_last_name, t1.phone as c_phone, t1.city as c_city, t1.area as c_area, t1.location as c_location
                  FROM (SELECT e1.f_id, e1.o_id,  e1.fo_name, e1.category, e2.first_name, e2.last_name, e2.phone, e2.city, e2.area, e2.location
                        FROM (SELECT order_table.o_id, food.f_id, food.fo_name, food.category
                              FROM order_table
                              LEFT JOIN food
                              ON food.f_id = order_table.f_id) as e1
                        LEFT JOIN (SELECT order_table.o_id, customer.first_name, customer.last_name, customer.phone, customer.city, customer.area, customer.location
                                   FROM order_table
                                   LEFT JOIN customer
                                   ON customer.username = order_table.username) as e2
                        ON e1.o_id = e2.o_id) AS t1
                  LEFT JOIN (SELECT supplier.*, food.f_id
                             FROM food
                             LEFT JOIN supplier
                             ON food.username = supplier.username) as t2
                  ON t1.f_id = t2.f_id) as q1
       
       INNER JOIN (SELECT s_d.uname_s, s_d.uname_d
                  FROM delivery_man
                  INNER JOIN s_d
                  ON s_d.uname_d = delivery_man.username) as q2
       ON q2.uname_s = q1.username
       WHERE q2.uname_d = '$uname'";
        $result = mysqli_query($conn, $qry);
        $count = mysqli_num_rows($result);
        if ($count > 0) {
            echo "<table border=1>
        <tr>
          <th>Food Name</th>
          <th>Supplier Name</th>
          <th>Supplier Phone</th>
          <th>Supplier City</th>
          <th>Supplier area</th>
          <th>Supplier location</th>
          <th>Customer Name</th>
          <th>Customer Phone</th>
          <th>Customer City</th>
          <th>Customer area</th>
          <th>Customer location</th>
        </tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                $foname = $row['fo_name'];
                $sname = $row['user_first_name'] . " " . $row['user_last_name'];
                $sphone = $row['user_phone'];
                $scity = $row['user_city'];
                $sarea = $row['user_area'];
                $slocation = $row['user_location'];
                $cname = $row['c_first_name'] . " " . $row['c_last_name'];
                $cphone = $row['c_phone'];
                $ccity = $row['c_city'];
                $carea = $row['c_area'];
                $clocation = $row['c_location'];

                echo "<tr> <form action='' method='POST'>
            <td >$foname</td>
            <td >$sname</td>
            <td >$sphone</td>
            <td >$scity</td>
            <td >$sarea</td>
            <td >$slocation</td>
            <td >$cname</td>
            <td >$cphone</td>
            <td >$ccity</td>
            <td >$carea</td>
            <td >$clocation</td>
            </form>
           </tr>";
            }
            echo "</table><br><br>
          <label style='color: #ddd;'>If you confirmed that all of your order has delivered then click here: </label><br>
          <form action='' method='POST'>
          <button name='cnfrm' type='submit' style='float: left; color:brown; padding:15px 10px;'>Confirm All</button>
           </form>";
        } else echo "<h2 style='color: white;'>You have no order to delivery now</h2>";
    }
    if (isset($_POST['cnfrm'])) {
        $qry = "DELETE FROM s_d WHERE uname_d = '$uname'";
        mysqli_query($conn, $qry);
    }
}

if (isset($_POST['logout'])) {
    header("location: Home_Page.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Man Khati Food</title>
    <link rel="stylesheet" href="css/Delivery_man.css">
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
    <div class="btn">
        <form action="" method="POST">
            <button name="morder" type="submit" style="float: left; color:brown; padding:15px 10px;">My Orders</button>
        </form>
        <?php fnc(); ?>

    </div>
</div>

<?php include "footer.html"; ?>

</body>
</html> 