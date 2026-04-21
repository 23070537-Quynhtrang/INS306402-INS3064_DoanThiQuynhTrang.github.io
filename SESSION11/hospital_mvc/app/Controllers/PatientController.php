// app/Controllers/PatientController.php
<?php
require_once __DIR__ . '/../Models/Patient.php';

class PatientController {

    public function index() {
        $model = new Patient();
        $patients = $model->all();
        require __DIR__ . '/../Views/patients/index.php';
    }

    public function create() {
        require __DIR__ . '/../Views/patients/create.php';
    }

    public function store() {
        $model = new Patient();
        $model->create($_POST['code'], $_POST['name']);
        header("Location: /patients");
    }

    public function delete() {
        $model = new Patient();
        $model->delete($_GET['id']);
        header("Location: /patients");
    }
}