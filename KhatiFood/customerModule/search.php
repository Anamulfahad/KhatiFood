<?php

function search()
{
    $conn = null;

    $uname = $_GET['uname'];
    include "db_connect.php";
//    echo gettype($conn);

//    search by category
    if (isset($_POST['sbc'])) {
        $ctgry = $_POST['category'];
//        echo $ctgry;
        $qry = "SELECT supplier.first_name, supplier.last_name, food.fo_name, food.category, food.price, food.f_id "
            . "FROM food "
            . "INNER JOIN supplier "
            . "ON food.username = supplier.username "
            . "WHERE food.category = '$ctgry' "
            . "order by food.price";

        $result = $conn->query($qry);
//        echo gettype($result);
//        echo $result;
        $count = $result->num_rows;

        if ($count > 0) {
            echo "<table border=1 width='100%'>
          <tr>
            <th>Food ID</th>
            <th>Food Name</th>
            <th>Ingredients</th>
            <th>Category</th>
            <th>Price</th>
            <th>Supplier Name</th>
            <th></th>
          </tr>";

            include "customerModule/searchHelp.php";
            while ($row = mysqli_fetch_assoc($result)) {
                $fid = $row['f_id'];

//                passing food id to the function
//                returns the ingredients as a string
                $ingredients = getIngredients($fid);

                $fname = $row['fo_name'];
                $ct = $row['category'];
                $pr = $row['price'];
                $snm = $row['first_name'] . " " . $row['last_name'];
                echo "<tr> <form action='' method='POST'>
              <td ><input type='hidden' name='fids' value='$fid'/>$fid</input></td>
              <td >$fname</td>
              <td>$ingredients</td> 
              <td >$ct</td>
              <td >$pr</td>
              <td >$snm</td>
              <td><button type='submit' name='orderbutton'>order</button><br>
              <button type='submit' name='readyMix'>order ReadyMix</button></td>
              </form>
             </tr>";
            }
            echo "</table>";
        } else echo "$ctgry is not found";
    }

    // query to search by category or food name----------------------------------------------------------------------------

    if (isset($_POST['srch'])) {
        $src = $_POST['s_bar'];
        $qry = "SELECT supplier.first_name, supplier.last_name, food.fo_name, food.category, food.price, food.f_id
        FROM food
        INNER JOIN supplier
        ON food.username = supplier.username
        WHERE food.category= '$src' OR food.fo_name = '$src' OR food.fo_name LIKE '%$src%'
        order by food.price";
        $result = mysqli_query($conn, $qry);
        $count = mysqli_num_rows($result);
        if ($count > 0) {
            echo "<table border=1 width='100%'>
          <tr>
            <th>Food ID</th>
            <th>Food Name</th>
            <th>Ingredients</th>
            <th>Category</th>
            <th>Price</th>
            <th>Supplier Name</th>
            <th></th>
          </tr>";

            include "customerModule/searchHelp.php";
            while ($row = mysqli_fetch_assoc($result)) {
                $fid = $row['f_id'];

                $ingredients = getIngredients($fid);

                $fname = $row['fo_name'];
                $ct = $row['category'];
                $pr = $row['price'];
                $snm = $row['first_name'] . " " . $row['last_name'];
                echo "<tr> <form action='' method='POST'>
              <td><input type='hidden' name='fids' value='$fid'/>$fid</td>
              <td>$fname</td>
              <td>$ingredients</td>
              <td>$ct</td>
              <td>$pr</td>
              <td>$snm</td> 
              <td><button type='submit' name='readyMix'>order ReadyMix</button><br>
              <button type='submit' name='orderbutton'>order </button></td>
              </form>
             </tr>";
            }
            echo "</table>";
        } else echo "$src is not found";
    }
}