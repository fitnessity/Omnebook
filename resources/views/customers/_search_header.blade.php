<form action="{{route("business_customer_index", ['business_id' => $company_id])}}">
	<div class="row">
		<div class="col-md-4">
			<a href="#" class="btn-nxt manage-cus-btn" data-toggle="modal" data-target="#newclient">Add New Client</a>
		</div>
		<div class="col-md-5">
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
			<button type="submit" class="btn-nxt search-btn-sp" data-behavior="search_customer">Search</button>
		</div>
	</div>
</form>
@include('customers._add_new_client_modal', ['business_id' => $company_id])

<script>

$(document).on('keyup', '#serchclient', function() {
  $.ajax({
      type: "GET",
      url: "{{route("business_customer_index", ['business_id' => $company_id])}}",
      data: { fname: $(this).val(),  _token: '{{csrf_token()}}', },
      success: function(data) {
        $("#option-box1 .customer-list").html('');
        console.log(data);
        let customer_row = $('<li class="searchclick"><div class="row rowclass-controller"></div></li>');
        $.each(data, function(index, customer){
          let content = customer_row.find('.rowclass-controller');
          let profile_img = '<div class="collapse-img"><div class="company-list-text" style="height: 50px;width: 50px;"><p style="padding: 0;">A</p></div></div>';

          if(customer.profile_pic_url){
            profile_img = '<img src="' + (customer.profile_pic_url ? customer.profile_pic_url : '') + '" style="width: 50px;height: 50">';            
          }
          customer_row.append('<div class="col-md-2">' + profile_img + '</div>');
          customer_row.append('<div class="col-md-10 div-controller"><a style="color: black;" href="/business/' + {{$company_id}} +'/customers/'+ customer.id + '">' + 
              '<p class="pstyle"><label class="liaddress">' + customer.fname + ' ' +  customer.lname  + (customer.age ? ' (52  Years Old)' : '') + '</label></p>' +
              '<p class="pstyle liaddress">' + customer.email +'</p>' + 
              '<p class="pstyle liaddress">' + customer.phone_number + '</p></a></div>');
          
        })

        $("#option-box1 .customer-list").append(customer_row);
        $("#option-box1").show();
      }
  });
});
</script>