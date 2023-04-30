<?php

    include("dbConnec.php");

    $message = '';

	if(isset($_POST["loginBtn"])){
		$formData = array();

		if(empty($_POST["userEmail"])){
			$message .= '<li>Email Address is required</li>';
		}
		else{
			if(!filter_var($_POST["userEmail"], FILTER_VALIDATE_EMAIL)){
				$message .= '<li>Invalid Email Address</li>';
			}
			else{
				$formData['userEmail'] = $_POST['userEmail'];
			}
		}

		if(empty($_POST['userName'])){
			$message .= '<li>user Name is Required</li>';
		}
		else{
			$formData['userName'] = $_POST['userName'];
		}

		if(empty($_POST['userPassword'])){
			$message .= '<li>Password is Required</li>';
		}
		else{
			$formData['userPassword'] = $_POST['userPassword'];
		}

		if($message == ''){
			$data = array(
				':userEmail' => $formData['userEmail']
			);

			$query = "
				SELECT name FROM user 
				WHERE email = :userEmail
			";

			$statement = $connection->prepare($query);
			$statement->execute($data);

			if($statement->rowCount() > 0){
				$message = '<li>Email Already Exists</li>';
			}	
			else{
                $data = array(
                    ':userEmail'			=>	$formData['userEmail'],
                    ':userName'			=>	$formData['userName'],
                    ':userPassword'	    =>	$formData['userPassword']
                );

                $query = "
                    INSERT INTO user 
                    (email, pass, name) 
                    VALUES (:userEmail, :userPassword, :userName)
			    ";

                $statement = $connection->prepare($query);
                $statement->execute($data);
                header('location:login.php?msg=success');
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
    .logReg{
        display: flex;
        flex-direction: column;
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
            <div class="card-header d-flex justify-content-center"><h2>Register</h2></div>
                <div class="card-body">
                    <form class="_form" method="POST">
                        <div class="mb-3">
                            <h5><label class="form-label">User Name</label></h5>
                            <div class="center">
                                <input type="text" name="userName" id="userName" class="form-control"/>
                            </div>
                        </div>

                        <div class="mb-3">
                            <h5><label class="form-label">Email Address</label></h5>
                            <div class="center">
                                <input type="text" name="userEmail" id="userEmail" class="form-control"/>
                            </div>
                        </div>

                        <div class="mb-3">
                            <h5><label class="form-label">Password</label></h5>
                            <div class="center">
                                <input type="password" name="userPassword" id="userPassword" class="form-control" />
                            </div>
                        </div>

                        <div class="mt-4 mb-0 center logReg">
                            <input type="submit" name="loginBtn" class="logBtn" value="Register" />
                            <a href="login.php" class="logBtn" style="background:black;border:3px solid red;text-decoration:none">Back to Login</a>
                        </div>
                        <br>
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