<!-- DELETE FROM
pessoas
WHERE
id = 3 -->
<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-Type: application/json');

include 'db.php';

if ($id != "") {
    $delete = "DELETE FROM pessoas WHERE id = $id";
    $result = mysql_query($delete)
}