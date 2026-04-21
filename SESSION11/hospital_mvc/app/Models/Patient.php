// app/Models/Patient.php
<?php
require_once __DIR__ . '/../../classes/Database.php';

class Patient {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function all() {
        return $this->db->fetchAll("SELECT * FROM patients");
    }

    public function create($code, $name) {
        return $this->db->query(
            "INSERT INTO patients (patient_code, full_name) VALUES (?, ?)",
            [$code, $name]
        );
    }

    public function delete($id) {
        return $this->db->query("DELETE FROM patients WHERE id=?", [$id]);
    }
}