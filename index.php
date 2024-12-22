<? require($_SERVER["DOCUMENT_ROOT"] . "/include/header.php"); ?>
<?include_once("news/banner.php")?>

<div class="container">
  <h1>Новости</h1>
  <div class="news_list">
    <?include_once("news/news.php")?>
  </div>
</div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/include/footer.php"); ?>