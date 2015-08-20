
map.on('draw:edited', function (e) {
    var layers = e.layers;
    var shape = layers.toGeoJSON();
    var shape_for_db = JSON.stringify(shape);
    var i = 0;
    var id = '';
    var newLat = '';
    var newLng = '';
    var strada = '';
    var civico = '';

    layers.eachLayer(function (layer) {
        //console.log(i);
        i++;
        //console.log(i);
        //do whatever you want, most likely save back to db

        if (i==1){}
        else {
          id      +='|';
          newLat  +='|';
          newLng  +='|';
          strada  +='|';
          civico  +='|';
        }

        id      += layer.feature.properties.id;
        newLat  += layer._latlng.lat;
        newLng  += layer._latlng.lng;
        strada  += layer.feature.properties.strada;
        civico  += layer.feature.properties.civico;

        //console.log(layer);
        console.log("ID: "+layer.feature.properties.id);
        //console.log("LAT: "+layer.feature.geometry.coordinates[1]);
        //console.log("newLAT: "+layer._latlng.lat);
        //console.log("Strada: "+layer.feature.properties.strada);
        //console.log("Civico: "+layer.feature.properties.civico);

    });
    console.log(id);
    $.getJSON("crea_civici_mod.php?id="+id+"&strada="+strada+"&civico="+civico+"&lat="+newLat+"&lng="+newLng+"");
    console.log(shape_for_db);
    //file2geojson.push(shape_for_db);
    //https://jhoyimperial.wordpress.com/2008/07/28/parsing-json-data-from-php-using-jquery/
    //drawnItems.clearLayers();
    drawnItems.removeLayer();
    carica_geojson();
