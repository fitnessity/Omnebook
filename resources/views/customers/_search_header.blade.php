<form action="{{route("business_customer_index", ['business_id' => $company_id])}}">
	<div class="row">
		<div class="col-md-3">
			<a href="#" class="btn-nxt manage-cus-btn" data-toggle="modal" data-target="#newclient">Add New Client</a>
		</div>
		<div class="col-md-6">
			<div class="manage-search serchcustomer">
				<div class="sub">
					<input type="text" id="serchclient" name="fname" placeholder="Search for client" autocomplete="off" value="{{Request::get('fname')}}">
					<div id="option-box1" style="display:none;">
            <ul class="customer-list">
            </ul>
          </div>
					<button ><i class="fa fa-search"></i></button>
				</div>
			</div>
		</div>

		<div class="col-md-3">
			<button  id="serchbtn" type="submit" class="btn-nxt search-btn-sp" data-behavior="search_customer">Search</button>
		</div>
	</div>
</form>

<script>

$(document).on('keyup', '#serchclient', function() {
  $.ajax({
      type: "GET",
      url: "{{route("business_customer_index", ['business_id' => $company_id])}}",
      data: { fname: $(this).val(),  _token: '{{csrf_token()}}', },
      beforeSend: function() {
          //$("#label").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
      },
      success: function(data) {
        
        console.log(data);
        let customer_row = $('<li class="searchclick"><div class="row rowclass-controller"></div></li>');
        $.each(data, function(index, customer){
          let content = customer_row.find('.rowclass-controller');
          customer_row.append('<div class="col-md-2"><img src="http://lvh.me:8080//customers/images/1629330153-gymnastics.jpg"></div>');
          customer_row.append('<div class="col-md-10 div-controller">' + 
              '<p class="pstyle"><label class="liaddress">' + customer.fname + ' ' +  customer.lname  + (customer.age ? ' (52  Years Old)' : '') + '</label></p>' +
              '<p class="pstyle liaddress">' + customer.email +'</p>' + 
              '<p class="pstyle liaddress">' + customer.phone_number + '</p></div>');
          
          console.log(customer);
        })

        $("#option-box1 .customer-list").append(customer_row);
        $("#option-box1").show();

        // <li class="searchclick">
        //   <div class="row rowclass-controller">
        //       <div class="col-md-2"><img src="http://lvh.me:8080//customers/images/1629330153-gymnastics.jpg"></div>
        //       <div class="col-md-10 div-controller">
        //           <p class="pstyle">  <label class="liaddress">(52  Years Old)<label></label></label></p>
        //           <p class="pstyle liaddress">demo@yopmail.com</p>
        //           <p class="pstyle liaddress">5456465465</p>
        //       </div>
        //       <input type="hidden" name="cid" id="cid" value="492">
        //   </div>
        // </li>

          // 
          // $("#option-box1").html(data);
          // $("#serchclient").css("background", "#FFF");
      }
  });
});

// function searchclick(cid){
//     $url = '{{env("APP_URL")}}';
//     //window.location.href = "viewcustomer/"+cid;
//      window.open($url + "viewcustomer/"+cid, "_blank");
// }
</script>