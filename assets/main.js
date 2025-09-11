document.addEventListener('DOMContentLoaded', e => {
	console.log('Focus on the donut, not the hole.');
	document.querySelectorAll('.pm-year-btn').forEach(btn => {
		btn.addEventListener('click', e => {
			e.currentTarget.classList.toggle('btn--open');
			e.currentTarget.closest('.pm-post').querySelector('.wp-block-pm-year-filter').classList.toggle('pm-hidden');
			e.currentTarget.closest('.wp-block-pm-year-filter').classList.toggle('pm-hidden');
		});
	})
});