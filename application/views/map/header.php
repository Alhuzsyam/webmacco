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
        @import url("https://fonts.googleapis.com/css2?family=Kanit:wght@600&display=swap");

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

        .mysubtitle {
            font-family: "Kanit", sans-serif;
            color: #f69168;
            font-size: 25px;
            text-decoration: none;
        }

        a:hover {
            background-image: url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/9632/squiggle.svg");
            background-position: bottom;
            background-repeat: repeat-x;
            background-size: 20%;
            border-bottom: 0;
            padding-bottom: .3em;
            text-decoration: none;
        }
    </style>
    <script>
        var map;

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: <?= $map['latitude']  ?>,
                    lng: <?= $map['longitude']  ?>
                },
                zoom: 10,
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
                        var ng = data[i].nama_gedung
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
                                content: '<div class="img-thumbnail" style="width: 130px;">' +
                                    '<img style="width: 120px;border-radius: 5px;" src="<?= base_url('assets/img/profile/') ?>' + foto + '">' +
                                    '<span class=" font-weight-bold text-success text-center" >Macco Reader</span>' + '<br>' + alamat + '<br>' + ' instansi :' + ni + '(' + ng + ')' + '<br>' +
                                    '</div>',
                            });
                            // marker.addListener('click', function() {
                            //     infoWindow.open(map, marker);
                            // });
                            google.maps.event.addListener(marker, 'mouseover', function() {
                                infoWindow.open(map, marker);
                            });
                            google.maps.event.addListener(marker, 'mouseout', function() {
                                infoWindow.close(map, marker);
                            });
                        }
                    }
                });
            fetch('http://localhost/webmacco/map/fetchuser')
                .then(response => response.json())
                .then(data => {
                    for (const i in data) {
                        var lat = parseFloat(data[i].latitude);
                        var long = parseFloat(data[i].logitude);
                        // var ni = data[i].nama_instansi;
                        // var alamat = data[i].alamat;
                        // var foto = data[i].foto;
                        console.log(lat, long);

                        addMarker({
                            lat: lat,
                            lng: long
                        })

                        function addMarker(coords) {
                            var marker = new google.maps.Marker({
                                position: coords,
                                dragable: true,
                                map: map,
                                icon: '<?= base_url('assets/img/image/user.svg') ?>',
                            });
                            google.maps.event.addListener(marker, 'mouseover', function() {
                                if (marker.getAnimation() !== null) {
                                    marker.setAnimation(null);
                                } else {
                                    marker.setAnimation(google.maps.Animation.BOUNCE);
                                }
                            });
                            // google.maps.event.addListener(marker, 'mouseout', function() {
                            //     marker.setAnimation(google.maps.Animation.DROP);
                            // });

                            // var infoWindow = new google.maps.InfoWindow({
                            //     content: '<div class="img-thumbnail" style="width: 130px;">' +
                            //         '<img style="width: 120px;border-radius: 5px;" src="<?//= base_url('assets/img/profile/') ?>' + foto + '">' +
                            //         '<span class=" font-weight-bold text-success text-center" >Macco Reader</span>' + '<br>' + alamat + '<br>' + ' instansi :' + ni + '<br>' +
                            //         '</div>',
                            // });
                            // marker.addListener('click', function() {
                            //     infoWindow.open(map, marker);
                            // });
                        }
                    }
                });
        }
    </script>
</head>