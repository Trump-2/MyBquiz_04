// JavaScript Document
function lof(x) {
  location.href = x;
}

// table 參數是為了知道是哪張資料表的資料要刪除，而 id 參數則是知道哪筆資料要刪除
function del(table, id) {
  $.post(
    "./api/del.php",
    {
      table,
      id,
    },
    () => {
      location.reload();
    }
  );
}
