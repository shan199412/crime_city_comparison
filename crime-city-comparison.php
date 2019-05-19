<?php
if (!defined('ABSPATH')) {
	exit;
}
$username = "zxl101";
$password = "S079z079";
$host = "mytestdb.cjkcq2pcruvk.us-east-2.rds.amazonaws.com";
$database="iter2";
//connect with database
$connect = mysqli_connect( $host, $username, $password, $database );

//getting data
$myquery2 = "select year(year) as year, crime_type_num, city_name, c.city_id, crime_type_des from crime_type_num as ctn
                join city as c on c.city_id = ctn.city_id
                join crime_type as ct on ctn.crime_type_id = ct.crime_type_id
                where year(year) in (2012,2013,2014,2015,2016,2017)
                order by city_name, year, crime_type_des;";

$query2 = mysqli_query($connect, $myquery2);

$crime_type    = array();
while ( $row = mysqli_fetch_assoc( $query2 ) ) {
	$element = array();
	$element['year'] = $row['year'];
	$element['city_id'] = $row['city_id'];
	$element['city_name'] = $row['city_name'];
	$element['crime_per'] = $row['crime_type_num'];
	$element['crime_type'] = $row['crime_type_des'];
	$crime_type[] = $element;
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
        <!--    Reference the required js and CSS-->
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<link rel="stylesheet" href="css/cricity_style.css">
		<script type="text/javascript" src="js/cricity_script.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">

		<link rel="stylesheet" href="css/cridia_style.css">
		<script src="http://d3js.org/d3.v3.min.js"></script>
		<script src="http://labratrevenge.com/d3-tip/javascripts/d3.tip.v0.6.3.js"></script>
		<script src="https://d3js.org/d3-axis.v1.min.js"></script>
	</head>

	<body>
<!--	<div class="section2_b" >-->
<!--		<div id="form1" style="text-align: center">-->
<!--			<p></p>-->
<!--			<label class="text_label_b">Select a city you would like to compare:</label>-->
<!--			<br>-->
<!--			<select id="city_b">-->
<!--				<option value="0">--select a city--</option>-->
<!--				<option value="1">Ballarat</option>-->
<!--				<option value="2">Greater Bendigo</option>-->
<!--				<option value="3">Greater Geelong</option>-->
<!--				<option value="4">Greater Shepparton</option>-->
<!--				<option value="5">Horsham</option>-->
<!--				<option value="6">Latrobe</option>-->
<!--				<option value="7">Mildura</option>-->
<!--				<option value="8">Wangaratta</option>-->
<!--				<option value="9">Warrnambool</option>-->
<!--				<option value="10">Wodonga</option>-->
<!--			</select>-->
<!--		</div>-->
<!--	</div>-->
	<br>
<!--check box-->
	<div class="section3_b" style="text-align: center">
		<p></p>
		<label class="text_label_b">Select up to four Regional Cities to compare:</label>
		<br>
		<div id="checkbox" style="text-align: center">

			<label class="city_b" id="1">
				<input class="checkcity" type="checkbox" id="1">
				Ballarat
				<span class="checkmark2"></span>
			</label>

			<label class="city_b" id="2">
				<input class="checkcity" type="checkbox" id="2">
				Greater Bendigo
				<span class="checkmark2"></span>
			</label>

			<label class="city_b" id="3">
				<input class="checkcity" type="checkbox" id="3">
				Greater Geelong
				<span class="checkmark2"></span>
			</label>

			<label class="city_b" id="4">
				<input class="checkcity" type="checkbox" id="4">
				Greater Shepparton
				<span class="checkmark2"></span>
			</label>

			<label class="city_b" id="5">
				<input class="checkcity" type="checkbox" id="5">
				Horsham
				<span class="checkmark2"></span>
			</label>
			<br>

			<label class="city_b" id="6">
				<input class="checkcity" type="checkbox" id="6">
				Latrobe
				<span class="checkmark2"></span>
			</label>

			<label class="city_b" id="7">
				<input class="checkcity" type="checkbox" id="7">
				Mildura
				<span class="checkmark2"></span>
			</label>

			<label class="city_b" id="8">
				<input class="checkcity" type="checkbox" id="8">
				Wangaratta
				<span class="checkmark2"></span>
			</label>

			<label class="city_b" id="9">
				<input class="checkcity" type="checkbox" id="9">
				Warrnambool
				<span class="checkmark2"></span>
			</label>

			<label class="city_b" id="10">
				<input class="checkcity" type="checkbox" id="10">
				Wodonga
				<span class="checkmark2"></span>
			</label>

		</div>
		<p></p>
		<div class="s_button_b">
			<button class="submit_button_b">Submit</button>
		</div>

<!--summary test-->
<!--		<div class="city_summary_b" style="display: none">-->
<!--			<div class="citys1">-->
<!--				<span style="font-weight: bold; font-size: 22px; color: #3498db">Ballarat</span>-->
<!--				<br>-->
<!--                <span style="font-size: 16px; line-height: 0.7">-->
<!--	                Data shows the V shaped, <span style="font-size: 18px; color: #27ae60; font-weight: bold">decrease</span> from 2012 to 2014,-->
<!--	                <br>then increased from 2014 to 2016, nearly the same in 2016 to 2017;-->
<!--	                <br>number of justice procedures offences increases each year; <span style="font-size: 18px; color: red; font-weight: bold">70%</span> of the crimes are property and deception offences.<br>-->
<!--                </span>-->
<!--			</div>-->
<!--			<div class="citys2" style="display: none">-->
<!--				<span style="font-weight: bold; font-size: 22px; color: #3498db">Greater Bendigo</span>-->
<!--				<br>-->
<!--                <span style="font-size: 16px; line-height: 0.7">-->
<!--	                The total number keeps increasing, with the most rapid <span style="font-size: 18px; color: red; font-weight: bold">increase</span> from 2015 to 2016;-->
<!--	                <br>number of justice procedures offences <span style="font-size: 18px; color: red; font-weight: bold">increases</span> each year.-->
<!--	                <br>Public order and security offences, and drug offences <span style="font-size: 18px; color: #27ae60; font-weight: bold">decreases</span>.<br>-->
<!--                </span>-->
<!--			</div>-->
<!---->
<!--			<div class="citys3" style="display: none">-->
<!--				<span style="font-weight: bold; font-size: 22px; color: #3498db">Greater Geelong</span>-->
<!--				<br>-->
<!--				<span style="font-size: 16px; line-height: 0.7">-->
<!--					Data <span style="font-size: 18px; color: red; font-weight: bold">increase</span> from 2012 to 2015, huge increase in 2016 and then <span style="font-size: 18px; color: #27ae60; font-weight: bold">decrease</span> (5971 to 7222, highest point in 2016, at 8118).-->
<!--					<br>The huge increase in 2015 to 2016 is due to increase in property and deception offences.-->
<!--					<br>Crime against person from 607 to 993. Justice from 147 to 806. Drug from 2014 to 215.<br>-->
<!--				</span>-->
<!--			</div>-->
<!--			<div class="citys4" style="display: none">-->
<!--				<span style="font-weight: bold; font-size: 22px; color: #3498db">Greater Shepparton</span>-->
<!--				<br>-->
<!--                <span style="font-size: 16px; line-height: 0.7">-->
<!--	                Data overall <span style="font-size: 18px; color: red; font-weight: bold">increase</span>, from 7868 to 9243, highest in 2016 at 9659.-->
<!--	                <br><span style="font-size: 18px; color: #27ae60; font-weight: bold">Decrease</span> in drug offence from 2013 to 2017.<br>-->
<!--                </span>-->
<!--			</div>-->
<!--			<div class="citys5" style="display: none">-->
<!--				<span style="font-weight: bold; font-size: 22px; color: #3498db">Horsham</span>-->
<!--				<br>-->
<!--                <span style="font-size: 16px; line-height: 0.7">-->
<!--	                The data <span style="font-size: 18px; color: red; font-weight: bold">increase</span> from 2013 to 2015, then huge <span style="font-size: 18px; color: #27ae60; font-weight: bold">decrease</span> from 2015 to 2017.-->
<!--	                <br>Lowest in 2013 at 6646, highest in 2015 at 9911.<br>-->
<!--                </span>-->
<!--			</div>-->
<!--			<div class="citys6" style="display: none">-->
<!--				<span style="font-weight: bold; font-size: 22px; color: #3498db">Latrobe</span>-->
<!--				<br>-->
<!--                <span style="font-size: 16px; line-height: 0.7">-->
<!--	                Data <span style="font-size: 18px; color: red; font-weight: bold">increase</span> from 2014 to 2016. In 2013 at 9773, then 2016 at 13649, in 2017 at 12946.-->
<!--	                <br>Main <span style="font-size: 18px; color: red; font-weight: bold">increase</span> are from Crime against the person,-->
<!--	                <br>Property and deception offence and Justice Procedures Offence.<br>-->
<!--                </span>-->
<!--			</div>-->
<!--			<div class="citys7" style="display: none">-->
<!--				<span style="font-weight: bold; font-size: 22px; color: #3498db">Mildura</span>-->
<!--				<br>-->
<!--                <span style="font-size: 16px; line-height: 0.7">-->
<!--	                Data <span style="font-size: 18px; color: red; font-weight: bold">increase</span> from 8508 to 9277. Property and deception offence crimes are <span style="font-size: 18px; color: #27ae60; font-weight: bold">decrease</span>.<br>-->
<!--                </span>-->
<!--			</div>-->
<!--			<div class="citys8" style="display: none">-->
<!--				<span style="font-weight: bold; font-size: 22px; color: #3498db">Wangaratta</span>-->
<!--				<br>-->
<!--                <span style="font-size: 16px; line-height: 0.7">-->
<!--	                Crimes <span style="font-size: 18px; color: red; font-weight: bold">increase</span> from 5891 to 6890 from 2015 to 2017.-->
<!--	                <br>There is slow <span style="font-size: 18px; color: red; font-weight: bold">increasing</span> in Drug offences and Justice Procedures Offence.<br>-->
<!--                </span>-->
<!--			</div>-->
<!--			<div class="citys9" style="display: none">-->
<!--				<span style="font-weight: bold; font-size: 22px; color: #3498db">Warrnambool</span>-->
<!--				<br>-->
<!--                <span style="font-size: 16px; line-height: 0.7">-->
<!--	                Data has huge <span style="font-size: 18px; color: red; font-weight: bold">increase</span> from 2014 at 5581 to 2017 at 7876.-->
<!--	                <br>Justice Procedures Offence are <span style="font-size: 18px; color: red; font-weight: bold">Increasing</span>.<br>-->
<!--                </span>-->
<!--			</div>-->
<!--			<div class="citys10" style="display: none">-->
<!--				<span style="font-weight: bold; font-size: 22px; color: #3498db">Wodonga</span>-->
<!--				<br>-->
<!--                <span style="font-size: 16px; line-height: 0.7">-->
<!--	                The city's crime data <span style="font-size: 18px; color: #27ae60; font-weight: bold">dropped</span> significantly from 2012 to 2017, with decreased from 7073 to 6028.-->
<!--	                <br>Especially in the case of property & deception, it is the city with the largest <span style="font-size: 18px; color: #27ae60; font-weight: bold">decline</span>.<br>-->
<!--                </span>-->
<!--			</div>-->
<!--		</div>-->
<!--when user select one choice the alert will show-->
		<div class="alert1" style="display: none">
			<p style="text-align: center; color: red; font-size: 22px; font-weight: bold;">You can't only choose one city!</p>
		</div>
<!--the summary text for each city-->
		<br>
<!--		<div class="result" style="display: none"></div>-->
        <!--title of the chart-->
        <div class="crime_res" style="font-family: Roboto">
            <div class="diagram_title" style="display: none; text-align: center">
                <span>Select One type of Crime </span>
            </div>
            <div id="drop_cri" style="display: none"></div><br>
        <div class="diagram_title" style="display: none">
            <span style="font-size: 20px; font-weight: bold; font-family: Roboto">------ <i class="far fa-chart-bar"> Number of Crimes per 100,000 Residents</i> ------</span>
        </div>
        <!--drop list for select the type of chart-->

        <!--for diagram-->
		<div class="svg2c" style="display: none">
		</div>
        </div>

	</body>

	<script>
        // load the data from php
        var cdata2 = <?php echo json_encode($crime_type); ?>;

	</script>
</html>