<!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title><?= TEXT_SITE_NAME?></title>
        <script src="https://kit.fontawesome.com/d16cee9f8d.js"></script>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    </head>
    <body style="background-image: url('/images/background.jpg'); background-position: center;
                        background-size: cover; background-repeat: no-repeat;">
    <?php include_once VIEWS_PAGES_DIR . $page . '_page.php'?>
    </body>
    <script src="<?=JS_DIR . 'script.js'?>" ></script>
</html>
