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

</script>