<form action="<?= \app\lib\Router::url('addUser')?>"
      method="post">
    <button>Add User</button>
</form>
<div class="">
    <table class="">
        <thead>
        <tr class="">
            <th >id</th>
            <th >Login</th>
            <th >Action</th>
        </tr>
        </thead>
        <?php if(!empty($users)):?>
            <tbody>
            <?php for ($i = 0; $i < count($users); $i++): ?>
                <tr >
                    <td ><?= $users[$i]['id'] ?></td>
                    <td ><?= $users[$i]['login']?></p></td>
                    <td class="row">
                        <form action="<?= \app\lib\Router::url('editUser')?>" method="post">
                            <input type="hidden" name="idEdit" value="<?=$i?>">
                            <button><i class="fa fa-pencil-square-o" aria-hidden="true" style="color:rgb(255,125,0)"></i></button>
                        </form>
                        <form action="<?= \app\lib\Router::url('delUser')?>" method="post">
                            <input type="hidden" name="idDel" value="<?=$i?>">
                            <button><i class="fa fa-trash-o" aria-hidden="true" style="color:red"></i></button>
                        </form>
                    </td>
                </tr>
            <?php endfor; ?>
            </tbody>
        <?php endif; ?>
    </table>
</div>