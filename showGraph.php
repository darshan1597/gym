<?php

    include("dbConnec.php");
    include("functions.php");

    $mail = $_SESSION['userEmail'];
    $workoutName = convertData($_GET['wN'], 'decrypt');

    $query = "
            SELECT * FROM schedule
            WHERE email = '".$mail."'
            AND exe = '".$workoutName."'
    ";
    $statement = $connection->prepare($query);
    $statement->execute();
    $workoutChart = '';
    if($statement->rowCount() > 0){
        foreach($statement->fetchAll() as $row){
            $workoutChart .= "{ date:'".$row["date"]."', status:'".$row["exe_status"]."'}, ";
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap links -->
    <link href="asset/css/simple-datatables-style.css" rel="stylesheet" />
    <link href="asset/css/styles.css" rel="stylesheet" />
    <script src="asset/js/font-awesome-5-all.min.js" crossorigin="anonymous"></script>
    <!-- favicions -->
    <link rel="apple-touch-icon" href="" sizes="180x180">
    <link rel="icon" href="" sizes="32x32" type="image/png">
    <link rel="icon" href="" sizes="16x16" type="image/png">
    <link rel="manifest" href="">
    <link rel="mask-icon" href="" color="#7952b3">
    <link rel="icon" href="">
    <meta name="theme-color" content="#7952b3">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <!-- graphs -->
    <link rel="icon" href=""><link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <title>Fitness Academy</title>
</head>
<style>
    body {
        background: -webkit-linear-gradient(45deg, red 50%, black 0%);
    }
    .mainGraph{
        margin: 50px 50px 50px 50px;
    }
    .items{
        margin: 10px;
        text-transform: capitalize;
        background: rgba(0, 100, 100, 0.8);
        border-radius: 25px;
    }
    .items:hover{
        cursor: pointer;
        border: 3px solid blue;
        border-radius: 25px;
        transition: 0.5s;
    }
    .header {
        padding: 20px 0px 20px 50px;
        background: rgba(225, 225, 225, 0.8);
    }
    .nav>span {
        margin-right: 15px;
        cursor: pointer;
        font-weight: bold;
        padding-right: 2px;
        border-right: 3px solid #000;
    }
    .nav>span>a{
        text-decoration: none;
        color: #000;
    }
</style>
<body>
    <header class="header">
        <nav class="nav">
            <span><a href="setGoal.php">Set Goals</a></span>
            <span><a href="viewGoals.php">View Goals</a></span>
            <span><a href="viewGraph.php">View Graph</a></span>
            <span><a href="nutrition.php">Nutritions</a></span>
        </nav>
    </header>
    <div class="mainGraph text-light">
        <div class="items">
            <h4 align="center" class="mt-2"><?php echo $workoutName ?> Exercise Graph</h4>
            <div id="chart"></div>
        </div>
    </div>
    <script>
        Morris.Bar({
            element : 'chart',
            data:[<?php echo $workoutChart; ?>],
            xkey:'date',
            ykeys:['status'],
            labels:['Status'],
            hideHover:'auto',
            stacked:true
        });
    </script>
    <script src="asset/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="asset/js/scripts.js"></script>
    <script src="asset/js/simple-datatables@latest.js" crossorigin="anonymous"></script>
    <script src="asset/js/datatables-simple-demo.js"></script>
</body>
</html>