google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback();
function drawMonthwiseChart(chart_data, chart_main_title)
{
	var jsonData = chart_data;
	var data = new google.visualization.DataTable();
      data.addColumn('string', 'Year');
      data.addColumn('number', 'Số liệu trạm');
      //dataTable.addColumn('number', 'Expenses');

      // Populate dataTable dynamically
      for (var i = 0; i < jsonData.length; i++) {
        var row = [];
        row.push(jsonData[i].cty_ten);
        row.push(parseFloat(jsonData[i].cty_mst));
        //row.push(parseFloat(jsonData[i].expenses));
        data.addRow(row);
      }
	
	/*
	var wrapper = new google.visualization.ChartWrapper({
	  chartType: 'ColumnChart',
	  dataTable: [
	  				['', 'Petrolimex', 'Orient Oil', 'PetroTime', 'Dầu khí VT', 'PVOil', 'Quân Đội', 'NSH'],
					['',  1, 2, 3, 4, 5, 6, 7]
					],
	  options: {'title': 'Countries'},
	  containerId: 'chart_area'
	});
	wrapper.draw();*/
	var options = {
        title: chart_main_title,
        hAxis: {title: "Trạm bán lẻ", titleTextStyle: {color: 'blue'}},
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

