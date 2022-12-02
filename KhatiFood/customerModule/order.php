<?php

function order()
{
    $conn = null;

    // order part
    $uname = $_GET['uname'];
    include "db_connect.php";
    if (isset($_POST['orderbutton'])) {
        $f_id = $_POST['fids'];
        $qry = "INSERT INTO order_table(username, f_id, orderReadyMix) "
            . "VALUES('$uname', $f_id, 0)";
        $result = mysqli_query($conn, $qry);
        if ($result === true) {
            ?>
            <script>
                alert('Thank you for your order, hope you will get your food within 1/2 hour');
            </script>
            <?php
        }
    }
    if (isset($_POST['readyMix'])) {
        $f_id = $_POST['fids'];
        $qry = "INSERT INTO order_table(username, f_id, orderReadyMix) "
            . "VALUES('$uname', $f_id, 1)";
        $result = mysqli_query($conn, $qry);
        if ($result === true) {
            ?>
            <script>
                alert('Thank you for your order, hope you will get your food within 1/2 hour');
            </script>
            <?php
        }
    }


    if (isset($_POST['rcv'])) {
        $qry = "DELETE FROM order_table where username = '$uname'";
        mysqli_query($conn, $qry);
    }
    if (isset($_POST['rcvp'])) {
        $oid = $_POST['id'];
        $qry = "DELETE FROM order_table where o_id = $oid";
        mysqli_query($conn, $qry);
    }
    if (isset($_POST['morder'])) {
        $qry = "SELECT order_table.o_id, food.f_id, food.fo_name, food.category, food.price
                FROM order_table
                INNER JOIN food
                ON food.f_id = order_table.f_id
                WHERE order_table.username = '$uname'";
        $result = mysqli_query($conn, $qry);
        $count = mysqli_num_rows($result);
        if ($count > 0) {
            echo "<table border=1 width='100%'>
          <tr>
            <th>Order ID</th>
            <th>Food id</th>
            <th>Food Name</th>
            <th>Category</th>
            <th>Price</th>
          </tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                $o_id = $row['o_id'];
                $foid = $row['f_id'];
                $foname = $row['fo_name'];
                $fo_cat = $row['category'];
                $fpr = $row['price'];
                echo "<tr> <form action='' method='POST'>
        <td>$o_id</td>
        <td> $foid</td>
        <td>$foname</td>
        <td>$fo_cat</td>
        <td>$fpr</td>
        </form>
       </tr>";
            }
            echo "</table>";
        } else echo "No Orders!";
    }
}
