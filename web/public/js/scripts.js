$(function(){
	feather.replace();

	$('.btn.submitNewMessage').on('click', function() {
		var $this = $(this);
		$this.prop("disabled", true);
	    $this.html($this.data("loading-text"));
	    setTimeout(function() {
	       $this.html('Submit');
	       $this.prop("disabled", false);
	   }, 8000);
	});
});

