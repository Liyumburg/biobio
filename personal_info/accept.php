<?php
require '../personal_info/connections/db_connect5.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';

$id = $_GET['id'] ?? null;

if ($id) {
    try {
        $gettemp = $db->prepare("SELECT Last_name, First_name, Middle_name, Suffix,
                    Mobile_number, Email_address,
                    Province, City, Barangay, Street,
                    DOB, Sex, Languages,
                    Marital_status, Religion, Hobbies,
                    uploads FROM temp_person WHERE id = ?");
        $gettemp->execute([$id]);

        if ($gettemp->rowCount()) {
            $rows = $gettemp->fetchAll();

            foreach ($rows as $row) {
                // Duplicate check before inserting into permanent table
                $dupCheck = $db->prepare("SELECT COUNT(*) FROM id WHERE First_name = ? AND Last_name = ? AND DOB = ?");
                $dupCheck->execute([$row['First_name'], $row['Last_name'], $row['DOB']]);
                if ((int)$dupCheck->fetchColumn() > 0) {
                    // Delete temp record and notify admin
                    $delDup = $db->prepare("DELETE FROM temp_person WHERE id = ?");
                    $delDup->execute([$id]);
                    echo "<script>alert('This record already exists in the system (duplicate: " . addslashes(htmlspecialchars($row['First_name'] . ' ' . $row['Last_name'])) . ", DOB: " . addslashes($row['DOB']) . "). The pending entry has been removed.'); window.location.href='../personal_info/accept_list.php';</script>";
                    exit;
                }

                // Insert into main id table
                $insert = $db->prepare("INSERT INTO id (Last_name, First_name, Middle_name, Suffix,
                    Mobile_number, Email_address,
                    Province, City, Barangay, Street,
                    DOB, Sex, Languages,
                    Marital_status, Religion, Hobbies,
                    uploads) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                $insert->execute([
                    $row['Last_name'],
                    $row['First_name'],
                    $row['Middle_name'],
                    $row['Suffix'],
                    $row['Mobile_number'],
                    $row['Email_address'],
                    $row['Province'],
                    $row['City'],
                    $row['Barangay'],
                    $row['Street'],
                    $row['DOB'],
                    $row['Sex'],
                    $row['Languages'],
                    $row['Marital_status'],
                    $row['Religion'],
                    $row['Hobbies'],
                    $row['uploads']
                ]);
            }

            // Send email using the last (or only) row fetched
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'liamcabiad@gmail.com';
            $mail->Password   = 'nimq ipqp dawn cgqf';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            $mail->setFrom('liamcabiad@gmail.com', 'Biodata System');
            $mail->addAddress($row['Email_address']); // FIXED: correct column name
            $mail->isHTML(true);

            $fullName = htmlspecialchars(strtoupper($row['First_name']))
                      . ' ' . htmlspecialchars(strtoupper($row['Middle_name']))
                      . ' ' . htmlspecialchars(strtoupper($row['Last_name']));

            $mail->Subject = 'Registration Confirmation';
            $mail->Body = '
<p>Dear <strong>' . $fullName . '</strong>,</p>
<p>Warm Greetings!</p>
<p>We are pleased to inform you that your registration has been <strong>accepted</strong> in our system.</p>
<p>Should you have any concerns, feel free to reach out to us.</p>
<br>
<p>Best regards,<br>
<strong>Biodata Records System</strong></p>';

            $mail->send();

            // Delete from temp table only after successful insert + email
            $stmt = $db->prepare("DELETE FROM temp_person WHERE id = ?");
            $stmt->execute([$id]);

            echo "<script>alert('Record accepted and email sent successfully.'); window.location.href='../personal_info/accept_list.php';</script>";
            exit;
        } else {
            // No record found
            header("Location: ../personal_info/accept_list.php");
            exit;
        }

    } catch (Exception $e) {
        echo "<script>alert('Error: " . addslashes($e->getMessage()) . "'); window.history.back();</script>";
        exit;
    }
} else {
    header("Location: ../personal_info/accept_list.php");
    exit;
}
?>