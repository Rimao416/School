<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <title>Document</title>
    <link rel="stylesheet" href="../public/css/login.css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
    <div id="container">
    </div>
    <div id="container2"></div>
    <div class="sidenav">
        
            <div class="main">
                    <form method="post" id="director_login_form">
                    <div class="title">
                            <h3>Page de Connexion</h3>
                            <hr>
                            <hr>
                    </div>
                    <div class="form-group">  
                        <label>Adresse de Connexion</label>
                            <input type="text" name="director_emailid" id="director_emailid" class="form-control">
                            <span id="error_director_emailid" class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label>Mot de passe</label>
                        <input type="password" name="director_password" id="director_password" class="form-control">
                        <span id="error_director_password" class="text-danger"></span>
                    </div>
                    <input type="hidden" value="send" name="action" id="action">
                    <input type="submit" name="student_login" id="student_login" class="btn btn-info" value="Connexion">
                
                </form>
                <a href="forgot_password.php" id="Forgot">Coordonnées Oubliées</a>
            </div>

        </div>
    </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="../public/js/director/login_action.js"></script>
</body>
</html>