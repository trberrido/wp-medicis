 import { store, getContext, getElement } from "@wordpress/interactivity";

 const { state } = store('pm/palmares', {
        actions: {
            toggle: (e) => {

                const context = getContext();                
                context.activedecades['is' + context.decade] = false;
                context.decade = e.currentTarget.dataset.decade;
                context.activedecades['is' + context.decade] = true;
                
            },
            toggleModale: (e) => {
                console.log('wao');
                const element = getElement().ref;
                if (element.querySelector('dialog').open) {
                    element.querySelector('dialog').close();
                } else {
                    element.querySelector('dialog').showModal();
                }

            },
            closeModale: (e) => {
                console.log('RRR')
                getElement.ref.closeModale()
            }
        },
        callbacks: {
            init: () => {
                const context = getContext();
                const defaultDecade = getElement().ref.dataset.defaultDecade;
                context.decade = defaultDecade;
                 context.activedecades['is' + defaultDecade] = true;
            }
        }
    });