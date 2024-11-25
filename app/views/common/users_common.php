<div class="div-colum">
    <form action="#"
          method="post">
        <button id="id-register" type="button" class="w3-btn w3-light-blue"
            onclick="document.getElementById('formModal').style.display='block'">Add User</button>
   </form>
</div>
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
                    <td class="div-row">
                        <form action="<?= \app\lib\Router::url('editUser')?>" method="post">
                            <input type="hidden" name="idEditUser" value="<?=$users[$i]['id']?>">
                            <button><i class="fa fa-pencil-square-o" aria-hidden="true" style="color:rgb(255,125,0)"></i></button>
                        </form>
                        <form action="<?= \app\lib\Router::url('delUser')?>" method="post">
                            <input type="hidden" name="idDelUser" value="<?=$users[$i]['id']?>">
                            <button><i class="fa fa-trash-o" aria-hidden="true" style="color:red"></i></button>
                        </form>
                    </td>
                </tr>
            <?php endfor; ?>
            </tbody>
        <?php endif; ?>
    </table>
</div>
<?php $user_id = 0;
if (!empty($user)){
    $user_id = $user['id'];
}
?>
<form action="<?= \app\lib\Router::url('addUser') . '&user_id=' . $user_id . '&modeEdit=' . $modeEdit?>"
      method="post" name="formAddUser" id="formModal"
      class="w3-panel  w3-center w3-modal"  >
    <div class="w3-modal-content ">
        <header class="w3-container w3-teal">
            <h1 class="w3-border-left w3-text-red w3-xlarge ">
                <?php if ($modeEdit === 'edit'): ?>
                    Edit User
                <?php else: ?>
                    Add User
                <?php endif; ?>
            </h1>
            <span onclick="document.getElementById('formModal').style.display='none'"
                  class="w3-button w3-display-topright">&times;
            </span>

        </header>
        <div class="w3-margin">
            <label for="id-reglogin">Login</label>
            <?php if (!empty($user)): ?>
                <input class="w3-input" type="text" name="reglogin" id="id-reglogin" value="<?=$user['login']?>">
            <?php else: ?>
                <input class="w3-input" type="text" name="reglogin" id="id-reglogin" placeholder="Enter login">
            <?php endif; ?>

        </div>
        <div class="w3-margin ">
            <label for="id-regpass">Password</label>
            <i class="w3-right fa fa-eye-slash" id="eye-regpass"></i>
            <input class="w3-input" type="password" name="regpass" id="id-regpass" placeholder="Enter password">
        </div>
        <div class="w3-margin">
            <label for="id-reregpass">Repeat Password</label>
            <i class="w3-right fa fa-eye-slash" id="eye-reregpass"></i>
            <input class="w3-input" type="password" name="reregpass" id="id-reregpass" placeholder="Enter password">
        </div>
        <?php if (!empty($errorsLogin)): ?>
            <!--            <ul class="w3-red w3-left w3-left-align" id="errorsLogin" >-->
            <dev class="w3-red w3-center w3-center-align" id="errorsLogin" > <?= $errorsLogin; ?> </dev>
        <?php endif; ?>
        <div class="w3-container w3-center w3-margin-bottom w3-margin-top ">
            <button class="w3-btn w3-teal w3-margin-bottom" style="min-width:50%">
                <?php if ($modeEdit === 'edit'): ?>
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

