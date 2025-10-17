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
                if (!context.cloneHappened){
                    const secondary = document.querySelector('.secondary-mobile').cloneNode(true);
                    const target = document.querySelector('#menu-menu-1');
                    secondary.querySelectorAll('li').forEach( li => {
                        li.classList.add('mobilehome-clone');
                        target.appendChild(li);
                    });
                    context.cloneHappened = true;
                }
				const { ref } = getElement();

				ref.closest('.wp-block-pm-menu-fetcher').classList.toggle('--open');
            },
        }
    });