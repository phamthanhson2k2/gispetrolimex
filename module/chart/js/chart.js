google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback();
function drawMonthwiseChart(chart_data, chart_main_title)
{
	var jsonData = chart_data;
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Tháng');
    data.addColumn('number', 'Số liệu Trạm');
    $.each(jsonData, function(i, jsonData){
        var tentram = jsonData.cty_ten;
        var soluongtram = parseFloat($.trim(jsonData.cty_mst));
        data.addRows([[tentram, soluongtram]]);
    });
	/*var data = google.visualization.arrayToDataTable([
          ['ColumnName', 'Petrolimex', 'Orient Oil', 'PetroTime', 'Dầu khí VT', 'PVOil', 'Quân Đội', 'NSH'], 
		  ['Ninh Kiều',  1, 2, 3, 4, 5, 6, 7], 
		  ['Cái răng', 	 1, 2, 3, 4, 5, 6, 7], 
		  ['Bình Thuỷ',  3, 5, 9, 4, 0, 5, 6], 
		  ['Cờ đỏ', 	 5, 5, 3, 5, 1, 8, 5], 
		  ['Phong Điền', 4, 6, 5, 6, 9, 2, 7], 
		  ['Thới Lai',   2, 7, 9, 2, 7, 7, 5], 
		  ['Ô Môn',      4, 8, 9, 3, 6, 6, 2]
		  ]);*/
    var options = {
        title: chart_main_title,
        hAxis: {title: "Trạm bán lẻ"},
        vAxis: {title: 'Số lượng Trạm',  titleTextStyle: {color: 'blue'}},
		seriesType: 'bars'
    };
	
    <!--var chart = new google.visualization.ColumnChart(document.getElementById('chart_area'));-->
	var chart = new google.visualization.ComboChart(document.getElementById('chart_area'));
    chart.draw(data, options);
}

function load_monthwise_data(bien, title)
{
	var tenHuyen = $("#cmbHuyen :selected").text();
    var temp_title = title + ' '+tenHuyen+'';
    $.ajax({
        url:"module/chart/index.php",
        method:"POST",
        data:{cmbHuyen:bien},
        dataType:"JSON",
        success:function(data)
        {
            drawMonthwiseChart(data, temp_title);
        }
    });
}

$(document).ready(function(){
    $('#cmbHuyen').change(function(){
        var cmbHuyen = $(this).val();
        if(cmbHuyen != '')
        {
            load_monthwise_data(cmbHuyen, 'Trạm bán lẻ xăng dầu của');
        }
    });

});
/*
function change_cb_congty(url)
{	
	url=url+'/'+document.getElementById('cmb-huyen').value+'/'+document.getElementById('cmb-congty').value;
	window.location= url;
}*/

