// core/Router.php
<?php
require_once __DIR__ . '/../app/Controllers/PatientController.php';

class Router {

    public function handle() {
        $url = $_GET['url'] ?? '';

        if ($url == 'patients') {
            (new PatientController())->index();
        } elseif ($url == 'patients/create') {
            (new PatientController())->create();
        } elseif ($url == 'patients/store') {
            (new PatientController())->store();
        } elseif ($url == 'patients/delete') {
            (new PatientController())->delete();
        } else {
            echo "404 Not Found";
        }
    }
}