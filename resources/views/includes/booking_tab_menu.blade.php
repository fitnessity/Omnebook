<?php
    $currentPath = explode("/", Request::path());
?>
<div class="business-menu">
    <div class="container">
        @if(Auth::user()->role == "business")
        <ul>
          <li><a href="/mybooking" class="@if($currentPath[0] == 'mybooking' && !isset($currentPath[1])) active-tab @endif">MY BOOKINGS</a></li>
          <li><a href="/booking/myquote" class="@if(isset($currentPath[1]) && $currentPath[1] == 'myquote') active-tab @endif">MY QUOTE</a></li>
          <li><a href="/mybooking/requested" class="@if($currentPath[0] == 'mybooking' && isset($currentPath[1]) && $currentPath[1] == 'requested') active-tab @endif">MY PENDING REQUESTS</a></li>
        </ul>
        @else
        <ul>
          <li><a href="/mybooking" class="@if($currentPath[0] == 'mybooking' && !isset($currentPath[1])) active-tab @endif">MY BOOKINGS</a></li>
          <li><a href="/mybooking/confirmed" class="@if($currentPath[0] == 'mybooking' && isset($currentPath[1]) && $currentPath[1] == 'confirmed') active-tab @endif">BOOKED</a></li>
          <li><a href="/mybooking/requested" class="@if($currentPath[0] == 'mybooking' && isset($currentPath[1]) && $currentPath[1] == 'requested') active-tab @endif">PENDING</a></li>
          <li><a href="/mybooking/rejected" class="@if($currentPath[0] == 'mybooking' && isset($currentPath[1]) && $currentPath[1] == 'rejected') active-tab @endif">REJECTED</a></li>
          <li><a href="/booking/myquote" class="@if(isset($currentPath[1]) && $currentPath[1] == 'myquote') active-tab @endif">VIEW QUOTES</a></li>
        </ul>
        @endif
    </div>
</div>