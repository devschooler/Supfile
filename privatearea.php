<?php
session_start();
include_once('dbconf.php');
$user = $_SESSION['username'] 
?> 

<!DOCTYPE html>
<html>
<head>
	<title> espace perso</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
</head>
<body>

<?php
			if(isset($_SESSION['username'])){
			?>
<div style="margin-left:35%" >
             <img src="assets/logo.jpg"></div>
             </div>
<div class="container" style="margin-bottom: 5%">
	<div class="row">
		<div class="col-md-12">
        <div style="text-align:center"> 
        
			<h2> bienvenue <?php echo $user ?> ! Ici tu peux voir et importer tes fichiers . </h2>
            <a href="index.php">Acceuil</a>
            <a href="logout.php">Deconnexion</a>
         
            </div>
            <div style="margin-top:7%"> 
			<form action="upload.php" enctype="multipart/form-data" class="dropzone" id="image-upload">
				<div style="text-align:center">
					<h3> Glissez-déposez vos fichiers ou cliquez ici pour sélectionner </h3>
				</div>
			</form>
            </div>
		</div>
	</div>
</div>

<div style="margin-left:40%">  
<?php

$userDirectory = 'uploads'.$user; 



if (is_dir($userDirectory)){
  if ($uf = opendir($userDirectory )){
    while (($file = readdir($uf)) !== false ){
      echo '<li><a style="margin-bottom:10%"href="'.$userDirectory.'/'.$file.'">'.$file.'</a>'  ; 
     echo '<a style="margin-bottom:3%;color: red;border-color:red;padding:2px;border-radius:20px;border:2px solid; margin-left: 3%" href="'.$userDirectory.'/'.$file.'" download> télécharger </a></li>'  ; 
   
    }
    closedir($uf); 
   
  }
 
}


else {echo '  Votre dossier est vide , vos fichiers safficheront ici lorsque vous en aurez uploader  </br> Vous pouvez faire cela juste au dessus'   ; 
}
?> 

<?php
				}else{
				?>
                <div style="margin-left: 35%; margin-top:2%"> 
                <img src="assets/logo.jpg"></div>

                <div style="border:2px solid;border-radius:20px;border-color:red;margin:10%;padding:20px;margin-top:5%"> 
				<p>Vous devez être connecté pour accéder à cette page</p>
                <br> 
                <p> Supfile est LE service cloud qu'il vous faut , n'hésitez pas à créer un compte si vous n'en avez pas encore , vous pourrez ainsi disposer de 30Go d'espace de stockage , pour stocker , lire et télécharger vos fichiers. </p>
                <p> cliquer <a href="index.php">ICI</a> si vous souhaitez vous connecter ou créer un compte</p>
                </div>
				<?php
				}
				?>

</body>

</html>


<script type="text/javascript">
	Dropzone.options.imageUpload = {
        maxFilesize:30000,
        acceptedFiles: ".jpeg,.jpg,.png,.gif,.pdf,.docx,.doc,.xls,.mov,.mp4,.mkv"
    };
</script>


</body>
</html>