$(function () {

	$('.should_confirm_delete').on("click", function(e){
		$this = $(this);

		var url = $this.attr('href');

		$this.closest('tr').addClass('bg-red disabled');

		swal({
		  title: 'Êtes-vous sûr(e) ?',
		  text: "La suppression de cet élément et ce qui dépend de lui est définitive.",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#d73925',
		  cancelButtonText: 'Annuler',
		  confirmButtonText: 'Supprimer'
		}).then((result) => {
		  if (result.value) {
		    window.location.href = url;
		  }else{
			$this.closest('tr').removeClass('bg-red disabled');

		  }
		});

		return false;
	});
});