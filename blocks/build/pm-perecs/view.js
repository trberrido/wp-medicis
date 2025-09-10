import * as __WEBPACK_EXTERNAL_MODULE__wordpress_interactivity_8e89b257__ from "@wordpress/interactivity";
/******/ var __webpack_modules__ = ({

/***/ "@wordpress/interactivity":
/*!*******************************************!*\
  !*** external "@wordpress/interactivity" ***!
  \*******************************************/
/***/ ((module) => {

module.exports = __WEBPACK_EXTERNAL_MODULE__wordpress_interactivity_8e89b257__;

/***/ })

/******/ });
/************************************************************************/
/******/ // The module cache
/******/ var __webpack_module_cache__ = {};
/******/ 
/******/ // The require function
/******/ function __webpack_require__(moduleId) {
/******/ 	// Check if module is in cache
/******/ 	var cachedModule = __webpack_module_cache__[moduleId];
/******/ 	if (cachedModule !== undefined) {
/******/ 		return cachedModule.exports;
/******/ 	}
/******/ 	// Create a new module (and put it into the cache)
/******/ 	var module = __webpack_module_cache__[moduleId] = {
/******/ 		// no module.id needed
/******/ 		// no module.loaded needed
/******/ 		exports: {}
/******/ 	};
/******/ 
/******/ 	// Execute the module function
/******/ 	__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 
/******/ 	// Return the exports of the module
/******/ 	return module.exports;
/******/ }
/******/ 
/************************************************************************/
/******/ /* webpack/runtime/make namespace object */
/******/ (() => {
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = (exports) => {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/ })();
/******/ 
/************************************************************************/
var __webpack_exports__ = {};
// This entry needs to be wrapped in an IIFE because it needs to be isolated against other modules in the chunk.
(() => {
/*!*******************************!*\
  !*** ./src/pm-perecs/view.js ***!
  \*******************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_interactivity__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/interactivity */ "@wordpress/interactivity");
/**
 * WordPress dependencies
 */

const updatePerec = (currentJuryId, currentTitleId) => {
  console.log('looooooooooooool');
  const {
    ref
  } = (0,_wordpress_interactivity__WEBPACK_IMPORTED_MODULE_0__.getElement)();
  const context = (0,_wordpress_interactivity__WEBPACK_IMPORTED_MODULE_0__.getContext)();
  ref.closest('.wp-block-pm-perecs').querySelectorAll('.perec-content__post').forEach(post => {
    const juryId = post.dataset.juryid;
    const titleId = post.dataset.titleid;
    if (titleId === currentTitleId && juryId === currentJuryId) {
      console.log('ppppppppppppppp');
      post.classList.remove('pm-hidden');
    } else {
      post.classList.add('pm-hidden');
    }
  });
  ref.closest('.wp-block-pm-perecs').querySelectorAll('.perec-index__item').forEach(item => {
    const juryId = item.dataset.juryid;
    if (juryId === currentJuryId) {
      item.classList.add('pm-selected');
    } else {
      item.classList.remove('pm-selected');
    }
    item.querySelectorAll('.perec-index__title').forEach(title => {
      const titleId = title.dataset.titleid;
      if (titleId === currentTitleId && juryId === currentJuryId) {
        title.classList.add('pm-selected');
      } else {
        title.classList.remove('pm-selected');
      }
    });
  });
};
const {
  state
} = (0,_wordpress_interactivity__WEBPACK_IMPORTED_MODULE_0__.store)('pm/perecs', {
  actions: {
    selection: () => {
      const context = (0,_wordpress_interactivity__WEBPACK_IMPORTED_MODULE_0__.getContext)();
      context.currentJuryId = context.juryId;
      context.currentTitleId = context.titleId;
      updatePerec(context.currentJuryId, context.currentTitleId);
    }
  },
  callbacks: {
    init: () => {
      const context = (0,_wordpress_interactivity__WEBPACK_IMPORTED_MODULE_0__.getContext)();
      updatePerec(context.currentJuryId, context.currentTitleId);
    }
  }
});
})();


//# sourceMappingURL=view.js.map