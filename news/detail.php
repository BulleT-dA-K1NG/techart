<? require($_SERVER["DOCUMENT_ROOT"] . "/include/header.php"); ?>
<div class="container">
    <?
    $id = $_GET["id"];
    require_once "conn.php";
    if ($conn->connect_errno) {
        echo "Не удалось подключиться" . $conn->error;
    }
    $sql = "SELECT * FROM news WHERE `id`=$id";
    $arResult = mysqli_query($conn, $sql);
    if ($arResult) {
        foreach ($arResult as $arItem) {
            $arItem["date"] = array_shift(explode(" ", $arItem["date"]));
            $arDate = explode("-", $arItem["date"]);
            $arItem["date"] = $arDate[2] . "." . $arDate[1] . "." . $arDate[0];
            ?>
            <div class="breadcrumbs row">
                <a href="/">Главная</a>
                <div>&nbsp;/&nbsp;</div>
                <div class="active"><?= $arItem["title"] ?></div>
            </div>
            <div class="detail-item">
                <h1><?= $arItem["title"] ?></h1>
                <div class="date"><?= $arItem["date"] ?></div>
                <div class="row">
                    <div class="col-70 description">
                        <?= $arItem["content"] ?>
                    </div>
                    <div class="col-30">
                        <img src="../include/images/<?= $arItem["image"] ?>" alt="">
                    </div>
                </div>
                <a href="/" class="btn">&larr; НАЗАД К НОВОСТЯМ</a>
            </div>
        <? } ?>
        <?
        mysqli_free_result($arResult);
    } else {
        echo "Ошибка: " . mysqli_error($conn);
    }
    mysqli_close($conn);
    ?>
</div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/include/footer.php"); ?>