$(function(){
    $('#add_button').click(function(){
        //    $('#formulaire').slideToggle()
        
        if (($("#formulaire" ).first().is( ":hidden"))&&($('#action').val()!='modifier')) {
            $("#formulaire" ).slideDown( "slow" );
            $('#formulaire')[0].reset()
            $('#action').val('send')
    
        }else if(($("#formulaire" ).first().is( ":visible")) && ($('#action').val()!='modifier')) {
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
    $(document).on('submit','#formulaire',function(event){
        event.preventDefault()
        var send=true
        var nom_student=$('#student_name').val()  
        var postnom_student=$('#student_post_name').val()  
        var prenom_student=$('#student_surname').val()
        var mail_student=$('#student_mail').val()
        var student_classe=$('#school_eleve').val()
        var habit_student=$('#student_habit').val()
        var sexe_student=$('#sexe_eleve').val()
        var date_student=$('#date_eleve').val()
        var pays_student=$('#student_pays').val()
        var image_student=$('#image_eleve').val()
        var extension = image_student.split('.').pop().toLowerCase();
        
        //alert(date_prof)
        if(extension != ''){
            if(jQuery.inArray(extension,['png','jpg','jpeg'])==-1)
            {
                send=false
                image_student.val('')
            }else{

            }
        }else{
            send=true
        }
        if($.trim(nom_student).length==0){
            $('#erreur_nom_student').attr('class','text-danger')
            send=false
        }else{
            $('#erreur_nom_student').attr('class','text-success')
            send=true
        }
        if($.trim(postnom_student).length==0){
            $('#erreur_post_nom').attr('class','text-danger')
            send=false
        }else{
            $('#erreur_post_nom').attr('class','text-success')
            send=true
        }
        if($.trim(prenom_student).length==0){
            $('#erreur_prenom').attr('class','text-danger')
            send=false
        }else{
            $('#erreur_prenom').attr('class','text-success')
            send=true
        }
        if($.trim(habit_student).length==0){
            $('#erreur_habit').attr('class','text-danger')
            send=false
        }else{
            $('#erreur_habit').attr('class','text-success')
            send=true
        }
        
        if($.trim(pays_student).length==0){
            $('#erreur_nationalite').attr('class','text-danger')
            send=false
        }else{
            $('#erreur_nationalite').attr('class','text-success')
            send=true
        }
        
        if(send==true){
            $.ajax({
                url:"../includes/director_page/students/student_operation.php",
                method:'POST',
                data:new FormData(this),
                dataType:"json",
                contentType:false,
                processData:false,
                success:function(data)
                {
                    if(data.error==false){
                        makepush_message("success",data.message,"Ajout")
                    }
                    if(data.update==true){
                        makepush_message("info",data.info,"Mise à jour")
                    }
                 $('#formulaire')[0].reset();
                
                 dataTable.ajax.reload();
                }
            })
        }
        
    })
    var dataTable = $('#student_data').DataTable({
        "processing":true,
        "serverSide":true,
        "order":[],
        "ajax":{
         url:"../includes/director_page/students/student_operation.php",
         type:"POST",
         data:{action:'fetch'}
        },
        "columnDefs":[
         {
          "targets":[0, 3, 4],
          "orderable":false,
         },
        ],
      
       });

       //MODIFICATION D'UN DIRECTEUR
$(document).on('click','.update',function(){
    var identifiant=$(this).attr('id');
    var action='edit_fetch';
    $.ajax({
        url:"../includes/director_page/students/student_operation.php",
        method:"post",
        dataType:"json",
        data:{action:action,identifiant:identifiant},
        success:function(data){

            $('#student_name').val(data.nom)
            $('#student_post_name').val(data.postnom)
            $('#student_surname').val(data.prenom)
            $('#student_mail').val(data.mail)
            $('#student_habit').val(data.addresse)
            $('#date_eleve').val(data.date)
            $('#student_pays').val(data.pays)
            $('#formulaire').slideDown()
//            $('#image_prof').val(data.image)
            $('#eleve_specific').val(data.id)
            $('#action').val('modifier')
            $('#Button_Envoi').text('Modifier')
            
        }
    })

})

//PARTIE SUPPRESSION D'UN ETUDIANT
$(document).on('click','.delete',function(){
    var identifiant_supprimer=$(this).attr('id')
    $('#exampleModalCenter').modal('show')
//    makepush_message("warning","")

    $('#Annuler').click(function(){
        $('#exampleModalCenter').modal('hide')
    })
    $('#Confirmer').click(function(){
        
        action='supprimer'
        $.ajax({
            url:"../includes/director_page/students/student_operation.php",
            method:"post",
          //dataType:"json",
            data:{action:action,identifiant_supprimer:identifiant_supprimer},
            
            success:function(data){
                if(data.delete==true){
                    makepush_message("Error",data.info,"Suppression")   
                }
                dataTable.ajax.reload()
                $('#exampleModalCenter').modal('hide')
            }
        })
    })
})

})