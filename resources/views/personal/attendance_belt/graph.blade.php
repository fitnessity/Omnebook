 <div id="projects-overview-chart" data-colors='["--vz-primary", "--vz-warning", "--vz-success"]' class="apex-charts" dir="ltr"></div>


<script>
	

	$( document ).ready(function() {
		daysCnt = <?php echo $graphData; ?>;
		category = <?php echo $categoryData; ?>;
        draw_chart_combo(daysCnt , category);
	});

	
	function draw_chart_combo(data,category){
		var maxData = Math.max(...data) ;
		var options = {
	        series: [ {
                name: "Total Attendance",
                type: "bar",
                data: data
            }],
            chart: {
                height: 374,
                type: "line",
                toolbar: {
                    show: !1
                }
            },
            stroke: {
                curve: "smooth",
                dashArray: [0, 3, 0],
                width: [0, 0, 0]
            },
            xaxis: {
                categories: category,
                axisTicks: {
                    show: !1
                },
                axisBorder: {
                    show: !1
                }
            },
            yaxis: {
	            min: 0, // Set a minimum value for the Y-axis
	            max: maxData, // Set a maximum value for the Y-axis (adjust as needed)
	            labels: {
	                formatter: function (value) {
	                    return value.toFixed(0); // Format Y-axis labels as needed
	                }
	            }
	        },
            legend: {
                show: !0,
                horizontalAlign: "center",
                offsetX: 0,
                offsetY: -5,
                markers: {
                    width: 9,
                    height: 9,
                    radius: 6
                },
                itemMargin: {
                    horizontal: 10,
                    vertical: 0
                }
            },
            plotOptions: {
                bar: {
                    columnWidth: "30%",
                    barHeight: "70%"
                }
            },
            tooltip: {
                shared: !0,
                y: [{
                    formatter: function(e) {
                        return void 0 !== e ?  e : 0
                    }
                }]
            },
    	};
    	(chart = new ApexCharts(document.querySelector("#projects-overview-chart"), options)).render();
	}
</script>