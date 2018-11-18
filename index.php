


<!---->
<!-- Author: Loukas Solea-->
<!-- ID:944544-->





<!--I start a session to save the value and used at the next page -->
<?php session_start();?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/index.css">
<!--boostrap input-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


    <title>Quiz</title>

    <?php
//When the start button is press this
//    values take this price
//


if (isset($_POST['start'])){
        $_SESSION['count']=0;
        $_SESSION['start']=1;
        $_SESSION['level']=1;
        $_SESSION['score']=0;
        $_SESSION['boolean']=0;





    }

//    when the next button pess the count is plus 1
    if (isset($_POST['next'])){
        $_SESSION['count']=$_SESSION['count']+1;


    }

//    at the stop game unset all post and reset start value to zero
    if (isset($_POST['stop_game'])){
        $_SESSION['start']=0;
        unset($_POST);
    }

    ?>






</head>


<div class="container-fluid">

    <!--  navbar  -->
    <nav class="navbar navbar-inverse">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-4">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Questions Game</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-collapse-4">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="index.php">Home Page</a></li>
                    <li><a href="helppage.php">Help Page</a></li>
                    <li><a href="highscore.php">High Scores Page</a></li>

                    <li>
                        <a class="btn btn-default btn-outline btn-circle collapsed"  data-toggle="collapse" href="#navbar-header" aria-expanded="false" aria-controls="nav-collapse4">TOP <i class=""></i> </a>
                    </li>
                </ul>

            </div><!-- /.navbar-collapse -->
        </div><!-- /.container -->
    </nav><!-- /.navbar -->
</div><!-- /.container-fluid -->



<div class="container">

<!-- two form with 2 buttons start and stop game -->
   <form method="post" >
       <input type="submit" name="start" value="START">

        </form>
    <form method="post" >
       <input type="submit" name="stop_game" value="STOP GAME">

        </form>

    <?php










//check if the button start is press and generate a random number from 0 - 24
    if (isset($_POST['start'])|| $_SESSION['start']==1 ) {
        $random_number= rand(0, 24);

//check if start or next button is press and check the question is the question is correct
//and if plus the level and compute the score
        if (isset($_POST['next']) || $_SESSION['start']==1&&   $_SESSION['boolean']==1&& $_SESSION['count']<4 ) {
            if( $_POST['radio']==$_SESSION['question_correct']){
                if($_SESSION['level'] == 1||$_SESSION['level'] == 2){
                    $_SESSION['level']=$_SESSION['level']+1;
                }
                $_SESSION['score']=$_SESSION['score']+$_SESSION['score_value'];


            }


            else {
                if ($_SESSION['level'] == 2||$_SESSION['level'] == 3) {
                    $_SESSION['level'] = $_SESSION['level'] - 1;
                }


            }
        }

        $_SESSION['boolean']=1;
        // Read JSON file
        if ($_SESSION['level']=="1") {
            $json = file_get_contents('level1.json');

        }
        elseif ($_SESSION['level']=="2"){
            $json = file_get_contents('level2.json');

        }
        elseif ($_SESSION['level']=="3"){
            $json = file_get_contents('level3.json');

        }
        //Decode JSON
        $json_data= json_decode($json,true);

//at this point the form is a dynamic from the json file with next button

        if($_SESSION['count']<4) {


            echo '<form method="post">';

            echo $json_data[$random_number]["question"];
            echo '<br> ';
            echo $_SESSION['count']+1;
            echo':from five question<br>';
            echo '<input type="radio" name="radio"  value="1">';
            echo $json_data[$random_number]["answer1"];
            echo'<br>';
            echo '<input type="radio" name="radio" value="2">  ';
            echo $json_data[$random_number]["answer2"];
            echo'<br>';
            echo '<input type="radio" name="radio" value="3"> ';
            echo $json_data[$random_number]["answer3"];
            echo'<br>';
            echo '<input type="radio" name="radio" value="4"> ';
            echo $json_data[$random_number]["answer4"];
            echo'<br>';
            echo '<input type="submit" name="next" value="NEXT">';
            echo '</form>';


        }
//at this point the form is a dynamic from the json file with finish button
        else if ($_SESSION['count']==4){
            echo $json_data[$random_number]["question"];
            echo '<br>';
            echo $_SESSION['count']+1;
            echo':from five question<br>';
            echo '<form method="post">';

            echo '<input type="radio" name="radio"  value="1">';
            echo $json_data[$random_number]["answer1"];
            echo'<br>';
            echo '<input type="radio" name="radio" value="2">  ';
            echo $json_data[$random_number]["answer2"];
            echo'<br>';
            echo '<input type="radio" name="radio" value="3"> ';
            echo $json_data[$random_number]["answer3"];
            echo'<br>';
            echo '<input type="radio" name="radio" value="4"> ';
            echo $json_data[$random_number]["answer4"];
            echo'<br>';
            echo '<input type="submit" name="finish" value="FINISH">';
            echo '</form>';

            $_SESSION['count']=$_SESSION['count']+1;



        }

        $_SESSION['question_correct']=$json_data[$random_number]["correct"];
        $_SESSION['score_value']=$json_data[$random_number]["score"];



    }
//if the finish button is press reset some values and present a form to save the score with name
    ////of the player
    if(isset($_POST['finish'])){
    if( $_POST['radio']==$_SESSION['question_correct']){
        $_SESSION['score']=$_SESSION['score']+$_SESSION['score_value'];
        $_SESSION['boolean']=0;
        $_SESSION['start']=0;
        echo'Your Score Is:';
        echo $_SESSION['score'];




    }



        echo '<form method="post">';



       echo' YOUR NAME TO SAVE THE SCORE:<br>';
  echo'<input type="text" name="firstname"><br>';


        echo'<br>';
        echo '<input type="submit" name="save" value="SAVE">';
        echo '</form>';


    }
// if save button press them with php apped to file the score and the name
    if(isset($_POST['save'])){
        $current_data=file_get_contents('score.json');
        $array_data=json_decode($current_data,true);
        $extra=array(
                'name'=>$_POST['firstname'],
                'score'=>$_SESSION['score'],
        );
        $array_data[]=$extra;
        $final_data=json_encode($array_data);
        if(file_put_contents('score.json',$final_data)){
            echo '<script language="javascript">';
            echo 'alert("Your save is complete")';
            echo '</script>';
        }


    }



    ?>

    <footer>
        <p>I hope to have i nice game!!</p>
    </footer>

</div>




 </html>