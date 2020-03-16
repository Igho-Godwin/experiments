<footer class="footer text-center">
    All Rights Reserved by  JOEville ITS.
</footer>

<style>
    .pac-container {
        z-index:2000;
    }
</style>


     
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCPJNYpRGMzD_dQp4jOHU_OwMoZ09vXzcU&sensor=true&libraries=places"
        async defer></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<!-- Bootstrap tether Core JavaScript -->
<script src="assets/libs/popper.js/dist/umd/popper.min.js "></script>
   <!-- Latest compiled and minified JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
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

<script src='js/formatNumber.js'></script>

<script src="js/edit_subAccount.js"></script>  



<script src="js/Orders.js "></script>



<script src="js/add_admin.js "></script>

<script src="js/addSubAccount.js"></script>

<script src="js/user.js "></script>

<script src="js/remission.js"></script>

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
 
 <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script>
    $('input[name="dates"]').daterangepicker({ locale: {
      format: 'DD/MM/YYYY'
    }});
</script>
 
  
 
 

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
     
    $('#order-table1').DataTable({
                    dom: 'Bfrtip',
                    paging:false,
                    searching:false,
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf'
                    ]
              });
      });
  </script>