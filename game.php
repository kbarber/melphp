<?php

$con = mysql_connet('localhost', 'root','')
    or die(mysql_error());

mysql_select_db('games', $con)
    or die(mysql_error());

if( isset($_POST['submit']) == TRUE ) :

    //Hold a variable
    $username = trim(mysql_real_escape_string(strip_tags(striplashes($_POST['username']))))

    //Store our session
    $_SESSION['username'] = $username;

    // Redirect the user
    header("Location: ./");

endif;

if( isset($_GET['logout']) == TRUE ) {
    session_destroy();
    header("Location: ./");
}
    function display_items($item = null) {

        $items = array(
            "rock"      => '<a href="?item=rock">Rock<br /><img src="images/rock.jpg" width="135" height="135" alt="Rock"></a>',
            "paper"     => '<a href="?item=paper">Paper<br /><img src="images/paper.jpg" width="135" height="135" alt="Paper"></a>',
            "scissors"  => '<a href="?item=scissors">Scissors<br /><img src="images/scissors.jpg" width="135" height="135" alt="Scissors"></a>'
            );

            if( $item == null ) :
                foreach( $items as $item => $value ) :
                    echo $value;
                endforeach;
            else :
                // echo $items[$item];
                echo str_replace("?item={$item}", "#", $items[$item]);
            endif;
    }
    function game() {

        if( isset($_GET['item']) == TRUE ) :
            
            // Valid Items
            $items = array('rock', 'paper', 'scissors');

            // User's Item
            $user_item = strtolower($_GET['item']);

            $comp_item = $items[rand(0, 2)];

            if( in_array($user_item, $items) == FALSE ) :
                echo "You must choose either a Rock | Paper | Scissors.";
                die;
            endif;

            //Scissors > Paper
            //Paper > Rock
            //Rock > Scissors

            if ( $user_item == 'scissors' && $comp_item == 'paper'||
                 $user_item == 'paper' && $comp_item == 'rock'||
                 $user_item == 'rock' && $comp_item == 'scissors' ) :
                    echo'<h2>You win!</h2>';
                    $outcome = 'yes';
            endif;

            if ( $comp_item == 'scissors' && $user_item == 'paper'||
                 $comp_item == 'paper' && $user_item == 'rock'||
                 $comp_item == 'rock' && $user_item == 'scissors' ) :
                    echo'<h2>You Lose.</h2>';
                    $outcome == 'no';
            endif;

            if( $user_item == $comp_item ) :
                echo '<h2>Tie!</h2>';
                    $outcome = 'tie';
            endif;

            // User's item
            display_items($user_item);

            // Computer's item
            display_items($comp_item);

            // Add a go back link
            echo '<div><a href="./">Play again!</a></div>';

            $sql = "INSERT INTO `rock_paper_scissors` VALUES (null, '" . $_SESSION['username']
            $res = mysql_query($sql) or die(mysql_error());
        else:
            
            display_items();

        endif;

    }
?>