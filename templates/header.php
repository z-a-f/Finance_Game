<!DOCTYPE html>

<html>

    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link href="./css/bootstrap.min.css" rel="stylesheet"/>
        <link href="./css/bootstrap-theme.min.css" rel="stylesheet"/>
        <link href="./css/styles.css" rel="stylesheet"/>

        <?php if (isset($title)): ?>
            <title>Zafar'$ Finance: <?= htmlspecialchars($title) ?></title>
        <?php else: ?>
            <title>Zafar'$ Finance</title>
        <?php endif ?>

        <script src="./js/jquery-1.10.2.min.js"></script>
        <script src="./js/bootstrap.min.js"></script>
        <script src="./js/scripts.js"></script>

    </head>

    <body>
        <div class="container">
<?php if(isset($_SESSION["username"])): ?>
            <div id = "topHead">
                Logged in as <strong><a href="profile.php"><?= $_SESSION["username"] ?>[PROFILE]</a></strong>
            </div><br/>
<?php endif ?>
            <div id="top">
                <a href="/~ztakhiro/Finance_Game"><img alt="Zafar'$ Finance" src="./img/logo.gif"/></a>
            </div>

            <div id="middle">
