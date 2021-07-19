$(function(){
    $('#add_button').click(function(){
/*        $('#formulaire').slideToggle()
        $('#formulaire')[0].reset()
        $('#action').val('send')*/
/*        var largeur=($('#formulaire').height())
        console.log(largeur)*/
/*        $('#Button_Envoi').text('Enregistrer')*/
        if (($( "#formulaire" ).first().is( ":hidden"))&&($('#action').val()!='modifier')) {
            $( "#formulaire" ).slideDown( "slow" );
            $('#formulaire')[0].reset()
            $('#action').val('send')

        }else if(($( "#formulaire" ).first().is( ":visible")) && ($('#action').val()!='modifier')) {
            $('#formulaire').slideUp('slow')
            $('#action').val('send')
        }
        if(($('#formulaire').first().is(":visible"))&&($('#action').val()=='modifier')){
            $('#formulaire').show()
            $('#formulaire')[0].reset()
            $('#action').val('send')
            $('#Button_Envoi').text('Enregistrer')
        }

    })

    //L'administrateur clique sur le button envoyé
    $('#formulaire').on('submit',function(event){
        event.preventDefault();
        var send=true
    //Verification de controle de Saisie
    var nom_directeur=$.trim($('#directeur_name').val())
    var postNom_directeur=$.trim($('#directeur_post_name').val())
    var prenom_directeur=$.trim($('#directeur_surname').val())
    var mail_directeur=$.trim($('#directeur_mail').val())
    var ecole_directeur=$.trim($('#school_director').val())
    if(nom_directeur.length==0){
        $('#erreur_nom_director').attr('class','text-danger')
        send=false
    }else{
        $('#erreur_nom_director').attr('class','text-success')
        send=true
    }
    if(postNom_directeur.length==0){
        $('#erreur_post_nom').attr('class','text-danger')
        send=false
    }else{
        $('#erreur_post_nom').attr('class','text-success')
        send=true
    }
    if(prenom_directeur.length==0){
        $('#erreur_prenom').attr('class','text-danger')
        send=false
    }else{
        $('#erreur_prenom').attr('class','text-success')
        send=true
    }
    if(mail_directeur.length==0){
        $('#erreur_mail').attr('class','text-danger')
        send=false
    }else{
        $('#erreur_mail').attr('class','text-success')
        send=true
    }
    if(send==true){
        $.ajax({
            url:"../includes/admin_page/director_operation.php",
            method:"post",
            dataType:"json",
            data:$("#formulaire").serialize(),
            success:function(data){
                if(data.error==true){
                    $('#erreur_ecole').attr('class','text-danger')
                }
                if(data.error==false){
                    alert(data.action)
                    $('#erreur_post_nom').attr('class','text-success')
                    $('#erreur_prenom').attr('class','text-success')
                    $('#erreur_mail').attr('class','text-success')
                    $('#erreur_ecole').attr('class','text-success')
                    $('#formulaire')[0].reset()
                    
                    dataTable.ajax.reload()
                }
                //dataTable.ajax.reload()
            }
        })
    }
})
//FIN FORMULAIRE AJOUT
//OPERATION AJAX DATATABLES
var dataTable = $('#directeur_fetch').DataTable({
    "processing":true,
    "serverSide":true,
    "order":[],
    "ajax":{
     url:"../includes/admin_page/director_operation.php",
     type:"POST",
     data:{action:'fetch'}
    },
    "columnDefs":[
     {
      "targets":[0,1,2,3,4],
      "orderable":false,
     },
    ],
   });


//MODIFICATION D'UN DIRECTEUR
$(document).on('click','.edit_directeur',function(){
    var identifiant=$(this).attr('id');
    var action='edit_fetch';
    $.ajax({
        url:"../includes/admin_page/director_operation.php",
        method:"post",
        dataType:"json",
        data:{action:action,identifiant:identifiant},
        success:function(data){
            $('#directeur_name').val(data.nom)
            $('#directeur_post_name').val(data.postnom)
            $('#directeur_surname').val(data.prenom)
            $('#directeur_mail').val(data.mail)
//            $('#School_tel').val(data.adresse_connexion)
            $('#school_specific').val(data.id)
            $('#action').val('modifier')
            $('#Button_Envoi').text('Modifier')
            $('#formulaire').slideDown()
        }
    })

})

//SUPPRESSION D'UN DIRECTEUR
$(document).on('click','.delete_directeur',function(){
    var identifiant_supprimer=$(this).attr('id')
    $('#exampleModalCenter').modal('show')

    $('#Annuler').click(function(){
        $('#exampleModalCenter').modal('hide')
    })
    $('#Confirmer').click(function(){

        action='supprimer'
        $.ajax({
            url:"../includes/admin_page/director_operation.php",
            method:"post",
            data:{action:action,identifiant_supprimer:identifiant_supprimer},
            success:function(data){
                dataTable.ajax.reload()
                $('#exampleModalCenter').modal('hide')
            }
        })
    })
})



})



