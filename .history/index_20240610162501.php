<?php
include 'db.php';

$sql = "SELECT * FROM pessoas";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<