<div class="row y-middle" id="mainRow">
	@forelse($content as $c)
		<div class="row y-middle">
			<div class="col-md-6 mb-10"><lable> {{$c->content}}</lable></div>
			<div class="col-md-6 align-right">
				@if($c->path)
					<a href="{{Storage::URL($c->path)}}" target="_blank" class="mr-10"><i class="fas fa-eye"></i> View </a>
					<a href="{{ route('personal.download', ['id' => $c->id]) }}" target="_blank" ><i class="fas fa-download"></i> Download </a>
				@endif
			</div>
		</div>
	@empty
	@endforelse
	
</div>
