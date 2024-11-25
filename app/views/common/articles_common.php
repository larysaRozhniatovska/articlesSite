<div class="div-colum">
    <form action="#"
          method="post">
        <button id="id-register" type="button" class="w3-btn w3-light-blue" name="openParamArticle"
                onclick="document.getElementById('formModal').style.display='block'">Add Article</button>
    </form>
</div>
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
                    <td class="div-row">
                        <form action="<?= \app\lib\Router::url('editArticle')?>" method="post">
                            <input type="hidden" name="idEditArticle" value="<?=$articles[$i]['id']?>">
                            <button><i class="fa fa-pencil-square-o" aria-hidden="true" style="color:rgb(255,125,0)"></i></button>
                        </form>
                        <form action="<?= \app\lib\Router::url('delArticle')?>" method="post">
                            <input type="hidden" name="idDelArticle" value="<?=$articles[$i]['id'] ?>">
                            <button><i class="fa fa-trash-o" aria-hidden="true" style="color:red"></i></button>
                        </form>
                    </td>
                </tr>
            <?php endfor; ?>
            </tbody>
        <?php endif; ?>
    </table>

</div>
<?php $article_id = 0;
if (!empty($article)){
    $article_id = $article['id'];
}
?>
<form action="<?= \app\lib\Router::url('addArticle') . '&article_id=' . $article_id . '&modeEdit=' . $modeEdit?>"
      method="post" name="formAddArticle" id="formModal"
      class="w3-panel  w3-center w3-modal"  >
    <div class="w3-modal-content ">
        <header class="w3-container w3-teal">
            <h1 class="w3-border-left w3-text-red w3-xlarge ">
                <?php if  ($modeEdit === 'edit'):  ?>
                    Edit Article
                <?php else: ?>
                    Add Article
                <?php endif; ?>
            </h1>
            <span onclick="document.getElementById('formModal').style.display='none'"
                  class="w3-button w3-display-topright">&times;
            </span>

        </header>
        <div class="w3-margin">
            <label for="id-title">Title</label>
            <?php if (!empty($article)): ?>

            <input class="w3-input" type="text" name="title" id="id-title" value="<?=$article['title']?>">
            <?php else: ?>
                <input class="w3-input" type="text" name="title" id="id-title" placeholder="Enter title">
            <?php endif; ?>
        </div>
        <div class="div-colum">
            <label for="id-content">Content</label>
            <?php if (!empty($article)):?>
                <textarea  name="content" id="id-content" > <?=$article['content']?></textarea>
            <?php else: ?>
                <textarea  name="content" id="id-content" placeholder="Enter content"> </textarea>
            <?php endif; ?>
        </div>
        <?php if (!empty($errorsAdd)): ?>
            <!--            <ul class="w3-red w3-left w3-left-align" id="errorsLogin" >-->
            <dev class="w3-red w3-center w3-center-align" id="errorsLogin" > <?= $errorsAdd; ?> </dev>
        <?php endif; ?>
        <div class="w3-container w3-center w3-margin-bottom w3-margin-top ">
            <button class="w3-btn w3-teal w3-margin-bottom" style="min-width:50%">
                <?php if  ($modeEdit === 'edit'):  ?>
                Edit
                <?php else: ?>
                Add
                <?php endif; ?>
            </button>
        </div>
    </div>
</form>
<?php if($modeEdit !== 'add'):?>
    <script>
        document.getElementById('formModal').style.display='block';
    </script>
<?php else: ?>
    <script>
        document.getElementById('formModal').style.display='hide';
    </script>
<?php endif; ?>