 <!-- Bootstrap core JavaScript-->
 <script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
 <script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

 <!-- Core plugin JavaScript-->
 <script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

 <!-- Custom scripts for all pages-->
 <script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>
 <!-- preview image -->
 <script src="<?= base_url("assets/js/image.js"); ?>"></script>
 <!-- preview maps -->
 <script src="<?= base_url("assets/js/map.js"); ?>"></script>
 <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCuAQmalDoKhlwPwBbfcYaEbPV3-OXdP9w&libraries=places&callback=initialize"></script>
 <script src="https://code.jquery.com/jquery-3.5.1.slim.js" integrity="sha256-DrT5NfxfbHvMHux31Lkhxg42LY6of8TaYyK50jnxRnM=" crossorigin="anonymous"></script>
 <script src="<?= base_url('assets/lib/tel/build/') ?>js/intlTelInput.js"></script>

 <script>
     $(document).ready(function() {
         custom_file();
         var input = document.querySelector("#tel");
         window.intlTelInput(input, {
             // allowDropdown: false,
             // autoHideDialCode: false,
             // autoPlaceholder: "off",
             dropdownContainer: document.body,
             // excludeCountries: ["id"],
             formatOnDisplay: false,
             // geoIpLookup: function(callback) {
             //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
             //     var countryCode = (resp && resp.country) ? resp.country : "";
             //     callback(countryCode);
             //   });
             // },
             // hiddenInput: "full_number",
             // initialCountry: "auto",
             // localizedCountries: { 'de': 'Deutschland' },
             // nationalMode: false,
             // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
             // placeholderNumberType: "MOBILE",
             preferredCountries: ['id', 'jp'],
             // separateDialCode: true,
             utilsScript: "<?= base_url('assets/lib/tel/build/') ?>js/utils.js",
         });

         function custom_file() {
             $('.custom-file input').change(function(e) {
                 var files = [];
                 for (var i = 0; i < $(this)[0].files.length; i++) {
                     files.push($(this)[0].files[i].name);
                 }
                 $(this).next('.custom-file-label').html(files.join(', '));

             });
         }
     });
 </script>
 </body>

 </html>