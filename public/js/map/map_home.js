var station1 = new L.LayerGroup(); var station2 = new L.LayerGroup();
var station3 = new L.LayerGroup(); var station4 = new L.LayerGroup();
var station5 = new L.LayerGroup(); var station6 = new L.LayerGroup();
var station7 = new L.LayerGroup(); var station8 = new L.LayerGroup();
var station9 = new L.LayerGroup(); var station10 = new L.LayerGroup();
var station11 = new L.LayerGroup(); var station12 = new L.LayerGroup();


var loyal = new L.LayerGroup();
var borders = new L.LayerGroup();

var x = 18.290015;
var y = 99.9656525;

var mbAttr = 'Mae Ping Basin',
    mbUrl = 'https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoidmFucGFueWEiLCJhIjoiY2loZWl5ZnJ4MGxnNHRwbHp5bmY4ZnNxOCJ9.IooQB0jYS_4QZvIq7gkjeQ';

var osm = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
    maxZoom: 20,
    subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
    attribution: mbAttr
});

var osmBw = L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
    maxZoom: 20,
    subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
    attribution: mbAttr
});



var runLayer = omnivore.kml(assetPath('kml/PHRAE.kml')).on('ready', function () {
    this.setStyle({
        fillOpacity: 0,
        color: "#466DF3",
        weight: 3
    });
}).addTo(borders);

var pin = L.icon({
    iconUrl: assetPath('images/icon/pin19.png'),
    iconRetinaUrl: assetPath('images/icon/pin19.png'),
    iconSize: [30, 40],
    iconAnchor: [20, 40],
    popupAnchor: [0, 0]
});

var pinMO = L.icon({
    iconUrl: assetPath('images/icon/pin19.png'),
    iconRetinaUrl: assetPath('images/icon/pin19.png'),
    iconSize: [25, 34],
    iconAnchor: [5, 30],
    popupAnchor: [0, 0]
});

var amp = ["เมืองแพร่", "ร้องกวาง", "ลอง", "สูงเม่น", "เด่นชัย", "สอง", "วังชิ้น", "หนองม่วงไข่"];

function checkname(name) {
    return name ?? "- ";
}

function addPin(ampName, i, mo) {
    $.getJSON(assetPath("form/getDataSurvey/" + amp[i]), function (data) {
        for (let j = 0; j < data.length; j++) {
            var x = data[j].lat;
            var y = data[j].long;

            var text = "<font style='font-family: Mitr;' size='3' COLOR=#1AA90A> รหัส :" + data[j].weir_code + "</font><br>";
            var text1 = "<font style='font-family: Mitr;' size='2' COLOR=#466DF3> ฝาย : " + checkname(data[j].weir_name) + " (ลำน้ำ : " + data[j].river + ")</font><br>";
            var text2 = "<font style='font-family: Mitr;' size='2' COLOR=#466DF3>ที่ตั้ง : " + data[j].weir_village + " ต." + data[j].weir_tumbol + " อ." + data[j].weir_district + "</font><br>";
            var text3 = "<br><table align='center'><tr><td><a href='" + assetPath("report/pdf/" + data[j].weir_code) + "' target='_blank'><button class='btn btn-primary btn-sm waves-effect waves-light'><i class='feather icon-sidebar'></i> รายงาน</button></a></td><td><a href='" + assetPath("pdf/" + data[j].weir_code) + "' target='_blank'><button class='btn btn-primary btn-sm waves-effect waves-light'><i class='feather icon-eye'></i> แบบสำรวจ</button></a></td><td><a href='" + assetPath("photo/" + data[j].weir_code) + "' target='_blank'><button class='btn btn-primary btn-sm waves-effect waves-light'><i class='feather icon-image'></i> ภาพประกอบ</button></a></td></tr></table>";

            L.marker([x, y], { icon: mo === 0 ? pinMO : pin }).addTo(ampName).bindPopup(text + text1 + text2 + text3);
        }
    });
}

// Media Query
var mo = window.matchMedia("(max-width: 700px)").matches ? 0 : 1;

// เพิ่ม Pin
for (let i = 0; i < amp.length; i++) {
    window["station" + (i + 1)] = new L.LayerGroup();
    addPin(window["station" + (i + 1)], i, mo);
}

// Layers Control
var baseTree = {
    label: 'BaseLayers',
    noShow: true,
    children: [
        { label: ' แผนที่ภูมิประเทศ (Streets)', layer: osm },
        { label: ' แผนที่ภาพถ่ายผ่านดาวเทียม (Satellite)', layer: osmBw },
    ]
};

var children = [];
for (let i = 0; i < amp.length; i++) {
    children.push({
        label: " " + amp[i],
        layer: window["station" + (i + 1)]
    });
}

var overlays = [{
    label: ' ข้อมูลฝายรายอำเภอ',
    selectAllCheckbox: true,
    children: children
}];


var map = L.map('map', {
    layers: [osm, station1, station2, station3, station4, station5, station6, station7, station8, station9, station10, station11, station12, borders],
    center: [x, y],
    zoom: 9
});

var ctl = L.control.layers.tree(baseTree, null);
ctl.addTo(map).collapseTree().expandSelected();
ctl.setOverlayTree(overlays).collapseTree(true).expandSelected(true);

function assetPath(path) {
    const base = document.querySelector('meta[name="asset-path"]').getAttribute('content');
    return new URL(path, base).href;
}
