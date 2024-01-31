<?php
session_start();


// unset() 可同時清除多個變數
unset($_SESSION['mem'], $_SESSION['admin']);
header("location:../index.php");
