<?php
require 'Record.php';
require_once '../connections/db_connect5.php';

$Record = new Classes\Record($db);
$data = $Record->getAll();

$stmt = $db->prepare("SELECT * FROM educational_background");
$stmt->execute();
$educationData = $stmt->fetchAll();

include 'components/db_content5.php';
include '../libraries.php';
?>