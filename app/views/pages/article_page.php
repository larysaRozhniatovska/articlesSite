<div class="div-home">
    <nav>
        <a href="/home.php"> Головна </a>
    </nav>
    <h1><?= $article['title'] ?></h1>
    <div><?= $article['content']?></div>
    <div class="div-flex">
        <div class="div-left"><?= $article['created_at']?></div>
        <div class="div-right"><?= $author?></div>
    </div>
</div>