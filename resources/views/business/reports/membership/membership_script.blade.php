<script>

   flatpickr(".flatpickr-range", {
   	altInput: true,
   	altFormat: "m/d/Y",
     	dateFormat: "Y-m-d",
     	maxDate: "2050-01-01"
	});

	$(document).on('click', '[data-behavior~=on_change_submit]', function(e){
		e.preventDefault()
		$(this).parents('form').submit();
	});

	$(document).on('change', '[data-behavior~=on_change_submit]', function(e){
		$('#filterOptionsvalue').val(this.value);
		$('#generateReport').click();
	});

	function exportData(){
		let startDate = '<?= $filterStartDate ? $filterStartDate->format("Y-m-d") : ''; ?>' || $('#startDate').val();
		let endDate = '<?= $filterEndDate ? $filterEndDate->format("Y-m-d") : ''; ?>' ||  $('#endDate').val();
		var type = $('#exportOptions').val();
      var filename =  '';

		if(type != '' && type != 'print'){

			var page = '<?= $page ? '&page='.$page : ''; ?>' ;
			var downloadUrl = '{{ route("business.active-membership.export") }}' + '?type=' + type +'&endDate=' + endDate +
		        '&startDate=' + startDate + page;

	    	if(type == 'excel'){
	    		filename = 'membership.xlsx';
	    	}else if(type == 'pdf'){
	    		filename = 'membership.pdf';
	    	}
	
	    	var link = document.createElement('a');
	    	link.href = downloadUrl;
	    	link.download = filename;
	    	document.body.appendChild(link);
	    	link.click();
	    	document.body.removeChild(link);
		}else if(type == 'print'){

			$('#accordionnesting').removeClass('collapsed');
			$('#accor_nestingExamplecollapsetoday').removeClass('scroll-customer');
			$('#accor_nestingExamplecollapsetoday, .buttonaccodiandiv').addClass('show');
		
			setTimeout(function() {
				print();
			}, 1000);

			setTimeout(function() {
				$('#accor_nestingExamplecollapsetoday, .buttonaccodiandiv').addClass('scroll-customer');
				$('#accordionnesting').addClass('collapsed');
				$('#accor_nestingExamplecollapsetoday, .buttonaccodiandiv').removeClass('show');
			}, 2000);
		}
	}

</script>