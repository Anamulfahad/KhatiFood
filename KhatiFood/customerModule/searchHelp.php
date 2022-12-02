<?php

function getIngredients($foodID) {
    $jointTexts = "";
    $foodID = (int)$foodID;

    $sql = "select ingredient_name, quantity "
        . "from ingredients "
        . "where f_id = $foodID";

    $conn = null;
    $result = null;
    include "db_connect.php";

    $countLine = 0;
    if ($conn != null) {
        $result = $conn->query($sql);
        $countLine = $result->num_rows;
    }


    if ($countLine > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $jointTexts .= $row["ingredient_name"] . " " . $row["quantity"] . "kg<br>";
        }
    }

    return $jointTexts;
}
