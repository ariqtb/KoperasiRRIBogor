  <!-- Javascript -->
  <script src="<?= base_url('assets/plugins/popper.min.js') ?>"></script>
  <script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.min.js') ?>"></script>

  <!-- Charts JS -->
  <script src="<?= base_url('assets/plugins/chart.js/chart.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/index-charts.js') ?>"></script>

  <!-- Page Specific JS -->
  <script src="<?= base_url('assets/js/app.js') ?>"></script>

  <!-- JQUERY -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
  <!-- <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.11.5/af-2.3.7/b-2.2.2/b-colvis-2.2.2/b-html5-2.2.2/b-print-2.2.2/cr-1.5.5/date-1.1.2/fc-4.0.2/fh-3.2.2/kt-2.6.4/r-2.2.9/rg-1.1.4/rr-1.2.8/sc-2.0.5/sb-1.3.2/sp-2.0.0/sl-1.3.4/sr-1.1.0/datatables.min.js"></script> -->

  <script src="<?= base_url('assets/vendor/jquery/jquery.js') ?>"></script>
  <script type="text/javascript" charset="utf8" src="<?= base_url('assets/vendor/DataTables/dataTables.min.js') ?>"></script>

  <script>
  	$("#table").DataTable({
  		// dom: 'Bfrtip',
  		"buttons": ['pageLength', 'copy', 'excel', 'pdf', 'print'],
  		"responsive": true,
  		"search": true,
  		"paging": true,
  		"ordering": true,
  		"info": true,
  		"lengthMenu": [
  			[5, 10, 20, -1],
  			[5, 10, 20, "All"]
  		],
  		"lengthChange": true,
  		"autoWidth": false
  	}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  	$("#table2").DataTable({
  		dom: 'Bfrtip',
  		"buttons": ['pageLength', 'copy', 'excel', 'pdf', 'print'],
  		"responsive": true,
  		"search": true,
  		"paging": true,
  		"order": [
  			[0, "desc"]
  		],
  		"info": true,
  		"lengthMenu": [
  			[5, 10, 20, -1],
  			[5, 10, 20, "All"]
  		],
  		"lengthChange": true,
  		"autoWidth": false
  	});

  	$(document).ready(function() {
  		// Create date inputs
  		minDate = new DateTime($('#min'), {
  			format: 'MMMM Do YYYY'
  		});
  		maxDate = new DateTime($('#max'), {
  			format: 'MMMM Do YYYY'
  		});

  		// DataTables initialisation
  		var table = $('#example').DataTable();

  		// Refilter the table
  		$('#min, #max').on('change', function() {
  			table.draw();
  		});
  	});

  	$(".datepicker").datepicker({
  		"format": "mm-yyyy",
  		"startView": "months",
  		"minViewMode": "months"
  	});

  	table = $('#table').DataTable({
  		"order": [],
  		"processing": true,
  		"serverSide": true,
  		"ajax": {
  			"url": "<?= base_url('orders') ?>",
  			"type": "POST",
  			"data": function(data) {
  				data.bulan = $('#bulan').val();
  			}
  		},
  		"columnDefs": [{
  			"targets": [0],
  			"orderable": false
  		}]
  	});
  	$('#bulan').change(function() {
  		table.draw();
  	});
  </script>