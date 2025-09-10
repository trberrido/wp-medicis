/**
 * WordPress dependencies
 */
import { store, getContext, getElement } from '@wordpress/interactivity';

const updatePosts = (currentYear) => {
	const { ref } = getElement();
	const context = getContext();
	ref.closest('.wp-site-blocks').querySelectorAll('.pm-post').forEach( ( post ) => {
		const postYear = post.querySelector('.taxonomy-graduate_year a').innerText;
		if ( postYear === context.currentYear ){
			post.classList.remove('pm-hidden');
		} else {
			post.classList.add('pm-hidden');
		}
	} );
};

const { state } = store( 'pm/year-filter', {
	actions: {
		selection: () => {
			const context = getContext();
			context.currentYear = context.year
			updatePosts(context.currentYear);
		}
	},
	callbacks: {
		init: () => {
			const context = getContext();
			updatePosts(context.currentYear);
		}
	}
});