<?php
namespace Classes;

use Classes\FileUpload;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';


require_once "../connections/db_connect5.php";
require_once "./uploads/FileUpload.php";

class Record {

    private $db;
    private string $response;

    public string $First_name;
    public string $Middle_name;
    public string $Last_name;
    public string $Suffix;
    public string $Languages;
    public string $Email_address;
    public string $Sex;
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
        $stmt = $this->db->prepare("SELECT * FROM id");
        $stmt->execute();
        return $stmt->rowCount() ? $stmt->fetchAll() : [];
    }

    public function getPost(){

        $this->Last_name = $_POST['Last_name'] ?? '';
        $this->First_name = $_POST['First_name'] ?? '';
        $this->Middle_name = $_POST['Middle_name'] ?? '';
        $this->Suffix = $_POST['Suffix'] ?? '';
        $this->Mobile_number = $_POST['Mobile_number'] ?? '';
        $this->Email_address = $_POST['Email_address'] ?? '';
        $this->Province = $_POST['Province'] ?? '';
        $this->City = $_POST['City'] ?? '';
        $this->Barangay = $_POST['Barangay'] ?? '';
        $this->Street = $_POST['Street'] ?? '';
        $this->DOB = $_POST['DOB'] ?? '';
        $this->Sex = $_POST['Sex'] ?? '';
        $this->Languages = $_POST['Languages'] ?? '';
        $this->Marital_status = $_POST['Marital_status'] ?? '';
        $this->Religion = $_POST['Religion'] ?? '';
        $this->Hobbies = $_POST['Hobbies'] ?? '';
    }

    public function isDuplicate(){
        // Check both permanent and temporary tables
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM id WHERE First_name = ? AND Last_name = ? AND DOB = ?");
        $stmt->execute([$this->First_name, $this->Last_name, $this->DOB]);
        if ((int)$stmt->fetchColumn() > 0) return true;

        $stmt2 = $this->db->prepare("SELECT COUNT(*) FROM temp_person WHERE First_name = ? AND Last_name = ? AND DOB = ?");
        $stmt2->execute([$this->First_name, $this->Last_name, $this->DOB]);
        return (int)$stmt2->fetchColumn() > 0;
    }

    public function add(){

        if(isset($_POST['add'])){

            $this->getPost();

            if ($this->isDuplicate()) {
                header("Location: add.php?error=duplicate");
                exit;
            }

            $per_img = '';

            if(!empty($_FILES['per_img']['name'])){
                $uploads = new FileUpload($_FILES['per_img'], './uploads/');

                if($uploads->upload()){
                    $per_img = $uploads->fileName;
                }
            }

            $stmt = $this->db->prepare("
                INSERT INTO temp_person(
                    Last_name, First_name, Middle_name, Suffix,
                    Mobile_number, Email_address,
                    Province, City, Barangay, Street,
                    DOB, Sex, Languages,
                    Marital_status, Religion, Hobbies,
                    uploads
                )
                VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)
            ");

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
                $this->Sex,
                $this->Languages,
                $this->Marital_status,
                $this->Religion,
                $this->Hobbies,
                $per_img
            ]);

              // Prepare and send email
                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'liamcabiad@gmail.com';
                $mail->Password = 'nimq ipqp dawn cgqf';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->setFrom('liamcabiad@gmail.com', 'Biodata System');
                $mail->addAddress($this->Email_address);
                $mail->isHTML(true);

                   $mail->Subject = 'Registration Confirmation';
                $mail->Body = '<pre>Dear ' . htmlspecialchars(strtoupper($this->First_name)) . ' ' . htmlspecialchars(strtoupper($this->Middle_name)) . ' ' . htmlspecialchars(strtoupper($this->Last_name)) . ', <br><br>'
                    .'Warm Greetings!
                       
                        We are pleased to confirm receipt of your payment for the 17th PhilSPEN Annual Convention, themed NUTRITION MEDICINE: Integrated Approach to Patient Care, to be held on November 20-21, 2025, at Novotel Manila, Araneta City.

                        Attached to this email is your unique QR code, which will serve as your entry pass to claim your convention ID and kit. It will also be used for attendance tracking throughout the event.

                        Important Reminders:
                        <li>Save your QR Code on your mobile device for easy access at the <b>Registration Table</b></li>
                        <li>Ensure the QR code is clearly visible for scanning</li>
                        <li>If you\'re unable to present the QR code digitally, bring a printed copy as backup.</li>
                        <li>Have your valid ID ready for verification of registration details.</li>

                        Should you have any concerns, feel free to reach out to us at 87230101 loc 5706 / 09338534625 or email us at philspen.sec20@gmail.com.

                        We look forward to seeing you at the convention!

                        Best regards,

                        Racquel O. Cainap-Andaya, MD
                        Head, Registration and Membership Committee
                        Philippine Society for Parenteral and Enteral Nutrition
                        </pre>';

               

                $mail->send();

            $this->responseSQL($stmt);

            header("Location: index.php");
            exit;
        }
    }

    public function view($id){
        if(!$id) return 0;

        $stmt = $this->db->prepare("SELECT * FROM id WHERE id=?");
        $stmt->execute([$id]);

        return $stmt->rowCount() ? $stmt->fetch() : 0;
    }

    public function delete($id){
        $stmt = $this->db->prepare("DELETE FROM id WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->rowCount() > 0;
    }

    public function update($id){

        if(!empty($_POST)){

            $this->getPost();

            $per_img = $_POST['old_img'] ?? '';

            if(!empty($_FILES['per_img']['name'])){
                $uploads = new FileUpload($_FILES['per_img'], './uploads/');

                if($uploads->upload()){
                    $per_img = $uploads->fileName;
                }
            }

            $stmt = $this->db->prepare("
                UPDATE id SET
                Last_name=?,
                First_name=?,
                Middle_name=?,
                Suffix=?,
                Mobile_number=?,
                Email_address=?,
                Province=?,
                City=?,
                Barangay=?,
                Street=?,
                DOB=?,
                Sex=?,
                Languages=?,
                Marital_status=?,
                Religion=?,
                Hobbies=?,
                uploads=?
                WHERE id=?
            ");

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
                $this->Sex,
                $this->Languages,
                $this->Marital_status,
                $this->Religion,
                $this->Hobbies,
                $per_img,
                $id
            ]);

            $this->responseSQL($stmt);

            header("Location: view.php?id=".$id);
            exit;
        }
    }

    public function responseSQL($stmt){
        $this->response = $stmt->rowCount() ? "success" : "failed";
    }

    public function getResponse(){
        return $this->response;
    }
}

$Record = new Record($db);
$Record->add();