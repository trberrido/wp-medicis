document.addEventListener('DOMContentLoaded', e => {
	console.log('Focus on the donut, not the hole.');

	document.querySelectorAll('.pm-year-btn').forEach(btn => {
		btn.addEventListener('click', e => {
			e.currentTarget.classList.toggle('btn--open');
			e.currentTarget.closest('.pm-post').querySelector('.wp-block-pm-year-filter').classList.toggle('pm-hidden');
			e.currentTarget.closest('.wp-block-pm-year-filter').classList.toggle('pm-hidden');
		});
	})

	const target = document.querySelector('.pm-popup__target');
	
	target.addEventListener('click', e => {
		if (e.target === target || e.target.classList.contains('pm-popup__close')) {
			document.body.classList.remove('pm-popup--open');
			// remove all children except close button
			const contentTarget = target.querySelector('.content-target');
			contentTarget.innerHTML = '';
		}
	});

	document.querySelectorAll('.is-style-popup').forEach(popup => {
		const button = popup.querySelector('.wp-block-button');
		const content = popup.querySelector('.popup__inner');
		// clone and put in popup target
		
		button.addEventListener('click', e => {
			const clone = content.cloneNode(true);
			const contentTarget = target.querySelector('.content-target');
			contentTarget.appendChild(clone);

			document.body.classList.add('pm-popup--open');
		});
	});
});