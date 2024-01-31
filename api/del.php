<?php
include "db.php";

$table = $_POST['table'];
$db = new DB($table);
$db->del($_POST['id']);
