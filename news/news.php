<?
$page = isset($_GET["page"]) ? $_GET["page"] : 1;

require_once "conn.php";
if ($conn->connect_errno) {
    echo "Не удалось подключиться" . $conn->error;
}
$sql1 = "SELECT * FROM news ORDER BY `date` DESC";
$arResult = mysqli_query($conn, $sql1);
if ($arResult) {
    $rowsCount = mysqli_num_rows($arResult);
    $limit = 4;
    $offset = $limit * ($page - 1);
    $totalPages = ceil($rowsCount / $limit);
}
mysqli_free_result($arResult);
$sql = "SELECT * FROM news ORDER BY `date` DESC LIMIT $limit OFFSET $offset";
$arResult = mysqli_query($conn, $sql);
if ($arResult) {
    ?>
    <div class="row-news">
        <?
        foreach ($arResult as $arItem) {
            $arItem["date"] = array_shift(explode(" ", $arItem["date"]));
            $arDate = explode("-", $arItem["date"]);
            $arItem["date"] = $arDate[2] . "." . $arDate[1] . "." . $arDate[0];
            ?>
            <div class="col-49 news_detail">
                <a href="news/detail.php?id=<?= $arItem["id"] ?>" class="">
                    <div class="date">
                        <?= $arItem["date"] ?>
                    </div>
                    <h2><?= $arItem["title"] ?></h2>
                    <div><?= $arItem["announce"] ?></div>
                    <div class="btn">ПОДРОБНЕЕ
                        <div class="arrow-1">
                            <div></div>
                        </div>
                    </div>
                </a>
            </div>
        <? } ?>
    </div>
    <div class="pagination">
        <? if ($page > 1) { ?>
            <a href="?page=<?= $page - 1 ?>" class="next_pag">&larr;</a>
        <? } ?>
        <?
        if ($page == 1) {
            $startPage = 1;
        } elseif ($page == $totalPages) {
            $startPage = $totalPages - 2;
        } else {
            $startPage = $page - 1;
        }

        if ($page == 1) {
            $endPage = 3;
        } elseif ($page == $totalPages) {
            $endPage = $totalPages;
        } else {
            $endPage = $page + 1;
        }
        ?>
        <? foreach (range($startPage, $endPage) as $pagination) { ?>

            <? if ($pagination == $page) { ?>
                <div class="active_pag"><?= $pagination ?></div>
            <? } else { ?>
                <?= "<a href='?page=" . $pagination . "' class='list_pag'>" . $pagination . "</a>" ?>
            <? } ?>
        <? } ?>
        <? if ($page != $totalPages) { ?>
            <a href="?page=<?= $page + 1 ?>" class="next_pag">&rarr;</a>
        <? } ?>
    </div>

    <?
    mysqli_free_result($arResult);
} else {
    echo "Ошибка: " . mysqli_error($conn);
}
mysqli_close($conn);
?>