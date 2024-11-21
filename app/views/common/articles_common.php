<form action="<?= \app\lib\Router::url('addArticle')?>"
      method="post">
    <button>Add Article</button>
</form>
<div class="">
    <table class="">
        <thead>
        <tr class="">
            <th >id</th>
            <th >Title</th>
            <th >Action</th>
        </tr>
        </thead>
        <?php if(!empty($articles)):?>
            <tbody>
            <?php for ($i = 0; $i < count($articles); $i++): ?>
                <tr class="w3-border-bottom w3-border-right">
                    <td > <?= $articles[$i]['id'] ?> </td>
                    <td ><?= $articles[$i]['title']?></p></td>
                    <td class="row">
                        <form action="<?= \app\lib\Router::url('editArticle')?>" method="post">
                            <input type="hidden" name="idEditArticle" value="<?=$i?>">
                            <button><i class="fa fa-pencil-square-o" aria-hidden="true" style="color:rgb(255,125,0)"></i></button>
                        </form>
                        <form action="<?= \app\lib\Router::url('delArticle')?>" method="post">
                            <input type="hidden" name="idDelArticle" value="<?=$i?>">
                            <button><i class="fa fa-trash-o" aria-hidden="true" style="color:red"></i></button>
                        </form>
                    </td>
                </tr>
            <?php endfor; ?>
            </tbody>
        <?php endif; ?>
    </table>
</div>
