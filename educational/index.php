<?php
        require 'educ_record.php';
require_once '../connections/db_connect5.php';

$educ_record = new Classes\educ_record($db);
$data = $educ_record->getAll();

$stmt = $db->prepare("SELECT * FROM educational_background");
$stmt->execute();
$educationData = $stmt->fetchAll();

include 'components/db_content_education.php';
include '../libraries.php';
?>