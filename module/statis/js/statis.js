function change_cb_huyen(url)
{	
	url=url+'/'+document.getElementById('cmb-huyen').value+'/'+document.getElementById('cmb-congty').value;
	window.location= url;
}

function change_cb_congty(url)
{	
	url=url+'/'+document.getElementById('cmb-huyen').value+'/'+document.getElementById('cmb-congty').value;
	window.location= url;
}