<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title><?= TEXT_SITE_NAME?></title>
        <link rel="stylesheet" href="<?=CSS_DIR . 'styles.css'?>">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    </head>
    <body class="body-home">
        <?php include_once VIEWS_COMMON_DIR . 'header.php'?>
        <?php include_once VIEWS_PAGES_DIR . $page . '_page.php'?>
        <?php include_once VIEWS_COMMON_DIR . 'footer.php'?>
    </body>

</html>
