var map;
var layer_dr;
var layer_cde;
var layer_wilaya;
var wilaya = [];
var map_location;
var printer;
$(document).ready(function () {
    map = L.map("map", {
        zoomControl: false
    });
    map.touchZoom.disable();
    map.doubleClickZoom.disable();
    map.scrollWheelZoom.disable();
    map.boxZoom.disable();
    map.keyboard.disable();
    map.dragging.disable();
    //adjust map view
    map.setView(new L.LatLng(28.285033, 1.911621), 6);
    //add map tile (fond de carte)
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 20
        , attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    });
    map.on("click", function (e) {
        // console.log("sdqdssssssssss" + map.getCenter())
    })
    map.attributionControl.setPrefix(false);
    // L.control.bigImage({position: 'topright'}).addTo(map);
    printer = L.easyPrint({
        // tileLayer: tiles,
        // sizeModes: ['Current'],
        // sizeModes: ['Current', 'A4Landscape', 'A4Portrait'],
        filename: 'CTC implantations',
        exportOnly: true,
        hideClasses: ['leaflet-control-easyPrint'],
        hideControlContainer: false,
        customWindowTitle: 'CTC implantations',
        hidden: true
    }).addTo(map);
    // loading GeoJSON file -
    $.getJSON("geojson/wilayas.geojson", function (data) {
        // L.geoJson function is used to parse geojson file and load on to map
        layer_cde = L.geoJSON(data, {
            style: function (feature) {
                wilaya.push({
                    code: feature.properties.code
                    , name: feature.properties.name
                })
                $("#wilaya").append(new Option(feature.properties.code + " : " + feature.properties.name, feature.properties.code));
                return set_cde_style(feature.properties.cde)
            }
            , onEachFeature: function (feature, featureLayer) {
                featureLayer.on({
                    click: function () {
                        $('#nav-dr-tab').hide()
                        set_info_cde(feature.properties.cde)
                    }
                });
                featureLayer.on('mouseover', function () {
                    this.setStyle({
                        'fillOpacity': 0.8
                    });
                });
                featureLayer.on('mouseout', function () {
                    // layer_cde.resetStyle(this);
                    this.setStyle({
                        'fillOpacity': 1
                    });
                });
                featureLayer.bindTooltip(feature.properties.name, {
                    className: 'leaflet-tooltip-own'
                    , direction: 'top'
                });
            }
        });

        layer_dr = L.geoJSON(data, {
            style: function (feature) {
                // return set_dr_style(feature.properties.nom_dr)
                return set_dr_style(feature.properties.nom_dr)
            }
            , pointToLayer: function (feature, latlng) {
                marker_icon = L.icon({
                    iconUrl: "../img/building2.png",
                    shadowUrl: "https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.4/images/marker-shadow.png",
                    iconSize: [60, 6],
                    iconAnchor: [20, 40],
                    shadowSize: [40, 40],
                    // popupAnchor: [1, -34],
                    // shadowSize: [40, 40],
                    // iconUrl: "https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png",
                    // shadowUrl: "https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.4/images/marker-shadow.png",
                    // iconSize: [25, 41],
                    // iconAnchor: [12, 41],
                    // popupAnchor: [1, -34],
                    // shadowSize: [41, 41],
                });
                marker = L.marker([36.74030188979503, 3.0963326523976655], {
                    draggable: false,
                    bounceOnAdd: false,
                    bounceOnAddOptions: {
                        duration: 1000,
                        height: 800,
                        function() {
                            // bindPopup(myPopup).openOn(map);
                        },
                    },
                    // icon: marker_icon,
                })
                return marker;
            }
            , onEachFeature: function (feature, featureLayer) {
                featureLayer.on({
                    click: function () {
                        // set_info(feature.properties.nom_dr)
                        console.log("sds" + feature.properties.nom_dr)
                        var myModal = new bootstrap.Modal(document.getElementById(feature.properties.nom_dr), {}).show()
                    }
                });
                featureLayer.on('mouseover', function () {
                    this.setStyle({
                        'fillOpacity': 0.8
                    });
                });
                featureLayer.on('mouseout', function () {
                    // layer_dr.resetStyle(this);
                    this.setStyle({
                        'fillOpacity': 1
                    });
                });
                featureLayer.bindTooltip(feature.properties.name, {
                    className: 'leaflet-tooltip-own'
                    , direction: 'top'
                });
            }
        });

        layer_wilaya = L.geoJSON(data, {
            style: function (feature) {
                // return set_dr_style(feature.properties.nom_dr)
                // return set_wilaya_style()
                return set_dr_style(feature.properties.nom_dr)
                // return {
                //     weight: 1,
                //     fillOpacity: 1,
                //     fillColor: "#0072cb",
                //     color: "white",
                // };
            },
            onEachFeature: function (feature, featureLayer) {
                featureLayer.on({
                    click: function () {
                        // console.log(feature.properties);
                        $('#nav-dr-tab').show()
                        set_info_agence_dr(feature.properties)
                        // set_info_agence(feature.properties.name)
                    }
                });
                featureLayer.on('mouseover', function () {
                    this.setStyle({
                        'fillOpacity': 0.8
                    });
                });
                featureLayer.on('mouseout', function () {
                    this.setStyle({
                        'fillOpacity': 1
                    });
                });
                featureLayer.bindTooltip(feature.properties.name, {
                    className: 'leaflet-tooltip-own'
                    , direction: 'top'
                });
            }
        });

        layer_wilaya.addTo(map);
        set_dr_legende()
    });
});

