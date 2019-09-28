<?php
//session_destroy();
$con = mysql_connect('localhost', 'root', '')
    or die(mysql_error());

mysql_select_db('games', $con)
    or die(mysql_error());

if(isset($_POST['submit']) == TRUE):

    // Hold a variable, strip insecure elements for database
    $username = trim(mysql_real_escape_string(strip_tags(stripslashes($_POST['username']))));

    // Store our username in the session
    $_SESSION['username'] = $username;

    // Redirect the user back to the application
    header("Location: ./");

endif;

if(isset($_GET['logout']) == TRUE):
    session_destroy();
    header("Location: ./");
endif;

function display_items($item = null) {

    $items = array(
        "rock"     => '<a href="?item=rock">Rock<br /><img src="images/rock.jpg" width="135" height="135" alt="Rock"></a>',
        "paper"    => '<a href="?item=paper">Paper<br /><img src="images/paper.jpg" width="135" height="135" alt="Paper"></a>',
        "scissors" => '<a href="?item=scissors">Scissors<br /><img src="images/scissors.jpg" width="135" height="135" alt="Scissors"></a>',
    );

    if($item == null) :
        foreach( $items as $item => $value ) :
            echo $value;
        endforeach;
    else:
        //echo $items[$item];

        echo str_replace("?item=${item}", "#", $items[$item]);
    endif;

}

function game() {

    if ( isset($_GET['item']) == TRUE) :
        // Valid items
        $items = array('rock', 'paper', 'scissors');

        // Users items
        $user_item = strtolower($_GET['item']);

        // Computer's items
        $comp_item = $items[rand(0, 2)];

        // Users items is valid
        if (in_array($user_item, $items) == FALSE) :
            echo "You must choose from either rock, paper, or scissors";
            die;
        endif;

        // Scissors > Paper
        // Paper > Rock
        // Rock > Scissors
        if ($user_item == 'scissors' && $comp_item =='paper' ||
            $user_item == 'paper' && $comp_item == 'rock' ||
            $user_item == 'rock' && $comp_item == 'scissors') :
            echo '<h2>You Win!</h2>';
            $outcome = 'yes';
        endif;

        if ($comp_item == 'scissors' && $user_item =='paper' ||
            $comp_item == 'paper' && $user_item == 'rock' ||
            $comp_item == 'rock' && $user_item == 'scissors') :
            echo '<h2>You Lose!</h2>';
            $outcome = 'no';
        endif;

        if( $user_item == $comp_item):
            echo '<h2>You Tie!</h2>';
            $outcome = 'tie';
        endif;

        // Users item
        display_items($user_item);

        // Computers item
        display_items($comp_item);

        // Add a bak link
        echo '<br/><a href="./">Play again</a>';

        $sql = "INSERT INTO rock_paper_scissors VALUES (NULL, '" . $_SESSION['username'] . "', '$outcome')";
        $res = mysql_query($sql) or die(mysql_error());
    else :
        display_items();
    endif;

}

function scores() {
    // SQL query to get out username and # of wins, losses or ties
    $sql = 'select
        username,
        sum(case when win = "yes" then 1 else 0 end) win,
        sum(case when win = "no" then 1 else 0 end) loss,
        sum(case when win = "tie" then 1 else 0 end) tie
        from rock_paper_scissors
        group by username;';

    $res = mysql_query($sql) or die(mysql_error());
    while ($row = mysql_fetch_assoc($res)) {
        echo '<tr>';
        echo '<td>' . $row['username'] . '</td>';
        echo '<td>' . $row['win'] . '</td>';
        echo '<td>' . $row['loss'] . '</td>';
        echo '<td>' . $row['tie'] . '</td>';
        echo '</tr>';
    }

}
?>
