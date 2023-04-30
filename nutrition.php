<?php

    include('dbConnec.php');
    include('functions.php');

    $message = '';

	if(isset($_POST["logBtn"])){
		$formdata = array();

		if(empty($_POST["meal"])){
			$message .= '<li>Meal is required</li>';
		}
		else{
			$formdata['meal'] = $_POST['meal'];
		}

		if(empty($_POST['protien'])){
			$message .= '<li>Protien is Required</li>';
		}
		else{
			$formdata['protien'] = $_POST['protien'];
		}

		if(empty($_POST['calories'])){
			$message .= '<li>Calorie is Required</li>';
		}
		else{
			$formdata['calories'] = $_POST['calories'];
		}

        $formdata['date'] = $_POST['date'];

		if($message == ''){
			$data = array(
				':date' => $formdata['date']
			);

			$query = "
                SELECT COUNT(date) AS Total FROM nutrition
			";

			$statement = $connection->prepare($query);
			$statement->execute($data);

			if($statement->rowCount() <= 4){
				$data = array(
                    ':mail'			      =>	   $_SESSION['userEmail'],
                    ':meal'			   =>   $formData['meal'],
                    ':protien'	       =>	$formData['protien'],
                    ':date'	       =>	$formData['date'],
                    ':calorie'	       =>	$formData['calorie'],
                );

                $query = "
                    INSERT INTO user 
                    (meal, protien, date, calorie, mail) 
                    VALUES (:meal, :protien, :date, :calorie, :mail)
			    ";
			}	
			else{
				$message = '<li>Cannot Enter More than 4 Meals a day</li>';
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
    .alert-danger{
        padding: 15px 45px 0px 20px;
        border-radius: 50px;
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
    
    <div class="d-flex align-items-center justify-content-center" style="min-height:700px;">
    <div class="card-body">
        <table id="datatablesSimple" class="text-light">
            <thead>
                <tr>
                    <th>Meal</th>
                    <th>Calories</th>
                    <th>Protien</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Meal</th>
                    <th>Calories</th>
                    <th>Protien</th>
                </tr>
            </tfoot>
            <tbody>
                <tr>
                    <td>Chicken Curry (100 g)</td>
                    <td>15-20</td>
                    <td>150-200</td>
                </tr>
                <tr>
                    <td>Tandoori Chicken (100 g)</td>
                    <td>25-30</td>
                    <td>200-250</td>
                </tr>
                <tr>
                    <td>Vegetable Biryani (100 g)</td>
                    <td>2-3</td>
                    <td>150-200</td>
                </tr>
                <tr>
                    <td>Chole Bhature (100 g)</td>
                    <td>10-15</td>
                    <td>500-600</td>
                </tr>
                <tr>
                    <td>Saag Paneer (100 g)</td>
                    <td>8-10</td>
                    <td>150-200</td>
                </tr>
                <tr>
                    <td>Naan Bread (100 g)</td>
                    <td>7-8</td>
                    <td>300-350</td>
                </tr>
                <tr>
                    <td>Masala Dosa (100 g)</td>
                    <td>5-6</td>
                    <td>200-250</td>
                </tr>
                <tr>
                    <td>Butter Chicken (100 g)</td>
                    <td>15-20</td>
                    <td>200-250</td>
                </tr>
                <tr>
                    <td>Samosas (100 g)</td>
                    <td>2-3</td>
                    <td>100-150</td>
                </tr>
                <tr>
                    <td>Chana Masala (100 g)</td>
                    <td>5-6</td>
                    <td>150-200</td>
                </tr>
                <tr>
                    <td>Idli and Dosa (100 g)</td>
                    <td>2-3</td>
                    <td>100-150</td>
                </tr>
                <tr>
                    <td>Aloo Gobi (100 g)</td>
                    <td>2-3</td>
                    <td>100-150</td>
                </tr>
                <tr>
                    <td>Dal Makhani (100 g)</td>
                    <td>10-12</td>
                    <td>250-300</td>
                </tr>
                <tr>
                    <td>Rasam (100 g)</td>
                    <td>1-2</td>
                    <td>50-70</td>
                </tr>
                <tr>
                    <td>Palak Paneer (100 g)</td>
                    <td>8-10</td>
                    <td>150-200</td>
                </tr>
                <tr>
                    <td>Vada Pav (100 g)</td>
                    <td>5-6</td>
                    <td>300-350</td>
                </tr>
                <tr>
                    <td>Hyderabadi Biryani (100 g)</td>
                    <td>10-12</td>
                    <td>250-300</td>
                </tr>
                <tr>
                    <td>Mutter Paneer (100 g)</td>
                    <td>8-10</td>
                    <td>150-200</td>
                </tr>
                <tr>
                    <td>Papdi Chaat (100 g)</td>
                    <td>2-3</td>
                    <td>150-200</td>
                </tr>
                <tr>
                    <td>Chicken Tikka Masala (100 g)</td>
                    <td>15-20</td>
                    <td>200-250</td>
                </tr>
                <tr>
                    <td>Dahi Vada (100 g)</td>
                    <td>3-4</td>
                    <td>150-200</td>
                </tr>
                <tr>
                    <td>Paneer Butter Masala (100 g)</td>
                    <td>10-12</td>
                    <td>250-300</td>
                </tr>
                <tr>
                    <td>Chicken Korma (100 g)</td>
                    <td>15-20</td>
                    <td>200-250</td>
                </tr>
                <tr>
                    <td>Aloo Tikki (100 g)</td>
                    <td>2-3</td>
                    <td>150-200</td>
                </tr>
            </tbody>
        </table>
    </div>
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
                <div class="card-header d-flex justify-content-center"><h2>Log Your Nutrition</h2></div>
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <h5><label class="form-label">Meal</label></h5>
                            <div class="center">
                                <select type="text" name="meal" id="meal" onkeyup="getWorkout(this.value)" class="form-control">
                                    <?php echo food($connection); ?>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <h5><label class="form-label">Protien</label></h5>
                            <div class="center">
                                <input type="number" name="protien" id="protien" class="form-control" />
                            </div>
                        </div>

                        <div class="mb-3">
                            <h5><label class="form-label">Calories</label></h5>
                            <div class="center">
                                <input type="number" name="calories" id="calories" class="form-control" />
                            </div>
                        </div>

                        <div class="mb-3">
                            <h5><label class="form-label">Date</label></h5>
                            <div class="center">
                                <input type="text" name="date" id="date" class="form-control" value="<?php echo date('d-m-Y'); ?>" readonly />
                            </div>
                        </div>

                        <div class="center">
                            <input type="submit" name="logBtn" class="logBtn text-dark" value="Log" />
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
</html>