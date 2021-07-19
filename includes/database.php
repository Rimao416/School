<?php
$connect = new PDO('mysql:host=localhost;dbname=school_system','root','');

function get_total_records($connect,$table_name){
         $query="SELECT * FROM $table_name";
         $statement=$connect->prepare($query);
         $statement->execute();
         return $statement->rowCount();
     }
     //Fonction contenant la date Actuelle
     function get_date(){
        return date("Y-m-d").' '.date("H:i:s",STRTOTIME(date('h:i:sa')));
    }
    //FONCTION QUI RETOURNE TOUTES LES ECOLES
    function load_school_list($connect){
        $query=$connect->prepare("SELECT * FROM ecole");
        $query->execute();
        $output='';
        $fetch_school=$query->fetchAll();
        foreach($fetch_school as $row){
            $output .='<option value="'.$row['id'].'">'.$row['nom'].'</option>';
        }
        return $output;
    }
    
    //////////////////////////////////////////////////////////////////////////SCHOOL///////////////////////////////////////////////////////////
    //FONCTION QUI RETOURNE LE NOM D'UNE ECOLE AVEC L'ID PASSEE EN PARAMETRE
    function get_school_name_with_id($connect,$id){
        $query="SELECT * FROM ecole WHERE id=?";
        $statement=$connect->prepare($query);
        $statement->execute(array($id));
        $fetch_ecole=$statement->fetch();
        if($statement->rowCount()==1){
            return $fetch_ecole['nom'];
        }else{
            return '---------------';
        }    
    }










    ///////////////////////////////////////////////////////////////////////////DIRECTOR/////////////////////////////////////////////
    //RETOURNE LE NOM DU DIRECTEUR PAR SON ID
    function get_director_name_with_id($connect,$id){
        $query="SELECT * FROM directeurs WHERE id_directeur=?";
        $statement=$connect->prepare($query);
        $statement->execute(array($id));
        $fetch_directeur=$statement->fetch();
        if($statement->rowCount()==1){
            return $fetch_directeur['nom'];
        }else{
            return '---------------';
        }    
    }
    //RETOURNE LE NOM DE L'ECOLE DU DIRECTEUR
    function get_director_school($connect,$id){
        $query="SELECT * FROM directeurs d
        INNER JOIN ecole e ON d.ecole=e.id
        WHERE id_directeur=?";
        $statement=$connect->prepare($query);
        $statement->execute(array($id));
        $fetch_directeur_school=$statement->fetch();
        if($statement->rowCount()==1){
            return $fetch_directeur_school['nom'];
        }else{
            return '---------------';
        }    
    }
    //CHARGER L'EMPLACEMENT DE LA PHOTO DE L'IMAGE DE L'ECOLE
    function upload_school_image()
    {
    if(isset($_FILES["image_school"]))
    {
    $extension = explode('.', $_FILES['image_school']['name']);
    $new_name = rand() . '.' . $extension[1];
    $destination = '../../public/images/admin/' . $new_name;
    move_uploaded_file($_FILES['image_school']['tmp_name'], $destination);
    return $new_name;
    }
    }
    //CHARGER L'IMAGE D'UNE ECOLE PARTANT DE L'ID
    function load_school_image($connect,$id)
    {
        $picture=$connect->prepare("SELECT * FROM ecole WHERE id=?");
        $picture->execute(array($id));
        $fetch_picture=$picture->fetch();
        return $fetch_picture["image"];
    }





















    //////////////////////////////////////////////////////////////////////////////TEACHER///////////////////////////////////////////////////
    //CHARGE LE PROFIL DU MONSIEUR
    function upload_image()
    {
    if(isset($_FILES["image_prof"]))
    {
    $extension = explode('.', $_FILES['image_prof']['name']);
    $new_name = rand() . '.' . $extension[1];
    $destination = '../../../public/images/teacher/' . $new_name;
    move_uploaded_file($_FILES['image_prof']['tmp_name'], $destination);
    return $new_name;
    }
    }
    //FONCTION QUI RETOURNE LE NOM DE L'IMAGE D'UN PROFESSEUR
    function load_teacher_image($connect,$id)
    {
        $picture=$connect->prepare("SELECT * FROM professeur WHERE professeur_id=?");
        $picture->execute(array($id));
        $fetch_picture=$picture->fetch();
        return $fetch_picture['professeur_image'];
    }

    //FONCTION QUI ENVOI AU PROFESSEUR SES COORDONNEES LORS DE LA CREATION DE SON COMPTE
    function send_teacher_mail($fromMail,$to,$name,$addresse,$password){
        $message='';
        $subject="COORDONNEES DU COMPTE";
        $headers = "MIME-Version: 1.0"."\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8"."\r\n";
        $headers .= 'From: Omarkayumba12345@gmail.com'."\r\n". 'Reply-to: Omarkayumbzsdqdq@gmail.com'."\r\n".'X-Mailer:PHP/'.phpversion();
        $message='<!doctype html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie-edge">
            <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
            <title>Document</title>
        </head>
        <body style="font-family:roboto;font-weight:700;">
        <hr>
        <strong>Cher(e) Enseignant(e) '.$name.'</strong> <br>
            
        <h5>INFORMATIONS DU COMPTE</h5> 
        <h5>Addresse Mail de Connexion : <strong>'.$addresse.'</strong> </h5>
        
        <h5> Nouveau Mot de passe: <strong>'.$password.'</strong> </h5>
        <br>
        <a href="http://localhost/attendace/login.php" style="text-decoration:none;background-color:#7460ee;padding:10px 10px;border:none;border-raidus:150px;color:white;font-size:16px;">Me connecter</a> <br>
         <h6>En vérifiant votre adresse e-mail ou en vous connectant au site Web, <br> vous confirmez avoir accepté et compris <br>
          les spécificités du système</h6>
          <h6>Cher Enseignant, vous recevrez toutes les informations, vous concernant et également concerant vos élèves</h6>

        <hr>
        </body>
        </html>';
            $result=mail($to,$subject,$message,$headers);               
    }























    ////////////////////////////////////////////////////////////////////////CLASSE///////////////////////////////////////////////////////////////////
    //FONCTION QUI RETOURNE LA LISTE DES PROFESSEURS
    function load_teacher_list($connect,$session){
        $query=$connect->prepare("SELECT * FROM professeur WHERE id_ecole =?");
        $query->execute(array($session));
        $output='';
        $fetch_school=$query->fetchAll();
        foreach($fetch_school as $row){
            $output .='<option value="'.$row['professeur_id'].'">'.$row['nom_professeur'].' '.$row['prenom_professeur'].'</option>';
        }
        return $output;
    }
    //FONCTION QUI RETOURNE LE TITULAIRE D'UNE SALLE DE CLASSE
    function load_titutailre_with_id($connect,$id){
        $query=$connect->prepare("SELECT * FROM classe c
        INNER JOIN professeur p ON c.id_teacher=p.professeur_id WHERE c.id_classe=?");
        $query->execute(array($id));
        $titulaire_list=$query->fetch();
        if($query->rowCount()>0){
            return $titulaire_list['nom_professeur'];
        }else{
            return "--------Aucun-------";
        }

    }
    //FONCTION QUI RETOURNE TOUTES LES CLASSES
    function load_classe_list($connect,$session){
        $query=$connect->prepare("SELECT * FROM classe WHERE id_ecole =?");
        $query->execute(array($session));
        $output='';
        $fetch_school=$query->fetchAll();
        foreach($fetch_school as $row){
            $output .='<option value="'.$row['id_classe'].'">'.$row['nom_classe'].'</option>';
        }
        return $output;
    }
    //FONCTION QUI RETOURNE LA CLASSE D'UN ELEVE
    function load_classe_with_id($connect,$id){
        $query=$connect->prepare("SELECT * FROM eleve e
        INNER JOIN classe c ON e.classe=c.id_classe WHERE e.id_ecole=?");
        $query->execute(array($id));
        $classe_list=$query->fetch();
        if($query->rowCount()>0){
            return $classe_list['nom_classe'];
        }else{
            return "--------Aucun-------";
        }

    }






















    //////////////////////////////////////////////////////////////////////////STUDENT//////////////////////////////////////////////////////////////
    //FONCTION QUI RETOURNE LA LISTE DES CLASSES POUR L'INSCRIPTION DE L'ELEVE
    function load_class_list($connect){
        $query=$connect->prepare("SELECT * FROM classe");
        $query->execute();
        $output='';
        $fetch_school=$query->fetchAll();
        foreach($fetch_school as $row){
            $output .='<option value="'.$row['id'].'">'.$row['nom'].'</option>';
        }
        return $output;
    }
    //CHARGE LA PHOTO DE L'ETUDIANT 
    function upload_student_image()
    {
    if(isset($_FILES["image_eleve"]))
    {
    $extension = explode('.', $_FILES['image_eleve']['name']);
    $new_name = rand() . '.' . $extension[1];
    $destination = '../../../public/images/student/' . $new_name;
    move_uploaded_file($_FILES['image_eleve']['tmp_name'], $destination);
    return $new_name;
    }
    }
    //OBTIENT LE ROLL NUMBER DE L'ETUDIANT LORS DE LA MODOFICATION
    function get_roll_number($connect,$id){
        $query=$connect->prepare("SELECT * FROM eleve WHERE id_eleve=?");
        $query->execute(array($id));
        $fetch_student=$query->fetch();
        return intval($fetch_student["id_unique"]);
    }
    //OBTIENT LE ROLL NUMBER DE L'ETUDIANT LORS DE LA MODOFICATION
    /*function get_roll_number($connect,$id){
        $query=$connect->prepare("SELECT * FROM eleve WHERE id_eleve=?");
        $query->execute(array($id));
        $output='';
        $fetch_student=$query->fetch();
        return $fetch_student["id_unique"];
    }*/
    //FONCTION QUI RETOURNE LE NOM DE L'IMAGE D'UN ETUDIANT
    function load_student_image($connect,$id)
    {
        $picture=$connect->prepare("SELECT * FROM eleve WHERE id_eleve=?");
        $picture->execute(array($id));
        $fetch_picture=$picture->fetch();
        return $fetch_picture["photo"];
    }
            //FONCTION QUI ENVOI AU PARENT SES COORDONNEES LORS DE LA CREATION DE SON COMPTE
            function send_student_mail($fromMail,$to,$name,$numero,$password){
                $message='';
                $subject="CREATION COMPTE";
                $headers = "MIME-Version: 1.0"."\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8"."\r\n";
                $headers .= 'From: Omarkayumba12345@gmail.com'."\r\n". 'Reply-to: Omarkayumbzsdqdq@gmail.com'."\r\n".'X-Mailer:PHP/'.phpversion();
                $message='<!doctype html>
                <html lang="fr">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
                    <meta http-equiv="X-UA-Compatible" content="ie-edge">
                    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
                    <title>Information du compte</title>
                </head>
                <body style="font-family:roboto;font-weight:700;">
                <hr>
                <center>
                <strong>Cher(e) Eleve(e) '.$name.'</strong> <br>
                    
                <h5>INFORMATIONS DU COMPTE</h5> 
                <h5>Addresse Mail de Connexion : <strong>'.$numero.'</strong> </h5>
                
                <h5> Nouveau Mot de passe: <strong>'.$password.'</strong> </h5>
                
                <br>
                <a href="monsite" style="text-decoration:none;background-color:#7460ee;padding:10px 10px;border:none;border-raidus:150px;color:white;font-size:16px;">Me connecter</a> <br>
                 <h6>En vérifiant votre adresse e-mail ou en vous connectant au site Web, <br> vous confirmez avoir accepté et compris <br>
                  les spécificités du système</h6>
                  <h6><i>Nous vous demandons de regulièrement vérifier votre boîte mail, afin de recevoir toutes les informations concernant votre enfant</i></h6>
                </center>
                <hr>
                </body>
                </html>';
                    $result=mail($to,$subject,$message,$headers);               
            }























    //////////////////////////////////////////////////////////////////////PARENT/////////////////////////////////////////////////////////////////////////////



    //FONCTION POUR OBTENIR LE MOT DE PASSE D'UN UTILISATEUR
    /*function get_password($nom,$post_nom,$prenom){

    }*/

        //FONCTION QUI ENVOI AU PARENT SES COORDONNEES LORS DE LA CREATION DE SON COMPTE
        function send_parent_mail($fromMail,$to,$name,$addresse,$password){
            $message='';
            $subject="CREATION COMPTE";
            $headers = "MIME-Version: 1.0"."\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8"."\r\n";
            $headers .= 'From: Omarkayumba12345@gmail.com'."\r\n". 'Reply-to: Omarkayumbzsdqdq@gmail.com'."\r\n".'X-Mailer:PHP/'.phpversion();
            $message='<!doctype html>
            <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="ie-edge">
                <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
                <title>Document</title>
            </head>
            <body style="font-family:roboto;font-weight:700;">
            <hr>
            <center>
            <strong>Cher(e) Parents(e) '.$name.'</strong> <br>
                
            <h5>INFORMATIONS DU COMPTE</h5> 
            <h5>Addresse Mail de Connexion : <strong>'.$addresse.'</strong> </h5>
            
            <h5> Nouveau Mot de passe: <strong>'.$password.'</strong> </h5>
            
            <br>
            <a href="monsite" style="text-decoration:none;background-color:#7460ee;padding:10px 10px;border:none;border-raidus:150px;color:white;font-size:16px;">Me connecter</a> <br>
             <h6>En vérifiant votre adresse e-mail ou en vous connectant au site Web, <br> vous confirmez avoir accepté et compris <br>
              les spécificités du système</h6>
              <h6><i>Nous vous demandons de regulièrement vérifier votre boîte mail, afin de recevoir toutes les informations concernant votre enfant</i></h6>
            </center>
            <hr>
            </body>
            </html>';
                $result=mail($to,$subject,$message,$headers);               
        }
    
///////////////////////////////////////////////////////////////////////////MATIERE////////////////////////////////////////////////
        function get_matiere_by_id($connect,$id,$session){
            $query=$connect->prepare("SELECT * FROM matiere WHERE id_classe = ? AND id_ecole=?");
            $output='';

            $query->execute(array($id,$session));
            $fetch_matiere=$query->fetchAll();

            foreach($fetch_matiere as $row){
                $output .='<option value="'.$row['id_matiere'].'">'.$row['nom_matiere'].'</option>';
            }
            $output.='<option value="0"></option>';
            return $output;
        }

?>
