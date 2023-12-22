<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tentukan Titik | Hi - Service</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <link rel="stylesheet" href=<?= base_url('assets/welcome.style.css') ?>>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2VWma2FEOVgx9KiHJgSkuTrEBIIMJ0VM"></script>
    <script>
        
        function initialize() {
            const infowindow = new google.maps.InfoWindow();
        var body =document.querySelector('body');
        var container = body.querySelector('.container');
        var form = body.querySelector('.form-loc')
        var lat_text = form.querySelector("#lat");
        var lng_text = form.querySelector("#lng");
        var latValue = container.querySelector("#default_lat");
        var lngValue = container.querySelector("#default_lng");
        
        // Titik Default
        if(lngValue == null || latValue == null){
            var default_lat = -7.920600218765736
            var default_lng = 112.59636853716687
        }else{
            var default_lat =latValue.value
            var default_lng =lngValue.value
            document.getElementById("hidden-button").style.visibility = "visible";
        }
        
        
        // Value dari teks input yang dihidden untuk memanggil API
        lat_text.value = default_lat
        lng_text.value = default_lng
        var propertiPeta = {
            center:new google.maps.LatLng(default_lat, default_lng),
            zoom:16,
            mapTypeId:google.maps.MapTypeId.ROADMAP
        };
        
        var peta = new google.maps.Map(document.getElementById("googleMap"), propertiPeta);
        function handleMapMove() {
            var lat = peta.getCenter().lat();
            var lng = peta.getCenter().lng();
            // Value dari teks input yang dihidden untuk memanggil API
            lat_text.value= lat;
            lng_text.value = lng;
        }
        peta.addListener('center_changed', handleMapMove);
        var i =0;
    <?php 
        foreach ($items as $item) : ?>
    var marker = new google.maps.Marker({
                    position: {lat: <?= $item->lat?>, lng: <?= $item->long ?>},
                    map: peta,
                    title: '<?= $item->text_mark ?>'
                });
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
        infowindow.setContent('<p style=color:black;><?= $item->text_mark ?></p>'); 
        infowindow.open(peta, marker);
        }
      })(marker, i));

        i++;
    <?php endforeach; ?>
}
  
        // event jendela di-load  
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
</head>

<body>
<div class="floating-profile">
    <div class="dropdown">
      <a class="profile-icon" href="#" onclick="toggleDropdown()">
        <i class="bi bi-person-circle"></i>
      </a>
      <div class="dropdown-menu" id="dropdownMenu">
        <a href="#">Atur Profil</a>
        <a href= <?= base_url('login/logout')?>  >Logout</a>
      </div>
    </div>
  </div>

  <!-- JavaScript -->
  <script>
    function toggleDropdown() {
      var dropdownMenu = document.getElementById("dropdownMenu");
      dropdownMenu.style.display = dropdownMenu.style.display === "none" ? "block" : "none";
    }
  </script>
    <div class="container">
        <span class="img">
        <p>Hi! </p>
        <p style="color:red;padding-left:5px;">Service</p>
        </span>
        <h4 style="margin:0px">Selamat Datang <?php echo session()->get('name');?> ,</h4>
        <h3>Tentukan titik lokasi anda saat ini. </h3>
        <div id="googleMap" style="width:80%;height:300px;border-radius:24px;"></div>
        <span class=form-loc>
        <form action="" id="form_loc" method="post">
            <input type="hidden" id="lat" name="lat" value="">
            <input type="hidden" id="lng" name="lng" value="">
        </form>
        </span>
        <button class="btn-submit" type="submit" id="save-button" form="form_loc" value="Submit"><i class="bi bi-save" style="display:flex;align-items:center;padding-right:10px;color:red;"></i>Simpan Lokasi</button>
        <?php
        $lat = '';
        $lng = '';
        $countries = '';
        if(isset($_POST['lat'])){
            $lat = $_POST['lat'];
            $lng = $_POST['lng'];
            $request = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?latlng=" . $lat . "," . $lng . "&sensor=true&key=AIzaSyB2VWma2FEOVgx9KiHJgSkuTrEBIIMJ0VM");
            $json = json_decode($request, true);
            $countries = $json['results'][3]['formatted_address'];
        ?>
        <input type="hidden" id="default_lat" value=<?php echo $lat?>>
        <input type="hidden" id="default_lng" value=<?php echo $lng?>>
        <?php
            echo ($countries);
        }

        ?>
         <form action=<?= base_url('service') ?> id="saved_form" method="post">
            <input type="hidden" id="saved_lat" name="saved_lat" value=<?php echo $lat?>>
            <input type="hidden" id="saved_lng" name="saved_lng" value=<?php echo $lng?>>
            <textarea id="saved_address" name="saved_address" cols="0" rows="0" hidden><?php echo $countries?></textarea> 
        </form>
        <button class="btn-submit" id="hidden-button" type="submit" form="saved_form" value="Submit" style="visibility:hidden"><i class="bi bi-arrow-bar-right" style="display:flex;align-items:center;padding-right:10px;color:red;" ></i>Lanjut Ke Layanan</button>
        </div>
    </div>
</body>
