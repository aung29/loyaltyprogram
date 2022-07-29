$(document).ready(function(){
    $("input:checkbox").on('click', function() {
        console.log('hi');
        var $box = $(this);
        // console.log($(this.checked).val()) ;
        if ($box.is(":checked")) {
         
          var group = "input:checkbox[name='" + $box.attr("name") + "']";
            console.log(group);
          $(group).prop("checked", false);
          $box.prop("checked", true);
        } else {
          $box.prop("checked", false);
        }
      });


      $('.history').click(function(){
        $('.history').addClass('active');
        $('.new').removeClass('active');

        $('.allusers').addClass('open');
        $('.allusers').removeClass('close');

        
        $('.useraccount').addClass('close');
        $('.useraccount').removeClass('open');
    })

    $('.new').click(function(){

        $('.history').removeClass('active');
        $('.new').addClass('active');

        $('.allusers').addClass('close');
        $('.allusers').removeClass('open');
        

        $('.useraccount').addClass('open');
        $('.useraccount').removeClass('close');
    })
});
