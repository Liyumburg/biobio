<?php
namespace Classes;
use db_connect5;
require_once "../connections/db_connect5.php";

class Record {
    public string $field;
    private $db;
    private string $response;
    public string $First_name;
    public string $Middle_name;
    public string $Last_name;
    public string $Suffix;
    public string $Languages;
    public string $Email_address;
    public string $Gender;
    public string $Marital_status;
    public string $DOB;
    public string $Hobbies;
    public string $Mobile_number;
    public string $Religion;
    public string $Province;
    public string $City;
    public string $Barangay;
    public string $Street;
    
    public function __construct($db){
        $this->db = $db;
    }

    public function getAll(){
        $stmt = $this->db->prepare('SELECT * FROM id');
        $stmt->execute();
        if(!$stmt->rowCount()){
            return [];
        }
        return $stmt->fetchAll();
    }

    public function getPost(){
        $this->Last_name = $_POST['Last_name'];
        $this->First_name = $_POST['First_name'];
        $this->Middle_name = $_POST['Middle_name'];
        $this->Suffix = $_POST['Suffix'];
        $this->Mobile_number = $_POST['Mobile_number'];
        $this->Email_address = $_POST['Email_address'];
        $this->Province = $_POST['Province'];
        $this->City = $_POST['City'];
        $this->Barangay = $_POST['Barangay'];
        $this->Street = $_POST['Street'];
        $this->DOB = $_POST['DOB'];
        $this->Gender = $_POST['Gender'];
        $this->Languages = $_POST['Languages'];     
        $this->Marital_status = $_POST['Marital_status'];
        $this->Religion = $_POST['Religion'];
        $this->Hobbies = $_POST['Hobbies'];
        
    }

    public function isDuplicate(){
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM id WHERE First_name = ? AND Last_name = ? AND DOB = ?");
        $stmt->execute([$this->First_name, $this->Last_name, $this->DOB]);
        return (int)$stmt->fetchColumn() > 0;
    }

    public function add(){
        if (isset($_POST['add'])){
            $this->getPost();

            if ($this->isDuplicate()) {
                header('Location: add.php?error=duplicate');
                exit;
            }

            $stmt = $this->db->prepare("INSERT INTO id(Last_name, Middle_name, First_name, Suffix, Mobile_number, Email_address, Province, City, Barangay, Street, DOB, Gender, Languages, Marital_status, Religion, Hobbies) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([
            $this->Last_name,
            $this->First_name, 
            $this->Middle_name, 
            $this->Suffix,
            $this->Mobile_number,
            $this->Email_address,
            $this->Province,
            $this->City, 
            $this->Barangay,
            $this->Street,
            $this->DOB,
            $this->Gender,
            $this->Languages,
            $this->Marital_status, 
            $this->Religion,
            $this->Hobbies,
            ]);
                               
            $this->responseSQL($stmt);
            header('Location: index.php');
        }
    }

    public function delete($id){
        $stmt = $this->db->prepare("DELETE FROM id WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->rowCount() > 0;
    }

    public function view($id){
        if (!$id) return 0;
        $stmt = $this->db->prepare("SELECT * FROM id WHERE id = ?"); 
        $stmt->execute([$id]);
        return $stmt->rowCount() ? $stmt->fetch() : 0;
    }
    
    public function responseSQL($stmt){
        if($stmt->rowCount()){
            $this->response = 'success';
            return;
        }
        $this->response = 'failed';
    }
    
    public function getResponse(){
        return $this->response;
    }
}

$Record = new Record($db);
$Record->add();

?>