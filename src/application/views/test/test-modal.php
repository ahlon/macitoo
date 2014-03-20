<link href="/assets/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" />
<script src="/assets/bootstrap-modal/js/bootstrap-modalmanager.js"></script>
<script src="/assets/bootstrap-modal/js/bootstrap-modal.js"></script>
<script type="text/javascript">
$(function() {
	var $modal = $('#ajax-modal');
	$('.ajax').on('click', function(){
		  // create the backdrop and wait for next modal to be triggered
	  $('body').modalmanager('loading');
	 
	  $modal.load('/test/modal_dialog', '', function(data) {
		  $modal.modal();
      });
	});
});
</script>
<a class="ajax demo btn">Click</a>
<div id="ajax-modal"></div>