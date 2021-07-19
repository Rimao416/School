function myChildren(event){
    /*
    var salle=document.getElementById('parent_eleve').value;
    alert(salle)*/
    var salle=$('#parent_eleve').val()
    
    if($("#parent_eleve").val()!='NULL'){
        if(!($("#student_div").length)){
            $.ajax({
                url:"../includes/director_page/parent/parent_action.php",
                method:'POST',
                data:{salle:salle},
                success:function(data){
                    $('#next').append('<div id="student_div">fsdfsdf</div>')
                    
                    $('#student_div').html(data)   
                }
            })                    
    }
    }else if($('#student_div').length && ($('#parent_eleve').val()=='NULL')){
        $('#student_div').remove()
    }

    }

$(function(){
    $('#add_button').click(function(){
        $('#formulaire').slideToggle()
        
    })
//    $('#next').append('<br> <select class="form-select" aria-label="Activation select" name="school_eleve" id="school_eleve"><option value="NULL">---Choisissez la salle de votre élève---</option></select>')

$(document).on('submit','#formulaire',function(event){
    event.preventDefault()
    var send=true
    var nom_parent=$('#parent_name').val()  
    var postnom_parent=$('#parent_post_name').val()  
    var prenom_parent=$('#parent_surname').val()
    var mail_parent=$('#parent_mail').val()
    var tel_parent=$('#parent_tel').val()
    if(!($('#student_div').length)){
        var id_etudiant='';
    }else{
        var id_etudiant=$('#list_eleve').val()
    }
    if($.trim(nom_parent).length==0){
        $('#erreur_nom_parent').attr('class','text-danger')
        var send=false
    }else{
        $('#erreur_nom_parent').attr('class','text-success')
        var send=true
    }
    if($.trim(postnom_parent).length==0){
        $('#erreur_post_nom').attr('class','text-danger')
        var send=false
    }else{
        $('#erreur_post_nom').attr('class','text-success')
        var send=true

    }
    if($.trim(prenom_parent).length==0){
        $('#erreur_prenom').attr('class','text-danger')
        var send=false
    }else{
        $('#erreur_prenom').attr('class','text-success')
        var send=true
    }
    if($('#parent_eleve').val()=='NULL'){
        $('#erreur_eleve').attr('class','text-danger')
        var send=false
    }else{
        var send=true
        $('#erreur_eleve').attr('class','text-success')
    }
    //var atLeastOneIsChecked = $('input[name="chk[]"]:checked').length > 0;
/*    if(send==true){
        $.ajax({

        })
    }*/
    if($('#validation').is(':checked') && ($.trim(mail_parent).length==0)){
        $('#message_valid').attr('class','text-danger')
        $('#message_valid').text('Vous devez mettre une addresse mail, ou désactiver la case à cocher')
        send=false
        setTimeout(function(){ 
            $('#message_valid').attr('class','text-muted')
            $('#message_valid').text('J\'accepte de recevoir toutes les informations concernant mon enfant')
            
        }, 3000);
    }else if($('#validation').is(':checked')&&($.trim(mail_parent).length > 0)){
        send=true
    }else if(!($('#validation').is(':checked'))&& ($.trim(mail_parent).length==0)){
        send=true
    }else if($.trim(mail_parent).length > 0 && (!($('#validation').is(':checked')))){
        $('#message_valid').attr('class','text-danger')
        $('#message_valid').text('Vous devez cocher  la case, ou ne pas mettre une adresse')
        send=false
        setTimeout(function(){ 
            $('#message_valid').attr('class','text-muted')
            $('#message_valid').text('J\'accepte de recevoir toutes les informations concernant mon enfant')
            
        }, 3000);
    }

    if(send==true){
        $.ajax({
            url:'../includes/director_page/parent/parent_action.php',
            method:"post",
            data:$(this).serialize(),
            success:function(data){
                alert(data)
                dataTable.ajax.reload()
            }
        })
    }



    })
    //FIN FORMULAIRE 
    //DEBUT CHARGEMENT DES ETUDIANTS
    var dataTable = $('#parent_data').DataTable({
        "processing":true,
        "serverSide":true,
        "order":[],
        "ajax":{
         url:"../includes/director_page/parent/parent_action.php",
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


})