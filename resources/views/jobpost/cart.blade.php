<div id="tbcrt">
<?php if(!empty($items)){ ?>
<table class="table">
    <thead>
      <tr>
        <th>Service Choice</th>
        <th>Date Time</th>
        
        <th>Persons</th>
        <th>Due Tax - Sale Tax</th>
        <th>Price + Tax + Days</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
    <?php $total =0 ?>
    @foreach ($items as $record)
    
        <tr>
        <td>{{$record['sport']}}</td>
        
        <td style="width: 260px;">
        <?php $times = json_decode($record->time['schedule'],true);
        $bookdays = @count(@$times);
        if(!empty($times)){
            //echo $times;
    foreach($times as $k=>$v){
     //  echo count($times);
     $g = str_replace("_"," ",$v);
     //echo (str_replace("_"," ",$v));
     echo (DateTime::createFromFormat('Y-m-d H:i a', $g)->format('m-d-Y H:i A'));
      //echo nl2br(str_replace("_"," ",$v)."\r\n");
    }
            
        }else{
      echo  'Please add time slot';
    }
    ?></td>
        <td style="width: 170px;">{{$record['numberofpersons']}}</td>
        <td style="width: 260px;">Due Tax {{($record['duestaxpercentage']=='')?0:$record['duestaxpercentage']}} % <br> Sale Tax {{($record['salestaxpercentage']=='')?0:$record['salestaxpercentage']}} % <br><br> Total Tax= {{$record['duestaxpercentage']+$record['salestaxpercentage']}} </td>
        <td>${{$record['price']}} x {{$record['numberofpersons']}} x {{$bookdays}} = 
        {{($record['price']*$record['numberofpersons']*$bookdays)+(($record['price']*$record['numberofpersons']*$bookdays)*($record['duestaxpercentage']+$record['salestaxpercentage'])/100) }}</td>
       <td>
          <!--<a href="javascript:void(0)"><div class="step1_days editcart" id="{{$record['id']}}"  bookid="{{$record['booking_id']}}" style="text-align: center;padding: 8px 4px;"><i class='fas fa-pencil-alt' style="color: #fff"></i></div></a>-->
       
          <a href="javascript:void(0)"><div class="step1_days deletethis" id="{{$record['id']}}" bookid="{{$record['booking_id']}}" style="text-al/100  ign: center;padding: 8px 4px;"><i class='far fa-trash-alt' style="color: #fff"></i></div></a>
        </td>
      </tr>
      <?php $total += ($record['price']*$record['numberofpersons']*$bookdays)+(($record['price']*$record['numberofpersons']*$bookdays)*($record['duestaxpercentage']+$record['salestaxpercentage'])/100) ; ?>
    @endforeach      
      <tr>
        <td><b>Total:</b></td>
        <td></td>
        <td></td>
        <td></td>
        <td><b>$ {{$total}}</b></td>
        <td></td>
      </tr>
    </tbody>
  </table>
<?php }else{
  echo  "No data found";
} ?>
</div>
   <script>
    $(document).ready(function()
    { 

            $('.editcart').click(function(){
        var b = $(this).attr('id');
        var t = $(this).attr('bookid');
        var u = $('#bsnid').val();
        $.ajax({
          url:'/editcart/'+t+'/'+b+'/'+u,
          type:'GET',
          beforeSend: function () {
             $('.loader').show();
           },
           complete: function () {
             $('.loader').hide();
           },
          success: function (response) {
            $('.cartedit').html(response).show();
          }
        });

            });


      $('.deletethis').click(function(){
        var t = $(this).attr('id');
        var b = $(this).attr('bookid');
      $.ajax({
          url:'/deletecart/'+t+'/'+b,
          type:'GET',
          beforeSend: function () {
             $('.loader').show();
           },
           complete: function () {
             $('.loader').hide();
           },
          success: function (response) {
                 if(response.status==1){
                    
   $.ajax({
          url:'/cart',
          type:'GET',
          beforeSend: function () {
             $('.loader').show();
           },
           complete: function () {
             $('.loader').hide();
           },
          success: function (response) {
               $('#tbcrt').html(response);
            }
        });

                 }else{
                  
                 }
            }
        });

      });
    });