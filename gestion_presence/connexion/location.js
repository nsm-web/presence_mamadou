if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function (position){
        lat = position.coords.latitude;
    lng = position.coords.longitude;
    
    
    console.log(lat,lng);


    const map = L.map('map').setView([5.342979, -4.02304], zoomlevel); 
    const mainLayer = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: 'pk.eyJ1IjoiZW1tYW51ZWxrb3Vha291IiwiYSI6ImNrdzRwZ2xwdTExcjkyd3A2aWQzY3g4NHYifQ.QvFklu_eb98DUivHbWDcBw'});

    mainLayer.addTo(map);

    // var marker = L.marker([lat, lng]).addTo(map);

    var circle = L.circle([5.342979, -4.02304], {
    color: 'yellow',
    fillColor: 'yellow',
    fillOpacity: 0.5,
    radius: 500
}).addTo(map);
    });
  } else { 
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
