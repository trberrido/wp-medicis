 import { store, getContext, getElement } from "@wordpress/interactivity";

 const { state } = store('pm/menu-fetcher', {
        state: {
            get isOpen() {
				const context = getContext();
				return context.isOpen || false;
			}
        },
        actions: {
            toggle: () => {
				const context = getContext();
                context.isOpen = !context.isOpen;
				const { ref } = getElement();
				console.log('CLIC')
				ref.closest('.wp-block-pm-menu-fetcher').classList.toggle('--open');
            },
        }
    });