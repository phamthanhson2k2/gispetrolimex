
var osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png?{foo}', 
{foo: 'bar', attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'});

var popup = L.popup();

function onMapClick(e) {
    popup
        .setLatLng(e.latlng)
        .setContent("Toạ độ " + e.latlng.toString())
        .openOn(map);
}

//map.on('click', onMapClick);

var ch1 = L.marker([10.04745, 105.77828]).bindTooltip("Cửa Hàng Xăng dầu Petrolimex số 1", {permanent: true, direction: 'right'});
var ch2 = L.marker([10.02327, 105.76969]).bindTooltip("Cửa Hàng Xăng dầu Petrolimex số 2", {permanent: true, direction: 'right'});
var ch3 = L.marker([10.059438, 105.766228]).bindTooltip("Cửa Hàng Xăng dầu Petrolimex số 3", {permanent: true, direction: 'right'});
var ch5 = L.marker([10.0449, 105.78065]).bindTooltip("Cửa Hàng Xăng dầu Petrolimex số 5", {permanent: true, direction: 'right'});
var ch9 = L.marker([10.04433, 105.73514]).bindTooltip("Cửa Hàng Xăng dầu Petrolimex số 9", {permanent: true, direction: 'right'});
var ch10 = L.marker([10.01548, 105.75994]).bindTooltip("Cửa Hàng Xăng dầu Petrolimex số 10", {permanent: true, direction: 'right'});
var ch13 = L.marker([10.01012, 105.75144]).bindTooltip("Cửa Hàng Xăng dầu Petrolimex số 13", {permanent: true, direction: 'right'});
var ch16 = L.marker([10.03747, 105.75924]).bindTooltip("Cửa Hàng Xăng dầu Petrolimex số 16", {permanent: true, direction: 'right'});
var ch17 = L.marker([10.01883, 105.76235]).bindTooltip("Cửa Hàng Xăng dầu Petrolimex số 17", {permanent: true, direction: 'right'});
var cty = L.marker([10.01785, 105.78662]).bindTooltip("Công Ty Dịch Vụ Xăng Dầu Petrolimex Cần Thơ", {permanent: true, direction: 'right'});

var petrolStations = L.layerGroup([ch2, ch1, ch3, ch5, ch9, ch10, ch13, ch16, ch17, cty]);

var baseMaps = {
    "Bản đồ nền": osm
};

var overlayMaps = {
    "Cây Xăng": petrolStations
};

var map = L.map('map',{center: [10.0338, 105.7867], zoom: 13, layers: [osm, petrolStations]});

var layerControl = L.control.layers(baseMaps, overlayMaps).addTo(map);
// Creating scale control
var scale = L.control.scale().addTo(map);
L.control.center.addTo(map);


/*
drawnItems = L.featureGroup().addTo(map);
var drawControl = new L.Control.Draw({
    edit: {
        featureGroup: drawnItems,
    },
});

var getName = function(layer) {
    var name = prompt('please, enter the geometry name', 'geometry name');
    return name;
};

map.addControl(drawControl);
map.on(L.Draw.Event.CREATED, function(e) {
    var layer = e.layer; 
    var name = getName(layer);
    if (name == 'geometry name') {
        layer.bindPopup('-- no name provided --');
    } else if (name == '') {
        layer.bindPopup('-- no name provided --');
    } else {
        layer.bindTooltip(name, {permanent:true, direction:'top'})
    };
    drawnItems.addLayer(layer);
});
*/