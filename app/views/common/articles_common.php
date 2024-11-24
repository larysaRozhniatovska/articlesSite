<div class="div-colum">
    <form action="#"
          method="post">
        <button id="id-register" type="button" class="w3-btn w3-light-blue"
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
<form action="<?= \app\lib\Router::url('addArticle')?>" method="post" name="formAddArticle" id="formModal"
      class="w3-panel  w3-center w3-modal"  >
    <div class="w3-modal-content ">
        <header class="w3-container w3-teal">
            <h1 class="w3-border-left w3-text-red w3-xlarge ">Add Article</h1>
            <span onclick="document.getElementById('formModal').style.display='none'"
                  class="w3-button w3-display-topright">&times;
            </span>

        </header>
        <div class="w3-margin">
            <label for="id-title">Title</label>
            <input class="w3-input" type="text" name="title" id="id-title" placeholder="Enter title">
        </div>
        <div class="div-colum">
            <label for="id-content">Content</label>
            <textarea  name="content" id="id-content" placeholder="Enter content"> </textarea>
        </div>
        <div class="w3-container w3-center w3-margin-bottom w3-margin-top ">
            <button class="w3-btn w3-teal w3-margin-bottom" style="min-width:50%">Add</button>
        </div>
        <?php if (!empty($errorsAdd)): ?>
        <ul class="w3-red w3-left w3-left-align" id="errorsAdd">
            <?php foreach ($errorsAdd as $key => $error):?>
                <li> <?= $error; ?> </li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>
    </div>
</form>