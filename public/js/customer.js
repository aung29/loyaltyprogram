

let currentId;

$(window).on('load', function(){
    
    console.log(currentId);
    let message = $('#error').text();
    if( message == "The card is already registered!"){
        window.alert(message);
    }
});

$(document).ready(function () {

    $('.history').click(function(){
        $('.history').addClass('active');
        $('.new').removeClass('active');

        $('.historytable').addClass('open');
        $('.historytable').removeClass('close');

        // $('').focus();
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

  
    $('.rotate').click(function(){
        location.reload();
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
                url : "searchCustomerCard",
                data: searchName,
                dataType: "json",
                beforeSend: function(){
                        $('.confirmdata').hide();
                        $('.confirmdata').empty();
                      
                },  
                success:function(data){
                    // console.log(data[0].amount.toString());
                    console.log(data);
                    // console.log(data.responseJSON.errors);
                    $('.confirmdata').show();
                    $('.confirmdata').append(`
                                <tr class="blank_row">
                                <td class="norow" colspan="8"></td>
                                </tr>
                                `);
                    let count = 1;
                    if(data.length >0 ){
                        for (const list of data) {
                        
                                $('.confirmdata').append(`
                               
                              
                                <tr>
                                <td class='text-center'>${count}</td>
                                <td>${list.customer_name}</td>
                                <td>${list.card_id}</td>
                                <td>${list.phone}</td>
                                <td>${list.dob}</td>
                                <td>${list.address}</td>
                                <td class="text-center"><a href="customer/${list.id}"><button
                                class="btn btn-outline-light edit" ><i class="bi bi-arrow-right"></i>Detail</button></a></td>
                                  <td class="text-center">  <button class="btn btn-outline-danger">
                                            Reset
                                       </button></td>
                                </tr>
                                `)
                                count++
                        }
                        $('.cards').text(data.length);
                        $('.links').empty();
                    }else{

                        $('.confirmdata').append(`
                        <tr class="blank_row">
                        <td class="norow text-center" colspan="7">There is no card in this table</td>
                        </tr>`);
                        $('.cards').text('0');
                        $('.links').hide();
                    }

                  

                 

                },
                error: function(err){
                    console.log(err);
                }
        });
        }
        });


        $('#username').change(function(e){
            e.preventDefault();
         
   
            $.ajaxSetup({
               headers: {
                   "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                       "content"
                   ),
               },
           })

           if($('#username').val() == 0){
                location.reload();
           }else{

            let formdata = {cusname : $('#username').val()};
       
   
            $.ajax({
                type: "POST",
                url: "changeCustomer",
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
                                <td class="norow" colspan="8"></td>
                                </tr>
                                `);
                    let count = 1;
                    if(data.length >0 ){
                        for (const list of data) {
                        
                           
                                $('.confirmdata').append(`
                               
                                <tr>
                                 <td class='text-center'>${count}</td>
                                 <td>${list.customer_name}</td>
                                 <td>${list.card_id}</td>
                                 <td>${list.phone}</td>
                                 <td>${list.dob}</td>
                                 <td>${list.address}</td>
                                 <td class="text-center"><a href="customer/${list.id}"><button
                                 class="btn btn-outline-light edit" ><i class="bi bi-arrow-right"></i>Detail</button></a></td>
                                 <td class="text-center">  <button class="btn btn-outline-danger">
                                 Reset
                            </button></td>
                                 </tr>
                                `)
                                count++
                        }
                        $('.cards').text(data.length);
                        $('.links').empty();
                    }else{
    
                        $('.confirmdata').append(`
                        <tr class="blank_row">
                        <td class="norow text-center" colspan="7">There is no customer!</td>
                        </tr>`);
                        $('.cards').text(data.length);
                        $('.links').hide();
                    }
    
                },
                error:function(err){
                    console.log(err);
                }
    
            });
           }
   
         
   
        })



        $('#reference').change(function(e){
            e.preventDefault();
  
            $.ajaxSetup({
              headers: {
                  "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                      "content"
                  ),
              },
          })

          if($('#reference').val() == 0){
                location.reload();
          }else{
            let formdata = {id : $('#reference').val()};
          console.log(formdata);
  
          $.ajax({
              type: "POST",
              url: "changeReference",
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
                              <td class="norow" colspan="8"></td>
                              </tr>
                              `);
                  let count = 1;
                  if(data.length >0 ){
                      for (const list of data) {
                      
                      
                              $('.confirmdata').append(`
                             
                              <tr>
                              <td>${count}</td>
                              <td>${list.customer_name}</td>
                              <td>${list.card_id}</td>
                              <td>${list.phone}</td>
                              <td>${list.dob}</td>
                              <td>${list.address}</td>
                              <td class="text-center"><a href="customer/${list.id}"><button
                              class="btn btn-outline-light edit" ><i class="bi bi-arrow-right"></i>Detail</button></a></td>
                              <td class="text-center">  <button class="btn btn-outline-danger">
                              Reset
                         </button></td>
                              </tr>
                              `)
                              count++
                      }
                      $('.cards').text(data.length);
                      $('.links').empty();
                  }else{
  
                      $('.confirmdata').append(`
                      <tr class="blank_row">
                  <td class="norow text-center" colspan="7">There is no customer for this membership</td>
                      </tr>`);
                      $('.cards').text('0');
                      $('.links').hide();
                  }
  
              },
              error:function(err){
                  console.log(err);
              }
          })
          }
  
          
            
        })

        $('.resets').click(function(){

            currentId = this.id;
            console.log(currentId);
            
        })


        $('.btnNo').click(function(){

            currentId = 0;
            console.log(currentId);
        });

        $('.btnYes').click(function(e){
          
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            })

            let formdata = {
                id : currentId
            }
            console.log(formdata);
            $.ajax({
                type: "POST",
                url: "reset",
                data: formdata,
                dataType: "json",
                success : function(data){
                    console.log(data);
                },
                error : function(data){
                    console.log(data);
                }
            });
        });

});