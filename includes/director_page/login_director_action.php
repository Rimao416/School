<?php
    include('../database.php');
    session_start();
    if(isset($_POST['action'])){
        //CONNEXION DU DIRECTEUR AU SITE WEB
        /*  
            1) On y fera 3 Opérations: Connexion, Récuperer Son compte en cas de mot de passe oublié
            2) Il peut également modifier son compte si cela le chante
            */
        if($_POST['actin']='send'){

            $email=$_POST['director_emailid'];
            $password=$_POST['director_password'];
            $verify=$connect->prepare("SELECT * FROM directeurs WHERE adresse_connexion =?");
            $verify->execute(array($email));
        //Existence ou non
        if($verify->rowCount()>0){
            $result=$verify->fetchAll();
            foreach($result as $row){
               if(password_verify($password,$row["password"])){
                    $_SESSION["id_directeur"]=$row["id_directeur"];
                    $_SESSION['id_ecole']=$row['ecole'];
                    $output=array(
                        'error'=>false
                    );
                }else{
                    $output=array(
                        'error'=>true,
                        'type'=>'password',
                        'error_directeur_password'=>'Mot de passe incorrect'
                    );
                }
            }
        }else{
            $output=array(
                'error'=>true,
                'type'=>'username',
                'error_directeur_mail'=>'Le directeur tapé n\'existe pas'
            );
        }   
        echo json_encode($output);
    }





    }
?>
