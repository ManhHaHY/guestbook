$(function(){
	feather.replace();

	$('.btn.submitNewMessage').on('click', function() {
	    var checkValid = validateMessageForm();
	    if(checkValid === false){
	    	return false;
	    }
		var $this = $(this);
		$this.prop("disabled", true);
	    $this.html($this.data("loading-text"));
	    newMessage($this);
	});

	$('.close-message-form').on('click', clearMessageForm);

});

var newMessage = function(btnObj){
	var message = $('#message-text').val();
	var visitorName = $('#visitor-name').val();
	$.ajax({
		url: '?add-message',
		method: 'POST',
		dataType: 'json',
		data: {
			message: message,
			visitorName: visitorName
		},
		cache: false,
		success: function(result){
			if(result.status == 1){
				btnObj.html('Submit');
       			btnObj.prop("disabled", false);
       			location.reload();
			}
		}
	});
}

var validateMessageForm = function(){
	var message = $('#message-text').val();
	var visitorName = $('#visitor-name').val();
	$('#newMessageModal .alert').removeClass('alert-danger').html('');
	$('#newMessageModal .alert').removeClass('alert-success').hide();
	if(message === '') {
		$('#newMessageModal .alert').append('<li>Please add message.</li>')
	}

	if(visitorName === '') {
		$('#newMessageModal .alert').append('<li>Please add visitor name.</li>')
	}

	if(visitorName == '' || message == '') {
		$('#newMessageModal .alert').addClass('alert-danger');
		$('#newMessageModal .alert').fadeIn().delay(5000).fadeOut();
		return false;
	}

	return true;
}

var clearMessageForm = function(){
	$('#visitor-name').val('');
	$('#message-text').val('');
}

var modalDelete = function(callback){
  
    $('.delete-message').on('click', function () {
		var $this = $(this);
		var messageId = $this.data('id');
		$("#deleteMessageId").val(messageId);
    	$("#deleteMessageModal").modal('show');

	});

    $("#modal-btn-yes").on("click", function(){
    	callback(true);
    	$("#deleteMessageModal").modal('hide');
    });
};

modalDelete(function(confirm){
	if(confirm){
		var messageId = $("#deleteMessageId").val();
		$.ajax({
			url: '?delete-message',
			method: 'POST',
			dataType: 'json',
			data: {messageId: messageId},
			cache: false,
			success: function(result){
				if(result.status == 1){
					$('.delete-message[data-id="'+messageId+'"]').parents('.card').remove();
				}
			}
		});
	}
});