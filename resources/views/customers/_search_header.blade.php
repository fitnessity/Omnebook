<form action="{{route("business_customer_index", ['business_id' => $company_id])}}">
  <input type="hidden" name="customer_id" id="customer-id" value="">
	<div class="row">
		<div class="col-md-4">
			<a href="#" class="btn-nxt manage-cus-btn" data-toggle="modal" data-target="#newclient">Add New Client</a>
		</div>
		<div class="col-md-5">
			<div class="manage-search serchcustomer">
				<div class="sub">
					<input type="text" id="serchclient" name="fname" placeholder="Search for client" autocomplete="off" value="{{Request::get('fname')}}" >
					<!-- <div id="option-box1" style="display:none;">
              <ul class="customer-list">
              </ul>
          </div> -->
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

<script type="text/javascript">
    $(document).ready(function () {
        var business_id = '{{$company_id}}';
        var url = "{{ url('/business/business_id/customers') }}";
        url = url.replace('business_id', business_id);

        $( "#serchclient" ).autocomplete({
            source: url,
            focus: function( event, ui ) {
                 return false;
            },
            select: function( event, ui ) {
                $("#serchclient").val( ui.item.fname + ' ' +  ui.item.lname);
                $('#customer-id').val( ui.item.id);
                 return false;
            }
        }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
            let profile_img = '<div class="collapse-img"><div class="company-list-text" style="height: 50px;width: 50px;"><p style="padding: 0;">A</p></div></div>';

            if(item.profile_pic_url){
                profile_img = '<img class="searchbox-img" src="' + (item.profile_pic_url ? item.profile_pic_url : '') + '" style="">';            
            }

            var inner_html = '<div class="row rowclass-controller"></div><div class="col-md-3 nopadding text-center">' + profile_img + '</div><div class="col-md-9 div-controller">' + 
                      '<p class="pstyle"><label class="liaddress">' + item.fname + ' ' +  item.lname  + (item.age ? ' (' + item.age+ '  Years Old)' : '') + '</label></p>' +
                      '<p class="pstyle liaddress">' + item.email +'</p>' + 
                      '<p class="pstyle liaddress">' + item.phone_number + '</p></div>';
           
            return $( "<li></li>" )
                    .data( "item.autocomplete", item )
                    .append(inner_html)
                    .appendTo( ul );
        };
      });
</script>

<script>
    $(document).on('click', 'body', function(){
        $("#option-box1 .customer-list").html('');
        $("#option-box1").hide();
    })
</script>