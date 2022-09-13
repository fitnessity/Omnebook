@extends('layouts.app')
<style>
.help-desk input {
    color: black;
}
.help-desk h1 {
    font-size: 40px !important;
    font-family: 'bebasregular';
    text-align: center;
    word-spacing: 12px;
    margin-top: -50px !important;
    margin-bottom: 20px !important;
}
</style>
@push('header_script')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endpush
<style>
  .help-desk p {
    font-size: 18px;
    padding: 20px !important;
    background: #fff !important;
    border-radius: 3px;
    text-align: justify !important;
    box-shadow: 0 0 20px #ddd;
}
  .help-desk {
    float: left;
    background: #e7e7e785 !important;
    width: 100%;
    min-height: 633px;
    color: #696969 !important;
    padding-top: 5%;
    padding-bottom: 5%;
}
.help{
  margin-bottom: 31px;
}
</style>
@section('content')
<div class="help-desk">
<!-- <input type="text" name="" id="help" list="qa" class="help" placeholder="How do we help ?" /> -->
<datalist id="qa"> </datalist>
	<div class="container">


  
		<h1>{{$data[0]->qustion}}</h1>
  
 
	<p>{!! $data[0]->answer !!}</p>

	</div>
</div>
               
              
  

@endsection
@push('footer-scripts')
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$(function(){
  var cache = {};
    $('#help').autocomplete({
      minLength: 2,
      source: function( request, response ) {
        var term = request.term;
        if ( term in cache ) {
          response( cache[ term ] );
          return;
        }
        $.getJSON( "{{ route('q') }}", request, function( data, status, xhr ) {
          cache[ term ] = data;
          response( data );
        });
      },
      select: function(event, ui) {   
                location.href="/help-dask/" + ui.item.id;
            }
    });
})
</script>
@endpush