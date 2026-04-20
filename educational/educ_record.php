<?php
namespace Classes;

require_once "../connections/db_connect5.php";

class educ_record {

    private $db;
    private string $response;

    public $personal_id;
    public string $level;
    public string $school_name;
    public string $course;
    public string $year_passing;

    public function __construct($db){
        $this->db = $db;
    }

    public function getAll(){
        $stmt = $this->db->prepare('SELECT * FROM educational_background');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getPost(){
    $this->personal_id = (int) $_POST['personal_id'];
    $this->level = $_POST['level'];
    $this->school_name = $_POST['school_name'];
    $this->course = $_POST['course'];
    $this->year_passing = $_POST['year_passing'];
}

    public function isDuplicate(){
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM educational_background WHERE personal_id = ? AND level = ?");
        $stmt->execute([$this->personal_id, $this->level]);
        return (int)$stmt->fetchColumn() > 0;
    }

    public function add(){
        if (isset($_POST['add'])){
            $this->getPost();

            if ($this->isDuplicate()) {
                header('Location: add.php?error=duplicate');
                exit;
            }

            $stmt = $this->db->prepare("
                INSERT INTO educational_background
                (personal_id, level, school_name, course, year_passing)
                VALUES (?, ?, ?, ?, ?)
            ");

            $stmt->execute([
                $this->personal_id,
                $this->level,
                $this->school_name,
                $this->course,
                $this->year_passing
            ]);

            $this->responseSQL($stmt);
            header('Location: index.php');
        }
    }

    public function delete($id){
        $stmt = $this->db->prepare("DELETE FROM educational_background WHERE education_id = ?");
        $stmt->execute([$id]);
        return $stmt->rowCount() > 0;
    }

    public function view($id){
        $stmt = $this->db->prepare("SELECT * FROM educational_background WHERE education_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    private function responseSQL($stmt){
        $this->response = $stmt->rowCount() ? 'success' : 'failed';
    }

    public function getResponse(){
        return $this->response;
    }

    public function update($id){
        $this->getPost();
        if (!empty($_POST)) {
        $stmt = $this->db->prepare('UPDATE educational_background SET level = ?, school_name = ?, course = ?, year_passing = ? WHERE education_id = ?');

        $stmt->execute([
                $this->level,
                $this->school_name,
                $this->course,
                $this->year_passing,
                $id
        ]);
        $this->responseSQL($stmt);
        header('Location: index.php');
        header ('Location: view.php?id=' . $id.'');
        }
    }
}

$educ_record = new educ_record($db);
$educ_record->add();

?>