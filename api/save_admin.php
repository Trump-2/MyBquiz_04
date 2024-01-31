<?php
include "db.php";
// serialize( ) 將陣列轉成字串
$_POST['pr'] = serialize($_POST['pr']);
$Admin->save($_POST);
to("../back.php?do=admin");
