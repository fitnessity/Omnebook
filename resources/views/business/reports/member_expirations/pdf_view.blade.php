<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <style>
		table {
		  border-collapse: collapse;
		  width: 100%;
		}
        th, td {
          border: 1px solid #dddddd;
		  font-size: 12px;
		  padding: 5px;
        }
		.table-card{
			padding: 15px 0;
		}
		.table-card label{
			color: #ed1b24;
			font-size: 14px;
			font-weight: 700;
		}
		.pdf-table table tr th{
			color: #fff;
			background-color: #ea1515;
		}
		.reports-card-header{
			text-align: center;
			margin-bottom: 0px;
			font-size: 17px;
		}
        
</style>
</head>
<body>
	<div class="reports-card-header">
		<h4>Membership Reports</h4>
	</div>
    <div class="card-header align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1" id="headingDate">{{$dates}}</h4>
    </div>
	
	@if(count($expiringMembershipTdy) > 0)
		<div class="table-card">
			<label>Expiring Today</label>
		</div>
		@include('business.reports.member_expirations.pdf_table_data' , ['memberships'=> $expiringMembershipTdy])
	@endif

    @if(count($expiringMembershipThd) > 0)
        <div class="table-card">
			<label>Expiring in 30 days</label>
		</div>
        @include('business.reports.member_expirations.pdf_table_data' , ['memberships'=> $expiringMembershipThd])
    @endif

    @if(count($expiringMembershipNid) > 0)
        <div class="table-card">
			<label> Expiring in 90 days</label>
		</div>
        @include('business.reports.member_expirations.pdf_table_data' , ['memberships'=> $expiringMembershipNid])
    @endif

    @if(count($expiringMembershipAll) > 0)
        <div class="table-card">
			<label> All Expired Members </label>
		</div>
        @include('business.reports.member_expirations.pdf_table_data' , ['memberships'=> $expiringMembershipAll ])
    @endif

</body>
</html>