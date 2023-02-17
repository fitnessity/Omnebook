<div class="row"> 
	<div class="col-lg-12">
	   <h4 class="modal-title" style="text-align: center; color: #000; line-height: inherit; font-weight: 600; margin-top: 9px; margin-bottom: 12px;">Autopay Schedule & History</h4>
	</div>
</div>
<div class="row">
<div class="col-md-12">
	<div>
		<label>Auopay Schedule For:</label>
		<span>Eric Santana </span>
	</div>
</div>
<div class="col-md-5">
	<div>
		<label>Contract Details:</label>
		<span>Vma , 6 Months contract (Recurring)</span>
	</div>
</div>
<div class="col-md-7">
	<div class="auto-details-location">
		<label>Location:</label>
		<span>Valor Mixed Martial Arts</span>
		
		<label> Autopay Remaining</label>
		<span>1/16 </span>
		
		<label>Autopay History</label>
		<a> View </a>
	</div>
</div>
<div class="col-md-12">
	<table id="pay-details" class="table table-striped table-bordered" style="width:100%">
		<thead>
			<tr>
				<th> Payment  Date </th>
				<th> Amount </th>
				<th> Tax </th>
				<th>Charged Amount </th>
				<th>Payment Method </th>
				<th> Status </th>
				<th>Check All  | Uncheck All </th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<div class="special-date">
						<input  type="text" class="form-control" id="auto-pay-date-filed" name="frm_passingdate[]" placeholder="" autocomplete="off" value="" data-behavior="datepicker">
						<span class="error" id="b_certificateyear"></span>
					</div>
				</td>
				<td> 
					<div class="auto-amount">
						<label>$</label>
						<input type="text" class="form-control valid" name="frm_programname"  placeholder="150" >
					</div>
				</td>
				<td>$8.95</td>
				<td>$158.95 </td>
				<td> Visa ***4376 </td>
				<td>Completed</td>
				<td><input type="checkbox" id="vehicle1" name="vehicle1" value="Bike"></td>
				<td>
					<button type="submit" class="btn-nxt cancel-modal">Save</button>
				</td>
			</tr>
			
			<tr>
				<td>
					<div class="special-date">
						<input  type="text" class="form-control" id="auto-pay-date" name="frm_passingdate[]" placeholder="" autocomplete="off" value="" data-behavior="datepicker">
						<span class="error" id="b_certificateyear"></span>
					</div>
				</td>
				<td> 
					<div class="auto-amount">
						<label>$</label>
						<input type="text" class="form-control valid" name="frm_programname"  placeholder="150" >
					</div>
				</td>
				<td>$8.95</td>
				<td>$158.95 </td>
				<td> Visa ***4376 </td>
				<td>Scheduled </td>
				<td><input type="checkbox" id="vehicle1" name="vehicle1" value="Bike"></td>
				<td>
					<button type="submit" class="btn-nxt cancel-modal">Save</button>
				</td>
			</tr>
			
		</tbody>
	</table>
</div>
<div class="col-md-12 text-right">
	<button type="submit" class="auto-pay-btns">Delete Checked Items</button> |
	<button type="submit" class="auto-pay-btns">Pay Checked Items</button>							
</div>
</div>