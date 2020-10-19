<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Macco Map</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/'); ?>css/sb-admin-2.min.css" rel="stylesheet">
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCuAQmalDoKhlwPwBbfcYaEbPV3-OXdP9w&callback=initMap&libraries=&v=weekly" defer></script>
    <style type="text/css">
        /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
        #map {
            height: 90%;
            margin-top: -25px;
        }

        /* Optional: Makes the sample page fill the window. */
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
    <script>
        var map;

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: -2.1248368,
                    lng: 115.7491428
                },
                zoom: 5,
            });
            //   addMarker({lat: -34.397, lng: 150.644})
            //   addMarker({lat: -33.870453,lng: 151.208755})
            fetch('http://localhost/webmacco/map/fetchmarker')
                .then(response => response.json())
                .then(data => {
                    for (const i in data) {
                        var lat = parseFloat(data[i].latitude);
                        var long = parseFloat(data[i].longitude);
                        var ni = data[i].nama_instansi;
                        var alamat = data[i].alamat;
                        var foto = data[i].foto;
                        console.log(lat, long, ni, alamat, foto);

                        addMarker({
                            lat: lat,
                            lng: long
                        })

                        function addMarker(coords) {
                            var marker = new google.maps.Marker({
                                position: coords,
                                dragable: true,
                                map: map,
                                icon: '<?= base_url('assets/img/image/maccoreader.svg') ?>',
                            });

                            var infoWindow = new google.maps.InfoWindow({
                                content: '<span class=" font-weight-bold text-success text-center" >Macco Reader</span>' + '<br>' +
                                    alamat + '<br>' + ' instansi :' + ni + '<br>' + '<div class="img-thumbnail ">' +
                                    '<img src="<?= base_url('assets/img/profile/') ?>' + foto + '">' +
                                    '</div>',
                            });
                            marker.addListener('click', function() {
                                infoWindow.open(map, marker);
                            });
                        }
                    }
                });
        }
    </script>
</head>