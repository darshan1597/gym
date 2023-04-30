<?php

    include('dbConnec.php');
    include('functions.php');

    $message = '';

    $query = "
        SELECT * FROM schedule 
        WHERE email = '".$_SESSION['userEmail']."'
    ";
    $statement = $connection->prepare($query);
    $statement->execute();

    if(isset($_POST["updateBtn"])){
		$formData = array();

        $formData['date'] = $_POST['date'];
        $formData['time'] = $_POST['time'];
        $formData['exe'] = $_POST['exe'];
        $formData['mail'] = $_SESSION['userEmail'];

        if(empty($_POST['completion'])){
            $message .= '<li>Work Out Status is Required</li>';
        }
        else{
            if($_POST['completion'] == "Done"){
                $formData['completion'] = 100;
            }
            elseif($_POST['completion'] == "Almost Done"){
                $formData['completion'] = 65;
            }
            elseif($_POST['completion'] == "Half / Less Than Half"){
                $formData['completion'] = 35;
            }
            elseif($_POST['completion'] == "Not Done"){
                $formData['completion'] = 5;
            }
        }
        if($message == ''){ 
            if($statement->rowCount() > 0){
                foreach($statement->fetchAll() as $row){
                    $data = array(
                        ':mail' => $formData['mail'],
                        ':date' => $formData['date'],
                        ':time' => $formData['time'],
                        ':exe' => $formData['exe'],
                    );
                    $query = "
                        SELECT * FROM schedule 
                        WHERE email = :mail AND
                        date = :date AND
                        time = :time AND
                        exe = :exe
                    ";
                    $statement = $connection->prepare($query);
                    $statement->execute($data);
                    if($statement->rowCount() > 0){
                        foreach($statement->fetchAll() as $row){
                            if($row['exe_status'] == 0){
                                $query = "
                                    UPDATE schedule 
                                    SET exe_status = '".$formData['completion']."'
                                    WHERE email = '".$formData['mail']."' AND
                                    date = '".$formData['date']."' AND
                                    time = '".$formData['time']."' AND
                                    exe = '".$formData['exe']."'
                                ";
                                $connection->query($query);
                            }
                            else{
                                $message = '<li>Can be changed only once</li>';
                            }
                        }
                    }
                }
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
    .center {
        display: flex;
        justify-content: center;
        align-items: center;
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
    .card {
        border-radius: 25px;
    }
    
    a{
        text-decoration: none;
        color: #000;
    }
    .contain{
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 15px;
    }
    .lie{
        color: #000;
        background: rgba(225, 225, 225, 0.7);
        padding: 5px;
        border-radius: 15px
    }
    .select{
        background: transparent;
    }
    .badge{
        width: 80%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 10px;
    }
    .alert-danger{
        padding: 15px 45px 0px 20px;
        border-radius: 50px;
    }
    .logBtn{
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
	.logBtn:hover{
        transition: 0.5s;
        transform: scale(1.2);
	}
    .form-control{
        border-radius: 50px;
        width: 80%;
        padding: 10px 10px;
    }
    .center{
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .form-control:focus{
        border: 2px solid black;
    }
    .card{
        border-radius: 25px;
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
    <div class="contain">
        <h1 class="lie">Never LIE on Your Health</h1>
    </div>
    <?php
        if(isset($_GET["action"])){
            if($_GET["action"] == 'view'){
                $date = $_GET['date'];
                $time = $_GET['time'];
                $exe = convertData($_GET['exe'], 'decrypt');
    ?>
                <div class="d-flex align-items-center justify-content-center" style="min-height:700px;">
                    <div class="col-md-4 form">

                        <?php 
                            if($message != ''){                
                                echo '
                                    <div class="center">
                                        <div class="alert alert-dismissible alert-danger" role="alert">
                                            <ul>'.$message.'</ul>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                        </div>
                                    </div>
                                    ';
                            }
                        ?>

                        <div class="card">
                            <div class="card-header d-flex justify-content-center"><h2>Add Workout</h2></div>
                            <div class="card-body">
                                <form method="POST">
                                    <div class="mb-3">
                                        <h5><label class="form-label">Completion Status</label></h5>
                                        <div class="center">
                                            <select type="text" name="completion" id="completion" class="form-control">
                                                <option value="">View</option>
                                                <option value="Done">Done</option>
                                                <option value="Almost Done">Almost Done</option>
                                                <option value="Half / Less Than Half">Half / Less Than Half</option>
                                                <option value="Not Done">Not Done</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <h5><label class="form-label">Workout</label></h5>
                                        <div class="center">
                                            <input type="text" name="exe" id="exe" style="text-transform:capitalize" class="form-control" value="<?php echo $exe ?>" readonly />
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <h5><label class="form-label">Date</label></h5>
                                        <div class="center">
                                            <input type="text" name="date" id="date" style="text-transform:capitalize" class="form-control" value="<?php echo $date ?>" readonly />
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <h5><label class="form-label">Time</label></h5>
                                        <div class="center">
                                            <input type="text" name="time" id="time" style="text-transform:capitalize" class="form-control" value="<?php echo $time ?>" readonly />
                                        </div>
                                    </div>

                                    <div class="center">
                                        <input type="submit" name="updateBtn" class="logBtn text-dark" value="Update" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
    <?php
            }
        }
        else{
    ?>
            <?php
            if ($message != '') {
                echo '
                        <div class="center">
                            <div class="alert alert-dismissible alert-danger" role="alert">
                                <ul>' . $message . '</ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        </div>
                    ';
            }
            ?>

            <div class="card-body">
                <table id="datatablesSimple" class="text-light">
                    <thead>
                        <tr>
                            <th>Exercise Name</th>
                            <th>time</th>
                            <th>date</th>
                            <th>Points</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Exercise Name</th>
                            <th>time</th>
                            <th>date</th>
                            <th>Points</th>
                            <th>Status</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                            if($statement->rowCount()>0){
                                foreach($statement->fetchAll() as $row){
                                    echo '
                                        <tr>
                                            <td style="text-transform:uppercase">'.$row["exe"].'</td>
                                            <td>'.$row["time"].'</td>
                                            <td>'.$row["date"].'</td>
                                            <td>'.$row['exe_status'].'</td>
                                            <td>
                                                <a href="viewGoals.php?action=view&exe='.convertData($row["exe"]).'&time='.$row['time'].'&date='.$row["date"].'" class="editBtn btn-info badge" style="color:black">View</a>
                                            </td>
                                        </tr>
                                    ';
                                }
                            }
                            else{
                                echo '
                                    <tr>
                                        <td colspan="4" class="text-center">No Data Found</td>
                                    </tr>
                                ';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
    <?php
        }
    ?>
    <script src="asset/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="asset/js/scripts.js"></script>
    <script src="asset/js/simple-datatables@latest.js" crossorigin="anonymous"></script>
    <script src="asset/js/datatables-simple-demo.js"></script>
</body>
</html>