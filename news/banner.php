<? require_once "conn.php";
if ($conn->connect_errno) {
    echo "Не удалось подключиться" . $conn->error;
}
$sql = "SELECT * FROM news ORDER BY `date` DESC LIMIT 1";
$arResult = mysqli_query($conn, $sql);
if ($arResult) {
    foreach ($arResult as $arItem) { ?>
        <div class="banner" style="background-image: url('/include/images/<?= $arItem["image"] ?>');">
            <div class="container">
                <div class="banner_txt">
                    <div class="h1_custom"><?= $arItem["title"] ?></div>
                    <div class="banner_descr"><?= $arItem["announce"] ?></div>
                </div>
            </div>
        </div>
    <? }
    mysqli_free_result($arResult);
} else {
    echo "Ошибка: " . mysqli_error($conn);
}
?>