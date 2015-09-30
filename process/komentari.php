<?php
require "../config.php";
$komentar = new Komentar();
$komentar->ime = $_POST['ime_koment'];
$komentar->email = $_POST['email_koment'];
$komentar->komentar = $_POST['koment'];
$komentar->tekst_id = $_POST['tekst_id'];
$komentar->datum = date('Y-m-d H:i:s');
$komentar->insert();
