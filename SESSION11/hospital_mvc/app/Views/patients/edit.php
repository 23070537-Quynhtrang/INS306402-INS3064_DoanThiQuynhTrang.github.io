<h2>Edit Patient</h2>

<form method="POST" action="/patients/update">
    <input type="hidden" name="id" value="<?= $patient['id'] ?>">

    <label>Patient Code:</label><br>
    <input type="text" name="code" value="<?= $patient['patient_code'] ?>"><br><br>

    <label>Full Name:</label><br>
    <input type="text" name="name" value="<?= $patient['full_name'] ?>"><br><br>

    <button type="submit">Update</button>
</form>

<a href="/patients">Back</a>