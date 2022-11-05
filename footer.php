<!-- /Back to Top -->
	<!-- Jquery Library-->
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="js/jquery-3.2.1.min.js"></script>

	<!-- Popper Library-->
	<script src="js/popper.min.js"></script>
	<!-- Bootstrap Library-->
    <script src="js/bootstrap.min.js"></script>
    
    <!-- Datatable  -->
	<script src="datatable/jquery.dataTables.min.js"></script>
	<script src="datatable/dataTables.bootstrap4.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script type="text/javascript">
	var jQuery_3_4_1 = $.noConflict(true);
	</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
	<script src="tableExport/tableExport.js"></script>
	<script type="text/javascript" src="tableExport/jquery.base64.js"></script>
	<script type="text/javascript" src="tableExport/jsPDF/libs/.js"></script>
	<script src="js/export.js"></script>

	<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
	<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    
	<!-- Custom Script-->
	<script src="js/custom.js"></script>

</body>

<script type="text/javascript">
	$('document').ready(function(){
		$('table#example1').DataTable({
		"searching":true,
		"paging":true,
		"order":[[0,"asc"]],
		"ordering":true,
		"columnDefs":[{
			"targets":[3],
			"orderable":false
		}],
		dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
	});
	});

	$('document').ready(function(){
		$('table#appointment_patient').DataTable({
		"searching":true,
		"paging":true,
		"order":[[0,"asc"]],
		"ordering":true,
		"columnDefs":[{
			"targets":[3],
			"orderable":false
		}],
		dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
	});
	});

	$('document').ready(function(){
		$('table#bills_patient').DataTable({
		"searching":true,
		"paging":true,
		"order":[[0,"asc"]],
		"ordering":true,
		"columnDefs":[{
			"targets":[3],
			"orderable":false
		}],
		dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
	});
	});

	$('document').ready(function(){
		$('table#all_patient').DataTable({
		"searching":true,
		"paging":true,
		"order":[[0,"asc"]],
		"ordering":true,
		"columnDefs":[{
			"targets":[3],
			"orderable":false
		}],
		dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
	});
	});

	$('document').ready(function(){
		$('table#tableId').DataTable({
		"searching":true,
		"paging":true,
		"order":[[0,"asc"]],
		"ordering":true,
		"columnDefs":[{
			"targets":[3],
			"orderable":false
		}],
		dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
	});
	});



</script>

<script type="text/javascript">
    

      $(document).ready(function () {
      $('select').selectize({
          sortField: 'text'
      });
  });

  $( document ).ready(function() {
	$(".dataExport").click(function() {
		var exportType = $(this).data('type');		
		$('#dataTable').tableExport({
			type : exportType,			
			escape : 'false',
			ignoreColumn: []
		});		
	});
});

</script>

</html>