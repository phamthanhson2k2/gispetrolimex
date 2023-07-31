$(document).ready(function () {
  // Send Search Text to the server
  $("#search").keyup(function () {
    var searchText = $(this).val();
    if (searchText != "") {
      $.ajax({
        url: "module/search/index.php",
        method: "post",
        data: {
          query: searchText,
        },
        success: function (response) {
          $("#show-list").html(response);
        },
      });
    } else {
      $("#show-list").html("");
    }
  });
  // Set searched text in input field on click of search button
  $(document).on("click", "a", function () {
    $("#search").val($(this).text());
    $("#show-list").html("");
  });
});


/*
function change_cb_congty(url)
{	
	url=url+'/'+document.getElementById('cmb-congty').value;
	window.location= url;
}

$(function() {
    $('#txt-search').autocomplete({
    source: 'module/search/index.php'  
    });
});*/