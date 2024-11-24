<div class="div-home">
    <?php if(empty($articles)) : ?>
    <div >
        Articeles not found
    </div>
    <?php else : ?>
        <?php foreach($articles as $article) : ?>
        <ul>
            <li><a href="<?= \app\lib\Router::url('viewArticle') . '&id=' . $article['id']?>"><?=$article['title'] ?></a></li>
        </ul>

        <?php endforeach;
    endif;?>

</div>
