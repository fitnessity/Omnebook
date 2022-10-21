<div class="navbar1">
    <div class="row businessprofile-navigationlink">
        <div>SET UP</div>
        <a href="{{route('business-welcome')}}" class="businesslink @if(request()->route()->uri=='business-welcome') active @endif"><div class="navlink1" id="tab1">Welcome</div></a> 
        <a href="/manage/service/{{$bsdata->cid}}" class=""><div class="navlink1" id="tab1">Manage Service Section</div></a>
    </div>
</div>