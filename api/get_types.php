<?php
include "db.php";
$types = $Type->all(['big_id' => $_GET['big_id']]);
foreach ($types as $type) {
    echo "<option value='{$type['id']}'>{$type['name']}</option>";
}