function set_info_cde(params) {
    $.ajax({
        type: "get"
        , url: "get-info-cde"
        , data: {
            structure: params
        }
        , dataType: "json"
        , success: function (response) {
            var structure = response
            console.log('okok', structure);
            set_modal_info(structure)
        }
    });
}

function set_info_agence(params) {
    $.ajax({
        type: "get"
        , url: "get-info-agence"
        , data: {
            wilaya: params
        }
        , dataType: "json"
        , success: function (response) {
            var structures = response
            if (structures.length > 1) {
                var myModal = new bootstrap.Modal(document.getElementById('multiplewilaya'), {});
                var modalTitle = $('#multiplewilaya .modal-title')
                modalTitle.html(params + ' ( ' + structures.length + ' Agences ) ')
                $('#multiple_result').html('')
                structures.forEach(structure => {
                    var $input = $('<button class="btn btn-outline-secondary" id="btn' + structure.id + '" >' + structure.Agence + '</button>');
                    $input.appendTo($("#multiple_result"));
                    $("#btn" + structure.id).on("click", function () {
                        set_modal_info(structure,)
                    });
                });
                myModal.show();
            }
            else
                set_modal_info(structures)
        }
    });
}

function set_info_agence_dr(params) {
    $.ajax({
        type: "get"
        , url: "get-info-agence-dr"
        , data: {
            wilaya: params
        }
        , dataType: "json"
        , success: function (res) {
            if (res.structures.length) {
                var modalTitle = $('#multiplewilaya .modal-title')
                modalTitle.html('(' + res.structures.length + ' Agences )')
                $('#multiple_result').html('')
                res.structures.forEach(structure => {
                    var $input = $('<button class="btn btn-outline-secondary" id="btn' + structure.id + '" >' + structure.Agence + '</button>');
                    $input.appendTo($("#multiple_result"));
                    $("#btn" + structure.id).on("click", function () {
                        $('#multiplewilaya').modal('hide');
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                        set_modal_info(structure, res.direction)
                    });
                });
                new bootstrap.Modal($('#multiplewilaya')).show()
            } else {
                set_modal_info(res.structures, res.direction)
            }
        }
    });
}

function set_modal_info(structure, direction) {
    console.log('bonjour', structure, direction);

    var myModal = new bootstrap.Modal($('#exampleModal'));
    var modalTitle = $('#exampleModal .modal-title')
    modalTitle.html(structure.Agence)
    $('#map-location-error').html('')
    $('#location').html(structure.Wilaya)
    $('#str_mail').html(structure.Email)
    $('#str_tel').html(structure.Telephone)
    $('#str_fax').html(structure.Fax)
    $('#str_adr').html(structure.Adresse)
    $('#str_adr').attr("href", structure.Localisation)
    $('#str_directeur').attr('src', structure.Photo_Directeur != "" ? '/files/directeur/' + structure.Photo_Directeur : 'img/anonyme.png');
    $('.galerie-photo1').attr('src', '/files/agence/' + structure.Photo_1);
    $('.galerie-photo2').attr('src', '/files/agence/' + structure.Photo_2);
    $('.galerie-photo3').attr('src', '/files/agence/' + structure.Photo_3);
    $('#str_nom_directeur').html(structure.Directeur)
    $('#str_fonction_directeur').html(structure.Fonction_dir);
    $('#content-info').show();
    $('#content-location').hide();
    $('#content-location').data("id", structure.coordonnées)
    $('#content-location').hide();
    $('#dr_mail').html(direction?.Email);
    $('#dr_tel').html(direction?.Telephone);
    $('#dr_fax').html(direction?.Fax);
    $('#dr_adr').html(direction?.Adresse);
    $('#dr_directeur').attr('src', direction?.Photo_Directeur != "" ? '/files/directeur/' + direction?.Photo_Directeur : 'img/anonyme.png');
    $('#dr_nom_directeur').html(direction?.Directeur);
    $('#dr_fonction_directeur').html(direction?.Fonction_dir);
    $('#nav-home-tab').trigger('click');
    myModal.show();
    // set_map_location() ;
    // $('#str_directeur').html(structure.Adresse)
}

