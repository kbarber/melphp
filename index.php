<?php session_start(); ?>
<?php include 'game.php'; ?>
<html>
    <head>
        <title> Scissors paper rock </title>
    </head>

    <body>
        <?php if( isset($_SESSION['username']) == FALSE) :  ?>
        <h3>Please supply a username to play</h3>
<?php else : ?>
    <div id="game">
        <?php game() ?>
    </div>

<?php endif; ?>

    </body>
</html>