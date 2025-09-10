/**
 * WordPress dependencies
 */
import { store, getContext, getElement } from '@wordpress/interactivity';

const updatePerec = (currentJuryId, currentTitleId) => {
	console.log('looooooooooooool')
	const { ref } = getElement();
	const context = getContext();
	ref.closest('.wp-block-pm-perecs').querySelectorAll('.perec-content__post').forEach( ( post ) => {
		const juryId = post.dataset.juryid;
		const titleId = post.dataset.titleid;
		if ( titleId === currentTitleId && juryId === currentJuryId ){
			console.log('ppppppppppppppp')
			post.classList.remove('pm-hidden');
		} else {
			post.classList.add('pm-hidden');
		}
	} );
	ref.closest('.wp-block-pm-perecs').querySelectorAll('.perec-index__item').forEach( ( item ) => {
		const juryId = item.dataset.juryid;
		if ( juryId === currentJuryId ){
			item.classList.add('pm-selected');
		} else {
			item.classList.remove('pm-selected');
		}
		item.querySelectorAll('.perec-index__title').forEach( ( title ) => {
			const titleId = title.dataset.titleid;
			if ( titleId === currentTitleId && juryId === currentJuryId ){
				title.classList.add('pm-selected');
			} else {
				title.classList.remove('pm-selected');
			}
		} );
	} );
};

const { state } = store( 'pm/perecs', {
	actions: {
		selection: () => {
			const context = getContext();
			context.currentJuryId = context.juryId;
			context.currentTitleId = context.titleId;
			updatePerec(context.currentJuryId, context.currentTitleId);
		}
	},
	callbacks: {
		init: () => {
			const context = getContext();
			updatePerec(context.currentJuryId, context.currentTitleId);
		}
	}
});