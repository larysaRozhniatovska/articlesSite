<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title><?= TEXT_SITE_NAME?></title>
        <script src="https://kit.fontawesome.com/d16cee9f8d.js"></script>
        <link rel="stylesheet" href="<?=CSS_DIR . 'styles.css'?>">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    </head>
    <body class="body-admin">
        <div class="div-nav">
            <nav>
                <ul>
                    <li><a href="<?= \app\lib\Router::url('changeArticles')?>">Articles</a> </li>
                    <li><a href="<?= \app\lib\Router::url('changeUsers')?>">Users</a> </li>
                </ul>
            </nav>

        </div>
        <div class="div-content">
            <div>
                <div class="w3-container w3-padding w3-teal">
                    <button class="w3-right " type="button" >
                        <a href="<?= \app\lib\Router::url('signOutUser')?>"> <i class="fa fa-sign-out" aria-hidden="true"></i></a></button>
                    <div class="w3-right w3-margin-right "><i class="fa fa-user-o" aria-hidden="true"></i><?= $login ?></div>
                </div>
            </div>
            <?php  include_once VIEWS_COMMON_DIR . $page . '_common.php';?>

        </div>

    </body>
    <script src="<?=JS_DIR . 'script.js'?>" ></script>
</html>