function set_map_location(latlg, map_container) {
    map_location = L.map(map_container);
    //adjust map view
    map_location.setView(new L.LatLng(latlg[0], latlg[1]), 12);
    //add map tile (fond de carte)
    osm = L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
        maxZoom: 20,
        attribution: '© Openstreetmap France | © OpenStreetMap contributors',
    });
    L.control.layers({
        'OpenStreetMap': osm.addTo(map_location),
        'Google': L.tileLayer('http://www.google.cn/maps/vt?lyrs=s@189&gl=cn&x={x}&y={y}&z={z}', {
            attribution: 'google',
            maxZoom: 20
        })
    }).addTo(map_location);
    marker_icon = L.icon({
        iconUrl: "../img/building2.png",
        shadowUrl: "https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.4/images/marker-shadow.png",
        iconSize: [40, 40],
        iconAnchor: [20, 40],
        shadowSize: [40, 40],
        // popupAnchor: [1, -34],
        // shadowSize: [40, 40],
        // iconUrl: "https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png",
        // shadowUrl: "https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.4/images/marker-shadow.png",
        // iconSize: [25, 41],
        // iconAnchor: [12, 41],
        // popupAnchor: [1, -34],
        // shadowSize: [41, 41],
    });
    marker = L.marker(latlg, {
        draggable: false,
        bounceOnAdd: false,
        bounceOnAddOptions: {
            duration: 1000,
            height: 800,
            function() {
                bindPopup(myPopup).openOn(map);
            },
        },
        icon: marker_icon,
    }).addTo(map_location);
}
// $('#wilaya').change(function () {
//     layer_cde.addTo(map)
// });
$("input[name='btnradio']").change(function (e) {
    // e.preventDefault();
    map.eachLayer(function (layer) {
        map.removeLayer(layer);
    });
    if (legend instanceof L.Control) {
        map.removeControl(legend);
    }
    var value = e.target.value;
    switch (value) {
        case "agence":
            layer_wilaya.addTo(map)
            set_dr_legende()
            break;
        case "cde":
            set_cde_layer()
            break;
        case "direction":
            set_dr_layer()
            break;
        default:
            break;
    }
    if (selected_wilaya != null) {
        $('#wilaya').trigger({
            type: 'select2:select',
            params: {
                data: selected_wilaya
            }
        });
    } else {
        $('#wilaya').trigger({
            type: 'select2:clear',
        });
    }
});

function set_cde_layer() {
    layer_cde.addTo(map)
    set_cde_legende()
}
function set_dr_layer() {
    layer_dr.addTo(map)
    // console.log(layer_dr);
    set_dr_legende()
}

