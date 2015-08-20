
<?php
if(isset($_POST['submit']))
    {
      //'tipo' => $_POST['tipo']

      //Sanitize input data using PHP filter_var().
      $phone1   = $_POST["phone1"];
      $phone2   = $_POST["phone2"];
      $feat_id  = $_POST["feat_id"];


      $id=$feat_id;

      //$lat=$_GET['lat'];
      //$lng=$_GET['lng'];
      // richiama il file geojson con delle geometrie presenti
      $inp = file_get_contents('civici.geojson');
      // decodifica il file geojson
      $tempArray = json_decode($inp, true);

      // NEW

      $newArray = array('type' => 'FeatureCollection','features' => array());
      //

      foreach ($tempArray['features'] as $features) {

        $latOLD=$features['geometry']['coordinates'][1];
        $lngOLD=$features['geometry']['coordinates'][0];
        $tipo=$features['properties']['tipo'];
        $strada=$features['properties']['strada'];
        $civico=$features['properties']['civico'];
        $thisID=$features['properties']['id'];

        if($features['properties']['id']==$id){
          $strada=$phone2;
          $civico=$phone1;
          $tipo="update";
        }
        else{
          //$strada=$phone2;
          //$civico=$phone1;
        }
        // preprara l'array strutturato come definito per i file geojson
        $feature = array(
          'type' => 'Feature',
          # Pass other attribute columns here
          'properties' => array(
              'id' => $thisID,
              'strada' => $strada,
              'civico' => $civico,
              'tipo' => $tipo
          ),
          'geometry' => array(
              'type' => 'Point',
              # Pass Longitude and Latitude Columns here
              //riceve le coordinate "nascoste" dal popup del POI
              'coordinates' => array($lngOLD,$latOLD)
          )
        );
        # Add feature arrays to feature collection array
        array_push($newArray['features'], $feature);

      }
      //

      //print_r($newArray);
      // encode del vecchio file geojson e degli array da aggiungere
      $jsonData = json_encode($newArray, JSON_NUMERIC_CHECK);
      file_put_contents('civici.geojson', $jsonData);

      ?>
            <script>
              carica_geojson();
            </script>
      <?php

}


?>
