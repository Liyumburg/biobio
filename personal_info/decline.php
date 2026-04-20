<?php
require 'connections/db_connect5.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';

$id = $_GET['id'] ?? null;

if ($id != null) {
    $stmt = "SELECT * FROM temp_person WHERE id = ?";
    $st = $db->prepare($stmt);

    if ($st->execute([$id])) {
        $row = $st->fetch(PDO::FETCH_ASSOC);

        if ($row) {

            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'liamcabiad@gmail.com';
            $mail->Password   = 'nimq ipqp dawn cgqf';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            $mail->setFrom('liamcabiad@gmail.com', 'Biodata System');
            $mail->addAddress($row['Email_address']);
            $mail->isHTML(true);

            $fullName = htmlspecialchars(strtoupper($row['First_name']))
                      . ' ' . htmlspecialchars(strtoupper($row['Middle_name']))
                      . ' ' . htmlspecialchars(strtoupper($row['Last_name']));

            $mail->Subject = 'Registration Declined';
            $mail->Body    = '
<p>Dear <strong>' . $fullName . '</strong>,</p>
<p>Sad Greetings!</p>
<p>We are sorry to inform you that your registration has been <strong>declined</strong>.</p>
<p>Should you have any concerns, feel free to reach out to us.</p>
<br>
<p>Best regards,<br><strong>Biodata Records System</strong></p>';

            $mail->send();

            $stmt = $db->prepare("DELETE FROM temp_person WHERE id = ?");
            $stmt->execute([$id]);

            echo "<script>alert('Record declined and notification email sent.'); window.location.href='index.php';</script>";
            exit;

        } else {
            header("Location: index.php");
            exit;
        }
    }
} else {
    header("Location: index.php");
    exit;
}
?>