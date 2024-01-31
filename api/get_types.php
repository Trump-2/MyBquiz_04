<?php
include "db.php";
// $types = $Type->all(['big_id' => $_GET['big_id']]);
$types = $Type->all($_GET);
foreach ($types as $type) {
    echo "<option value='{$type['id']}'>{$type['name']}</option>";
}