//radio input on click ?
function set_cde_style(cde) {
    var style = {
        color: "transparent"
        , weight: 1
        // , fillColor: "lightgrey"
        , fillOpacity: 1
    }
    switch (cde) {
        case 'CDE ALGER':
            style.fillColor = '#27a5efc4';
            style.color = "white";
            break;
        case 'CDE ANNABA':
            style.fillColor = '#0072bcc4';
            style.color = "white";
            break;
        case 'CDE BEJAIA':
            style.fillColor = '#796475';
            style.color = "white";
            break;
        case 'CDE BOUSSAADA':
            style.fillColor = '#301505c4';
            style.color = "white";
            break;
        case 'CDE CONSTANTINE':
            style.fillColor = '#d48b2dc9';
            style.color = "white";
            break;
        case 'CDE SETIF':
            style.fillColor = '#a79a39e8';
            style.color = "white";
            break;
        case 'CDE TIZI OUZOU':
            style.fillColor = '#f9c50ae3';
            style.color = "white";
            break;
        case 'CDE TLEMCEN':
            style.fillColor = '#673AB7c4';
            style.color = "white";
            break;
        case 'CDE OUARGLA':
            style.fillColor = '#347930c4';
            style.color = "white";
            break;
        case 'CDE LAGHOUAT':
            style.fillColor = '#a117c1c4';
            style.color = "white";
            break;
        case 'CDE BATNA':
            style.fillColor = '#980a0ac4';
            style.color = "white";
            break;
        case 'CDE EL BAYADH':
            style.fillColor = '#3114d0c4';
            style.color = "white";
            break;
        case 'CDE CHLEF':
            style.fillColor = '#639c16c4';
            style.color = "white";
            break;
        case 'CDE KHENCHELA':
            style.fillColor = '#c16778c9';
            style.color = "white";
            break;
        case 'CDE BECHAR':
            style.fillColor = '#bb4e0eC4';
            style.color = "white";
            break;
        case 'CDE TIPAZA':
            style.fillColor = '#e51717C4';
            style.color = "white";
            break;
        case 'CDE ORAN':
            style.fillColor = '#ef2c27c4';
            style.color = "white";
            break;
        case 'CDE SKIKDA':
            style.fillColor = '#ff8000';
            style.color = "white";
            break;
    }
    return style;
}

function set_dr_style(nom_dr) {
    var style = {
        color: "transparent"
        , weight: 1
        // , fillColor: "lightgrey"
        , fillOpacity: 1
    }
    switch (nom_dr) {
        case 'DRC':
            style.fillColor = '#54C2E8c4';
            style.color = "white";
            break;
        case 'DRE':
            style.fillColor = '#E69509c4';
            style.color = "white";
            break;
        case 'DRO':
            style.fillColor = '#309813c4';
            style.color = "white";
            break;
        case 'DRSO':
            style.fillColor = '#ef2c27c4';
            style.color = "white";
            break;
        case 'DRSE':
            style.fillColor = '#014898c4';
            style.color = "white";
            break;
    }
    return style;
}

// localStorage.clear();//this clears the localStorage completely
var colors = [];
//    colors = JSON.parse(localStorage.getItem("colors")) ;
var my_colors = [];
const set_wilaya_style = () => {
    var color = "#" + Math.floor(Math.random() * 16777215).toString(16).padStart(6, '0').toUpperCase();
    while (colors.includes(color)) {
        color = "#" + Math.floor(Math.random() * 16777215).toString(16).padStart(6, '0').toUpperCase();
    }
    if (colors.length <= 58)
        colors.push(color)
    //  my_colors.push("'"+color+"'")
    if (colors.length > 58) {
        localStorage.setItem('colors', JSON.stringify(colors))
    }
    var style;
    // colors.forEach(color => {
    //         style= {
    //             color: "transparent"
    //             , weight: 1
    //                 // , fillColor: "lightgrey"
    //             , fillOpacity: 1
    //             , fillColor : color
    //             , color : "white"
    //         }
    //     });
    style = {
        color: "transparent"
        , weight: 1
        // , fillColor: "lightgrey"
        , fillOpacity: 1
        , fillColor: color
        , color: "white"
    }
    return style;
}
/*Legend specific*/
var legend;
function set_dr_legende() {
    legend = L.control({
        position: "topleft"
    });
    legend.onAdd = function (map) {
        var div = L.DomUtil.create("div", "legend mt-5");
        div.id = "legend_dr";
        div.innerHTML += "<h4>Légende</h4>";
        div.innerHTML += '<i style="background: #54C2E8c4"></i><span>CTC Direction Régionale Centre</span><br>';
        div.innerHTML += '<i style="background: #E69509c4"></i><span>CTC Direction Régionale Est</span><br>';
        div.innerHTML += '<i style="background: #309813c4"></i><span>CTC Direction Régionale Ouest</span><br>';
        div.innerHTML += '<i style="background: #014898c4"></i><span>CTC Direction Régionale Sud Est</span><br>';
        div.innerHTML += '<i style="background: #ef2c27c4"></i><span>CTC Direction Régionale Sud Ouest</span><br>';
        return div;
    };
    legend.addTo(map);
}

