


$(document).ready(function () {



  
let data2 = [0,0,0,0];

datainput(data2);
chart(data2);

  $('#shop').change(function(){

    $.ajaxSetup({
      headers: {
          "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
              "content"
          ),
      },
  });

  let formdata = { 'data' : $('#shop').val()};

  $.ajax({
    type: "POST",
    url: "searchAnalytics",
    data: formdata,
    dataType: "json",
    beforeSend:function(){
      
    },
    success: function(data){
              
      $('#male').text(0);
      $('#female').text(0);
      $('.num').hide(400);
      $('.active').hide(400);
      $('.left').hide(400);
      $('.gpmember').remove();
      $('.tabledata').remove();
      // $('.blank_row').remove();
      console.log(data);
      
      let active = 0;
      if(data['reg'].length ==  0 ){
        console.log('hello');
        $('#male').text(0);
        $('#female').text(0);
      }
      for (const item of data['reg']) {
       
      
          console.log(item);
          if(item['gender'] == "male"){
            $("#male").text(item['qty']);
          }

          if(item['gender'] == 'female'){
            console.log('hello1');
            $('#female').text(item['qty']);
          }

          active += item['qty'];
          
      }

       
        

      for (const item of data['member']) {
       
      
        $('.collect').append(`
        <div class="col-md-3 col-sm-6 blog gpmember">
        <p class="reg">${ item['pgname'] }</p>
        <span class="num">${item['counts']}</span><span class="user"><i class="fa-solid fa-user us"></i></span>
       </div>`)
       
 
        
    }
    let count = 1;
    for (const item of data['purchased']) {
     

      $('.purchased').append(`
     
        
      <tr class="tabledata">
      <td>${count}</td>
      <td>${item['customer_name']}</td>
      <td>${item['card_id'] }</td>
      <td>${item['phone'] }</td>
      <td>${item['dob']}</td>
      <td>${item['address']}</td>
      </tr>

      `)

   
      count++;

    }

        let reg = 100 - active;
        console.log(reg);




      $('.num').show(400);
      $('.active').show(400);
      $('.left').show(400);
      $('.active').text(active);
      $('.left').text(reg);
      


          
    },
    error: function(err){
        console.log(err);
    }
    });
  })
  $('#cal').change(function(){
      console.log($('#cal').val());


      $.ajaxSetup({
          headers: {
              "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                  "content"
              ),
          },
      })

      let formdata = { 'date' : $('#cal').val()};
      console.log(formdata);
      $.ajax({
          type: "POST",
          url: "searchDaily",
          data: formdata,
          dataType: "json",
          beforeSend:function(){
            $('.card-body').empty();
            
          },
          success: function(data){
            $('.card-body').append('<canvas id="mylinechart"></canvas>') ;         
          
              data2 = [0,0,0,0];
              

                for (const item of data) {
       

                  if(item['shop_name'] == "Parami Pizza"){
                    data2[0] = item['total'];
                  }
                  if(item['shop_name'] == "Gekko"){
                    data2[1] = item['total'];
                  }
          
                  if(item['shop_name'] == "Bar Boon"){
                    data2[2] = item['total'];
                  }
          
                  if(item['shop_name'] == "Union"){
                    data2[3] = item['total'];
                  }
                }
               
                chart(data2);
                
          },
          error: function(err){
              console.log(err);
          }
      });
  })


});



   function chart(data2){

    const ctx = document.getElementById('mylinechart').getContext('2d');
    
    
  let label = ['Parami Pizza', 'Gekko' ,'Union' , "Bar Goon"];
const data = {
    labels: label,
    datasets: [{
        label: 'Daily Income',
      data: data2,
      backgroundColor: [
        'rgba(115, 135, 249, 1)',
        'rgba(115, 135, 249, 1)',
        'rgba(115, 135, 249, 1)',
        'rgba(115, 135, 249, 1)',
      ],
      borderColor: [
        'rgba(115, 135, 249, 1)',
        'rgba(115, 135, 249, 1)',
        'rgba(115, 135, 249, 1)',
        'rgba(115, 135, 249, 1)',
      ],
    tension : 0.5,
    barPercentage: 0.5,
    barThickness: 110,
    maxBarThickness: 120,
    minBarLength: 2,
    borderWidth: 0.5
    }],
   
  };


const config = {
    type: 'bar',
    data: data,
    plotOptions: {
        bar: {
            borderWidth: 0
        }
      
  },
//   plugins : [legendMargin]

  };

  const myChart = new Chart(ctx,config);
  
    
  }


  function datainput(data2){

    for (const result of saleDaily) {
       

      if(result['shop_name'] == "Parami Pizza"){
        data2[0] = result['total'];
      }
      if(result['shop_name'] == "Gekko"){
        data2[1] = result['total'];
      }

      if(result['shop_name'] == "Bar Boon"){
        data2[2] = result['total'];
      }

      if(result['shop_name'] == "Union"){
        data2[3] = result['total'];
      }
    }
  }