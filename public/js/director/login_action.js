$(function(){
    $('#director_login_form').on('submit',function(event){
        event.preventDefault()
        var send=true
        var mail=$('#director_emailid').val()
        var password=$('#director_password').val()
        if($.trim(mail).length==0){
            $('#error_director_emailid').text('Veuillez écrire quelque chose')
            send=false
        }else{
            $('#error_director_emailid').text('')
            send=true
        }
        if($.trim(password).length==0){ 
            $('#error_director_password').text('Veuillez écrire quelque chose')
            send=false
        }else{
            $('#error_director_password').text('')        
            send=true
        }
    if(send==true){
        $.ajax({
            url:'../includes/director_page/login_director_action.php',
            method:"post",
            dataType:"json",
            data:$(this).serialize(),
            success:function(data){
                if(data.type=='username'){
                    $('#error_director_emailid').text(data.error_directeur_mail)
                }
                if(data.type='password'){
                    $('#error_director_password').text(data.error_directeur_password)
                }
                if(data.error==false){
                    location.href='index.php';
                }
            }
        })
    }
    
    })


})