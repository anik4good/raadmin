$(document).ready(function () {
    am4core.ready(function () {

// Themes begin
        am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
        var chart = am4core.create("weight_chartdiv", am4charts.XYChart);
        chart.scrollbarX = new am4core.Scrollbar();

        // Set up data source
        $.get(API_URL + '/fitness/user/weight').then(function (response) {
            console.log(response);
// Display the array elements
            chart.data = response;

// Create axes
            var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
            categoryAxis.dataFields.category = "country";
            categoryAxis.renderer.grid.template.location = 0;
            categoryAxis.renderer.minGridDistance = 30;
            categoryAxis.renderer.labels.template.horizontalCenter = "right";
            categoryAxis.renderer.labels.template.verticalCenter = "middle";
            categoryAxis.renderer.labels.template.rotation = 270;
            categoryAxis.tooltip.disabled = true;
            categoryAxis.renderer.minHeight = 110;

            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
            valueAxis.renderer.minWidth = 50;

// Create series
            var series = chart.series.push(new am4charts.ColumnSeries());
            series.sequencedInterpolation = true;
            series.dataFields.valueY = "visits";
            series.dataFields.categoryX = "country";
            series.tooltipText = "[{categoryX}: bold]{valueY}[/]";
            series.columns.template.strokeWidth = 0;

            series.tooltip.pointerOrientation = "vertical";

            series.columns.template.column.cornerRadiusTopLeft = 10;
            series.columns.template.column.cornerRadiusTopRight = 10;
            series.columns.template.column.fillOpacity = 0.8;

// on hover, make corner radiuses bigger
            var hoverState = series.columns.template.column.states.create("hover");
            hoverState.properties.cornerRadiusTopLeft = 0;
            hoverState.properties.cornerRadiusTopRight = 0;
            hoverState.properties.fillOpacity = 1;

            series.columns.template.adapter.add("fill", function (fill, target) {
                return chart.colors.getIndex(target.dataItem.index);
            });

// Cursor
            chart.cursor = new am4charts.XYCursor();

        }); // end am4core.ready()

    });


    //bmi chart------------------------------------------------------------------

    am4core.ready(function () {

// Themes begin
        am4core.useTheme(am4themes_animated);
// Themes end

        var chartMin = 0;
        var chartMax = 50;


        var data = {
            score: globalVariable.bmi,
            gradingData: [
                {
                    title: "UNDER WEIGHT",
                    color: "yellow",
                    lowScore: 0,
                    highScore: 18
                },
                {
                    title: "NORMAL WEIGHT",
                    color: "green",
                    lowScore: 18.1,
                    highScore: 24.9
                },
                {
                    title: "OVER WEIGHT",
                    color: "#f04922",
                    lowScore: 25.00,
                    highScore: 29.9
                },

                {
                    title: "OBESE",
                    color: "red",
                    lowScore: 30.00,
                    highScore: 50.00
                },


            ]
        };

        /**
         Grading Lookup
         */
        function lookUpGrade(lookupScore, grades) {
            // Only change code below this line
            for (var i = 0; i < grades.length; i++) {
                if (
                    grades[i].lowScore < lookupScore &&
                    grades[i].highScore >= lookupScore
                ) {
                    return grades[i];
                }
            }
            return null;
        }

// create chart
        var chart = am4core.create("bmi_chartdiv", am4charts.GaugeChart);
        chart.hiddenState.properties.opacity = 0;
        chart.fontSize = 13;
        chart.innerRadius = am4core.percent(80);
        chart.resizable = true;

        /**
         * Normal axis
         */

        var axis = chart.xAxes.push(new am4charts.ValueAxis());
        axis.min = chartMin;
        axis.max = chartMax;
        axis.strictMinMax = true;
        axis.renderer.radius = am4core.percent(80);
        axis.renderer.inside = true;
        axis.renderer.line.strokeOpacity = 0.1;
        axis.renderer.ticks.template.disabled = false;
        axis.renderer.ticks.template.strokeOpacity = 1;
        axis.renderer.ticks.template.strokeWidth = 0.5;
        axis.renderer.ticks.template.length = 5;
        axis.renderer.grid.template.disabled = true;
        axis.renderer.labels.template.radius = am4core.percent(15);
        axis.renderer.labels.template.fontSize = "0.9em";

        /**
         * Axis for ranges
         */

        var axis2 = chart.xAxes.push(new am4charts.ValueAxis());
        axis2.min = chartMin;
        axis2.max = chartMax;
        axis2.strictMinMax = true;
        axis2.renderer.labels.template.disabled = true;
        axis2.renderer.ticks.template.disabled = true;
        axis2.renderer.grid.template.disabled = false;
        axis2.renderer.grid.template.opacity = 0.5;
        axis2.renderer.labels.template.bent = true;
        axis2.renderer.labels.template.fill = am4core.color("#000");
        axis2.renderer.labels.template.fontWeight = "bold";
        axis2.renderer.labels.template.fillOpacity = 0.3;


        /**
         Ranges
         */

        for (let grading of data.gradingData) {
            var range = axis2.axisRanges.create();
            range.axisFill.fill = am4core.color(grading.color);
            range.axisFill.fillOpacity = 0.8;
            range.axisFill.zIndex = -1;
            range.value = grading.lowScore > chartMin ? grading.lowScore : chartMin;
            range.endValue = grading.highScore < chartMax ? grading.highScore : chartMax;
            range.grid.strokeOpacity = 0;
            range.stroke = am4core.color(grading.color).lighten(-0.1);
            range.label.inside = true;
            range.label.text = grading.title.toUpperCase();
            range.label.inside = true;
            range.label.location = 0.5;
            range.label.inside = true;
            range.label.radius = am4core.percent(10);
            range.label.paddingBottom = -5; // ~half font size
            range.label.fontSize = "0.9em";
        }

        var matchingGrade = lookUpGrade(data.score, data.gradingData);

        /**
         * Label 1
         */

        var label = chart.radarContainer.createChild(am4core.Label);
        label.isMeasured = false;
        label.fontSize = "6em";
        label.x = am4core.percent(50);
        label.paddingBottom = 15;
        label.horizontalCenter = "middle";
        label.verticalCenter = "bottom";
//label.dataItem = data;
        label.text = data.score.toFixed(1);
//label.text = "{score}";
        label.fill = am4core.color(matchingGrade.color);

        /**
         * Label 2
         */

        var label2 = chart.radarContainer.createChild(am4core.Label);
        label2.isMeasured = false;
        label2.fontSize = "2em";
        label2.horizontalCenter = "middle";
        label2.verticalCenter = "bottom";
        label2.text = matchingGrade.title.toUpperCase();
        label2.fill = am4core.color(matchingGrade.color);


        /**
         * Hand
         */

        var hand = chart.hands.push(new am4charts.ClockHand());
        hand.axis = axis2;
        hand.innerRadius = am4core.percent(55);
        hand.startWidth = 8;
        hand.pin.disabled = true;
        hand.value = data.score;
        hand.fill = am4core.color("#444");
        hand.stroke = am4core.color("#000");

        hand.events.on("positionchanged", function () {
            label.text = axis2.positionToValue(hand.currentPosition).toFixed(1);
            var value2 = axis.positionToValue(hand.currentPosition);
            var matchingGrade = lookUpGrade(axis.positionToValue(hand.currentPosition), data.gradingData);
            label2.text = matchingGrade.title.toUpperCase();
            label2.fill = am4core.color(matchingGrade.color);
            label2.stroke = am4core.color(matchingGrade.color);
            label.fill = am4core.color(matchingGrade.color);
        })

        setInterval(function () {
            var value = globalVariable.bmi;
            hand.showValue(value, 1000, am4core.ease.cubicOut);
        }, 2000);

    }); // end am4core.ready()


//for admin chart start here ------------------------------------------------------------------------------------------------------------
    am4core.ready(function () {

// Themes begin
        am4core.useTheme(am4themes_animated);
// Themes end

        /**
         * Chart design taken from Samsung health app
         */

        var chart = am4core.create("user_weight_chartdiv", am4charts.XYChart);
        chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

        chart.paddingBottom = 30;
        // Set up data source
        $.get(API_URL + '/fitness/admin/weight').then(function (response) {
            console.log(response);
// Display the array elements
            chart.data = response;

            var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
            categoryAxis.dataFields.category = "name";
            categoryAxis.renderer.grid.template.strokeOpacity = 0;
            categoryAxis.renderer.minGridDistance = 10;
            categoryAxis.renderer.labels.template.dy = 35;
            categoryAxis.renderer.tooltip.dy = 35;

            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
            valueAxis.renderer.inside = true;
            valueAxis.renderer.labels.template.fillOpacity = 0.3;
            valueAxis.renderer.grid.template.strokeOpacity = 0;
            valueAxis.min = 0;
            valueAxis.cursorTooltipEnabled = false;
            valueAxis.renderer.baseGrid.strokeOpacity = 0;

            var series = chart.series.push(new am4charts.ColumnSeries);
            series.dataFields.valueY = "weight";
            series.dataFields.categoryX = "name";
            series.tooltipText = "{valueY.value}";
            series.tooltip.pointerOrientation = "vertical";
            series.tooltip.dy = -6;
            series.columnsContainer.zIndex = 100;

            var columnTemplate = series.columns.template;
            columnTemplate.width = am4core.percent(50);
            columnTemplate.maxWidth = 66;
            columnTemplate.column.cornerRadius(60, 60, 10, 10);
            columnTemplate.strokeOpacity = 0;

            series.heatRules.push({
                target: columnTemplate,
                property: "fill",
                dataField: "valueY",
                min: am4core.color("#e5dc36"),
                max: am4core.color("#5faa46")
            });
            series.mainContainer.mask = undefined;

            var cursor = new am4charts.XYCursor();
            chart.cursor = cursor;
            cursor.lineX.disabled = true;
            cursor.lineY.disabled = true;
            cursor.behavior = "none";

            var bullet = columnTemplate.createChild(am4charts.CircleBullet);
            bullet.circle.radius = 30;
            bullet.valign = "bottom";
            bullet.align = "center";
            bullet.isMeasured = true;
            bullet.mouseEnabled = false;
            bullet.verticalCenter = "bottom";
            bullet.interactionsEnabled = false;

            var hoverState = bullet.states.create("hover");
            var outlineCircle = bullet.createChild(am4core.Circle);
            outlineCircle.adapter.add("radius", function (radius, target) {
                var circleBullet = target.parent;
                return circleBullet.circle.pixelRadius + 10;
            })

            var image = bullet.createChild(am4core.Image);
            image.width = 60;
            image.height = 60;
            image.horizontalCenter = "middle";
            image.verticalCenter = "middle";
            image.propertyFields.href = "image";

            image.adapter.add("mask", function (mask, target) {
                var circleBullet = target.parent;
                return circleBullet.circle;
            })

            var previousBullet;
            chart.cursor.events.on("cursorpositionchanged", function (event) {
                var dataItem = series.tooltipDataItem;

                if (dataItem.column) {
                    var bullet = dataItem.column.children.getIndex(1);

                    if (previousBullet && previousBullet != bullet) {
                        previousBullet.isHover = false;
                    }

                    if (previousBullet != bullet) {

                        var hs = bullet.states.getKey("hover");
                        hs.properties.dy = -bullet.parent.pixelHeight + 30;
                        bullet.isHover = true;

                        previousBullet = bullet;
                    }
                }
            })

        }); // end am4core.ready()
    });


});
