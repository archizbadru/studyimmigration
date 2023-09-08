<script src="<?=base_url().'assets/js/sweetalert2@9.js'?>"></script>
<script>
  var evtSource = new EventSource("<?=base_url().'reminder/task_reminder'?>");  
  evtSource.onmessage = function(e) {    
Swal.fire(
	{
		title:'Task Reminder', html:e.data
	}
	);
  };
  evtSource.onerror = function() {
    console.log("EventSource failed.");
  };
</script>