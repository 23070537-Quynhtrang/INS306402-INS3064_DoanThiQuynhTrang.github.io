<h2>Patients</h2>
<a href="/patients/create">Add</a>

<table border="1">
<?php foreach ($patients as $p): ?>
<tr>
    <td><?= $p['full_name'] ?></td>
    <td>
        <a href="/patients/delete?id=<?= $p['id'] ?>">Delete</a>
    </td>
</tr>
<?php endforeach; ?>
</table>