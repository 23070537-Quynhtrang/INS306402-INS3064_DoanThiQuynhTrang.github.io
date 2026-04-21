<?php
require_once "../classes/Database.php";

$db = Database::getInstance();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $description = $_POST["description"];

    $db->query(
        "INSERT INTO courses (title, description) VALUES (?, ?)",
        [$title, $description]
    );

    header("Location: index.php");
    exit;
}
?>

<h2>Thêm khóa học</h2>

<form method="POST">
    Title: <input type="text" name="title"><br><br>
    Description: <textarea name="description"></textarea><br><br>
    <button type="submit">Save</button>
</form>