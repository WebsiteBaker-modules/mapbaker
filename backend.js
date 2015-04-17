function showlatlonarr(latlonarr,adresse) {
	var lat = latlonarr[0];
	var lon = latlonarr[1];
	
	document.modify.latitude.value = lat;
	document.modify.longitude.value = lon;
	if (document.modify.marker.value == "") {document.modify.marker.value = adresse;}

}