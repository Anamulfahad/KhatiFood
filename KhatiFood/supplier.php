<!-- Left Part -->

<?php
    $uname = $_GET['uname'];
    include "db_connect.php";

    // add part---------------------------------------------------------------------------------

    if(isset($_POST['add'])){
      $ctgry = $_POST['category'];
      $f_name =$_POST['f_name'];
      $price = $_POST['price'];

      $qry = "INSERT INTO food(category, username, fo_name, price) VALUES ('$ctgry', '$uname', '$f_name','$price')";
      $result = mysqli_query($conn , $qry);
      
      if($result === true){
        $qry_last_food_id = "SELECT f_id FROM food WHERE f_id=(SELECT max(f_id) FROM food)";
        $result_last_food_id = mysqli_query($conn , $qry_last_food_id);
        $row_last = mysqli_fetch_assoc($result_last_food_id);
        $last_food_id = $row_last['f_id']; 
        for($i = 1; $i<=10; $i++){
          $ingredientName = "ingredient".$i;
          $quantityName   = "quantity".$i;
          $ingredient = $_POST[$ingredientName];
          $quantity   = $_POST[$quantityName];
          if ($quantityName == NULL || $quantity == NULL){
            break;
          }
          $qry2 = "INSERT INTO ingredients(f_id, ingredient_name, quantity) VALUES ('$last_food_id', '$ingredient', '$quantity')";
          $result2 = mysqli_query($conn , $qry2);
        }
        ?>
        <script>
        alert('Items inserted successfully!');
        </script>
        <?php    
        }
      }

      // update part--------------------------------------------------------------------------

      if(isset($_POST['update'])){
        $fidup = $_POST['fid_up'];
        $ctgry = $_POST['category_up'];
        $f_name =$_POST['f_name_up'];
        $price = $_POST['price_up'];
        $qry = "UPDATE food
                SET fo_name='$f_name',
                    category='$ctgry',
                    price = $price
                WHERE f_id = $fidup";
        $result = mysqli_query($conn , $qry);
        if($result === true){
          ?>
          <script>
          alert('Item updated successfully!');
          </script>
          <?php    
          }
        }

        // delete part-----------------------------------------------------------------------

      if(isset($_POST['dlt'])){
        $fid = $_POST['fids'];
        $qry1 = "SELECT *
                 FROM order_table
                 WHERE f_id = $fid";
        $result1 = mysqli_query($conn, $qry1);
        $count1 = mysqli_num_rows($result1);
        if($count1>0)
        {
          ?>
        <script>
        alert('This food has a order, please deliver your order first then you will be able to to delete this food item');
        </script>
        <?php  
        }
        else
        {
          $qry2 = "SELECT *
                 FROM food
                 WHERE f_id = $fid AND username = '$uname'";
          $result2 = mysqli_query($conn, $qry2);
          $count2 = mysqli_num_rows($result2);
          if($count2>0)
         { 
           $qry = "DELETE FROM food
                WHERE f_id = $fid AND username = '$uname'";
          $result = mysqli_query($conn, $qry);
          ?>
           <script>
           alert('Item deleted successfully!!');
           </script>
          <?php  
          }
          else { 
            ?>
          <script>
          alert('This item does not exist');
          </script>
         <?php  
         }
      }
      }
      // logout part--------------------------------------------------------------------------
      if(isset($_POST['logout'])){
        header("location: Home_Page.php");
      }
  ?>
<!-- Middle Part -->

