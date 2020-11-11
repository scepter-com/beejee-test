<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BeeJee <?php echo $title; ?></title>

    <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wdth,wght@113,564&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../Resources/public/css/app.css?v=<?php echo date('l jS \of F Y h:i:s A'); ?>">
    <link rel="stylesheet" href="../../Resources/public/bootstrap/css/bootstrap.css?v=<?php echo date('l jS \of F Y h:i:s A'); ?>">
    <script src="../../Resources/public/js/jquery.js"></script>

</head>
<body>
    <?php
    if(isset($data['admin']))
    {
        ?>

        <div class="bj-header">
            <a href="http://scepter.bridgetown.com.ua/admin/logout">
                <div class="bj-login-page-button btn btn-primary mb-2">
                    Logout
                </div>
            </a>
            <a href="http://scepter.bridgetown.com.ua/home">
                <div class="bj-home-page-button btn btn-primary mb-2">
                    Home
                </div>
            </a>
            <div class="header-bj-user-status">
                Admin
            </div>
        </div>

        <?php
    }
    else
    {
        ?>

        <div class="bj-header">
            <a href="http://scepter.bridgetown.com.ua/admin">
                <div class="bj-login-page-button btn btn-primary mb-2">
                    Login
                </div>
            </a>
            <a href="http://scepter.bridgetown.com.ua/home">
                <div class="bj-home-page-button btn btn-primary mb-2">
                    Home
                </div>
            </a>
            <div class="header-bj-user-status">
                Guest
            </div>
        </div>

        <?php
    }
    ?>

    <div class="bj-content">
        <?php
            echo $content;
        ?>
    </div>


    <script src="../../Resources/public/js/XHRManager.js?v=<?php echo date('l jS \of F Y h:i:s A'); ?>"></script>
</body>
</html>

