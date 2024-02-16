<h2 class="ct">新增商品</h2>
<form action="./api/save_goods.php" method="post" enctype="multipart/form-data">
    <table class="all">
        <tr>
            <th class="tt ct">所屬大分類</th>
            <td class="pp">
                <!-- 這個 onchange 是我自己改寫的 -->
                <select name="big" id="big" onchange="getTypes('mid',$('#big').val())"></select>
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
            <td class="pp">完成分類後自動分配</td>
        </tr>
        <tr>
            <th class="tt ct">商品名稱</th>
            <td class="pp"><input type="text" name="name" value=""></td>
        </tr>
        <tr>
            <th class="tt ct">商品價格</th>
            <td class="pp"><input type="text" name="price" value=""></td>
        </tr>
        <tr>
            <th class="tt ct">規格</th>
            <td class="pp"><input type="text" name="spec" value=""></td>
        </tr>
        <tr>
            <th class="tt ct">庫存量</th>
            <td class="pp"><input type="text" name="stock" value=""></td>
        </tr>
        <tr>
            <th class="tt ct">商品圖片</th>
            <td class="pp"><input type="file" name="img" value=""></td>
        </tr>
        <tr>
            <th class="tt ct">商品介紹</th>
            <td class="pp"><textarea name="intro" style="width:80%;height:150px;"></textarea></td>
        </tr>
    </table>
    <div class="ct">
        <input type="submit" value="新增">
        <input type="reset" value="重置">
        <input type="button" value="返回">
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