<div class="row">
	<div class="col-lg-12">
    	<h4 class="modal-title mt-15 mb-25 partcipate-model text-center"> Products</h4>
	</div>
	<div class="row">
		<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 col-12">
			<div class="search-box">
				<label>Search Products </label>
				<input type="text" id="proName" name="proName" class="form-control productName" placeholder="Search by Product" data-id="" value="" chk="{{$chk}}">
				<i class="ri-search-line search-icon custom-search-icon"></i>
			</div>
		</div>
		<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 col-12">
			<div class="select0service category-search mb-15">
				<label>Search By Category </label>
				<select id="category" class="form-select">
					<option value="">Search By All Category</option>
					@foreach($productCategory as $c)
						<option value="{{$c->id}}">{{$c->name}}</option>
					@endforeach
				</select>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 col-12"></div>
		<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 col-12" id="categoryProduct">
			
		</div>
	</div>

	<div id="productDetails"> 
		{!! $productData !!}
	</div>
</div>

<script>
	var business_id = "{{$business_id}}"
	$(document).ready(function () {
	 	$("#proName").keyup( function() {
	    	var proUrl = '/business/'+ business_id +'/products?categoryId='	+ $('#category').val();
	    	
	    	$("#proName").autocomplete({
		    	source: proUrl,
		  		focus: function( event, ui ) {
		  			return false;
		    	},
		    	select: function( event, ui ) {
		    		$("#proName").attr('data-id',ui.item.id);
		    		getProduct(ui.item.id,business_id,$("#proName").attr('chk'));
		        }
			}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
				
		        var inner_html = '<div class="row rowclass-controller"></div><div class="row"><div class="col-md-12 div-controller">' + 
		                  '<p class="pstyle"><label class="liaddress">' + item.name + '</label></p></div></div>';
		       
		        return $( "<li></li>" )
		                .data( "item.autocomplete", item )
		                .append(inner_html)
		                .appendTo( ul );
		    };
		});

		$('#category').change(function(e){
			$.ajax({
				url: '{{route("business.get-category-product")}}',
				type: 'get',
				data:  {
					'id': this.value,
					'chk': '{{$chk}}',
					'business_id': business_id,
				},
				success:function(data){
					if(data){
						$('#categoryProduct').html(data);
					}
				}
			});
		});
	});
</script>
