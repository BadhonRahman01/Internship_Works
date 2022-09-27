let map;
let infoWindow;

function initMap() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (p) {
          var LatLng = new google.maps.LatLng(
            p.coords.latitude,
            p.coords.longitude
          );
          var mapOptions = {
            center: LatLng,
            zoom: 16,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            
          };
          var map = new google.maps.Map(
            document.getElementById("dvMap"),
            mapOptions
          );
          fetch('postman.json').then((response) => {
         return response.json()}).then((json) => {
         json.results.forEach( (i)=>{
           console.log(i.icon);
           const LatLng = { lat: i.geometry.location.lat, lng: i.geometry.location.lng };
           new google.maps.Marker({
             position: LatLng,
             map: map,
             title: i.name,
             icon: i.icon,
             open_now: i.opening_hours.open_now,
             rating: i.rating
           });
         })
       });
       window.initMap = initMap;
})
