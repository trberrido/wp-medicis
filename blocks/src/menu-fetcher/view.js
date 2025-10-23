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
                if (!context.cloneHappened){
                    const secondary = document.querySelector('.secondary-mobile ul').cloneNode(true);
                    const target = ref.closest('.wp-block-pm-menu-fetcher').querySelector('.pm-menus');
                    secondary.querySelectorAll('li').forEach( ( li, index ) => {
                        li.classList.add('mobilehome-clone');
                        if (index === 0){
                          li.classList.add('pm-menu-item-first');
                        }
                        target.appendChild(li);
                    });
                    context.cloneHappened = true;
                }

				ref.closest('.wp-block-pm-menu-fetcher').classList.toggle('--open');
            },
        }
    });