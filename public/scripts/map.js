     // Code JavaScript pour initialiser et afficher la carte
        function initMap() {
            var options = {
                center: {lat: 44.86536609557045, lng: -0.5603782196036978}, // Coordonnées du centre de la carte
                zoom: 15 // Niveau de zoom initial
            };
            var map = new google.maps.Map(document.getElementById('map'), options);
           const marker = new google.maps.Marker({
                    position : {lat: 44.86536609557045, lng: -0.5603782196036978},
                    map,
                    title : "My beers",
                    icon : {url:"./icons/bar.svg",
                scaledSize : new google.maps.Size(38, 31)
                             },
                    
                
                });
                const infoWindow = new google.maps.InfoWindow({
                    content : "Le bar de My beers vous attend"
        });
        marker.addEventListener("click", () => {
            infoWindow.open(map, marker);
        });
    }