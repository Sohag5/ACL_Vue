<template>
	<section>
		<div class="container">
			<div class="report-section">
				<div class="row" >
					<div class="col-md-3 ">
						<div class="report-box first-box">
							<span>
								<i class="fa fa-handshake-o"></i> B2C Agent Report
							</span>
						</div>
					</div>
					<div class="col-md-3 ">
						<div class="report-box second-box">
							<span>
								<i class="fa fa-handshake-o"></i> B2B Agent Report
							</span>
						</div>
					</div>
					<div class="col-md-3 ">
						<div class="report-box third-box">
							<span>
								<i class="fa fa-handshake-o"></i> White Level Report
							</span>
						</div>
					</div>
					<div class="col-md-3 ">
						<div class="report-box fourth-box">
							<span>
								<i class="fa fa-handshake-o"></i> Transaction Report
							</span>
						</div>
					</div>
				</div>

				<div class="row chart">


					<div class="col-md-6 pieDiv">
						<div class="pie-chart">
							<div id="chartContainerOne" style="height: 300px; width: 100%;"></div>
						</div>
					</div>


					<div class="col-md-6 pieDiv">
						<div class="pie-chart">
							<div id="chartContainer" style="height: 300px; width: 100%;"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

</template>


<script>
	import Header from './Header.vue';
	import Footer from './Footer.vue';
	export default {
		name: 'Dashboard',
		components: {Header,Footer},
		methods: {
			piChart(){
				var chart = new CanvasJS.Chart("chartContainer", {
					theme: "light2", 
					exportEnabled: true,
					animationEnabled: true,
					title: {
						text: "User PIE Chart"
					},
					data: [{
						type: "pie",
						startAngle: 25,
						toolTipContent: "<b>{label}</b>: {y}%",
						showInLegend: "true",
						legendText: "{label}",
						indexLabelFontSize: 16,
						indexLabel: "{label} - {y}%",
						dataPoints: [
						{ y: 51.08, label: "B2C Agent" },
						{ y: 27.34, label: "B2B Agent" },
						{ y: 10.62, label: "White Level" },
						{ y: 5.02, label: "Corporate Customer" }
						]
					}]
				});
				chart.render();
			},


			transaction(){
				var dataPoints = [];

				var chart = new CanvasJS.Chart("chartContainerOne", {
					animationEnabled: true,
					theme: "light2", // "light1", "light2", "dark1", "dark2"
					exportEnabled: true,
					title: {
						text: "goMyair Transaction Report"
					},
					subtitles: [{
						text: "Weekly Averages"
					}],
					axisX: {
						interval: 1,
						valueFormatString: "MMM"
					},
					axisY: {
						prefix: "$",
						title: "Price"
					},
					toolTip: {
						content: "Date: {x}<br /><strong>Price:</strong><br />Open: {y[0]}, Close: {y[3]}<br />High: {y[1]}, Low: {y[2]}"
					},
					data: [{
						type: "candlestick",
						yValueFormatString: "$##0.00",
						dataPoints: dataPoints
					}]
					});
                
				  $.get("https://canvasjs.com/data/gallery/javascript/netflix-stock-price.csv", getDataPointsFromCSV);

				function getDataPointsFromCSV(csv) {
					var csvLines = this.points = [];
					csvLines = csv.split(/[\r?\n|\r|\n]+/);
					for (var i = 0; i < csvLines.length; i++) {
						if (csvLines[i].length > 0) {
							this.points = csvLines[i].split(",");
							dataPoints.push({
								x: new Date(
									parseInt(this.points[0].split("-")[0]),
									parseInt(this.points[0].split("-")[1]),
									parseInt(this.points[0].split("-")[2])
									),
								y: [
								parseFloat(this.points[1]),
								parseFloat(this.points[2]),
								parseFloat(this.points[3]),
								parseFloat(this.points[4])
								]
							});
						}
					}
					chart.render();
				}
			}


		},
		mounted(){

			this.piChart();
			this.transaction();

		},
	}
</script>