<?php
function fnc(){
  $uname = $_GET['uname'];
  include "db_connect.php";
  // query to see item list ------------------------------------------------------------------
  if(isset($_POST['i_list'])){
    $si = "SELECT * FROM food WHERE username='$uname'";
    $result = mysqli_query($conn, $si);
    $count = mysqli_num_rows($result);
    if($count>0){
      echo "<table border=1 width='100%'>
          <tr>
            <th>Food ID</th>
            <th>Food Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Click To Delete</th>
          </tr>";
    while($row = mysqli_fetch_assoc($result)){
      
      $foid = $row['f_id']; 
      $foname = $row['fo_name'];
      $ctgr = $row['category'];
      $prc = $row['price'];
    echo "<tr> <form action='' method='POST'>
              <td><input type='hidden' name='fids' value='$foid'/>$foid</td>
              <td>$foname</td>
              <td>$ctgr</td>
              <td>$prc</td> 
              <td><button type='submit' name='dlt'>Delete</button></td>
              </form>
             </tr>";
    }
    echo "</table>";

  }
  else echo "You have no item now, Please add item";
  }

  // query to see orders-----------------------------------------------------------------------------------------

  if(isset($_POST['orders'])){
    $ord = "SELECT t1.o_id, t1.f_id, t1.fo_name, t1.category, t1.first_name, t1.last_name, t1.phone, t1.city, t1.area, t1.location
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
            LEFT JOIN (SELECT supplier.username, food.f_id
                       FROM food
                       LEFT JOIN supplier
                       ON food.username = supplier.username) as t2
            ON t1.f_id = t2.f_id 
            WHERE t2.username='$uname'";
    $resultord = mysqli_query($conn, $ord);
    $countord = mysqli_num_rows($resultord);
    if($countord > 0){
      echo "<table border=1 width='100%'>
          <tr>
            <th>Order ID</th>
            <th>Food ID</th>
            <th>Food Name</th>
            <th>Category</th>
            <th>Customer Name</th>
            <th>Customer Phone</th>
            <th>Customer City</th>
            <th>Customer Area</th>
            <th>Customer Location</th>
          </tr>";
      while($roword = mysqli_fetch_assoc($resultord)){
        $oid = $roword['o_id'];
        $fid = $roword['f_id'];
        $fname = $roword['fo_name'];
        $fctgr = $roword['category'];
        $cname = $roword['first_name']." ".$roword['last_name'];
        $cphone = $roword['phone'];
        $ccity = $roword['city'];
        $carea = $roword['area'];
        $clocation = $roword['location'];

        echo "<tr>
        <td>$oid</td>
        <td>$fid</td>
        <td>$fname</td>
        <td>$fctgr</td>
        <td>$cname</td>
        <td>$cphone</td>
        <td>$ccity</td>
        <td>$carea</td>
        <td>$clocation</td>
       </tr>";
      }
      echo "</table>";
    }
    else echo "You have no orders";
  }

  // query to see delivery man--------------------------------------------------------------------------------

  if(isset($_POST['d_man'])){
    $qry = "SELECT username, first_name, last_name, phone, area
    FROM delivery_man
    WHERE area = (SELECT area
                 FROM supplier
                 WHERE username = '$uname')";
    $result = mysqli_query($conn, $qry);
    $count = mysqli_num_rows($result);
    if($count > 0){
      echo "<table border=1 width='100%'>
          <tr>
            <th>D.M Username</th>
            <th>Name</th>
            <th>Phone Number</th>
            <th>Area</th>
            <th></th>
          </tr>";
      while($row = mysqli_fetch_assoc($result)){
        $duname=$row['username'];
        $dname = $row['first_name']." ".$row['last_name'];
        $dphone = $row['phone'];
        $darea = $row['area'];
        echo "<tr> <form action='' method='POST'>
        <td><input type='hidden' name='duname' value='$duname'/> $duname</td>
        <td>$dname</td>
        <td>$dphone</td>
        <td>$darea</td>
        <td><button type='submit' name='calldl'>Call D.man</button></td>
        </form>
       </tr>";
      }
      echo "</table>";
    }
    else echo "No delivery man in this area";
  }

    // query to see other areas delivery man--------------------------------------------------------------------------------

  if(isset($_POST['od_man'])){
    $area = $_POST['o_area'];
    $qry = "SELECT username, first_name, last_name, phone, area
    FROM delivery_man
    WHERE area = '$area'";
    $result = mysqli_query($conn, $qry);
    $count = mysqli_num_rows($result);
    if($count > 0){
      echo "<table border=1 width='100%'>
          <tr>
            <th>D.M Username</th>
            <th>Name</th>
            <th>Phone Number</th>
            <th>Area</th>
            <th></th>
          </tr>";
      while($row = mysqli_fetch_assoc($result)){
        $duname=$row['username'];
        $dname = $row['first_name']." ".$row['last_name'];
        $dphone = $row['phone'];
        $darea = $row['area'];
        echo "<tr> <form action='' method='POST'>
        <td><input type='hidden' name='duname' value='$duname'/> $duname</td>
        <td>$dname</td>
        <td>$dphone</td>
        <td>$darea</td>
        <td><button type='submit' name='calldl'>Call D.man</button></td>
        </form>
       </tr>";
      }
      echo "</table>";
    }
    else echo "No delivery man in $area";
  }

  if(isset($_POST['calldl'])){
    $duname = $_POST['duname'];
    $qry = "INSERT INTO s_d(uname_s, uname_d)
    VALUES('$uname', '$duname')";
    mysqli_query($conn, $qry);
  }
}
?>