function set_cde_legende() {
    legend = L.control({
        position: "topright"
    });
    legend.onAdd = function (map) {
        var div = L.DomUtil.create("div", "legend mt-5");
        // div.id = "legend_dr";
        div.innerHTML += "<h4>Légende</h4>";
        div.innerHTML += '<i style="background: #27a5ef"></i><span>CDE ALGER</span><br>';
        div.innerHTML += '<i style="background: #0072bc"></i><span>CDE ANNABA</span><br>';
        div.innerHTML += '<i style="background: #980a0a"></i><span>CDE BATNA</span><br>';
        div.innerHTML += '<i style="background: #bb4e0e"></i><span>CDE BECHAR</span><br>';
        div.innerHTML += '<i style="background: #796475"></i><span>CDE BEJAIA</span><br>';
        div.innerHTML += '<i style="background: #301505"></i><span>CDE BOUSSAADA</span><br>';
        div.innerHTML += '<i style="background: #639c16"></i><span>CDE CHLEF</span><br>';
        div.innerHTML += '<i style="background: #d48b2d"></i><span>CDE CONSTANTINE</span><br>';
        div.innerHTML += '<i style="background: #3114d0"></i><span>CDE EL BAYADH</span><br>';
        div.innerHTML += '<i style="background: #c16778"></i><span>CDE KHENCHELA</span><br>';
        div.innerHTML += '<i style="background: #a117c1"></i><span>CDE LAGHOUAT</span><br>';
        div.innerHTML += '<i style="background: #ef2c27"></i><span>CDE ORAN</span><br>';
        div.innerHTML += '<i style="background: #347930"></i><span>CDE OUARGLA</span><br>';
        div.innerHTML += '<i style="background: #a79a39"></i><span>CDE SETIF</span><br>';
        div.innerHTML += '<i style="background: #ff8000"></i><span>CDE SKIKDA</span><br>';
        div.innerHTML += '<i style="background: #f9c50a"></i><span>CDE TIZIOUZOU</span><br>';
        div.innerHTML += '<i style="background: #673AB7"></i><span>CDE TLEMCEN</span><br>';
        div.innerHTML += '<i style="background: #e51717"></i><span>CDE TIPAZA</span><br>';

        return div;
    };
    legend.addTo(map);
}

function set_cde_legende__() {
    // var div = L.DomUtil.create("div", "legend");
    var div_legend = document.createElement("div");
    div_legend.className = "col-lg-2 mt-5";
    div_legend.id = "legend_cde";
    var div = document.createElement("div");
    div.className = "legend single-content";
    div.innerHTML += "<h4>Légende</h4>";
    div.innerHTML += '<i style="background: #27a5ef"></i><span>CDE ALGER</span><br>';
    div.innerHTML += '<i style="background: #0072bc"></i><span>CDE ANNABA</span><br>';
    div.innerHTML += '<i style="background: #796475"></i><span>CDE BEJAIA</span><br>';
    div.innerHTML += '<i style="background: #301505"></i><span>CDE BOUSSAADA</span><br>';
    div.innerHTML += '<i style="background: #d48b2d"></i><span>CDE CONSTANTINE</span><br>';
    div.innerHTML += '<i style="background: #a79a39"></i><span>CDE SETIF</span><br>';
    div.innerHTML += '<i style="background: #f9c50a"></i><span>CDE TIZI OUZOU</span><br>';
    div.innerHTML += '<i style="background: #673AB7"></i><span>CDE TLEMCEN</span><br>';
    div.innerHTML += '<i style="background: #347930"></i><span>CDE OUARGLA</span><br>';
    div.innerHTML += '<i style="background: #a117c1"></i><span>CDE LAGHOUAT</span><br>';
    div.innerHTML += '<i style="background: #980a0a"></i><span>CDE BATNA</span><br>';
    div.innerHTML += '<i style="background: #3114d0"></i><span>CDE EL BAYADH</span><br>';
    div.innerHTML += '<i style="background: #639c16"></i><span>CDE CHLEF</span><br>';
    div.innerHTML += '<i style="background: #c16778"></i><span>CDE KHENCHELA</span><br>';
    div.innerHTML += '<i style="background: #bb4e0e"></i><span>CDE BECHAR</span><br>';
    div.innerHTML += '<i style="background: #e51717"></i><span>CDE TIPAZA</span><br>';
    div.innerHTML += '<i style="background: #ef2c27"></i><span>CDE ORAN</span><br>';
    document.getElementById("legend_div").appendChild(div_legend);
    document.getElementById("legend_cde").appendChild(div);
}

