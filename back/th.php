<h2 class="ct">商品分類</h2>

<div class="ct">
    新增大分類
    <input type="text" name="big" id="big">
    <button onclick="addType('big')">新增</button>
</div>
<div class="ct">
    新增中分類
    <select name="big" id="bigs"></select>
    <input type="text" name="mid" id="mid">
    <button onclick="addType('mid')">新增</button>
</div>

<!-- table.all>(tr.tt.ct>td+td>button*2)+tr.pp.ct>td*2 -->
<table class="all">
    <?php
    $bigs = $Type->all(['big_id' => 0]);
    foreach ($bigs as $big) {
    ?>
        <tr class="tt ct">
            <td><?= $big['name'] ?></td>
            <td>
                <button onclick="edit(this,<?= $big['id'] ?>)">修改</button>
                <button onclick="del('type',<?= $big['id'] ?>)">刪除</button>
            </td>
        </tr>
        <?php
        // 顯示大分類對應的中分類
        $mids = $Type->all(['big_id' => $big['id']]);
        foreach ($mids as $mid) {

        ?>
            <tr class="pp ct">
                <td><?= $mid['name'] ?></td>
                <td>
                    <button onclick="edit(this,<?= $mid['id'] ?>)">修改</button>
                    <button onclick="del('type',<?= $mid['id'] ?>)">刪除</button>
                </td>
            </tr>
    <?php
        }
    }
    ?>
</table>


<script>
    getTypes(0); // 網頁一開始載入時，就會執行的 function；且一載入時就顯示大分類 ( 因為大分類的 big_id 為 0 );



    function getTypes(big_id) {
        $.get("./api/get_types.php", {
            big_id
        }, (types) => {
            $("#bigs").html(types); // 這裡因為老師打算後台回傳的東西就是 html 標籤
        })
    }

    function edit(dom, id) {
        // js 的 prompt ( ) 彈出視窗，點擊 [確定 ] 會回傳 輸入值，點擊[ 取消 ] 回傳 null
        if (name != null) {
            let name = prompt("請輸入您要修改的分類名稱:", `${$(dom).parent().prev().text()}`) // jq 的 .prev() 會回傳前一個兄弟姊妹；
            $.post("./api/save_type.php", {
                name,
                id
            }, () => {
                // 1. 第一種方式
                // location.reload();

                // 2. 第二種方式
                $(dom).parent().prev().text(name);
            });
        }
    }

    function addType(type) {
        let name, big_id;

        switch (type) {
            case "big":
                name = $("#big").val();
                big_id = 0;
                break;
            case 'mid':
                name = $("#mid").val();
                big_id = $("#bigs").val();
                break;
        }

        $.post("./api/save_type.php", {
            name,
            big_id // 這裡不用送 type 到後台，是因為不管是大分類跟中分類送到後台的 $_POST 都是一樣的
        }, () => {
            location.reload()
        })
    }
</script>

<h2 class="ct">商品管理</h2>
<div class="ct">
    <button>新增商品</button>
</div>
<!-- table.all>(tr.tt.ct>td*5)+(tr.pp>td*4+td>button*4) -->


<table class="all">
    <tr class="tt ct">
        <td>編號</td>
        <td>商品名稱</td>
        <td>庫存量</td>
        <td>狀態</td>
        <td>操作</td>
    </tr>
    <tr class="pp">
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>
            <button>修改</button>
            <button>刪除</button>
            <button>上架</button>
            <button>下架</button>
        </td>
    </tr>
</table>