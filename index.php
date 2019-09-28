<?php session_start() ?>
<?php !include 'game.php' ?>
<!DOCTYPE html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Rock - Paper - Scissors</title>
<link rel="stylesheet" href="style.css" type="text/css" media="screen" title="no title"></link>
</head>

<body>

<?php if (isset($_SESSION['username']) == FALSE): ?>
    <form method="post">
        <h3>Please supply a username to play</h3>
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" />
        <input type="submit" name="submit" value="Let's play!" />
    </form>
<?php else : ?>
    <div id="game">
        <h3>Welcome Back <?= $_SESSION['username'] ?> <a href="?logout=true">Logout</a></h3>
        <?php game() ?>
    </div>
<?php endif; ?>

<div id="scores">
    <table border="1" cellspacing="5" cellpadding="5">
        <tr>
            <th>Username:</th>
            <th>Win:</th>
            <th>Lost:</th>
            <th>Ties:</th>
        </tr>
        <?php scores() ?>
    </table>
</div>

</body>

</html>