$('#location-href').click(function (e) {
    e.preventDefault();
    var coord = $('#content-location').data('id');
    if (coord != "") {
        if (map_location != null)
            map_location.remove();
        var latlg = JSON.parse("[" + coord + "]");
        set_map_location(latlg, 'map-location');
        setTimeout(function () { map_location.invalidateSize() }, 300);
        $('.map-location').show();
    }
    else {
        $('.map-location-error').html("<h3 class='text-center'> La carte n'est pas disponible pour le moment</h3><h1 class='text-center' style='font-size: 6em;'><i class='fa fa-map-marked'></i></h1>");
        $('.map-location').hide();
        $('.map-location-error').show();
    }
    $('#content-info').toggle();
    $('#content-location').toggle();
    // $('.map-location').toggle();
});

function display_location(e, dir) {
    var map_container = "map-location" + dir;
    var coord = $(e).data('coordinates');
    // console.log('szdq'+coord)
    if (coord != "") {
        if (map_location != null)
            map_location.remove();
        var latlg = JSON.parse("[" + coord + "]");
        set_map_location(latlg, map_container);
        setTimeout(function () { map_location.invalidateSize() }, 300);
        $('#' + map_container).toggle();
    }
    else {
        $('.map-location-error' + dir).html("<h3 class='text-center'> La carte n'est pas disponible pour le moment</h3><h1 class='text-center' style='font-size: 6em;'><i class='fa fa-map-marked'></i></h1>");
        $('#map-location' + dir).hide();
        $('#map-location-error' + dir).show();
    }
    $('#content-info' + dir).toggle();
    $('#content-location' + dir).toggle();
}
function highlightLayer(layer) {
    layer.setStyle({
        fillColor: '#FF0000',
        weight: 5,
        opacity: 0.65
    });
}

$('#select-box').on('change', function () {
    var layer = getLayerFromSelectBox();
    highlightLayer(layer);
});
var selected_wilaya;
// $('#wilaya').on('select2:open', function (e) {
// if (selected_wilaya!=null) {
//     $('#wilaya').trigger({
//         type: 'select2:select',
//         params: {
//             data: selected_wilaya
//         }
//     });
// }
// })
$('#wilaya').on('select2:select', function (e) {
    var value = e.params.data.id;
    selected_wilaya = e.params.data;
    // console.log(value);
    map.eachLayer(function (layer) {
        if (layer.feature != null) {
            // check if this is the selected layer
            if (layer.feature.properties.code == value) {
                // set the layer style to highlight it
                layer.setStyle({
                    color: 'black'
                    , weight: 3
                    , fillOpacity: 0.6
                });
                layer.openTooltip()
                layer.bringToFront();
            } else {
                layer.closeTooltip();
                // remove any previous highlighting
                layer.setStyle({
                    color: 'white'
                    , weight: 1
                    , fillOpacity: 1
                });
            }
        }
    });
});
$('#wilaya').on('select2:clear', function (e) {
    map.eachLayer(function (layer) {
        if (layer.feature != null) {
            layer.closeTooltip();
            // remove any previous highlighting
            layer.setStyle({
                color: 'white'
                , weight: 1
                , fillOpacity: 1
            });
        }
    });
    selected_wilaya = null
});
// listen for changes on the select box
var selectBox = document.getElementById('wilaya');
selectBox.addEventListener('click', function () {
    console.log('dfdfdf' + selectBox.value)
    // loop through all the layers in the feature group
    map.eachLayer(function (layer) {
        if (layer.feature != null) {
            console.log("sdcsdsd" + layer.feature.properties.code)
            // check if this is the selected layer
            if (layer.feature.properties.code == selectBox.value) {
                // set the layer style to highlight it
                layer.setStyle({
                    color: 'black'
                    , weight: 3
                    , fillOpacity: 0.6
                });
                layer.openTooltip()
                layer.bringToFront();
            } else {
                layer.closeTooltip();
                // remove any previous highlighting
                layer.setStyle({
                    color: 'white'
                    , weight: 1
                    , fillOpacity: 1
                });
            }
        }
    });
});
function manualPrint() {
    printer.printMap('CurrentSize')
}
