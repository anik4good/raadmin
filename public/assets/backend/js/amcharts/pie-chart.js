$(document).ready(function () {
    am4core.ready(function () {

// Themes begin
        am4core.useTheme(am4themes_animated);
// Themes end

        var chart = am4core.create("user_diets_nutritions_chartdiv", am4charts.PieChart3D);
        chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

        chart.legend = new am4charts.Legend();

        $.get(API_URL + '/fitness/pie/' + globalVariable.diet_id + '/nutritions').then(function (response) {
            console.log(response);
// Display the array elements
            chart.data = response;

            chart.innerRadius = 100;

            var series = chart.series.push(new am4charts.PieSeries3D());
            series.dataFields.value = "value";
            series.dataFields.category = "nutrition";

        }); // end am4core.ready()
    });
});
