

function show(url,title,msg){
$(document).ready(function(){
			// let url=pageurl;
				$('.save-modal-title').html(title);
				$('#save-msg').html(msg);
			$('.modal_done_link').attr("href",url);
			$('#saveModel').modal('show');
			});
}

function delete_modal($url){
	$(document).ready(function() {
    $('#table').DataTable();

    $('.delete_link').on('click',function(){

    	let id=$(this).attr('rel');
    	let delete_url=$url+"?id="+ id +" ";
    	// alert(delete_url);
    	$('.modal_delete_link').attr("href",delete_url);
    	$('#myModal').modal('show');
    });
});
}