$(document).ready(function(){

// if add complaint dialog opened
$("#add_complaint_dialog").on('shown.bs.modal', function(){
	
	// reload capcha
	reload_capcha();
	
});


// login
$("#login_form").submit(function( event ) {
	
	event.preventDefault();
	
	// show progress
	$('.loading-p').css('display', 'inline-block');
	
	// send data AJAX
	$.post("/authentication/login/", $(this).serialize(), function(r){

		// hide progress
		$('.loading-p').hide();
		
		// successful
		if (r == 1) {
			url = "/";
			$( location ).attr("href", url);					
		} else {
			alert('Логін або пароль введені неправильно!');
		}
		
	});
});
	

// add complaint
$("#add_complaint").submit(function( event ) {

		
	event.preventDefault();
	
	// show progress
	$('.btn-primary', this).append('<span class="loading-p" style="display: inline-block"></span>');

			
	// ajax login
	$.post("/complaints/savenew/", $(this).serialize(), function(r){

		if (r == 1) {				
		
			//reset form
			$('#add_complaint').trigger("reset");
			
			// close modal
			$('#add_complaint_dialog').modal('hide');
			
			get_complaints_list();
				
		} else {
			alert("Поля заповнені неправильно або ви ввели заборонені символи");
		}
	
		// hide progress
		$('.btn-primary .loading-p').remove();
			
	});
	
		
});
	
	
// logout
$('#logout').click(function(){
	
	// send data
	$.post("/authentication/logout/", {}, function(r){
		
		if (r == 1) {
			url = "/";
			$( location ).attr("href", url);
		}
		
	});
});

	
});



// reload complaint list
function get_complaints_list(page = 1, sortfield = get_sortfield() ) {

	$.post("/complaints/index/", {listpage: page, sort: sortfield}, function(j) {

		
		if (($("#content tbody tr").length <=0) || (typeof($("#content table").html()) == 'undefined')) {
	
			$('.alert-success').remove();
			$('#content').html('<table class="table table-striped">'+$('table', j).html()+'</table>');
			$('#content').append('<ul class="pagination">'+$('.pagination', j).html()+'</ul>');
			
			
		} else {
			$('#content table > tbody').html($('table > tbody', j).html());
			$('#content .pagination').html($('.pagination', j).html());
			
		}
		
		if (total_pages() == 0 && $("#content tbody tr").length == 0) {
			$('#content').html('<div class="alert alert-success" role="alert">Записів немає</div>');
		}
		

	});
	
}


// get_sortfield()
function get_sortfield() {
	
	var id;
	
	$(".sorting-radio input[name='sort']:checked").each(function() {

		id = $(this).attr('id');
		id = id.replace('_', ' ');

	});
	
	if (typeof(id) == 'undefined') {return '';} else {return id;}	
	
}



// get cur page
function active_page() {
	return $('.pagination .active').text();
}


// total pages
function total_pages() {
	return $(".pagination li").length;
}


// if sorting click
$(function() {
	
	$(".sorting-radio input[type=radio]").click(function() {
		id = $(this).attr('id');
		get_complaints_list(active_page(), id.replace('_', ' '));

	});
});



// update_complaint data
function update(id) {
	
	// show progress
	
	$('#item_'+id+' td:last-child span').remove();
	$('#item_'+id+' td:last-child .btn-primary').html('<span class="loading-p" style="display: inline-block"></span>');
	$('#item_'+id+' td:last-child .btn-default').hide();
	
	
	var data = 'id='+id+'&';
	
	$('#item_'+id).each(function() {
		
		$.each(this.cells, function(){
			
			if (typeof($('.form-control', this).val()) == 'string') {
				data = data+$('.form-control', this).attr('name')+'='+$('.form-control', this).val()+'&';
			}
			
		});
       
    });

	// ajax login
	$.post("/complaints/update/", data, function(r){

		if (r == 1) {		
		
			// refresh list
			get_complaints_list(active_page());
				
		} else {
			alert("Поля заповнені неправильно");
		}
			
	});
	

}

// edit complaint
function edit_complaint(id) {
	
	$('#item_'+id+' :button').hide();
	// select edited item
	$('#item_'+id).css('background', 'rgba(38, 197, 38, 0.16)');
	
	// generate edit form
	$('#item_'+id+' td:nth-child(2)').html('<textarea class="form-control" name="text" type="text" cols="55" rows="3" required>'+$('#item_'+id+' td:nth-child(2)').text()+'</textarea>');
	$('#item_'+id+' td:nth-child(3)').html('<input class="form-control " name="name" type="text" size="55" value="'+$('#item_'+id+' td:nth-child(3)').text()+'" required="required">');
	$('#item_'+id+' td:nth-child(4)').html('<input class="form-control" type="email" name="email" size="55" value="'+$('#item_'+id+' td:nth-child(4)').text()+'" required>');
	$('#item_'+id+' td:nth-child(5)').html('<input class="form-control" type="text" name="website" value="'+$('#item_'+id+' td:nth-child(5)').text()+'" size="55">');
	$('#item_'+id+' td:last-child').append('<button type="button" onclick="update('+id+')" class="btn btn-sm btn-primary">OK<span class="glyphicon glyphicon-ok"></span></button>&nbsp;<button type="button" onclick="cancel_edit_complaint()" class="btn btn-default btn-sm">Скас.</button>');
	
}

function cancel_edit_complaint() {
	
	// refresh list
	get_complaints_list(active_page());
	
}


// delete complaint
function delete_complaint(ids) {
	
	//show progress
	$('#item_'+ids+' td:last-child .btn-danger').html('<span class="loading-p"></span>');
	$('#item_'+ids+' .loading-p').css('display','inline-block');
	
	// send data
	$.post("/complaints/del/", {id: ids}, function(r){
		
		if (r == 1) {
		
			// hide deleted item
			$('#item_'+ids).remove();
			
			// if empty page
			if ($("#content tbody tr").length == 0) {
				
				// refresh list
				if (active_page() > 1) {get_complaints_list(active_page()-1);} else {get_complaints_list(active_page());}
				
		
			}
			
		}
		
	});	
}

	
// refresh capcha	
function reload_capcha() {
	$(".captcha").empty();
	var code = new Date().getTime();
	$('<img onclick="reload_capcha();" alt="Код безпеки" title="Оновити код" src="/libs/capcha/secpic.php?'+code+'" />').appendTo(".captcha");
}
