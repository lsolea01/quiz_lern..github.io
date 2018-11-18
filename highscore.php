

<!--  Author: Loukas Solea-->
<!--  ID:944544-->
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


    <title>Page Help</title>







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

<?php
    $json = file_get_contents('score.json');

    $json_data= json_decode($json,true);

foreach ( $json_data as $key => $value) {
    echo $value["name"] . ", " . $value["score"] . "<br>";
}

?>
</div><!-- /.container-fluid -->



<footer>
    <p>You can try again and score more!!</p>
</footer>



</html>
