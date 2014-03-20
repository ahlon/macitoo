$(function() {
	$('.rating').jRating({
		isDisabled : true
	});
});

function updateReadingStatus(book_id, status) {
	var url = '/reading/status/update?book_id=' + book_id + '&status=' + status;
	$.get(url, function() {
	    location.reload();
    });
}
