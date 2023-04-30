<?php

include("dbConnec.php");

$message = '';

if (isset($_POST["next"])) {
    $formData = array();

    if ((!empty($_POST['bp']) && !empty($_POST['diabetes'])) || (!empty($_POST['bp']) && !empty($_POST['diabetes'])) || (!empty($_POST['bp'])) || (!empty($_POST['bp']) && !empty($_POST['stroke'])) || (!empty($_POST['diabetes'])) || (!empty($_POST['diabetes']) && !empty($_POST['stroke'])) || (!empty($_POST['stroke'])) || (!empty($_POST['bp']) && !empty($_POST['diabetes']) && !empty($_POST['stroke']))) {
        $message .= '<li>Select One</li>';
    }

    if (empty($_POST['bp']) && empty($_POST['diabetes']) && empty($_POST['stroke'])) {
        header('location:setGoal.php');
    }

    if (!empty($_POST['bp'])) {
        $formData['disease'] = $_POST['bp'];
    }

    if (!empty($_POST['diabetes'])) {
        $formData['disease'] = $_POST['diabetes'];
    }

    if (!empty($_POST['stroke'])) {
        $formData['disease'] = $_POST['stroke'];
    }

    if ($message == '') {
        $data = array(
            ':userEmail' => $_SESSION['userEmail']
        );

        $query = "
				SELECT * FROM disease 
				WHERE email = :userEmail
                AND disease = '" . $formData['disease'] . "'
			";

        $statement = $connection->prepare($query);
        $statement->execute($data);

        if ($statement->rowCount() > 0) {
            $message = '<li>Exsits</li>';
        } else {
            $data = array(
                ':userEmail' => $_SESSION['userEmail'],
                ':disease' => $formData['disease']
            );

            $query = "
                    INSERT INTO disease 
                    (email, disease) 
                    VALUES (:userEmail, :disease)
			    ";

            $statement = $connection->prepare($query);
            $statement->execute($data);
            header('location:setGoal.php?msg=success');
        }
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
    <title>Fitness Academy</title>
</head>
<style>
    body {
        background: -webkit-linear-gradient(45deg, red 50%, black 0%);
    }

    .popup {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        display: none;
    }

    .contentBox {
        position: relative;
        width: 500px;
        height: 320px;
        background: #fff;
        border-radius: 20px;
        display: flex;
        flex-direction: column;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1)
    }

    .radio {
        display: flex;
        flex-direction: column;
        margin: 15px
    }

    .radio>span {
        margin-bottom: 15px;
    }

    .anyBelow {
        padding-top: 25px;
    }

    .next {
        position: relative;
        left: 0;
        margin-right: 10px;
        background: cyan;
        border: none;
        border-radius: 10px;
        padding: 9px;
        font-weight: bolder;
        cursor: pointer;
    }

    .close {
        position: absolute;
        top: 10px;
        right: 20px;
        cursor: pointer;
        background: rgb(158, 249, 249);
        padding: 10px 15px;
        border-radius: 50%;
        background-size: 10px;
        background-position: center;
    }

    .alert-danger {
        padding: 15px 45px 0px 20px;
        border-radius: 50px;
    }

    .center {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .container {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-template-rows: repeat(3, 1fr);
    }

    img {
        width: 250px;
        height: 250px;
        border-radius: 25px
    }

    .exercise {
        margin: 10px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .exercise:hover {
        cursor: pointer;
        transform: scale(1.2);
        transition: 1s;
    }

    .des {
        background: gray;
        width: 50%;
        border-radius: 25px;
        padding: 10px;
        margin-top: 10px;
        text-align: center;
        font-size: large;
        font-weight: 900;
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

    .timePopup {
        background: rgba(0, 0, 0, 0.6);
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        display: none;
        align-items: center;
        justify-content: center;
    }

    .timePopupContent {
        position: relative;
    }

    .logBtn {
        background: #ff1313;
        font-family: "Oswald", sans-serif;
        text-transform: uppercase;
        padding: 20px 45px;
        color: #fff;
        cursor: pointer;
        font-size: 18px;
        font-weight: 600;
        border-radius: 50px;
        border: 3px solid black;
        line-height: 0;
        margin-bottom: 0;
        margin: 10px;
    }

    .logBtn:hover {
        transition: 0.5s;
        transform: scale(1.2);
    }

    .form-control {
        border-radius: 50px;
        width: 80%;
        padding: 10px 10px;
    }

    .form-control:focus {
        border: 2px solid black;
    }

    .card {
        border-radius: 25px;
    }

    .alert-danger {
        padding: 15px 45px 0px 20px;
        border-radius: 50px;
    }

    a{
        text-decoration: none;
        color: #000;
    }

    @media (max-width: 500px) {
        .contentBox {
            width: 300px;
            height: 350px;
        }

        .close {
            position: absolute;
            top: 5px;
        }
    }

    @media (max-width: 325px) {
        .contentBox {
            width: 200px;
            height: 350px;
        }

        .close {
            position: absolute;
            top: 3px;
        }
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
    <div class="container">
        <div class="running">
            <a href="scheduleTime.php?exe=running" class="exercise">
                <img src="images/jogging.gif" />
                <span class="des">Running</span>
            </a>
        </div>
        <div class="walking">
            <a href="scheduleTime.php?exe=walking" class="exercise">
                <img src="https://source.unsplash.com/362x300/?jogging" />
                <span class="des">Walking</span>
            </a>
        </div>
        <div class="yoga">
            <a href="scheduleTime.php?exe=yoga" class="exercise">
                <img src="images/yoga.gif" />
                <span class="des">Yoga</span>
            </a>
        </div>
        <div class="pushUps">
            <a href="scheduleTime.php?exe=pushUps" class="exercise">
                <img src="images/pushup.gif" />
                <span class="des">Push Ups</span>
            </a>
        </div>
        <div class="lunge">
            <a href="scheduleTime.php?exe=lunge" class="exercise">
                <img src="images/lunge.gif" />
                <span class="des">Lunge</span>
            </a>
        </div>
        <div class="cycling">
            <a href="scheduleTime.php?exe=cycling" class="exercise">
                <img src="https://source.unsplash.com/362x300/?cycling" />
                <span class="des">Cycling</span>
            </a>
        </div>
        <div class="jumpRope">
            <a href="scheduleTime.php?exe=jumpRope" class="exercise">
                <img src="images/jumpRope.webp" />
                <span class="des">Jump Rope</span>
            </a>
        </div>
        <div class="swimming">
            <a href="scheduleTime.php?exe=swimming" class="exercise">
                <img src="https://source.unsplash.com/362x300/?swimming" />
                <span class="des">Swimming</span>
            </a>
        </div>
    </div>
    <script src="asset/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="asset/js/scripts.js"></script>
    <script src="asset/js/simple-datatables@latest.js" crossorigin="anonymous"></script>
    <script src="asset/js/datatables-simple-demo.js"></script>
</body>

</html>