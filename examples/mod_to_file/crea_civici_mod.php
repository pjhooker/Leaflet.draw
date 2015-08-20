<?php
$id=$_GET['id'];

$strada=$_GET['strada'];
$civico=$_GET['civico'];
$lat=$_GET['lat'];
$lng=$_GET['lng'];

$ids = explode("|", $id);

$strade = explode("|", $strada);
$civici = explode("|", $civico);
$tipi = explode("|", $tipo);
$lats = explode("|", $lat);
$lngs = explode("|", $lng);

foreach($ids as $collection){

  // richiama il file geojson con delle geometrie presenti
  $inp = file_get_contents('civici.geojson');
  // decodifica il file geojson
  $tempArray = json_decode($inp, true);

  $newArray = array('type' => 'FeatureCollection','features' => array());

  foreach ($tempArray['features'] as $features) {

    $thisLAT=$features['geometry']['coordinates'][1];
    $thisLNG=$features['geometry']['coordinates'][0];
    $thisTipo=$features['properties']['tipo'];
    $thisCivico=$features['properties']['civico'];
    $thisStrada=$features['properties']['strada'];
    $thisID=$features['properties']['id'];
    if($features['properties']['id']==$collection){$thisTipo='eliminato';}
    else{}
    // preprara l'array strutturato come definito per i file geojson
    $feature = array(
      'type' => 'Feature',
      # Pass other attribute columns here
      'properties' => array(
          'id' => $thisID,
          'strada' => $thisStrada,
          'civico' => $thisCivico,
          'tipo' => $thisTipo
      ),
      'geometry' => array(
          'type' => 'Point',
          # Pass Longitude and Latitude Columns here
          //riceve le coordinate "nascoste" dal popup del POI
          'coordinates' => array($thisLNG,$thisLAT)
      )
    );
    # Add feature arrays to feature collection array
    array_push($newArray['features'], $feature);

  }

  // per ogni valore, cerca e modifica e ricrea il file geojson
  $jsonData = json_encode($newArray, JSON_NUMERIC_CHECK);
  file_put_contents('civici.geojson', $jsonData);

}

// AGGIUNGI NUOVI

// richiama il file geojson con delle geometrie presenti
$inp = file_get_contents('civici.geojson');
// decodifica il file geojson
$toAddArray = json_decode($inp, true);

$p=0;

$strade = explode("|", $strada);
$civici = explode("|", $civico);
$tipi = explode("|", $tipo);
$lats = explode("|", $lat);
$lngs = explode("|", $lng);

foreach($ids as $collection){

  // preprara l'array strutturato come definito per i file geojson
  $feature = array(
    'type' => 'Feature',
    # Pass other attribute columns here
    'properties' => array(
        'id' => $collection,
        'strada' => $strade[$p],
        'civico' => $civici[$p],
        'tipo' => 'new'
    ),
    'geometry' => array(
        'type' => 'Point',
        # Pass Longitude and Latitude Columns here
        //riceve le coordinate "nascoste" dal popup del POI
        'coordinates' => array($lngs[$p],$lats[$p])
    )
  );
  # Add feature arrays to feature collection array
  array_push($toAddArray['features'], $feature);

  $p++;
}

//print_r($newArray);
// encode del vecchio file geojson e degli array da aggiungere
$jsonAddData = json_encode($toAddArray, JSON_NUMERIC_CHECK);
file_put_contents('civici.geojson', $jsonAddData);

// NEW
// encode del vecchio file geojson e degli array da aggiungere
//$jsonData = json_encode($tempArray, JSON_NUMERIC_CHECK);
//file_put_contents('civici.geojson', $jsonData);
?>
