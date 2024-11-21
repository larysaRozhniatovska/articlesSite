<form action="<?= \app\lib\Router::url('loginUser')?>" method="post"
      class="w3-panel w3-card-4 w3-content w3-center" name="formSignIn" style="max-width:400px">
    <div >
        <h1 class="w3-border-left w3-text-red w3-xlarge">LOGIN</h1>
        <div class="w3-margin-bottom">
            <label for="id-login">Login</label>
            <input class="w3-input" type="text" name="login" id="id-login" placeholder="Enter login">
        </div>
        <div class="w3-margin-bottom">
            <label for="id-pass">Password</label>
            <i class="w3-right fa fa-eye-slash" id="eye"></i>
            <input class="w3-input" type="password" name="pass" id="id-pass" placeholder="Enter password">
        </div>
        <?php if (!empty($errorsLogin)): ?>
<!--            <ul class="w3-red w3-left w3-left-align" id="errorsLogin" >-->
                <dev class="w3-red w3-left w3-left-align" id="errorsLogin" > <?= $errorsLogin; ?> </dev>
        <?php endif; ?>
        <div class="w3-container w3-center w3-margin-bottom w3-margin-top">
            <button class="w3-btn w3-teal" style="min-width:50%">Sign In</button>
        </div>
    </div>
</form>