<!-- Front End -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Khati Food</title>
    <link rel="stylesheet" href="supplier.css">
</head>
<body>
    <div class="head">
        <div class="column"><img src="img/KhatiFoodlogoround.png" width="300" height="100%"></div>
        <div class="column1">
        <form action="" method="POST">
           <div class="btn"><button name="logout" type="submit" style="float: right; color:brown; padding:15px 10px;">Logout</button></div>
        </form>
           </div>
    </div>

    <div class="container" id = 'blur'>

       <div class="add_food">
         <!-- add -->
         
             <div class="food">
             <h3 style="color:#DCE515 ;">Add Your Food Items Here</h3><br>
             <form action="" method="POST">
               <label for="fname" style="color:aquamarine">Select a category:</label>
               <select name="category" id="ctgry">
               <option>Not selected</option>
               <option value="Rice">Rice</option>
               <option value="Vegetable">Vegetable</option>
               <option value="Fish">Fish</option>
               <option value="Chicken">Chicken</option>
               <option value="Mutton">Mutton</option>
               <option value="Beef">Beef</option>
               <option value="Vorta">Vorta</option>
               <option value="Snacks">Snacks</option>
               <option value="Native cake">Native cake</option>
               <option value="Dessert">Dessert</option>
               <option value="Juice">Juice</option>
               <option value="Others">Others</option>
               </select><br><br>
               <input name="f_name" type="text" class="input-box" placeholder="Enter food name" style="background-color:gray; " required name="" id="">
               <!-- <button class="open-button" onclick="openForm()">Add Ingredients</button> -->
               <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Add Ingredients</button>
               <!-- pop up form -->
               <!-- <div class="form-popup" id="myForm"> -->
               <div id="id01" class="modal">
                 <div class="modal-content">
                  <label for="1"><b>1</b></label><br>
                  <input type="text" placeholder="Ingredient name" name="ingredient1" required>
                  <input type="float" placeholder="Quantity per kg" name="quantity1" required><br>
                  <label for="2"><b>2</b></label><br>
                  <input type="text" placeholder="Ingredient name" name="ingredient2">
                  <input type="float" placeholder="Quantity per kg" name="quantity2"><br>
                  <label for="3"><b> 3</b></label><br>
                  <input type="text" placeholder="Ingredient name" name="ingredient3">
                  <input type="float" placeholder="Quantity per kg" name="quantity3"><br>
                  <label for="4"><b>4</b></label><br>
                  <input type="text" placeholder="Ingredient name" name="ingredient4">
                  <input type="float" placeholder="Quantity per kg" name="quantity4"><br>
                  <label for="5"><b>5</b></label><br>
                  <input type="text" placeholder="Ingredient name" name="ingredient5">
                  <input type="float" placeholder="Quantity per kg" name="quantity5"><br>
                  <label for="6"><b>6</b></label><br>
                  <input type="text" placeholder="Ingredient name" name="ingredient6">
                  <input type="float" placeholder="Quantity per kg" name="quantity6"><br>
                  <label for="7"><b>7</b></label><br>
                  <input type="text" placeholder="Ingredient name" name="ingredient7">
                  <input type="float" placeholder="Quantity per kg" name="quantity7"><br>
                  <label for="8"><b>8</b></label><br>
                  <input type="text" placeholder="Ingredient name" name="ingredient8">
                  <input type="float" placeholder="Quantity per kg" name="quantity8"><br>
                  <label for="9"><b>9</b></label><br>
                  <input type="text" placeholder="Ingredient name" name="ingredient9">
                  <input type="float" placeholder="Quantity per kg" name="quantity9"><br>
                  <label for="10"><b>10</b></label><br>
                  <input type="text" placeholder="Ingredient name" name="ingredient10">
                  <input type="float" placeholder="Quantity per kg" name="quantity10"><br>
                  <button type="button" class="close" onclick="document.getElementById('id01').style.display='none'">Close</button>
                 </div>
               </div>
               <input name="price" type="float" class="input-box" placeholder="Price" style="background-color:gray" required name="" id="">
               <button name="add" type="submit" class="bttn">Add</button>
               </form><br><br>

               <!-- Update -->

               <h3 style="color:#DCE515;">Update your items</h3><br>
               <form action="" method="POST">
               <input name="fid_up" type="text" class="input-box" placeholder="Enter Food ID" style="background-color:gray" required name="" id=""><br><br>
               <label for="fname" style="color:aquamarine">Select a category:</label>
               <select name="category_up" id="ctgry">
               <option>Not selected</option>
               <option value="Rice">Rice</option>
               <option value="Vegetable">Vegetable</option>
               <option value="Fish">Fish</option>
               <option value="Chicken">Chicken</option>
               <option value="Mutton">Mutton</option>
               <option value="Beef">Beef</option>
               <option value="Vorta">Vorta</option>
               <option value="Snacks">Snacks</option>
               <option value="Native cake">Native cake</option>
               <option value="Dessert">Dessert</option>
               <option value="Juice">Juice</option>
               <option value="Others">Others</option>
               </select><br><br>
               <input name="f_name_up" type="text" class="input-box" placeholder="Enter food name" style="background-color:gray; " required name="" id="">
               <input name="price_up" type="float" class="input-box" placeholder="Price" style="background-color:gray" required name="" id="">
               <button name="update" type="submit" class="bttn">Update</button>
               </form>
             </div>
         

      </div>

    <div class="query">

        <div class="aln">
        <form action="" method="POST">
           <button name="i_list" type="submit" class="bttn" >Your Food Items</button>
           <button name="orders" type="submit" class="bttn" > Orders </button>
           <button name="d_man" type="submit" class="bttn" > Delivery Man of Your Area</button>
           </form><br><br>
           <form action="" method="POST">
           <label for="fname" style="color:aquamarine" > Delivery Man of other Area: </label><br><br>
           <input name="o_area" type="text" placeholder="Enter Area" style="background-color:white" required name="" id="">
           <button name="od_man" type="submit" class="bttn">Search</button><br><br><br><br>
          </form>
          <!-- <form action="" method="POST">
           <label for="fname" style="color:aquamarine" >Delete Food item: </label><br><br>
           <input name="fid" type="text" placeholder="Enter Food ID" style="background-color:white" required name="" id="">
           <button name="dlt" type="submit" class="bttn">Delete</button><br><br>
          </form> -->
          <!-- <form action="" method="POST">
           <label for="dm" style="color:aquamarine" >Connect a delivery man: </label><br><br>
           <input name="fid" type="text" placeholder="Enter Food ID" style="background-color:gray" required name="" id="">
           <button name="cnct" type="submit" class="bttn">Connect</button><br><br>
          </form> -->
        </div>
    </div>

        <div class="last">
          <?php fnc();?>
        </div>
</div>

    <footer class="footer">
    <div class="f_left">
            <!-- <h1 style="color:white; text-align: center;">Team DBMS Warriors</h1>
            <h5 style="color:white; text-align: center;">Lab Project</h5> -->
        </div>
        <div class="f_right">
            <!-- <h5 style="color:white; text-align: center;">Anamul Hasan</h5> <br>
            <h5 style="color:white; text-align: center;">Prianka Akter</h5> <br>
            <h2 style="color:white; text-align: center;">United International University</h2> -->
        </div>
    </footer>
    
  <script>
    // function openForm() {
    //   document.getElementById("myForm").style.display = "block";
    // }
    
    // function closeForm() {
    //   document.getElementById("myForm").style.display = "none";
    // }
    // Get the modal
    var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
    }
}
  </script>
</body>
</html> 