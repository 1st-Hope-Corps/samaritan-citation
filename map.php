<title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0">
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
  <script type="text/javascript" charset="utf8" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.3.js"></script>
    <meta charset="utf-8">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }

      #hud-loading {
          position:fixed;
          width:100%;
          left:0;right:0;top:0;bottom:0;
          background-color: rgba(255,255,255,0.7);
          z-index:9999;
          display:none;
      }

      @-webkit-keyframes spin {
        from {-webkit-transform:rotate(0deg);}
        to {-webkit-transform:rotate(360deg);}
      }

      @keyframes spin {
        from {transform:rotate(0deg);}
        to {transform:rotate(360deg);}
      }

      #hud-loading::after {
          content:'';
          display:block;
          position:absolute;
          left:48%;top:40%;
          width:40px;height:40px;
          border-style:solid;
          border-color:black;
          border-top-color:transparent;
          border-width: 4px;
          border-radius:50%;
          -webkit-animation: spin .8s linear infinite;
          animation: spin .8s linear infinite;
      }
    </style>
<div id="hud-loading"></div>
<div id="map"></div>

<script type="text/javascript">
  var map;
  let current_workz_id = "<?php echo $_GET['id']; ?>";

  function getData() {
    $('#hud-loading').show();
    $.ajax({
    // url: "map_api_wrapper.php?address=<?php echo $_GET['id']; ?>",
    url: "/kindness/callback/workz2_get_geocode/<?php echo $_GET['id']; ?>",
    async: true,
    dataType: 'json',
    success: function (data) {
      //load map
      init_map(data);
      $('#hud-loading').hide();
    }
  });  
  }
  
  function init_map(data) {
    let current_workz = data.current_workz;
    let all_workz = data.all_workz;
    let geocode, map_options;
    let firstHasGeoCode = false;
        if(current_workz){
          map_options = {
              zoom: 14,
              center: new google.maps.LatLng(current_workz['latitude'], current_workz['longitude'])
            }

          map = new google.maps.Map(document.getElementById("map"), map_options);
          marker = new google.maps.Marker({
              map: map,
              position: new google.maps.LatLng(current_workz['latitude'], current_workz['longitude']),
              icon: '/hud_files/images/location-pin.png',
          });
          google.maps.event.addListener(marker, "click", function () {
            window.parent.Kindness_ApproveTitle2(current_workz_id);
          });

        }
        
        for(let i in all_workz){
          //Multiple marker
          if(current_workz_id === all_workz[i]['id']){
            continue;
          }

          geocode = all_workz[i]['geocode'];
          if(geocode){

            if(!current_workz && firstHasGeoCode == false){
              map_options = {
                zoom: 8,
                center: new google.maps.LatLng(geocode['latitude'], geocode['longitude'])
              }
              map = new google.maps.Map(document.getElementById("map"), map_options);
            }else{
              // map_options = {
              //   zoom: 14,
              // }
              // map = new google.maps.Map(document.getElementById("map"));
            }

            marker = new google.maps.Marker({
                map: map,
                position: new google.maps.LatLng(geocode['latitude'], geocode['longitude'])
            });

            google.maps.event.addListener(marker, "click", function () {
              window.parent.Kindness_ApproveTitle2(all_workz[i]['id']);
            });

            firstHasGeoCode = true;
          }
        }

        
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAUp6JSd_cCxtx6i9Z74nUi3-LFq5IYcKM&callback=getData" async defer></script>