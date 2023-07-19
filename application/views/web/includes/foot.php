<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?=base_url('_assets/web/');?>DataTables/datatables.min.js"></script> 

<script>
$(document).ready(function(){
document.getElementById('sorguformu').style.marginTop = "40vh";

function load_data(query='')
	{
		
		$.ajax({
			url:"<?php echo base_url(); ?>www/bulgetir",
			method:"POST",
			data:{query:query},
			success:function(data){
			
			$('#sonuclar').html(data);

		} 
	})
}

$('#search_text').keyup(function(){
	var search = $(this).val();
	var y=document.getElementById('sorguformu');
	var x = document.getElementById('sonuclar');
 		if(search == "") {
   			x.style.display = 'none';
   			load_data();
   		} else {
   			y.style.marginTop = "0vh";
   			x.style.display = 'block';
   			load_data(search);
   		}
	});
});

</script>
</body>
</html>
