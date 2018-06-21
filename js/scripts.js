$(document).ready(function(){
	$('.edit').click(function(){
		id = $(this).attr('id').split("astronaut_")[1];
		
		$.ajax({
			url: "ajax/astronaut.php?id=" + id,
		}).done(function(data) {
			if(data == null)
				alert("Astronaut does not exist");
			else
			{
				astronaut = jQuery.parseJSON(data);
				$('#editFirstName').val(astronaut['firstName']);
				$('#editLastName').val(astronaut['lastName']);
				$('#editBorn').val(astronaut['born']);
				$('#editSuperpower').val(astronaut['superpower']);
				$('#editId').val(astronaut['id']);
			}
		})

		$('#editWindow').fadeIn(150);
	});

	$('#editWindowIn').click(function(event){
		event.stopPropagation();
	});

	$('#editWindow').click(function(){
		$('#editWindow').fadeOut(150, function(){
			$('#editFirstName').val('');
			$('#editLastName').val('');
			$('#editBorn').val('');
			$('#editSuperpower').val('');
			$('#editId').val('');
		});
	});

	$('#saveEdit').click(function(){
		ok = true;

		if($('#editFirstName').val() == "")
		{
			$('#editFirstName').css('border-color', 'red');
			ok = false;
		}
		else
			$('#editFirstName').css('border-color', '#ced4da');
		if($('#editLastName').val() == "")
		{
			$('#editLastName').css('border-color', 'red');
			ok = false;
		}
		else
			$('#editLastName').css('border-color', '#ced4da');
		if($('#editBorn').val() == "")
		{
			$('#editBorn').css('border-color', 'red');
			ok = false;
		}
		else
			$('#editBorn').css('border-color', '#ced4da');
		if($('#editSuperpower').val() == "")
		{
			$('#editSuperpower').css('border-color', 'red');
			ok = false;
		}
		else
			$('#editSuperpower').css('border-color', '#ced4da');

		if(!ok)
			return;

		saveEdited();
	});

	$( function() {
		$( "#datepicker" ).datepicker();
	} );
	$( function() {
		$( "#editBorn" ).datepicker();
	} );

});

function saveEdited()
{
	first = $('#editFirstName').val();
	last = $('#editLastName').val();
	born = $('#editBorn').val();
	superpower = $('#editSuperpower').val();
	id = $('#editId').val();

	$.ajax({
		url: "ajax/editAstronaut.php?id=" + id + "&firstName=" + first + "&lastName=" + last + "&born=" + born + "&superpower=" + superpower,
	}).done(function(data) {
		if(data == "WRONG")
			alert("Error while editing astronaut");
		else
		{
			$('#first_' + id).html($('#editFirstName').val());
			$('#last_' + id).html($('#editLastName').val());
			help = $('#editBorn').val().split("/");
			born = help[2] + "-" + help[0] + "-" + help[1];
			$('#born_' + id).html(born);
			$('#superpower_' + id).html($('#editSuperpower').val());

			$('#editWindow').click();
		}
	})
}