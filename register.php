<?php
include_once('dbconf.php');

$error = false;
if(isset($_POST['btn-register'])){
   
    $username = $_POST['username'];
    $username = strip_tags($username);
    $username = htmlspecialchars($username);

    $email = $_POST['email'];
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $pass= $_POST['password'];
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);


    if(empty($username)){
        $error = true;
        $errorUsername = 'Veuillez entrer un pseudo ';
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error = true;
        $errorEmail = 'veuillez entrer un email ';
    }

    if(empty($pass)){
        $error = true;
        $errorPassword = 'Entrez un mot de passe ';
    }elseif(strlen($pass) < 6){
        $error = true;
        $errorPassword = '6 caractères minimum';
    }

  
    $pass = md5($pass);

    if(!$error){
        $sql = "insert into users(username, email ,password)
                values('$username', '$email', '$pass')";
        if(mysqli_query($conn, $sql)){
            $successMsg = 'Inscription réussie. <a href="index.php">Cliquez ici pour vous connecter</a>';
        }else{
            echo 'Error '.mysqli_error($conn);
        }
    }

}

?>

<html>
<head>
<div style="margin-left:35%" >
             <img src="assets/logo.jpg"></div>
             </div>
<title> Inscrivez-vous  </title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div style="width: 500px; margin: 50px auto;">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
                <center><h2>Inscrivez-vous et profitez de 30Gb d'espace gratuit </h2></center>
                <hr/>
                <?php
                    if(isset($successMsg)){
                 ?>
                        <div class="alert alert-success">
                            <span class="glyphicon glyphicon-info-sign"></span>
                            <?php echo $successMsg; ?>
                        </div>
                <?php
                    }
                ?>
                <div class="form-group">
                    <label for="username" class="control-label">Nom d'utilisateur</label>
                    <input type="text" name="username" class="form-control">
                    <span class="text-danger"><?php if(isset($errorUsername)) echo $errorUsername; ?></span>
                </div>
                <div class="form-group">
                    <label for="email" class="control-label">Email</label>
                    <input type="email" name="email" class="form-control" autocomplete="on">
                    <span class="text-danger"><?php if(isset($errorEmail)) echo $errorEmail; ?></span>
                </div>
                <div class="form-group">
                    <label for="password" class="control-label">Mot de passe </label>
                    <input type="password" name="password" class="form-control" autocomplete="off">
                    <span class="text-danger"><?php if(isset($errorPassword)) echo $errorPassword; ?></span>
                </div>
                <div class="form-group">
                    <center><input type="submit" name="btn-register" value="S'inscrire" class="btn btn-primary"></center>
                </div>
                <hr/>
                <a href="index.php">Connexion</a>
            </form>
        </div>
    </div>
</body>
</html>