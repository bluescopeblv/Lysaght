window.onload = function () {
	
// var chartLU = new CanvasJS.Chart("chartLU", {
// 		backgroundColor: "#ecf0f5",
// 	animationEnabled: true,
// 	theme: "light2",
// 	title: {
// 		text: "OEE"
// 	},
// 	axisX: {
// 		valueFormatString: "MMM"
// 	},
// 	axisY: {
// 		prefix: "$",
// 		labelFormatter: addSymbols
// 	},
// 	toolTip: {
// 		shared: true
// 	},
// 	legend: {
// 		cursor: "pointer",
// 		itemclick: toggleDataSeries
// 	},
// 	data: [
// 	{
// 		type: "column",
// 		name: "Actual Sales",
// 		showInLegend: true,
// 		xValueFormatString: "MMMM YYYY",
// 		yValueFormatString: "$#,##0",
// 		dataPoints: [
// 			{ x: new Date(2016, 0), y: 20000 },
// 			{ x: new Date(2016, 1), y: 30000 },
// 			{ x: new Date(2016, 2), y: 25000 },
// 			{ x: new Date(2016, 3), y: 70000, indexLabel: "High Renewals" },
// 			{ x: new Date(2016, 4), y: 50000 },
// 			{ x: new Date(2016, 5), y: 35000 },
// 			{ x: new Date(2016, 6), y: 30000 },
// 			{ x: new Date(2016, 7), y: 43000 },
// 			{ x: new Date(2016, 8), y: 35000 },
// 			{ x: new Date(2016, 9), y:  30000},
// 			{ x: new Date(2016, 10), y: 40000 },
// 			{ x: new Date(2016, 11), y: 50000 }
// 		]
// 	}, 
// 	{
// 		type: "line",
// 		name: "Expected Sales",
// 		showInLegend: true,
// 		yValueFormatString: "$#,##0",
// 		dataPoints: [
// 			{ x: new Date(2016, 0), y: 40000 },
// 			{ x: new Date(2016, 1), y: 42000 },
// 			{ x: new Date(2016, 2), y: 45000 },
// 			{ x: new Date(2016, 3), y: 45000 },
// 			{ x: new Date(2016, 4), y: 47000 },
// 			{ x: new Date(2016, 5), y: 43000 },
// 			{ x: new Date(2016, 6), y: 42000 },
// 			{ x: new Date(2016, 7), y: 43000 },
// 			{ x: new Date(2016, 8), y: 41000 },
// 			{ x: new Date(2016, 9), y: 45000 },
// 			{ x: new Date(2016, 10), y: 42000 },
// 			{ x: new Date(2016, 11), y: 50000 }
// 		]
// 	},
// 	{
// 		type: "area",
// 		name: "Profit",
// 		markerBorderColor: "white",
// 		markerBorderThickness: 2,
// 		showInLegend: true,
// 		yValueFormatString: "$#,##0",
// 		dataPoints: [
// 			{ x: new Date(2016, 0), y: 5000 },
// 			{ x: new Date(2016, 1), y: 7000 },
// 			{ x: new Date(2016, 2), y: 6000},
// 			{ x: new Date(2016, 3), y: 30000 },
// 			{ x: new Date(2016, 4), y: 20000 },
// 			{ x: new Date(2016, 5), y: 15000 },
// 			{ x: new Date(2016, 6), y: 13000 },
// 			{ x: new Date(2016, 7), y: 20000 },
// 			{ x: new Date(2016, 8), y: 15000 },
// 			{ x: new Date(2016, 9), y:  10000},
// 			{ x: new Date(2016, 10), y: 19000 },
// 			{ x: new Date(2016, 11), y: 22000 }
// 		]
// 	}]
// });
//chartLU.render();
// var chart_record_revenue = new CanvasJS.Chart("record_revenue", {
// 		backgroundColor: "#ecf0f5",
// 	animationEnabled: true,
// 	theme: "light2",
// 	title: {
// 		text: "OEE"
// 	},
// 	axisX: {
// 		valueFormatString: "MMM"
// 	},
// 	axisY: {
// 		prefix: "$",
// 		labelFormatter: addSymbols
// 	},
// 	toolTip: {
// 		shared: true
// 	},
// 	legend: {
// 		cursor: "pointer",
// 		itemclick: toggleDataSeries
// 	},
// 	data: [
// 	{
// 		type: "column",
// 		name: "Actual Sales",
// 		showInLegend: true,
// 		xValueFormatString: "MMMM YYYY",
// 		yValueFormatString: "$#,##0",
// 		dataPoints: [
// 			{ x: new Date(2016, 0), y: 20000 },
// 			{ x: new Date(2016, 1), y: 30000 },
// 			{ x: new Date(2016, 2), y: 25000 },
// 			{ x: new Date(2016, 3), y: 70000, indexLabel: "High Renewals" },
// 			{ x: new Date(2016, 4), y: 50000 },
// 			{ x: new Date(2016, 5), y: 35000 },
// 			{ x: new Date(2016, 6), y: 30000 },
// 			{ x: new Date(2016, 7), y: 43000 },
// 			{ x: new Date(2016, 8), y: 35000 },
// 			{ x: new Date(2016, 9), y:  30000},
// 			{ x: new Date(2016, 10), y: 40000 },
// 			{ x: new Date(2016, 11), y: 50000 }
// 		]
// 	}, 
// 	{
// 		type: "line",
// 		name: "Expected Sales",
// 		showInLegend: true,
// 		yValueFormatString: "$#,##0",
// 		dataPoints: [
// 			{ x: new Date(2016, 0), y: 40000 },
// 			{ x: new Date(2016, 1), y: 42000 },
// 			{ x: new Date(2016, 2), y: 45000 },
// 			{ x: new Date(2016, 3), y: 45000 },
// 			{ x: new Date(2016, 4), y: 47000 },
// 			{ x: new Date(2016, 5), y: 43000 },
// 			{ x: new Date(2016, 6), y: 42000 },
// 			{ x: new Date(2016, 7), y: 43000 },
// 			{ x: new Date(2016, 8), y: 41000 },
// 			{ x: new Date(2016, 9), y: 45000 },
// 			{ x: new Date(2016, 10), y: 42000 },
// 			{ x: new Date(2016, 11), y: 50000 }
// 		]
// 	},
// 	{
// 		type: "area",
// 		name: "Profit",
// 		markerBorderColor: "white",
// 		markerBorderThickness: 2,
// 		showInLegend: true,
// 		yValueFormatString: "$#,##0",
// 		dataPoints: [
// 			{ x: new Date(2016, 0), y: 5000 },
// 			{ x: new Date(2016, 1), y: 7000 },
// 			{ x: new Date(2016, 2), y: 6000},
// 			{ x: new Date(2016, 3), y: 30000 },
// 			{ x: new Date(2016, 4), y: 20000 },
// 			{ x: new Date(2016, 5), y: 15000 },
// 			{ x: new Date(2016, 6), y: 13000 },
// 			{ x: new Date(2016, 7), y: 20000 },
// 			{ x: new Date(2016, 8), y: 15000 },
// 			{ x: new Date(2016, 9), y:  10000},
// 			{ x: new Date(2016, 10), y: 19000 },
// 			{ x: new Date(2016, 11), y: 22000 }
// 		]
// 	}]
// });
//chart_record_revenue.render();

function addSymbols(e) {
	var suffixes = ["", "K", "M", "B"];
	var order = Math.max(Math.floor(Math.log(e.value) / Math.log(1000)), 0);

	if(order > suffixes.length - 1)                	
		order = suffixes.length - 1;

	var suffix = suffixes[order];      
	return CanvasJS.formatNumber(e.value / Math.pow(1000, order)) + suffix;
}

function toggleDataSeries(e) {
	if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	} else {
		e.dataSeries.visible = true;
	}
	e.chart.render();
}
// var chartLU = new CanvasJS.Chart("chartLU", {
// 		backgroundColor: "#ecf0f5",
// 	animationEnabled: true,
// 	theme: "light2",
// 	title: {
// 		text: "OEE"
// 	},
// 	axisX: {
// 		valueFormatString: "MMM"
// 	},
// 	axisY: {
// 		prefix: "$",
// 		labelFormatter: addSymbols
// 	},
// 	toolTip: {
// 		shared: true
// 	},
// 	legend: {
// 		cursor: "pointer",
// 		itemclick: toggleDataSeries
// 	},
// 	data: [
// 	{
// 		type: "column",
// 		name: "Actual Sales",
// 		showInLegend: true,
// 		xValueFormatString: "MMMM YYYY",
// 		yValueFormatString: "$#,##0",
// 		dataPoints: [
// 			{ x: new Date(2016, 0), y: 20000 },
// 			{ x: new Date(2016, 1), y: 30000 },
// 			{ x: new Date(2016, 2), y: 25000 },
// 			{ x: new Date(2016, 3), y: 70000, indexLabel: "High Renewals" },
// 			{ x: new Date(2016, 4), y: 50000 },
// 			{ x: new Date(2016, 5), y: 35000 },
// 			{ x: new Date(2016, 6), y: 30000 },
// 			{ x: new Date(2016, 7), y: 43000 },
// 			{ x: new Date(2016, 8), y: 35000 },
// 			{ x: new Date(2016, 9), y:  30000},
// 			{ x: new Date(2016, 10), y: 40000 },
// 			{ x: new Date(2016, 11), y: 50000 }
// 		]
// 	}, 
// 	{
// 		type: "line",
// 		name: "Expected Sales",
// 		showInLegend: true,
// 		yValueFormatString: "$#,##0",
// 		dataPoints: [
// 			{ x: new Date(2016, 0), y: 40000 },
// 			{ x: new Date(2016, 1), y: 42000 },
// 			{ x: new Date(2016, 2), y: 45000 },
// 			{ x: new Date(2016, 3), y: 45000 },
// 			{ x: new Date(2016, 4), y: 47000 },
// 			{ x: new Date(2016, 5), y: 43000 },
// 			{ x: new Date(2016, 6), y: 42000 },
// 			{ x: new Date(2016, 7), y: 43000 },
// 			{ x: new Date(2016, 8), y: 41000 },
// 			{ x: new Date(2016, 9), y: 45000 },
// 			{ x: new Date(2016, 10), y: 42000 },
// 			{ x: new Date(2016, 11), y: 50000 }
// 		]
// 	},
// 	{
// 		type: "area",
// 		name: "Profit",
// 		markerBorderColor: "white",
// 		markerBorderThickness: 2,
// 		showInLegend: true,
// 		yValueFormatString: "$#,##0",
// 		dataPoints: [
// 			{ x: new Date(2016, 0), y: 5000 },
// 			{ x: new Date(2016, 1), y: 7000 },
// 			{ x: new Date(2016, 2), y: 6000},
// 			{ x: new Date(2016, 3), y: 30000 },
// 			{ x: new Date(2016, 4), y: 20000 },
// 			{ x: new Date(2016, 5), y: 15000 },
// 			{ x: new Date(2016, 6), y: 13000 },
// 			{ x: new Date(2016, 7), y: 20000 },
// 			{ x: new Date(2016, 8), y: 15000 },
// 			{ x: new Date(2016, 9), y:  10000},
// 			{ x: new Date(2016, 10), y: 19000 },
// 			{ x: new Date(2016, 11), y: 22000 }
// 		]
// 	}]
//});
//chartLU.render();
// function addSymbols(i) {
// 	var suffixes = ["", "K", "M", "B"];
// 	var order = Math.max(Math.floor(Math.log(i.value) / Math.log(1000)), 0);

// 	if(order > suffixes.length - 1)                	
// 		order = suffixes.length - 1;

// 	var suffix = suffixes[order];      
// 	return CanvasJS.formatNumber(i.value / Math.pow(1000, order)) + suffix;
// }
// function toggleDataSeries(i) {
// 	if (typeof (i.dataSeries.visible) === "undefined" || i.dataSeries.visible) {
// 		i.dataSeries.visible = false;
// 	} else {
// 		i.dataSeries.visible = true;
// 	}
// 	i.chartLU.render();
// }


}
/*ytd*/
// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {
  var data = google.visualization.arrayToDataTable([
  ['Hihi', 'Hihi'],
  ['One', 8],
  ['Two', 0],
  ['Three', 17],
  ['Four', 0],
  ['Five', 75]
]);

  // Optional; add a title and set the width and height of the chart
  // var options = {'title':'MANPOWER - YTD', 'width':500, 'height':400};
  var options = {
  	'title':'MANPOWER - YTD',
	backgroundColor: "#ecf0f5",
	'fontSize':'13px',
};

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}
/*chart LU*/

/*end chart LU*/
