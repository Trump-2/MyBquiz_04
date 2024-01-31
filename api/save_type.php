<?php

include "db.php";

// save( ) 裡面直接放 $_POST 是因為 $_POST 裡面的欄位跟資料表的欄位一樣
$Type->save($_POST);
