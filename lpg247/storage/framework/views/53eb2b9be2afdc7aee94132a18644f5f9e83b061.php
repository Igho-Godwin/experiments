<footer class="footer text-center">
    All Rights Reserved by  JOEville ITS.
</footer>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="assets/libs/jquery/dist/jquery.min.js "></script>
<!-- Latest compiled and minified JavaScript -->


<!-- Bootstrap tether Core JavaScript -->
<script src="assets/libs/popper.js/dist/umd/popper.min.js "></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<!-- apps -->
<script src="dist/js/app.min.js "></script>
<script src="dist/js/app.init.boxed.js "></script>
<script src="dist/js/app-style-switcher.js "></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js "></script>
<script src="assets/extra-libs/sparkline/sparkline.js "></script>
<!--Wave Effects -->
<script src="dist/js/waves.js "></script>
<!--Menu sidebar -->
<script src="dist/js/sidebarmenu.js "></script>
<!--Custom JavaScript -->
<script src="dist/js/custom.min.js "></script>

<script src="js/add_admin.js "></script>

<script src="js/SalesRep.js "></script>

<script src="js/suspendAdmin.js "></script>

<script src="js/edit_admin.js "></script>

<script src="js/product.js "></script>

<script src="js/remission.js"></script>

<script src="js/createMajorMarketer.js"></script>

 <script src="cropper/cropper-master/dist/cropper.js"></script>
 
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

<script src="//cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>

<script src="//cdn.datatables.net/buttons/1.5.6/js/buttons.print.min."></script>
 
<script src="//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCPJNYpRGMzD_dQp4jOHU_OwMoZ09vXzcU&sensor=true&libraries=places"
        async defer></script>
 
 <script>
    
        function initAutocomplete() {
            // Create the autocomplete object, restricting the search predictions to
            // geographical location types.
            autocomplete = new google.maps.places.Autocomplete(
            document.getElementById('autocomplete'), {types: ['geocode']});
        }
        
        $(window).on('load', function() {
            initAutocomplete();
        });
    
</script>
  
  <script>
      $(document).ready(function() {
        $('#table').DataTable({
        dom: 'Bfrtip',
        paging:false,
        buttons: [
            'copy', 'csv', 'excel', 'pdf'
        ]
    });
    
     
      });
  </script>
  
<?php /**PATH /home/lpg247/public_html/resources/views/admin/footer/footer.blade.php ENDPATH**/ ?>