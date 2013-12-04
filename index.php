<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>WT Ankety</title>
    </head>
    <body>
        <?php
        require_once('core/Answer.php');
        require_once('core/User.php');
        require_once('core/Question.php');
        require_once('core/Poll.php');
        require_once('db/DBHelper.php');
        
        $db = new DBHelper();
        
        session_start();
        if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
            header("location:login/login.php");
        } else {
            echo 'Prihlásený ako ' . $_SESSION['user'];
            echo '<form action = "login/logout.php" >
                <input type="submit" value="Odhlásiť" >
            </form>';
        }
        
        echo '<br>
            <div class="menu" >
                <form method="get" action="create_poll.php" >
                    <input type="submit" value="Vytvoriť anketu">
                </form>
            </div>';
        
        echo '<h2 class="header">Vaše ankety</h2>';
        
        $polls = $db->select->getUsersPolls($_SESSION['user']);
        for($i = 0; $i < count($polls); $i++) {
            echo '<div class="poll">' . ($i + 1) . ' ' . $polls[$i]->getName() . ' ' . $polls[$i]->getType() . '<a href="show_poll.php?pollId=' . $polls[$i]->getId() . '">Zobraziť anketu</a></div>';
        }
        ?>
        
    </body>
</html>
