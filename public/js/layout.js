$(document).ready(function () {


    $('.clickicon').click(function(){

        console.log('hello');
        if($('#sidebar').hasClass('on')){
            $('#sidebar').removeClass('on');
            $('.sides').hide();
            $('#content').addClass('content');
        }else{
            $('#content').removeClass('content');
            $('#sidebar').addClass('on');
            $('.sides').show();
           
        }
       
        
    });

    if($(window).width() < 960){
        console.log('width');
        $('.sides').hide();
        $('#sidebar').removeClass('on');
        $('#content').addClass('content');
    }


    if($(window).width() < 500){
        //  $('ul').hide();
        let count =11;
        for (let index = 4; index <= count; index++) {
          
            $(`ul li:nth-child(${index})`).hide();
        }
    

    }

    $( window ).resize(function() {
        let count =11;
        for (let index = 4; index <= count; index++) {
          
            $(`ul li:nth-child(${index})`).hide();
        }


        if($(window).width() < 960){
            console.log('width');
            $('.sides').hide();
            $('#sidebar').removeClass('on');
            $('#content').addClass('content');
        }else{
            $('.sides').show();
            $('#sidebar').addClass('on');
            $('#content').removeClass('content');


        }

        if($(window).width() > 500){
            //  $('ul').hide();
            let count =11;
            for (let index = 0; index <= count; index++) {
              
                $(`ul li:nth-child(${index})`).show();
            }
        
    
        }
    
      });



});