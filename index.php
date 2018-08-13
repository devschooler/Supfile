<?php
session_start();
include_once('dbconf.php');

$error = false;
if(isset($_POST['btn-login'])){
    $email = trim($_POST['email']);
    $email = htmlspecialchars(strip_tags($email));

    $pass = trim($_POST['password']);
    $pass = htmlspecialchars(strip_tags($pass));

    if(empty($email)){
        $error = true;
        $mailerror = 'entrez un mail ';
    }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error = true;
        $mailerror = 'Entrez un mail valide';
    }

    if(empty($pass)){
        $error = true;
        $passerror = 'Mot de passe requis';
    }elseif(strlen($pass)< 6){
        $error = true;
        $passerror = 'Au moins 6 caractères';
    }

    if(!$error){
        $pass = md5($pass);
        $sql = "select * from users where email='$email' ";
        $result = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        if($count==1 && $row['password'] == $pass){ 
            $_SESSION['username'] = $row['username'];
            header('location: privatearea.php');
        }else{
            $errorMsg = 'Mail ou mot de passe incorrect ';
        }
    }
}

?>

<html>
<head>
<title>Supfile Beta </title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div style="width: 500px; margin: 50px auto;">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
            <img src="assets/logo.jpg"></div>
                <center><h2>Connexion   </h2></center>
                <hr/>
                <?php
                    if(isset($errorMsg)){
                        ?>
                        <div class="alert alert-danger">
                            <span class="glyphicon glyphicon-info-sign"></span>
                            <?php echo $errorMsg; ?>
                        </div>
                        <?php
                    }
                ?>
                <div class="form-group">
                    <label for="email" class="control-label">Email</label>
                    <input type="email" name="email" class="form-control" autocomplete="off">
                    <span class="text-danger"><?php if(isset($mailerror)) echo $mailerror; ?></span>
                </div>
                <div class="form-group">
                    <label for="password" class="control-label">Mot de passe </label>
                    <input type="password" name="password" class="form-control" autocomplete="off">
                    <span class="text-danger"><?php if(isset($passerror)) echo $passerror; ?></span>
                </div>
                <div class="form-group">
                    <center><input type="submit" name="btn-login" value="Se connecter " class="btn btn-primary"></center>
                </div>
                <hr/>
                <a href="register.php">S'inscrire</a>
            </form>
        </div>
<h3 style="text-align : center"> 
        Supfile est un service cloud vous permétant d'upload jusqu'a 30Go de fichiers en ligne ! Qu'attendez-vous pour vous connectez ou vous inscrire si ce n'est déjà le cas ;) 
        </h3>
    </div>
</body>
</html>