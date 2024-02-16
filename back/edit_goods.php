<h2 class="ct">修改商品</h2>
<?php
$goods = $Goods->find($_GET['id']);

?>
<form action="./api/save_goods.php" method="post" enctype="multipart/form-data">
    <table class="all">
        <tr>
            <th class="tt ct">所屬大分類</th>
            <td class="pp">
                <select name="big" id="big"></select>
            </td>
        </tr>
        <tr>
            <th class="tt ct">所屬中分類</th>
            <td class="pp">
                <select name="mid" id="mid"></select>
            </td>
        </tr>
        <tr>
            <th class="tt ct">商品編號</th>
            <td class="pp"><?= $good['no'] ?></td>
        </tr>
        <tr>
            <th class="tt ct">商品名稱</th>
            <td class="pp"><input type="text" name="name" value="<?= $good['name'] ?>"></td>
        </tr>
        <tr>
            <th class="tt ct">商品價格</th>
            <td class="pp"><input type="text" name="price" value="<?= $good['price'] ?>"></td>
        </tr>
        <tr>
            <th class="tt ct">規格</th>
            <td class="pp"><input type="text" name="spec" value="<?= $good['spec'] ?>"></td>
        </tr>
        <tr>
            <th class="tt ct">庫存量</th>
            <td class="pp"><input type="text" name="stock" value="<?= $good['stock'] ?>"></td>
        </tr>
        <tr>
            <th class="tt ct">商品圖片</th>
            <td class="pp"><input type="file" name="img" value=""></td>
        </tr>
        <tr>
            <th class="tt ct">商品介紹</th>
            <td class="pp"><textarea name="intro" style="width:80%;height:150px;"><?= $good['intro'] ?></textarea></td>
        </tr>
    </table>
    <div class="ct">
        <input type="submit" value="修改">
        <input type="reset" value="重置">
        <!-- 這裡記得要加上 onclick -->
        <input type="button" value="返回" onclick="location.href='?do=th'">
    </div>
</form>

<script>
    getTypes('big', 0); // 網頁一開始載入時，就會執行的 function；且一載入時就顯示大分類 ( 因為大分類的 big_id 為 0 );



    function getTypes(type, big_id) {
        $.get("./api/get_types.php", {
            big_id
        }, (types) => {

            switch (type) {
                case "big":
                    $("#big").html(types)
                    getTypes('mid', $("#big").val())
                    break;
                case "mid":
                    $("#mid").html(types)
                    break;
            }

        })
    }
</script>