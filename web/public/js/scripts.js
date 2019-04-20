$(function(){
	$('.btnPostNewMessage').on('click', function () {
		$('.submitNewMessage').text('Submit');
		$('#newMessageModalLabel').text('Send New Message');
		$('#editMessageId').val('');
	});

	editMessage();

	$('.btn.submitNewMessage').on('click', function() {
	    var checkValid = validateMessageForm();

	    if(checkValid === false){
	    	return false;
	    }

		var $this = $(this);
		$this.prop("disabled", true);
	    $this.html($this.data("loading-text"));

	    if($('#editMessageId').val() == ''){
	    	newMessage($this);
	    }

	    if($('#editMessageId').val() != ''){
	    	updateMessage($this, $('#editMessageId').val());
	    }
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
       			if($('main .card-columns .card').length >= 9) {
       				$('main .card-columns .card:last-child').remove();
       			}
       			var html = '<div class="card bg-dark">'
                    + '<div class="card-block quote-card">'
                        + '<div class="card-text">'
                            + '<span class="pl-2 message" data-id="'+result.messageData.id+'">'
                                + result.messageData.message
                            + '</span>'
                        + '</div>'
                        + '<div class="meta">'
                            + '<span class="visitor-name pl-2" data-id="'+result.messageData.id+'">'
                                + result.messageData.visitor_name
                            + '</span>'
                        + '</div>'
                    + '</div>'
                    + '<div class="card-footer">'
                    +    '<small>' + result.messageData.created_at + '</small>';
                if (result.isLogin == true) {
                	html += '<button class="btn btn-circle btn-danger float-right btn-sm ml-1 delete-message" data-id="'+result.messageData.id+'">'
                    +        '<i class="fas fa-trash"></i>'
                    +    '</button>'
                    +    '<button class="btn btn-circle btn-danger float-right btn-sm edit-message"  data-id="'+result.messageData.id+'"'
                    +    ' data-toggle="modal" data-target="#editMessageModal">'
                    +        '<i class="fas fa-pencil-alt"></i>'
                    +    '</button>'
                }
                html += '</div>'+'</div>';
       			$('main .card-columns').prepend(html);
       			$('#newMessageModal .alert').removeClass('alert-danger alert-success').html('');
       			$('#newMessageModal .alert').addClass('alert-success').append('<li>'+result.message+'</li>').fadeIn().delay(3000).fadeOut(function() {
       				$('#newMessageModal').modal('hide');
       			});
       			modalDelete();
       			clearMessageForm();
			}
		}
	});
}

var editMessage = function () {
	$('.edit-message').on('click', function () {
		$('.submitNewMessage').text('Save');
		$('#newMessageModalLabel').text('Edit Message');
		$this =$(this);
		var messageId = $this.data('id');
		$('#editMessageId').val(messageId);
		$.ajax({
			url: '?edit-message',
			method: 'GET',
			dataType: 'json',
			data: {
				messageId: messageId
			},
			cache: false,
			success: function(result){
				$('#message-text').val(result.message);
				$('#visitor-name').val(result.visitor_name);
			}
		});
	});	
}

var updateMessage = function (obj, messageId) {
	var message = $('#message-text').val();
	var visitorName = $('#visitor-name').val();
	$.ajax({
		url: '?edit-message',
		method: 'POST',
		dataType: 'json',
		data: {
			messageId: messageId,
			message: message,
			visitorName: visitorName
		},
		cache: false,
		success: function(result){
			if(result.status == 1){
				obj.html('Submit');
       			obj.prop("disabled", false);
       			$('#newMessageModal .alert').removeClass('alert-danger alert-success').html('');
       			$('#newMessageModal .alert').addClass('alert-success').append('<li>'+result.message+'</li>').fadeIn().delay(3000).fadeOut(function() {
       				$('#newMessageModal').modal('hide');
       			});
       			$('.message[data-id="'+messageId+'"]').text(result.messageData.message);
       			$('.visitor-name[data-id="'+messageId+'"]').text(result.messageData.visitorName);
       		}
       	}
    });
}

var validateMessageForm = function(){
	var message = $('#message-text').val();
	var visitorName = $('#visitor-name').val();
	$('#newMessageModal .alert').removeClass('alert-danger alert-success').html('').hide();
	if(message === '') {
		$('#newMessageModal .alert').append('<li>Please add message.</li>')
	}

	if(visitorName === '') {
		$('#newMessageModal .alert').append('<li>Please add visitor name.</li>')
	}

	if(visitorName == '' || message == '') {
		$('#newMessageModal .alert').addClass('alert-danger');
		$('#newMessageModal .alert').fadeIn().delay(3000).fadeOut();
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