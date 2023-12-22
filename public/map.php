<?php 

if(isset($_GET['lat']) && isset($_GET['lng'])){
$lat = $_GET['lat'];
$lng = $_GET['lng'];
}else{$lat = -7.797068;
    $lng = 110.370529;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Google Maps API Key Example</title>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2VWma2FEOVgx9KiHJgSkuTrEBIIMJ0VM"></script>
    <script>
        function initMap() {
            // Inisialisasi peta
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: <?php echo $lat?>, lng:<?php echo $lng?> }, // Koordinat pusat peta
                zoom: 18 // Tingkat zoom peta
            });

            // Menambahkan marker
            var marker = new google.maps.Marker({
                position:{lat: <?php echo $lat?>, lng:<?php echo $lng?> }, // Koordinat pusat peta
                map: map,
                title: 'Lokasi'
            });
            var infowindow = new google.maps.InfoWindow({
                content: "Lokasi User"
            });

            marker.addListener('click', function() {
                infowindow.open(map, marker);
            });
        }
    </script>
</head>
<body>
    <div id="map" style="height: 500px;width: 500px;"></div>

    <script>
        // Memanggil fungsi initMap saat halaman selesai dimuat
        google.maps.event.addDomListener(window, 'load', initMap);
    </script>
</body>
</html>