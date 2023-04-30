<?php

    include('dbConnec.php');
    include('functions.php');

    $exercise = $_GET['exe'];

    $message = '';

	if(isset($_POST["scheduleBtn"])){
		$formdata = array();

		if(empty($_POST["time"])){
			$message .= '<li>Time is Required</li>';
		}
		else{
			$formdata['time'] = $_POST['time'];
		}

		if(empty($_POST['date'])){
			$message .= '<li>Date is Required</li>';
		}
		else{
			$formdata['date'] = $_POST['date'];
		}

		if($message == ''){
			$data = array(
				':time' => $formdata['time'],
                ':date'  => $formdata['date'],
                ':user'  => $_SESSION['userEmail'],
                ':exe'  => $exercise
			);

			$query = "
				SELECT * FROM schedule 
				WHERE email = :user AND
                time = :time AND
                date = :date AND
                exe = :exe
			";

			$statement = $connection->prepare($query);
			$statement->execute($data);

			if($statement->rowCount() > 0){
				foreach($statement->fetchAll() as $row){
                    $message = '<li>Exercise Exists</li>';
				}
            }
			else{
                $data = array(
                    ':time' => $formdata['time'],
                    ':date'  => $formdata['date'],
                    ':user'  => $_SESSION['userEmail'],
                    ':status'  => '0',
                    ':exe'  => $exercise
                );

                $query = "
                    INSERT INTO schedule 
                    (email, exe, time, date, exe_status) 
                    VALUES (:user, :exe, :time, :date, :status)
                ";
        
                $statement = $connection->prepare($query);
                $statement->execute($data);
                header('location:viewGoals.php');
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
    body{
        background: -webkit-linear-gradient(45deg, red 50%, black 0%);
    }
    .logBtn{
        background: #ff1313;
        font-family: "Oswald", sans-serif;
        text-transform: uppercase;
        padding: 20px 15px;
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
    .alert-danger{
        padding: 15px 45px 0px 20px;
        border-radius: 50px;
    }
    .benifits{
        background: rgba(225, 225, 225, 0.8);
    }
    .benifits{
        padding: 10px 0px 6px 20px;
    }
    .benifits > h3{
        padding-bottom: 15px;
    }
    .benifits > ul > li{
        padding-bottom: 8px;
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
    @media (max-width: 992px){
        .form{
            width: 60%;
        }
    }
    @media (max-width: 786px){
        .form{
            width: 100%;
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
    <div class="benifits">
        <h3>Benefits of <span style="text-transform:capitalize"><?php echo $exercise ?></span></h3>
        <?php echo exe($connection, $exercise) ?>
    </div>
    <div class="d-flex align-items-center justify-content-center" style="min-height:500px;">
        <div class="col-md-3 form">

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
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <h5><label class="form-label">Schedule Time</label></h5>
                            <div class="center">
                                <input type="time" name="time" id="time" class="form-control" min="<?php echo date('H:i') ?>" />
                            </div>
                        </div>

                        <div class="mb-3">
                            <h5><label class="form-label">Date</label></h5>
                            <div class="center">
                                <input type="text" name="date" id="date" class="form-control" value="<?php echo date('d-m-Y'); ?>" readonly />
                                    
                            </div>
                        </div>

                        <div class="center">
                            <input type="submit" name="scheduleBtn" class="logBtn text-dark" value="Schedule" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="asset/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="asset/js/scripts.js"></script>
    <script src="asset/js/simple-datatables@latest.js" crossorigin="anonymous"></script>
    <script src="asset/js/datatables-simple-demo.js"></script>
</body>