@extends('layouts.front.main')


@section('content')  

    <!-- CONTENT START -->
    <!-- INNER PAGE BANNER -->
    <div class="wt-bnr-inr-breadcrumb overlay-wraper bg-top-center"  data-stellar-background-ratio="0.5">
        <div class="overlay-main-breadcrumb bg-black opacity-07"></div>
            <div class="container">
                <div class="row y-middle">
                    <div class="col-lg-6 col-sm-12 col-md-12 col-12">
                        <div class="wt-bnr-inr-entry">                    
                            <!-- BREADCRUMB ROW -->                            
                            <div class="p-tb35 wow fadeInUp">
                                <div>
                                    <ul class="wt-breadcrumb breadcrumb-style-2">
                                        <li><a href="{{route('home')}}">{{ GoogleTranslate::trans('Home',\App::getLocale())}}</a></li>
                                        <li>{{ GoogleTranslate::trans('Shop',\App::getLocale())}}  </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- BREADCRUMB ROW END -->                        
                        </div>
					</div>
					<div class="col-lg-6 col-sm-12 col-md-12 col-12">
						<div class="wow fadeInUp">
                         	<a href="#" class="wt-box-wraper btn-half site-button button-lg mmt-25" data-bs-toggle="modal" data-bs-target="#contact_us"><span>{{ GoogleTranslate::trans('Contact us for more information',\App::getLocale())}}</span><em></em></a>
                    	</div>
					</div>
				</div>                 
            </div>
        </div>
    </div>
    <!-- INNER PAGE BANNER END -->

     <!-- SECTION CONTENT START -->

     <div class="section-full p-tb90 square_shape1 square_shape3">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12">
                    <div class="row" id="productsDiv">

                    	@forelse($products as $product)
                           
                            <div class="col-lg-4 col-md-6 col-sm-6 mb-50 md-mb-40">
                                <a href="{{route('shop.show',['id' => $product->id])}}">
                                    <div class="product-list">
                                        <div class="image-product">
                                            <img src="{{url('/products/'.$product->image)}}" alt="RevolutionLean">
                                            <div class="overley">
                                                <a onclick="addToCart('{{$product->id}}')"><i class="fa-solid fa-cart-plus"></i></a>
                                            </div>
                                        </div>
                                        <div class="content-desc text-center">
                                            <h2 class="loop-product-title">{{$product->name}}</h2>
                                            <span class="price">${{$product->price}}</span>
                                        </div>
                                    </div>
                                 </a>
                                <div class="mt-10"> <span id="cartMsg{{$product->id}}" class=""> </span> </div>
                            </div>
                           
                        @empty
                            {{ GoogleTranslate::trans('No Products Available',\App::getLocale())}}
                        @endforelse

                    </div>

                    @if ($products->hasMorePages())
                       <div><a onclick="loadMore('{{request()->id}}')" id="load-more-btn"> {{ GoogleTranslate::trans('Load More',\App::getLocale())}} </a></div>
                    @endif


                    
                </div>
                <!-- SIDE BAR START -->
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <aside  class="side-bar">
                        <!-- SEARCH -->
                        <div class="widget bg-white ">
                            <h4 class="widget-title text-uppercase">{{ GoogleTranslate::trans('Search',\App::getLocale())}} </h4>
                            <div class="search-bx">
                                <form role="search" method="post">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="{{ GoogleTranslate::trans('Search for products',\App::getLocale())}}" autocomplete="off" id="search-product"  name="fname" value="">

                                        <!-- <input name="news-letter" type="text" class="form-control" placeholder="Write your text">
                                        <span class="input-group-btn">
                                            <button type="submit" class="site-button"><i class="fa fa-search"></i></button>
                                        </span> -->
                                    </div>
                                </form>
                            </div>                            
                        </div>  

                        <div class="live-preview-acco">
                            <div class="accordion custom-accordionwithicon accordion-border-box" id="accordionnesting">

                            	@foreach($categories as $i=>$category)

                            		@if(count($category->products()->get()) > 0)
		                                <div class="accordion-item">
		                                    <h2 class="accordion-header" id="accordionnestingExample{{$i}}">
		                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse{{$i}}" aria-expanded="true" aria-controls="accor_nestingExamplecollapse{{$i}}"> {{$category->name}} </button>
		                                    </h2>

		                                    @if(count($category->SubCategory()->limit(2)->get()) > 0)
			                                	<div id="accor_nestingExamplecollapse{{$i}}" class="accordion-collapse collapse" aria-labelledby="accordionnestingExample{{$i}}" data-bs-parent="#accordionnesting">
		                                        <div class="accordion-body">
		                                            <div class="accordion nesting2-accordion custom-accordionwithicon accordion-border-box mt-3" id="accordionnesting2">

		                                            	@foreach($category->SubCategory()->limit(2)->get() as $s=>$sub)
			                                                <div class="accordion-item">
			                                                    <h2 class="accordion-header" id="accordionnesting2Example{{$s}}">
			                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting2Examplecollapse{{$s}}" aria-expanded="false" aria-controls="accor_nesting2Examplecollapse{{$s}}">{{$sub->name}} </button>
			                                                    </h2>
			                                                    <div id="accor_nesting2Examplecollapse{{$s}}" class="accordion-collapse collapse" aria-labelledby="accordionnesting2Example{{$s}}" data-bs-parent="#accordionnesting2">
			                                                        <div class="accordion-body">
			                                                            <div class="inner-links">
			                                                                <ul>
			                                                                	@foreach($sub->products()->limit(4)->get() as $product)
				                                                                    <li><a href="{{route('shop.show',['id' => $product->id])}}" target="_blank">{{$product->name}}</a></li>
				                                                                @endforeach
			                                                                </ul>
			                                                            </div> 
			                                                        </div>
			                                                    </div>
			                                                </div>
			                                            @endforeach 

		                                            </div>
		                                        </div>
		                                    </div>
			                                @else
			                                	<div id="accor_nestingExamplecollapse{{$i}}" class="accordion-collapse collapse show" aria-labelledby="accordionnestingExample{{$i}}" data-bs-parent="#accordionnesting">
			                                        <div class="accordion-body">
			                                            <div class="inner-links">
			                                                <ul>
			                                                	@foreach($category->products()->limit(4)->get() as $product)
			                                                    	<li><a href="{{route('shop.show',['id' => $product->id])}}" target="_blank">{{$product->name}}</a></li>
			                                                   	@endforeach
			                                                </ul>
			                                            </div>                                                        
			                                        </div>
			                                    </div>
			                                @endif
		                                </div>
	                              	@endif
                                @endforeach
                            </div>
                        </div>                         
                    </aside>
                </div>
                <!-- SIDE BAR END -->                            
            </div>   
        </div>
    </div>
    <!-- SECTION CONTENT END -->
     
    <!-- INNER PAGE BANNER -->
    <div class="wt-bnr-inr overlay-wraper bg-top-center" style="background-image:url(/assets/images/banner-10.jpg);">
        <div class="overlay-main bg-black opacity-07"></div>
            <div class="container">
                <div class="wt-bnr-inr-entry">
                    <!-- BREADCRUMB ROW -->                            
                    <div class="p-tb20">
                        <div class="bottom-breadcrumb wow fadeInUp">
                            <label><p> {{ GoogleTranslate::trans("It's a whole new way of doing business that brings success within reach and keeps it there.",\App::getLocale())}}  </p></label>
                        </div>
                    </div>
                    <!-- BREADCRUMB ROW END -->                        
                </div>
            </div>
        </div>
    </div>
    <!-- INNER PAGE BANNER END -->


