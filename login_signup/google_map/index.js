let map;
let infoWindow;

function initMap() {
  map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: 23.771587800856683, lng: 90.41193936800533 },
    zoom: 16,
    mapTypeId: "roadmap",
  });
  infoWindow = new google.maps.InfoWindow();

  fetch('./postman.json').then((response) => {
    return response.json()}).then((json) => {
    json.results.forEach( (i)=>{
      const LatLng = { lat: i.geometry.location.lat, lng: i.geometry.location.lng };
      new google.maps.Marker({
        position: LatLng,
        map: map,
        title: i.name,
        icon: i.icon,
        icon_background_color:i.icon_background_color,
        rating: i.rating,
        icon_mask_base_uri:i.icon_mask_base_uri
      });
    })
  });
  
}
window.initMap = initMap;