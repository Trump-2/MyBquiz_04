<?php
// 不能放在 class 中
date_default_timezone_set("Asia/Taipei");
session_start();

class DB
{
  // class 內的成員不能為運算式

  // dbname 以考試時的工作崗位命名，這裡先用 db04 代替
  protected $dsn = "mysql:host=localhost;charset=utf8;dbname=db04_4";
  protected $pdo;
  protected $table;

  public function __construct($table)
  {
    $this->table = $table;
    $this->pdo = new PDO($this->dsn, 'root', '');
  }


  function all($where = '', $other = '')
  {
    $sql = "select * from `$this->table` ";
    $sql = $this->sql_all($sql, $where, $other);
    return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  }

  // 聚合函數 「count」的專用函數
  function count($where = '', $other = '')
  {
    $sql = "select count(*) from `$this->table` ";
    $sql = $this->sql_all($sql, $where, $other);
    return $this->pdo->query($sql)->fetchColumn();
  }

  function math($math, $col, $array = '', $other = '')
  {
    $sql = "select $math(`$col`) from `$this->table` ";
    $sql = $this->sql_all($sql, $array, $other);
    return $this->pdo->query($sql)->fetchColumn();
  }


  // 用 switch case 改寫 math( ) 函數
  function math2($math)
  {
    switch ($math) {
      case 'sum':
    }
  }

  // 複製 count 函數，然後進行微調整
  function sum($col, $where = '', $other = '')
  {
    return $this->math('sum', $col, $where, $other);
  }

  // 複製 sum 函數，然後進行微調整
  function max($col, $where = '', $other = '')
  {
    return $this->math('max', $col, $where, $other);
  }

  // 複製 max 函數，然後進行微調整
  function min($col, $where = '', $other = '')
  {
    return $this->math('min', $col, $where, $other);
  }

  function avg($col, $where = '', $other = '')
  {
    return $this->math('avg', $col, $where, $other);
  }

  function total($id)
  {
    $sql = "select count(`id`) from `$this->table` ";

    if (is_array($id)) {
      $tmp = $this->array2sql($id);
      $sql .= " where " . join(" && ", $tmp);
    } else if (is_numeric($id)) {
      $sql .= " where `id`='$id'";
    } else {
      echo "錯誤:參數的資料型態比須是數字或陣列";
    }
    //echo 'find=>'.$sql;
    $row = $this->pdo->query($sql)->fetchColumn();
    return $row;
  }

  function find($id)
  {
    $sql = "select * from `$this->table` ";

    if (is_array($id)) {
      $tmp = $this->array2sql($id);
      $sql .= " where " . join(" && ", $tmp);
    } else if (is_numeric($id)) {
      $sql .= " where `id`='$id'";
    } else {
      echo "錯誤:參數的資料型態比須是數字或陣列";
    }
    //echo 'find=>'.$sql;
    $row = $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    return $row;
  }

  // save () 結合了 update()、insert()
  function save($array)
  {
    if (isset($array['id'])) {
      $sql = "update `$this->table` set ";

      if (!empty($array)) {
        $tmp = $this->array2sql($array);
      } else {
        echo "錯誤:缺少要編輯的欄位陣列";
      }

      $sql .= join(",", $tmp) . " where `id`='{$array['id']}'";
    } else {
      $sql = "insert into `$this->table` ";
      $cols = "(`" . join("`,`", array_keys($array)) . "`)";
      $vals = "('" . join("','", $array) . "')";

      $sql = $sql . $cols . " values " . $vals;
    }
    return $this->pdo->exec($sql);
  }

  // protected function update($id, $cols)
  // {

  //   $sql = "update `$this->table` set ";

  //   if (!empty($cols)) {
  //     foreach ($cols as $col => $value) {
  //       $tmp[] = "`$col`='$value'";
  //     }
  //   } else {
  //     echo "錯誤:缺少要編輯的欄位陣列";
  //   }

  //   $sql .= join(",", $tmp);
  //   $tmp = [];
  //   if (is_array($id)) {
  //     foreach ($id as $col => $value) {
  //       $tmp[] = "`$col`='$value'";
  //     }
  //     $sql .= " where " . join(" && ", $tmp);
  //   } else if (is_numeric($id)) {
  //     $sql .= " where `id`='$id'";
  //   } else {
  //     echo "錯誤:參數的資料型態比須是數字或陣列";
  //   }
  //   // echo $sql;
  //   return $this->pdo->exec($sql);
  // }


  // 確定 $id 的值就是數字的 function 寫法
  // protected function update($cols)
  // {

  //   $sql = "update `$this->table` set ";

  //   if (!empty($cols)) {
  //     foreach ($cols as $col => $value) {
  //       $tmp[] = "`$col`='$value'";
  //     }
  //   } else {
  //     echo "錯誤:缺少要編輯的欄位陣列";
  //   }

  //   $sql .= join(",", $tmp) . " where `id`='{$cols['id']}'";
  //   // echo $sql;
  //   return $this->pdo->exec($sql);
  // }




  // protected function insert($values)
  // {

  //   $sql = "insert into `$this->table` ";
  //   $cols = "(`" . join("`,`", array_keys($values)) . "`)";
  //   $vals = "('" . join("','", $values) . "')";

  //   $sql = $sql . $cols . " values " . $vals;

  //   //echo $sql;

  //   return $this->pdo->exec($sql);
  // }

  function del($id)
  {
    $sql = "delete from `$this->table` where ";

    if (is_array($id)) {
      $tmp = $this->array2sql($id);
      $sql .= join(" && ", $tmp);
    } else if (is_numeric($id)) {
      $sql .= " `id`='$id'";
    } else {
      echo "錯誤:參數的資料型態比須是數字或陣列";
    }
    //echo $sql;

    return $this->pdo->exec($sql);
  }


  // pdo->query() 專用的函數
  function q($sql)
  {
    return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  }

  // 這裡將上面每個函數都有的 foreach 程式片段獨立成一個 funciton
  private function array2sql($array)
  {
    foreach ($array as $col => $value) {
      $tmp[] = "`$col`='$value'";
    }
    return $tmp;
  }


  private function sql_all($sql, $array, $other)
  {
    if (isset($this->table) && !empty($this->table)) {

      if (is_array($array)) {

        if (!empty($array)) {
          $tmp = $this->array2sql($array);
          $sql .= " where " . join(" && ", $tmp);
        }
      } else {
        $sql .= " $array";
      }

      $sql .= $other;
      //echo 'all=>'.$sql;
      // $rows = $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
      return $sql;
    } else {
      echo "錯誤:沒有指定的資料表名稱";
    }
  }
}

function dd($array)
{
  echo "<pre>";
  print_r($array);
  echo "</pre>";
}


// 為 header() 創造一個 to 函數
function to($url)
{
  header("location:$url");
}

$Bottom = new DB('bottom');
$Mem = new DB('mem');
$Admin = new DB('admin');
$Type = new DB('type');
$Goods = new DB('goods');
$Order = new DB("orders");
