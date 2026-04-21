<?php
require_once "../classes/Database.php";

$db = Database::getInstance();
$courses = $db->fetchAll("SELECT * FROM courses");
?>

<h2>Danh sách khóa học</h2>
<a href="create.php">+ Thêm khóa học</a>

<table border="1">
<tr>
    <th>ID</th>
    <th>Title</th>
    <th>Description</th>
    <th>Action</th>
</tr>

<?php foreach($courses as $row): ?>
<tr>
    <td><?= $row['id'] ?></td>
    <td><?= $row['title'] ?></td>
    <td><?= $row['description'] ?></td>
    <td>
        <a href="edit.php?id=<?= $row['id'] ?>">Sửa</a> |
        <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Xóa?')">Xóa</a>
    </td>
</tr>
<?php endforeach; ?>

</table>