@endsection

@push('css')
     <link href="{{url('/assets/front/css/jqueryui.css')}}" rel="stylesheet"></link>
@endpush

@push('scripts')
    <script src="{{url('/assets/front/js/jquery-ui.min.js')}}"></script>
    <script type="text/javascript">


        $(document).ready(function () {
            var url = "{{ url('/get-products') }}";
   
            $( "#search-product" ).autocomplete({
                source: url,
                focus: function( event, ui ) {
                    return false;
                },
                select: function( event, ui ) {
                    window.location.href = "/product/"+ui.item.id;
                    return false;
                }
            }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
                var inner_html = '<div class="row "><span class="pl-15">' + item.name + '</span></div>';
                
                return $( "<li></li>" )
                         .data( "item.autocomplete", item )
                         .append(inner_html)
                         .appendTo( ul );
            };
        });


        var loading = false;
         
        function loadMore(id){
            if (loading) {
                return; // Prevent multiple requests while one is still in progress
            }
            
            var currentPage = {{ $products->currentPage() }};
            var lastPage = {{ $products->lastPage() }};

            // Check if there are no more pages left
            if (currentPage >= lastPage) {
                return; // No more pages left, do nothing
            }

            loading = true; // Set loading to true to prevent multiple requests
            var nextPage = currentPage + 1;
            $.ajax({
                url: '/load-more-products/'+id,
                type: 'get',
                data: {
                    page: nextPage
                },
                success: function(response) {
                    $('#productsDiv').append(response);
                },
                complete: function() {
                   loading = false; // Reset loading to false after the request is completed

                    // Update current page
                    currentPage++;

                    // Check again if there are no more pages left
                    if (currentPage >= lastPage) {
                        $('#load-more-btn').hide(); // Hide the "Load More" button
                    }
                }
            });
        }

        function addToCart(id){
            $('#cartMsg'+id).removeClass('font-red font-green');
            $.ajax({
                url: '{{route("checkout.addtocart")}}',
                type: 'POST',
                data: {
                    _token: '{{csrf_token()}}',
                    pid: id,
                },
                success: function(response) {
                    if(response.chkInCart == 1){
                        $('#cartMsg'+id).html('{{ GoogleTranslate::trans("Product already in cart.",\App::getLocale())}}').addClass('font-red');
                    }else{
                        $('#cartMsg'+id).html('{{ GoogleTranslate::trans("Product added succesfully.",\App::getLocale())}}').addClass('font-green');
                    }
                    $('#cart-count').html(response.count);
                }
            });
        }
    </script>
@endpush