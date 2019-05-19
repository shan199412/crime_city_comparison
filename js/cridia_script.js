function secondGraph(chosen_city) {
    // The previous data is cleared when the refresh occurs
    d3.select('.svg2c').selectAll("*").remove();
    d3.select("#drop_cri").selectAll('*').remove();
    // modify the data into appropriate structure
    var color = ["gold", "lightskyblue", "salmon", "lightgreen"];
    var mdata2 = [];
    var k2 = 0;
    // for each row in cdata2
    for (i = 0; i < cdata2.length; i++) {
        // every 6 rows include the number of crimes in the same city over 6 years
        if (i % 6 == 0){
            var added2 = [];
            added2["city_id"] = cdata2[i]["city_id"];
            added2["city_name"] = cdata2[i]["city_name"];
            added2["year"] = cdata2[i]["year"];
            added2[cdata2[i]["crime_type"]] = cdata2[i]["crime_per"];
        } else if (i % 6 == 5){
            // add the record to mdata for further usage
            added2[cdata2[i]["crime_type"]] = cdata2[i]["crime_per"];
            mdata2[k2] = added2;
            k2 = k2 + 1;
        } else {
            added2[cdata2[i]["crime_type"]] = cdata2[i]["crime_per"];
        }
    }
    // the margin, width, and height of the svg
    var margin2 = {top: 40, right: 20, bottom: 30, left: 60},
        width2 = 300 - margin2.left - margin2.right,
        height2 = 250 - margin2.top - margin2.bottom;
    // get column names
    var elements2 = Object.keys(mdata2[0])
        .filter(function (d) {
            return ((d != "city_name") & (d != "city_id") & (d != "year"));
        });
    // Judge the selected city
    var sdata = [];
    for (i = 0; i < mdata2.length; i++) {
        record = mdata2[i];
        if (chosen_city.includes(record["city_id"])) {
            sdata.push(record);
        }
    }
    // Get the selected city
    for (num = 0; num < chosen_city.length; num++) {
        var city = chosen_city[num];

        for (z = 0; z < mdata2.length; z++) {
            if (mdata2[z]['city_id'] == city) {
                var city_name = mdata2[z]['city_name'];
                break;
            }
        }

        var data = [];
        for (k = 0; k < mdata2.length; k++) {
            record = mdata2[k];
            if (record['city_id'] == chosen_city[num]) {
                data.push(record);
            }
        }

        // create an svg in html
        var svg = d3.select(".svg2c").append("svg")
            .attr("width", width2 + margin2.left + margin2.right)
            .attr("height", height2 + margin2.top + margin2.bottom)
            .append("g")
            .attr("transform", "translate(" + margin2.left + "," + margin2.top + ")");



        var selection2 = elements2[0];
        // console.log(elements2);
        // console.log(selection2);
        var y2 = d3.scale.linear()
        // .domain([d3.min(mdata, function (d) {
        //     return +d[selection1]/2;
        // }), d3.max(mdata, function (d) {
        //     return +d[selection1];
        // })])
            .domain([0,d3.max(data, function (d) {
                return +d[selection2];
            })])
            .range([height2, 0]);
        var x2 = d3.scale.ordinal()
            .domain(data.map(function (d) {
                return d.year;
            }))
            .rangeBands([0, width2]);
        var xAxis2 = d3.svg.axis()
            .scale(x2)
            .orient("bottom");
        //function to create the y axis
        var yAxis2 = d3.svg.axis()
            .scale(y2)
            .orient("left");
        // draw on svg, add x axis
        svg.append("g")
            .attr("class", "x2 axis")
            .attr("transform", "translate(0," + height2 + ")")
            .call(xAxis2)
            .selectAll("text")
            .style("font-size", "11px")
            .style("text-anchor", "end")
            .attr("dx", "0.5em")
            .attr("dy", "0.75em")
            .attr("transform", "rotate(-30)");
        // add y axis to the svg
        svg.append("g")
            .attr("class", "y2 axis")
            .style("font-size", "15px")
            .call(yAxis2)
            .append("text")
            .attr("transform", "rotate(-90)")
            .attr("x", 0)
            .attr("y", -50)
            .attr("dy", ".11em")
            .style("text-anchor", "end")
            .style("font-size", "11.5px")
            .text("Number of Crimes Per 100,000 People");
        // draw the bar charts
        svg.selectAll("rectangle2")
            .data(data)
            .enter()
            .append("rect")
            .attr("class", "rectangle2")
            .attr("width", width2 / data.length -15 )
            .attr("height", function (d) {
                return height2 - y2(+d[selection2]);
            })
            .attr("x", function (d, i) {
                return (width2 / data.length) * i + 7.5;
            })
            .attr("y", function (d) {
                return y2(+d[selection2]);
            })
            .attr("fill", function (d) {
                return color[num];
            })
            // .attr("fill","#99CCFF")
            // the bar of Mlebourne Metro will be dark red, others would be blue
            .style("margin-top", "10px")
            .append("title")
            .text(function (d) {
                return d.year + " : " + Math.floor(d[selection2] * 100) / 100 + " cases";
            });
        // add title
        svg.append("text")
            .attr("x", (width2 / 2))
            .attr("y", 0 - (margin2.top / 2))
            .attr("text-anchor", "middle")
            .style("font-size", "15px")
            // .style("text-decoration", "underline")
            .text(city_name);

    // the selector (drop-down button)
        if (num == 0) {
            var selector2 = d3.select("#drop_cri")
                .append("select")
                .attr("id", "dropdown_cri")
                // how to update the plot
                .on("change", function (d) {
                    selection2 = document.getElementById("dropdown_cri");
                    // change the domain of the y axis
                    y2.domain([0, d3.max(sdata, function (d) {
                        return +d[selection2.value];
                    })]);

                    yAxis2.scale(y2);
                    // change the height of the bar charts
                    d3.selectAll(".rectangle2")
                        .transition()
                        .attr("height", function (d) {
                            return height2 - y2(+d[selection2.value]);
                        })
                        .attr("x", function (d, i) {
                            return (width2 / data.length) * (i % 6) + 7.5;
                        })
                        .attr("y", function (d) {
                            return y2(+d[selection2.value]);
                        })
                        .ease("linear")
                        .select("title")
                        .text(function (d) {
                            return d.year + " : " + Math.floor(d[selection2.value] * 100) / 100 + " cases";
                        });
                    // change the y axis
                    d3.selectAll("g.y2.axis")
                        .transition()
                        .call(yAxis2);

                });
            // add values to the drop down button
            selector2.selectAll("option")
                .data(elements2)
                .enter().append("option")
                .attr("value", function (d) {
                    return d;
                })
                .text(function (d) {
                    return d;
                });
        }
    }
}