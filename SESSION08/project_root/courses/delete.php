<?php
require_once "../config/database.php";

$id = $_GET["id"];

$sql = "DELETE FROM courses WHERE id = $id";
$conn->query($sql);

header("Location: index.php");
exit();