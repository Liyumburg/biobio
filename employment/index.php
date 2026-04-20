<?php
require 'employ_record.php';
require_once '../connections/db_connect5.php';

$employ_record = new Classes\employ_record($db);
$data = $employ_record->getAll();

include 'components/db_content_employment.php';
include '../libraries.php';
?>