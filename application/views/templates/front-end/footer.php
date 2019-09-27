<script>
	$(function () {
		const menu = $('.dv-nav-menu');
		$.each($(menu), function (i, e) {
			let menu = $(e).data('menu');
			let containerMenu = $('.main-container').data('navmenu');
			if (menu == containerMenu) {
				$(e).addClass('active');
			}
		});
	});

</script>
<script src="<?=base_url('assets/')?>js/popper.min.js"></script>
<script src="<?=base_url('assets/')?>js/bootstrap.min.js"></script>
</body>

</html>
