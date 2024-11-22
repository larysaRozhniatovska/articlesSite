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

<form action="<?= \app\lib\Router::url('addUser')?>" method="post" name="formAddUser" id="formModal"
      class="w3-panel  w3-center w3-modal"  >
    <div class="w3-modal-content ">
        <header class="w3-container w3-teal">
            <h1 class="w3-border-left w3-text-red w3-xlarge ">Add User</h1>
            <span onclick="document.getElementById('formModal').style.display='none'"
                  class="w3-button w3-display-topright">&times;
            </span>

        </header>
        <div class="w3-margin">
            <label for="id-reglogin">Login</label>
            <input class="w3-input" type="text" name="reglogin" id="id-reglogin" placeholder="Enter login">
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

