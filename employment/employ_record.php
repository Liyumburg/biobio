<?php
namespace Classes;

require_once "../connections/db_connect5.php";

class employ_record {
    private $db;
    private string $response;

    public $personal_id;
    public string $company_name;
    public string $position;
    public string $start_date;
    public string $end_date;

    public function __construct($db){
        $this->db = $db;
    }

    public function getAll(){
        $stmt = $this->db->prepare("SELECT * FROM employment_history");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getPost(){
        $this->personal_id = (int) $_POST['personal_id'];
        $this->company_name = $_POST['company_name'];
        $this->position = $_POST['position'];
        $this->start_date = $_POST['start_date'];
        $this->end_date = $_POST['end_date'];
    }

    public function isDuplicate(){
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM employment_history WHERE personal_id = ? AND company_name = ? AND start_date = ?");
        $stmt->execute([$this->personal_id, $this->company_name, $this->start_date]);
        return (int)$stmt->fetchColumn() > 0;
    }

    public function add(){
        if(isset($_POST['add'])){
            $this->getPost();

            if ($this->isDuplicate()) {
                header("Location: add.php?error=duplicate");
                exit;
            }

            $stmt = $this->db->prepare("
                INSERT INTO employment_history
                (personal_id, company_name, position, start_date, end_date)
                VALUES (?, ?, ?, ?, ?)
            ");

            $stmt->execute([
                $this->personal_id,
                $this->company_name,
                $this->position,
                $this->start_date,
                $this->end_date
            ]);

           
            header("Location: index.php");
        }
    }

    public function delete($id){
        $stmt = $this->db->prepare("DELETE FROM employment_history WHERE employment_id = ?");
        $stmt->execute([$id]);
    }

    public function view($id){
        $stmt = $this->db->prepare("SELECT * FROM employment_history WHERE employment_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function update($id){
        $this->getPost();
        if (!empty($_POST)) {
        $stmt = $this->db->prepare('UPDATE employment_history SET company_name = ?, position = ?, start_date = ?, end_date = ? WHERE employment_id = ?');

        $stmt->execute([
                $this->company_name,
                $this->position,
                $this->start_date,
                $this->end_date,
                $id
        ]);
        
        header('Location: index.php');
        header ('Location: view.php?id=' . $id.'');
        }
    }
}

$employ_record = new employ_record($db);
$employ_record->add();

?>