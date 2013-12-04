<html>
    <head>
        <meta charset="UTF-8">
        <title>WT Ankety</title>
    </head>
    <body>
        <form method="post" action="check_login.php">
                <div class="form"><b>Prihlasovacie meno: </b><input type="text" name="login"></div>
                <div class="form"><b>Heslo: </b><input type="password" name="password"></div>
                <div class="form"><input type="submit" value="Prihlásiť"></div>
        </form>
        <form method="post" action="../register/register_user.php">
            <input type="submit" value="Registrovať">
        </form>

    <?php
        session_start();
        if (!(!(isset($_SESSION['login']) && $_SESSION['login'] != ''))) {
            header("location:index.php");
        }
    ?>
    </body>
</html>

