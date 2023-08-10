$(document).ready(function () {

    $('.rotate').click(function(){
        location.reload();
    })


    $('.btnYes').click(function(){
         
       
        // console.log($('#cusname').val());
        let name = $('#cusname').val();
        let address = $('#cusadd').val();
        let phone = $('#cusphone').val();
        let id = $('#cusid').text();
          let   formData = {
                 cardid : id,
                 name : name,
                 address : address,
                 phone : phone
            }
            // console.log(formData);
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            })
           
             $.ajax({
                type : "POST",
                url : "/editform",
                data : {
                    cardid : id,
                    name : name,
                    address : address,
                    phone : phone
                },
                dataType : "json",
                success : function(data){
                    // console.log(data);
                    window.alert(data.responseText);
                },
                error : function(err){
               
                    window.alert(err.responseText);
                    // console.log(err);
                }
             }) 
           

          
        
        
        })
    if($(window).width() < 960){
        console.log('width');
        $('.pre').before('<br>');
       
    }else{

    }
});