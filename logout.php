<?php
session_start();
unset($_SESSION['status']);
header("location: index.php");
session_destroy();