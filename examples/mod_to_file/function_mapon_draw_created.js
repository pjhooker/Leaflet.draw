map.on('draw:created',function(e) {
    e.layer.addTo(drawnItems);
    var type = e.layerType;
    var layer = e.layer;
    drawnItems.addLayer(layer);
    var newLat = layer._latlng.lat;
    var newLng = layer._latlng.lng;
    var id = layer._leaflet_id;
    var strada = 'nd';
    var civico = 'nd';
    console.log(toWKT(layer));
    console.log(layer);
    $.getJSON("crea_civici_add.php?id="+id+"&strada="+strada+"&civico="+civico+"&lat="+newLat+"&lng="+newLng+"");
});
