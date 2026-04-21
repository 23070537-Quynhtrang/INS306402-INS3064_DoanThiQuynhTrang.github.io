<?php
require_once "../config/database.php";

$id = $_GET["id"];
$sql = "SELECT * FROM courses WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST["title"]);
    $description = trim($_POST["description"]);

    if (empty($title) || strlen($title) < 3) {
        $error = "Title phải >= 3 ký tự!";
    } else {
        $sql = "UPDATE courses 
                SET title='$title', description='$description' 
                WHERE id=$id";
        $conn->query($sql);
        header("Location: index.php");
        exit();
    }
}
?>

<h2>Sửa khóa học</h2>
<p style="color:red;"><?= $error ?></p>

<form method="POST">
    Title: <input type="text" name="title" value="<?= $row['title'] ?>"><br><br>
    Description: <textarea name="description"><?= $row['description'] ?></textarea><br><br>
    <button type="submit">Cập nhật</button>
</form>