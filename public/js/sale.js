$(document).ready(function () {

    $('.history').click(function(){
        $('.history').addClass('active');
        $('.new').removeClass('active');

        $('.historytable').addClass('open');
        $('.historytable').removeClass('close');


        $('.addnew').addClass('close');
        $('.addnew').removeClass('open');
    })

    $('.new').click(function(){

        $('.history').removeClass('active');
        $('.new').addClass('active');

        $('.historytable').addClass('close');
        $('.historytable').removeClass('open');
        

        $('.addnew').addClass('open');
        $('.addnew').removeClass('close');
    })


    $('.cancel').click(function(e){
        e.preventDefault();
        $('.show').hide();
    
    });
    $(document).keypress(
        function(event){
          if (event.which == '13') {
            event.preventDefault();
          }
      });
    $('.type').keypress(function (e) {
        if (e.which == 13) {
        let formdata;
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            })
            if($('#card').val() != ''){
                 formData = {
                    name : $('#name').val(),
                    card : $('#card').val(),
                    invoice : $('#invoice').val(),
                    price : $('#price').val()
               };

               $.ajax({
                type : "POST",
                url : "/confirm",
                data: formData,
                dataType: "json",
                success : function(data){
                    console.log(data);
                    let ks = ' Ks';
                    $('.show').show();
                    for (const list of data.card) {
                            $('#cname').val(data.card[0]['customer_name']);
                            $('#ccard').val(data.card[0]['card_id']);
                            $('#cinvoice').val($('#invoice').val());
                            $('.membership').text(data.card[0]['program_name']);
                            
                    }

                     $('.cprice').text(data.price);
                     let cprice = $('.cprice').text();
                     let res = cprice.concat('',ks);
                     $('.cprice').text(res);
                     $('#cprice').val(data.price);
                   
                    $('.transactiontime').text(data.time);
                  
                    
                

                },
                error : function(err){
                    // console.log(err.responseText);
                    window.alert(err.responseText)
                }
            });
               
            }

          
        }
      });
      $('#reference').change(function(e){
          e.preventDefault();

          $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
        })

        let formdata = {id : $('#reference').val()};
        console.log(formdata);

        $.ajax({
            type: "POST",
            url: "searchReference",
            data: formdata,
            dataType: "json",
            beforeSend: function(){
                $('.confirmdata').hide();
                $('.confirmdata').empty();
              
            },
            success:function(data){
                console.log(data);

                
                $('.confirmdata').show();
                $('.confirmdata').append(`
                            <tr class="blank_row">
                            <td class="norow" colspan="7"></td>
                            </tr>
                            `);
                let count = 1;
                if(data.length >0 ){
                    for (const list of data) {
                    
                        let  stringData = list.amount.toString();
                        let amount = numberWithCommas(stringData);
                            $('.confirmdata').append(`
                           
                            <tr>
                            <td class='text-center'>${count}</td>
                            <td>${list.customer_name}</td>
                            <td>${list.card_id}</td>
                            <td>${list.invoice}</td>
                            <td>${amount}</td>
                            <td>${list.program_name}</td>
                            <td>${list.transaction_date}</td>
                            </tr>
                            `)
                            count++
                    }
                    $('.sale-count').text(data.length);
                    $('.links').empty();
                }else{

                    $('.confirmdata').append(`
                    <tr class="blank_row">
                <td class="norow text-center" colspan="7">There is no customer transaction for this membership</td>
                    </tr>`);
                    $('.sale-count').text('0');
                    $('.links').hide();
                }

            },
            error:function(err){
                console.log(err);
            }
        })
          
      })

     $('#username').change(function(e){
         e.preventDefault();
      

         $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
        })

        let formdata = {cusname : $('#username').val()};
        console.log(formdata);

        $.ajax({
            type: "POST",
            url: "searchCustomer",
            data: formdata,
            dataType: "json",
            beforeSend: function(){
                $('.confirmdata').hide();
                $('.confirmdata').empty();
              
        },  
            success:function(data){
                console.log(data);

                $('.confirmdata').show();
                $('.confirmdata').append(`
                            <tr class="blank_row">
                            <td class="norow" colspan="7"></td>
                            </tr>
                            `);
                let count = 1;
                if(data.length >0 ){
                    for (const list of data) {
                    
                        let  stringData = list.amount.toString();
                        let amount = numberWithCommas(stringData);
                            $('.confirmdata').append(`
                           
                            <tr>
                            <td class='text-center'>${count}</td>
                            <td>${list.customer_name}</td>
                            <td>${list.card_id}</td>
                            <td>${list.invoice}</td>
                            <td>${amount}</td>
                            <td>${list.program_name}</td>
                            <td>${list.transaction_date}</td>
                            </tr>
                            `)
                            count++
                    }
                    $('.sale-count').text(data.length);
                    $('.links').empty();
                }else{

                    $('.confirmdata').append(`
                    <tr class="blank_row">
                    <td class="norow text-center" colspan="7">There is no sale for this customer</td>
                    </tr>`);
                    $('.sale-count').text('0');
                    $('.links').hide();
                }

            },
            error:function(err){
                console.log(err);
            }

        });

     })

     

      $('#search').keyup(function(e){

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
        })
        if($('#search').val() == ""){
            location.reload(true);
        }
        var searchName = {name : $('#search').val()};
        if(e.keyCode == 13)
        {
            $.ajax({
                type : "POST",
                url : "searchCardId",
                data: searchName,
                dataType: "json",
                beforeSend: function(){
                        $('.confirmdata').hide();
                        $('.confirmdata').empty();
                      
                },  
                success:function(data){
                    // console.log(data[0].amount.toString());
                    // console.log(data.responseJSON.errors);
                    $('.confirmdata').show();
                    $('.confirmdata').append(`
                                <tr class="blank_row">
                                <td class="norow" colspan="7"></td>
                                </tr>
                                `);
                    let count = 1;
                    if(data.length >0 ){
                        for (const list of data) {
                        
                            let  stringData = list.amount.toString();
                            let amount = numberWithCommas(stringData);
                                $('.confirmdata').append(`
                               
                                <tr>
                                <td>${count}</td>
                                <td>${list.customer_name}</td>
                                <td>${list.card_id}</td>
                                <td>${list.invoice}</td>
                                <td>${amount}</td>
                                <td>${list.program_name}</td>
                                <td>${list.transaction_date}</td>
                                </tr>
                                `)
                                count++
                        }
                        $('.sale-count').text(data.length);
                        $('.links').empty();
                    }else{

                        $('.confirmdata').append(`
                        <tr class="blank_row">
                        <td class="norow text-center" colspan="7">There is no card in this table</td>
                        </tr>`);
                        $('.sale-count').text('0');
                        $('.links').hide();
                    }

                  

                 

                },
                error: function(err){
                    console.log(err);
                }
        });
        }
       

});
    
     
});

function numberWithCommas(x) {
    return x.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
}