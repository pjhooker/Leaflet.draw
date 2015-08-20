function pt_popup(feature, layer) {
		var popupContent = ''
          +'<form method="POST" class="form-signin">'
          +'ID; <input type="text" name="feat_id" class="form-control" value="'
          +		feature.properties.id
          +'"/>'
          +'<br>Civico: <input type="text" name="phone1" class="form-control" value="'
          +		feature.properties.civico
          +'"/>'
          +'<br>Strada: <input type="text" name="phone2" class="form-control" value="'
          +		feature.properties.strada
          +'"/>'
            +"<br><button type='submit' name='submit' class='btn btn-lg btn-primary btn-block'>Modifica</form>"
					+'</form>';
		layer.bindPopup(popupContent);
	}
