<div id="mainRow">
	@forelse($content as $i=>$c)
		<div class="row border-bottom-grey">
			<div class="col-md-4 col-sm-5 col-12"><label class="mb-10 mt-10">{{$i+1}}. {{$c->content}}</label></div>
			<div class="col-md-4 col-sm-4 col-6 align-right mt-10 mmb-10">
				@if($c->path)
					<a href="{{Storage::URL($c->path)}}" target="_blank" class="mr-10"><i class="fas fa-eye"></i> View </a>
					<a href="{{ route('personal.download', ['id' => $c->id]) }}" target="_blank" ><i class="fas fa-download"></i> Download </a>
				@endif	
			</div>
			<div class="col-md-4 col-sm-3 col-6 align-right mt-10">
				@if($c->path)
					<span class="font-green">Document Uploaded</span>
				@else
					<span class="font-red">Document Not Uploaded</span>
				@endif
			</div>
		</div>
	@empty
	@endforelse
	
</div>
