!function(e){var t={};function n(o){if(t[o])return t[o].exports;var r=t[o]={i:o,l:!1,exports:{}};return e[o].call(r.exports,r,r.exports,n),r.l=!0,r.exports}n.m=e,n.c=t,n.d=function(e,t,o){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:o})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var o=Object.create(null);if(n.r(o),Object.defineProperty(o,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var r in e)n.d(o,r,function(t){return e[t]}.bind(null,r));return o},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=35)}([function(e,t){e.exports=window.wp.element},function(e,t){e.exports=window.wp.components},function(e,t){e.exports=window.wp.data},function(e,t){e.exports=window.wp.compose},function(e,t){e.exports=function(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}},function(e,t){function n(t){return e.exports=n=Object.setPrototypeOf?Object.getPrototypeOf:function(e){return e.__proto__||Object.getPrototypeOf(e)},n(t)}e.exports=n},function(e,t){e.exports=function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}},function(e,t){function n(e,t){for(var n=0;n<t.length;n++){var o=t[n];o.enumerable=o.enumerable||!1,o.configurable=!0,"value"in o&&(o.writable=!0),Object.defineProperty(e,o.key,o)}}e.exports=function(e,t,o){return t&&n(e.prototype,t),o&&n(e,o),e}},function(e,t,n){var o=n(21);e.exports=function(e,t){if("function"!=typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function");e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,writable:!0,configurable:!0}}),t&&o(e,t)}},function(e,t,n){var o=n(22),r=n(10);e.exports=function(e,t){return!t||"object"!==o(t)&&"function"!=typeof t?r(e):t}},function(e,t){e.exports=function(e){if(void 0===e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return e}},function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.canUseDOM=void 0;var o,r=n(31);var l=((o=r)&&o.__esModule?o:{default:o}).default,a=l.canUseDOM?window.HTMLElement:{};t.canUseDOM=l.canUseDOM;t.default=a},function(e,t){e.exports=window.wp.editPost},function(e,t){e.exports=window.wp.blockEditor},function(e,t){e.exports=window.React},function(e,t,n){e.exports=n(25)()},function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default=function(e){return[].slice.call(e.querySelectorAll("*"),0).filter(a)};
/*!
 * Adapted from jQuery UI core
 *
 * http://jqueryui.com
 *
 * Copyright 2014 jQuery Foundation and other contributors
 * Released under the MIT license.
 * http://jquery.org/license
 *
 * http://api.jqueryui.com/category/ui-core/
 */
var o=/input|select|textarea|button|object/;function r(e){var t=e.offsetWidth<=0&&e.offsetHeight<=0;if(t&&!e.innerHTML)return!0;var n=window.getComputedStyle(e);return t?"visible"!==n.getPropertyValue("overflow")||e.scrollWidth<=0&&e.scrollHeight<=0:"none"==n.getPropertyValue("display")}function l(e,t){var n=e.nodeName.toLowerCase();return(o.test(n)&&!e.disabled||"a"===n&&e.href||t)&&function(e){for(var t=e;t&&t!==document.body;){if(r(t))return!1;t=t.parentNode}return!0}(e)}function a(e){var t=e.getAttribute("tabindex");null===t&&(t=void 0);var n=isNaN(t);return(n||t>=0)&&l(e,!n)}e.exports=t.default},function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.assertNodeList=s,t.setElement=function(e){var t=e;if("string"==typeof t&&a.canUseDOM){var n=document.querySelectorAll(t);s(n,t),t="length"in n?n[0]:n}return i=t||i},t.validateElement=c,t.hide=function(e){c(e)&&(e||i).setAttribute("aria-hidden","true")},t.show=function(e){c(e)&&(e||i).removeAttribute("aria-hidden")},t.documentNotReadyOrSSRTesting=function(){i=null},t.resetForTesting=function(){i=null};var o,r=n(30),l=(o=r)&&o.__esModule?o:{default:o},a=n(11);var i=null;function s(e,t){if(!e||!e.length)throw new Error("react-modal: No elements were found for selector "+t+".")}function c(e){return!(!e&&!i)||((0,l.default)(!1,["react-modal: App element is not defined.","Please use `Modal.setAppElement(el)` or set `appElement={el}`.","This is needed so screen readers don't see main content","when modal is opened. It is not recommended, but you can opt-out","by setting `ariaHideApp={false}`."].join(" ")),!1)}},function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var o=new function e(){var t=this;!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,e),this.register=function(e){-1===t.openInstances.indexOf(e)&&(t.openInstances.push(e),t.emit("register"))},this.deregister=function(e){var n=t.openInstances.indexOf(e);-1!==n&&(t.openInstances.splice(n,1),t.emit("deregister"))},this.subscribe=function(e){t.subscribers.push(e)},this.emit=function(e){t.subscribers.forEach((function(n){return n(e,t.openInstances.slice())}))},this.openInstances=[],this.subscribers=[]};t.default=o,e.exports=t.default},function(e,t){e.exports=window.wp.plugins},function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var o,r=n(23),l=(o=r)&&o.__esModule?o:{default:o};t.default=l.default,e.exports=t.default},function(e,t){function n(t,o){return e.exports=n=Object.setPrototypeOf||function(e,t){return e.__proto__=t,e},n(t,o)}e.exports=n},function(e,t){function n(t){return"function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?e.exports=n=function(e){return typeof e}:e.exports=n=function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},n(t)}e.exports=n},function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.bodyOpenClassName=t.portalClassName=void 0;var o=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var n=arguments[t];for(var o in n)Object.prototype.hasOwnProperty.call(n,o)&&(e[o]=n[o])}return e},r=function(){function e(e,t){for(var n=0;n<t.length;n++){var o=t[n];o.enumerable=o.enumerable||!1,o.configurable=!0,"value"in o&&(o.writable=!0),Object.defineProperty(e,o.key,o)}}return function(t,n,o){return n&&e(t.prototype,n),o&&e(t,o),t}}(),l=n(14),a=m(l),i=m(n(24)),s=m(n(15)),c=m(n(27)),u=function(e){if(e&&e.__esModule)return e;var t={};if(null!=e)for(var n in e)Object.prototype.hasOwnProperty.call(e,n)&&(t[n]=e[n]);return t.default=e,t}(n(17)),p=n(11),d=m(p),f=n(34);function m(e){return e&&e.__esModule?e:{default:e}}function h(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}function b(e,t){if(!e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return!t||"object"!=typeof t&&"function"!=typeof t?e:t}var v=t.portalClassName="ReactModalPortal",y=t.bodyOpenClassName="ReactModal__Body--open",w=p.canUseDOM&&void 0!==i.default.createPortal,O=function(){return w?i.default.createPortal:i.default.unstable_renderSubtreeIntoContainer};function g(e){return e()}var _=function(e){function t(){var e,n,r;h(this,t);for(var l=arguments.length,s=Array(l),u=0;u<l;u++)s[u]=arguments[u];return n=r=b(this,(e=t.__proto__||Object.getPrototypeOf(t)).call.apply(e,[this].concat(s))),r.removePortal=function(){!w&&i.default.unmountComponentAtNode(r.node);var e=g(r.props.parentSelector);e&&e.contains(r.node)?e.removeChild(r.node):console.warn('React-Modal: "parentSelector" prop did not returned any DOM element. Make sure that the parent element is unmounted to avoid any memory leaks.')},r.portalRef=function(e){r.portal=e},r.renderPortal=function(e){var n=O()(r,a.default.createElement(c.default,o({defaultStyles:t.defaultStyles},e)),r.node);r.portalRef(n)},b(r,n)}return function(e,t){if("function"!=typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function, not "+typeof t);e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,enumerable:!1,writable:!0,configurable:!0}}),t&&(Object.setPrototypeOf?Object.setPrototypeOf(e,t):e.__proto__=t)}(t,e),r(t,[{key:"componentDidMount",value:function(){p.canUseDOM&&(w||(this.node=document.createElement("div")),this.node.className=this.props.portalClassName,g(this.props.parentSelector).appendChild(this.node),!w&&this.renderPortal(this.props))}},{key:"getSnapshotBeforeUpdate",value:function(e){return{prevParent:g(e.parentSelector),nextParent:g(this.props.parentSelector)}}},{key:"componentDidUpdate",value:function(e,t,n){if(p.canUseDOM){var o=this.props,r=o.isOpen,l=o.portalClassName;e.portalClassName!==l&&(this.node.className=l);var a=n.prevParent,i=n.nextParent;i!==a&&(a.removeChild(this.node),i.appendChild(this.node)),(e.isOpen||r)&&!w&&this.renderPortal(this.props)}}},{key:"componentWillUnmount",value:function(){if(p.canUseDOM&&this.node&&this.portal){var e=this.portal.state,t=Date.now(),n=e.isOpen&&this.props.closeTimeoutMS&&(e.closesAt||t+this.props.closeTimeoutMS);n?(e.beforeClose||this.portal.closeWithTimeout(),setTimeout(this.removePortal,n-t)):this.removePortal()}}},{key:"render",value:function(){return p.canUseDOM&&w?(!this.node&&w&&(this.node=document.createElement("div")),O()(a.default.createElement(c.default,o({ref:this.portalRef,defaultStyles:t.defaultStyles},this.props)),this.node)):null}}],[{key:"setAppElement",value:function(e){u.setElement(e)}}]),t}(l.Component);_.propTypes={isOpen:s.default.bool.isRequired,style:s.default.shape({content:s.default.object,overlay:s.default.object}),portalClassName:s.default.string,bodyOpenClassName:s.default.string,htmlOpenClassName:s.default.string,className:s.default.oneOfType([s.default.string,s.default.shape({base:s.default.string.isRequired,afterOpen:s.default.string.isRequired,beforeClose:s.default.string.isRequired})]),overlayClassName:s.default.oneOfType([s.default.string,s.default.shape({base:s.default.string.isRequired,afterOpen:s.default.string.isRequired,beforeClose:s.default.string.isRequired})]),appElement:s.default.instanceOf(d.default),onAfterOpen:s.default.func,onRequestClose:s.default.func,closeTimeoutMS:s.default.number,ariaHideApp:s.default.bool,shouldFocusAfterRender:s.default.bool,shouldCloseOnOverlayClick:s.default.bool,shouldReturnFocusAfterClose:s.default.bool,preventScroll:s.default.bool,parentSelector:s.default.func,aria:s.default.object,data:s.default.object,role:s.default.string,contentLabel:s.default.string,shouldCloseOnEsc:s.default.bool,overlayRef:s.default.func,contentRef:s.default.func,id:s.default.string,overlayElement:s.default.func,contentElement:s.default.func},_.defaultProps={isOpen:!1,portalClassName:v,bodyOpenClassName:y,role:"dialog",ariaHideApp:!0,closeTimeoutMS:0,shouldFocusAfterRender:!0,shouldCloseOnEsc:!0,shouldCloseOnOverlayClick:!0,shouldReturnFocusAfterClose:!0,preventScroll:!1,parentSelector:function(){return document.body},overlayElement:function(e,t){return a.default.createElement("div",e,t)},contentElement:function(e,t){return a.default.createElement("div",e,t)}},_.defaultStyles={overlay:{position:"fixed",top:0,left:0,right:0,bottom:0,backgroundColor:"rgba(255, 255, 255, 0.75)"},content:{position:"absolute",top:"40px",left:"40px",right:"40px",bottom:"40px",border:"1px solid #ccc",background:"#fff",overflow:"auto",WebkitOverflowScrolling:"touch",borderRadius:"4px",outline:"none",padding:"20px"}},(0,f.polyfill)(_),t.default=_},function(e,t){e.exports=window.ReactDOM},function(e,t,n){"use strict";var o=n(26);function r(){}function l(){}l.resetWarningCache=r,e.exports=function(){function e(e,t,n,r,l,a){if(a!==o){var i=new Error("Calling PropTypes validators directly is not supported by the `prop-types` package. Use PropTypes.checkPropTypes() to call them. Read more at http://fb.me/use-check-prop-types");throw i.name="Invariant Violation",i}}function t(){return e}e.isRequired=e;var n={array:e,bool:e,func:e,number:e,object:e,string:e,symbol:e,any:e,arrayOf:t,element:e,elementType:e,instanceOf:t,node:e,objectOf:t,oneOf:t,oneOfType:t,shape:t,exact:t,checkPropTypes:l,resetWarningCache:r};return n.PropTypes=n,n}},function(e,t,n){"use strict";e.exports="SECRET_DO_NOT_PASS_THIS_OR_YOU_WILL_BE_FIRED"},function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var o=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var n=arguments[t];for(var o in n)Object.prototype.hasOwnProperty.call(n,o)&&(e[o]=n[o])}return e},r="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},l=function(){function e(e,t){for(var n=0;n<t.length;n++){var o=t[n];o.enumerable=o.enumerable||!1,o.configurable=!0,"value"in o&&(o.writable=!0),Object.defineProperty(e,o.key,o)}}return function(t,n,o){return n&&e(t.prototype,n),o&&e(t,o),t}}(),a=n(14),i=h(n(15)),s=m(n(28)),c=h(n(29)),u=m(n(17)),p=m(n(32)),d=h(n(11)),f=h(n(18));function m(e){if(e&&e.__esModule)return e;var t={};if(null!=e)for(var n in e)Object.prototype.hasOwnProperty.call(e,n)&&(t[n]=e[n]);return t.default=e,t}function h(e){return e&&e.__esModule?e:{default:e}}n(33);var b={overlay:"ReactModal__Overlay",content:"ReactModal__Content"},v=0,y=function(e){function t(e){!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,t);var n=function(e,t){if(!e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return!t||"object"!=typeof t&&"function"!=typeof t?e:t}(this,(t.__proto__||Object.getPrototypeOf(t)).call(this,e));return n.setOverlayRef=function(e){n.overlay=e,n.props.overlayRef&&n.props.overlayRef(e)},n.setContentRef=function(e){n.content=e,n.props.contentRef&&n.props.contentRef(e)},n.afterClose=function(){var e=n.props,t=e.appElement,o=e.ariaHideApp,r=e.htmlOpenClassName,l=e.bodyOpenClassName;l&&p.remove(document.body,l),r&&p.remove(document.getElementsByTagName("html")[0],r),o&&v>0&&0===(v-=1)&&u.show(t),n.props.shouldFocusAfterRender&&(n.props.shouldReturnFocusAfterClose?(s.returnFocus(n.props.preventScroll),s.teardownScopedFocus()):s.popWithoutFocus()),n.props.onAfterClose&&n.props.onAfterClose(),f.default.deregister(n)},n.open=function(){n.beforeOpen(),n.state.afterOpen&&n.state.beforeClose?(clearTimeout(n.closeTimer),n.setState({beforeClose:!1})):(n.props.shouldFocusAfterRender&&(s.setupScopedFocus(n.node),s.markForFocusLater()),n.setState({isOpen:!0},(function(){n.setState({afterOpen:!0}),n.props.isOpen&&n.props.onAfterOpen&&n.props.onAfterOpen({overlayEl:n.overlay,contentEl:n.content})})))},n.close=function(){n.props.closeTimeoutMS>0?n.closeWithTimeout():n.closeWithoutTimeout()},n.focusContent=function(){return n.content&&!n.contentHasFocus()&&n.content.focus({preventScroll:!0})},n.closeWithTimeout=function(){var e=Date.now()+n.props.closeTimeoutMS;n.setState({beforeClose:!0,closesAt:e},(function(){n.closeTimer=setTimeout(n.closeWithoutTimeout,n.state.closesAt-Date.now())}))},n.closeWithoutTimeout=function(){n.setState({beforeClose:!1,isOpen:!1,afterOpen:!1,closesAt:null},n.afterClose)},n.handleKeyDown=function(e){9===e.keyCode&&(0,c.default)(n.content,e),n.props.shouldCloseOnEsc&&27===e.keyCode&&(e.stopPropagation(),n.requestClose(e))},n.handleOverlayOnClick=function(e){null===n.shouldClose&&(n.shouldClose=!0),n.shouldClose&&n.props.shouldCloseOnOverlayClick&&(n.ownerHandlesClose()?n.requestClose(e):n.focusContent()),n.shouldClose=null},n.handleContentOnMouseUp=function(){n.shouldClose=!1},n.handleOverlayOnMouseDown=function(e){n.props.shouldCloseOnOverlayClick||e.target!=n.overlay||e.preventDefault()},n.handleContentOnClick=function(){n.shouldClose=!1},n.handleContentOnMouseDown=function(){n.shouldClose=!1},n.requestClose=function(e){return n.ownerHandlesClose()&&n.props.onRequestClose(e)},n.ownerHandlesClose=function(){return n.props.onRequestClose},n.shouldBeClosed=function(){return!n.state.isOpen&&!n.state.beforeClose},n.contentHasFocus=function(){return document.activeElement===n.content||n.content.contains(document.activeElement)},n.buildClassName=function(e,t){var o="object"===(void 0===t?"undefined":r(t))?t:{base:b[e],afterOpen:b[e]+"--after-open",beforeClose:b[e]+"--before-close"},l=o.base;return n.state.afterOpen&&(l=l+" "+o.afterOpen),n.state.beforeClose&&(l=l+" "+o.beforeClose),"string"==typeof t&&t?l+" "+t:l},n.attributesFromObject=function(e,t){return Object.keys(t).reduce((function(n,o){return n[e+"-"+o]=t[o],n}),{})},n.state={afterOpen:!1,beforeClose:!1},n.shouldClose=null,n.moveFromContentToOverlay=null,n}return function(e,t){if("function"!=typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function, not "+typeof t);e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,enumerable:!1,writable:!0,configurable:!0}}),t&&(Object.setPrototypeOf?Object.setPrototypeOf(e,t):e.__proto__=t)}(t,e),l(t,[{key:"componentDidMount",value:function(){this.props.isOpen&&this.open()}},{key:"componentDidUpdate",value:function(e,t){this.props.isOpen&&!e.isOpen?this.open():!this.props.isOpen&&e.isOpen&&this.close(),this.props.shouldFocusAfterRender&&this.state.isOpen&&!t.isOpen&&this.focusContent()}},{key:"componentWillUnmount",value:function(){this.state.isOpen&&this.afterClose(),clearTimeout(this.closeTimer)}},{key:"beforeOpen",value:function(){var e=this.props,t=e.appElement,n=e.ariaHideApp,o=e.htmlOpenClassName,r=e.bodyOpenClassName;r&&p.add(document.body,r),o&&p.add(document.getElementsByTagName("html")[0],o),n&&(v+=1,u.hide(t)),f.default.register(this)}},{key:"render",value:function(){var e=this.props,t=e.id,n=e.className,r=e.overlayClassName,l=e.defaultStyles,a=e.children,i=n?{}:l.content,s=r?{}:l.overlay;if(this.shouldBeClosed())return null;var c={ref:this.setOverlayRef,className:this.buildClassName("overlay",r),style:o({},s,this.props.style.overlay),onClick:this.handleOverlayOnClick,onMouseDown:this.handleOverlayOnMouseDown},u=o({id:t,ref:this.setContentRef,style:o({},i,this.props.style.content),className:this.buildClassName("content",n),tabIndex:"-1",onKeyDown:this.handleKeyDown,onMouseDown:this.handleContentOnMouseDown,onMouseUp:this.handleContentOnMouseUp,onClick:this.handleContentOnClick,role:this.props.role,"aria-label":this.props.contentLabel},this.attributesFromObject("aria",o({modal:!0},this.props.aria)),this.attributesFromObject("data",this.props.data||{}),{"data-testid":this.props.testId}),p=this.props.contentElement(u,a);return this.props.overlayElement(c,p)}}]),t}(a.Component);y.defaultProps={style:{overlay:{},content:{}},defaultStyles:{}},y.propTypes={isOpen:i.default.bool.isRequired,defaultStyles:i.default.shape({content:i.default.object,overlay:i.default.object}),style:i.default.shape({content:i.default.object,overlay:i.default.object}),className:i.default.oneOfType([i.default.string,i.default.object]),overlayClassName:i.default.oneOfType([i.default.string,i.default.object]),bodyOpenClassName:i.default.string,htmlOpenClassName:i.default.string,ariaHideApp:i.default.bool,appElement:i.default.instanceOf(d.default),onAfterOpen:i.default.func,onAfterClose:i.default.func,onRequestClose:i.default.func,closeTimeoutMS:i.default.number,shouldFocusAfterRender:i.default.bool,shouldCloseOnOverlayClick:i.default.bool,shouldReturnFocusAfterClose:i.default.bool,preventScroll:i.default.bool,role:i.default.string,contentLabel:i.default.string,aria:i.default.object,data:i.default.object,children:i.default.node,shouldCloseOnEsc:i.default.bool,overlayRef:i.default.func,contentRef:i.default.func,id:i.default.string,overlayElement:i.default.func,contentElement:i.default.func,testId:i.default.string},t.default=y,e.exports=t.default},function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.handleBlur=c,t.handleFocus=u,t.markForFocusLater=function(){a.push(document.activeElement)},t.returnFocus=function(){var e=arguments.length>0&&void 0!==arguments[0]&&arguments[0],t=null;try{return void(0!==a.length&&(t=a.pop()).focus({preventScroll:e}))}catch(e){console.warn(["You tried to return focus to",t,"but it is not in the DOM anymore"].join(" "))}},t.popWithoutFocus=function(){a.length>0&&a.pop()},t.setupScopedFocus=function(e){i=e,window.addEventListener?(window.addEventListener("blur",c,!1),document.addEventListener("focus",u,!0)):(window.attachEvent("onBlur",c),document.attachEvent("onFocus",u))},t.teardownScopedFocus=function(){i=null,window.addEventListener?(window.removeEventListener("blur",c),document.removeEventListener("focus",u)):(window.detachEvent("onBlur",c),document.detachEvent("onFocus",u))};var o,r=n(16),l=(o=r)&&o.__esModule?o:{default:o};var a=[],i=null,s=!1;function c(){s=!0}function u(){if(s){if(s=!1,!i)return;setTimeout((function(){i.contains(document.activeElement)||((0,l.default)(i)[0]||i).focus()}),0)}}},function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default=function(e,t){var n=(0,l.default)(e);if(!n.length)return void t.preventDefault();var o=void 0,r=t.shiftKey,a=n[0],i=n[n.length-1];if(e===document.activeElement){if(!r)return;o=i}i!==document.activeElement||r||(o=a);a===document.activeElement&&r&&(o=i);if(o)return t.preventDefault(),void o.focus();var s=/(\bChrome\b|\bSafari\b)\//.exec(navigator.userAgent);if(null==s||"Chrome"==s[1]||null!=/\biPod\b|\biPad\b/g.exec(navigator.userAgent))return;var c=n.indexOf(document.activeElement);c>-1&&(c+=r?-1:1);if(void 0===(o=n[c]))return t.preventDefault(),void(o=r?i:a).focus();t.preventDefault(),o.focus()};var o,r=n(16),l=(o=r)&&o.__esModule?o:{default:o};e.exports=t.default},function(e,t,n){"use strict";var o=function(){};e.exports=o},function(e,t,n){var o;
/*!
  Copyright (c) 2015 Jed Watson.
  Based on code that is Copyright 2013-2015, Facebook, Inc.
  All rights reserved.
*/!function(){"use strict";var r=!("undefined"==typeof window||!window.document||!window.document.createElement),l={canUseDOM:r,canUseWorkers:"undefined"!=typeof Worker,canUseEventListeners:r&&!(!window.addEventListener&&!window.attachEvent),canUseViewport:r&&!!window.screen};void 0===(o=function(){return l}.call(t,n,t,e))||(e.exports=o)}()},function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.dumpClassLists=function(){0};var o={},r={};t.add=function(e,t){return n=e.classList,l="html"==e.nodeName.toLowerCase()?o:r,void t.split(" ").forEach((function(e){!function(e,t){e[t]||(e[t]=0),e[t]+=1}(l,e),n.add(e)}));var n,l},t.remove=function(e,t){return n=e.classList,l="html"==e.nodeName.toLowerCase()?o:r,void t.split(" ").forEach((function(e){!function(e,t){e[t]&&(e[t]-=1)}(l,e),0===l[e]&&n.remove(e)}));var n,l}},function(e,t,n){"use strict";var o,r=n(18),l=(o=r)&&o.__esModule?o:{default:o};var a=void 0,i=void 0,s=[];function c(){0!==s.length&&s[s.length-1].focusContent()}l.default.subscribe((function(e,t){a&&i||((a=document.createElement("div")).setAttribute("data-react-modal-body-trap",""),a.style.position="absolute",a.style.opacity="0",a.setAttribute("tabindex","0"),a.addEventListener("focus",c),(i=a.cloneNode()).addEventListener("focus",c)),(s=t).length>0?(document.body.firstChild!==a&&document.body.insertBefore(a,document.body.firstChild),document.body.lastChild!==i&&document.body.appendChild(i)):(a.parentElement&&a.parentElement.removeChild(a),i.parentElement&&i.parentElement.removeChild(i))}))},function(e,t,n){"use strict";function o(){var e=this.constructor.getDerivedStateFromProps(this.props,this.state);null!=e&&this.setState(e)}function r(e){this.setState(function(t){var n=this.constructor.getDerivedStateFromProps(e,t);return null!=n?n:null}.bind(this))}function l(e,t){try{var n=this.props,o=this.state;this.props=e,this.state=t,this.__reactInternalSnapshotFlag=!0,this.__reactInternalSnapshot=this.getSnapshotBeforeUpdate(n,o)}finally{this.props=n,this.state=o}}function a(e){var t=e.prototype;if(!t||!t.isReactComponent)throw new Error("Can only polyfill class components");if("function"!=typeof e.getDerivedStateFromProps&&"function"!=typeof t.getSnapshotBeforeUpdate)return e;var n=null,a=null,i=null;if("function"==typeof t.componentWillMount?n="componentWillMount":"function"==typeof t.UNSAFE_componentWillMount&&(n="UNSAFE_componentWillMount"),"function"==typeof t.componentWillReceiveProps?a="componentWillReceiveProps":"function"==typeof t.UNSAFE_componentWillReceiveProps&&(a="UNSAFE_componentWillReceiveProps"),"function"==typeof t.componentWillUpdate?i="componentWillUpdate":"function"==typeof t.UNSAFE_componentWillUpdate&&(i="UNSAFE_componentWillUpdate"),null!==n||null!==a||null!==i){var s=e.displayName||e.name,c="function"==typeof e.getDerivedStateFromProps?"getDerivedStateFromProps()":"getSnapshotBeforeUpdate()";throw Error("Unsafe legacy lifecycles will not be called for components using new component APIs.\n\n"+s+" uses "+c+" but also contains the following legacy lifecycles:"+(null!==n?"\n  "+n:"")+(null!==a?"\n  "+a:"")+(null!==i?"\n  "+i:"")+"\n\nThe above lifecycles should be removed. Learn more about this warning here:\nhttps://fb.me/react-async-component-lifecycle-hooks")}if("function"==typeof e.getDerivedStateFromProps&&(t.componentWillMount=o,t.componentWillReceiveProps=r),"function"==typeof t.getSnapshotBeforeUpdate){if("function"!=typeof t.componentDidUpdate)throw new Error("Cannot polyfill getSnapshotBeforeUpdate() for components that do not define componentDidUpdate() on the prototype");t.componentWillUpdate=l;var u=t.componentDidUpdate;t.componentDidUpdate=function(e,t,n){var o=this.__reactInternalSnapshotFlag?this.__reactInternalSnapshot:n;u.call(this,e,t,o)}}return e}n.r(t),n.d(t,"polyfill",(function(){return a})),o.__suppressDeprecationWarning=!0,r.__suppressDeprecationWarning=!0,l.__suppressDeprecationWarning=!0},function(e,t,n){"use strict";n.r(t);var o=n(0),r=n(19),l=n(2),a=n(3),i=n(12),s=n(1),c=n(4),u=n.n(c),p=Object(a.compose)(Object(l.withSelect)((function(e,t){return{value:e("core/editor").getEditedPostAttribute("meta")[t.metaKey]}})),Object(l.withDispatch)((function(e,t){return{setValue:function(n){e("core/editor").editPost({meta:u()({},t.metaKey,n)})}}})))((function(e){var t=e.placeholder||"",n=e.help||"";return Object(o.createElement)(s.TextControl,{label:e.label,value:e.value,placeholder:t,help:n,onChange:function(t){return e.setValue(t)}})})),d=Object(a.compose)(Object(l.withSelect)((function(e,t){return{value:e("core/editor").getEditedPostAttribute("meta")[t.metaKey]}})),Object(l.withDispatch)((function(e,t){return{setValue:function(n){e("core/editor").editPost({meta:u()({},t.metaKey,n)})}}})))((function(e){var t=e.placeholder||"",n=e.help||"";return Object(o.createElement)(s.TextareaControl,{label:e.label,value:e.value,placeholder:t,help:n,onChange:function(t){return e.setValue(t)}})})),f=n(13);function m(e){for(var t=arguments.length,n=new Array(t>1?t-1:0),o=1;o<t;o++)n[o-1]=arguments[o];return n.reduce((function(e,t){return e&&e[t]?e[t]:null}),e)}function h(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"wp_social_preview_default";if(!e)return null;var n=Object(l.select)("core").getMedia(e);if(!n)return null;var o=m(n,"media_details","sizes",t,"source_url");return o||(o=m(n,"media_details","sizes","thumbnail","source_url")),o}var b=Object(a.compose)(Object(l.withSelect)((function(e,t){var n=e("core/editor").getEditedPostAttribute("meta")[t.metaKey];return{value:n,url:h(n)}})),Object(l.withDispatch)((function(e,t){return{setValue:function(n){e("core/editor").editPost({meta:u()({},t.metaKey,n)})}}})))((function(e){return Object(o.createElement)("div",{class:"components-base-control"},Object(o.createElement)("div",{className:"components-base-control__field"},Object(o.createElement)("label",{className:"components-base-control__label"},e.label),Object(o.createElement)("div",{className:"wp-social-preview-sidebar-media-upload-control"},e.url&&Object(o.createElement)("div",null,Object(o.createElement)("img",{src:e.url,alt:""})),Object(o.createElement)("div",null,Object(o.createElement)(f.MediaUploadCheck,null,Object(o.createElement)(f.MediaUpload,{onSelect:function(t){return e.setValue(t.id)},allowedTypes:["image"],value:e.value,render:function(e){var t=e.open;return Object(o.createElement)(s.Button,{className:"button",onClick:t},"Choose Image")}})),e.url&&Object(o.createElement)(s.Button,{isLink:!0,isDestructive:!0,onClick:function(){return e.setValue(null)}},"Remove Image")))))})),v=n(6),y=n.n(v),w=n(7),O=n.n(w),g=n(8),_=n.n(g),E=n(9),C=n.n(E),j=n(5),P=n.n(j);function S(e){var t=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Date.prototype.toString.call(Reflect.construct(Date,[],(function(){}))),!0}catch(e){return!1}}();return function(){var n,o=P()(e);if(t){var r=P()(this).constructor;n=Reflect.construct(o,arguments,r)}else n=o.apply(this,arguments);return C()(this,n)}}var M=function(e){_()(n,e);var t=S(n);function n(){return y()(this,n),t.apply(this,arguments)}return O()(n,[{key:"render",value:function(){var e=this.props.type||"facebook";return Object(o.createElement)("div",{className:"wp-social-preview-share-preview wp-social-preview-share-preview-".concat(e)},this.props.imageUrl?Object(o.createElement)("div",{className:"wp-social-preview-share-preview-image",style:{backgroundImage:"url('".concat(this.props.imageUrl,"')")}}):Object(o.createElement)("div",{className:"wp-social-preview-share-preview-image-empty"}),Object(o.createElement)("div",{className:"wp-social-preview-share-preview-content"},Object(o.createElement)("div",{className:"wp-social-preview-share-preview-url"},this.props.url),Object(o.createElement)("div",{className:"wp-social-preview-share-preview-title"},this.props.title),Object(o.createElement)("div",{className:"wp-social-preview-share-preview-description"},this.props.description)))}}]),n}(o.Component),R=n(10),N=n.n(R),x=n(20),k=n.n(x);function U(e){var t=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Date.prototype.toString.call(Reflect.construct(Date,[],(function(){}))),!0}catch(e){return!1}}();return function(){var n,o=P()(e);if(t){var r=P()(this).constructor;n=Reflect.construct(o,arguments,r)}else n=o.apply(this,arguments);return C()(this,n)}}var T={overlay:{backgroundColor:"rgba(0, 0, 0, 0.75)",zIndex:99999},content:{top:"50%",left:"50%",right:"auto",bottom:"auto",transform:"translate(-50%, -50%)",width:"100%",maxWidth:"902px",height:"100%",maxHeight:"70%",overflow:"visible",padding:"0px",background:"transparent",border:"0",borderRadius:"0"}},D=function(e){_()(n,e);var t=U(n);function n(e){var o;return y()(this,n),(o=t.call(this,e)).state={showModal:!1},o.openModal=o.openModal.bind(N()(o)),o.closeModal=o.closeModal.bind(N()(o)),o}return O()(n,[{key:"openModal",value:function(){this.setState({showModal:!0})}},{key:"closeModal",value:function(){this.setState({showModal:!1})}},{key:"render",value:function(){return Object(o.createElement)("div",{className:"wp-social-preview-modal"},Object(o.createElement)("button",{className:"components-button button",onClick:this.openModal},"View Full Size Previews"),Object(o.createElement)(k.a,{isOpen:this.state.showModal,onRequestClose:this.closeModal,ariaHideApp:!1,style:T,contentLabel:"WP Social Preview Modal"},Object(o.createElement)("button",{className:"wp-social-preview-modal-close",onClick:this.closeModal},Object(o.createElement)("span",{className:"dashicons dashicons-no"})),Object(o.createElement)("div",{className:"wp-social-preview-modal-content"},Object(o.createElement)("div",{className:"wp-social-preview-modal-wrap"},Object(o.createElement)("div",{className:"wp-social-preview-modal-main"},Object(o.createElement)("p",null,"Facebook Preview:"),Object(o.createElement)(M,{type:"facebook",imageUrl:this.props.imageUrl,url:this.props.url,title:this.props.title,description:this.props.description}),Object(o.createElement)("p",null,"Twitter Preview:"),Object(o.createElement)(M,{type:"twitter",imageUrl:this.props.imageUrl,url:this.props.url,title:this.props.title,description:this.props.description}),Object(o.createElement)("p",null,"LinkedIn Preview:"),Object(o.createElement)(M,{type:"linkedin",imageUrl:this.props.imageUrl,url:this.props.url,title:this.props.title,description:this.props.description}),this.props.imageUrl&&Object(o.createElement)(o.Fragment,null,Object(o.createElement)("p",null,"Pinterest Preview:"),Object(o.createElement)(M,{type:"pinterest",imageUrl:this.props.imageUrl,url:this.props.url,title:this.props.title,description:this.props.description}))),Object(o.createElement)("div",{className:"wp-social-preview-modal-sidebar"},Object(o.createElement)("p",{style:{margin:"0"}},Object(o.createElement)("strong",null,"Share Settings")),Object(o.createElement)(b,{metaKey:"wp_social_preview_image",label:"Image"}),Object(o.createElement)(p,{metaKey:"wp_social_preview_title",label:"Title",placeholder:this.props.placeholders.wp_social_preview_title}),Object(o.createElement)(d,{metaKey:"wp_social_preview_description",label:"Description",placeholder:this.props.placeholders.wp_social_preview_description}))))))}}]),n}(o.Component),A=Object(a.compose)(Object(l.withSelect)((function(e){(o=document.createElement("a")).href=e("core/editor").getPermalink();var t=o.hostname,n=e("core/editor").getEditedPostContent(),o=document.createElement("div");o.innerHTML=n;var r=(o.textContent||o.innerText||"").replace("\n","");r.length>100&&(r=r.substring(0,100)+"...");var l=e("core/editor").getEditedPostAttribute("meta").wp_social_preview_image;return l||(l=e("core/editor").getEditedPostAttribute("featured_media")),l||(l=window.WPSocialPreview.fallback_image),{hostname:t,meta:e("core/editor").getEditedPostAttribute("meta"),placeholder:{wp_social_preview_title:e("core/editor").getEditedPostAttribute("title"),wp_social_preview_description:r},imageUrl:h(l)}})))((function(e){var t=e.meta.wp_social_preview_title||e.placeholder.wp_social_preview_title,n=e.meta.wp_social_preview_description||e.placeholder.wp_social_preview_description;return Object(o.createElement)(i.PluginSidebar,{name:"wp-social-preview-editor-sidebar",className:"wp-social-preview-editor-sidebar",title:"WP Social Preview",icon:"share-alt2"},Object(o.createElement)(s.Panel,null,Object(o.createElement)(s.PanelBody,{title:"Share Settings",initialOpen:!0},Object(o.createElement)(s.PanelRow,null,Object(o.createElement)("div",null,Object(o.createElement)("a",{href:"https://ogp.me/",target:"_blank"},"Open Graph")," meta tags are used to generate rich previews when content is shared on social media. Use these settings to override the meta tags for this content.")),Object(o.createElement)(s.PanelRow,null,Object(o.createElement)("div",{className:"components-base-control"},Object(o.createElement)("div",{className:"components-base-control__field"},Object(o.createElement)("label",{className:"components-base-control__label"},"Preview"),Object(o.createElement)(M,{imageUrl:e.imageUrl,url:e.hostname,title:t,description:n}),Object(o.createElement)("br",null),Object(o.createElement)(D,{imageUrl:e.imageUrl,url:e.hostname,title:t,description:n,placeholders:e.placeholder})))),Object(o.createElement)(s.PanelRow,null,Object(o.createElement)(b,{metaKey:"wp_social_preview_image",label:"Image"})),Object(o.createElement)(s.PanelRow,null,Object(o.createElement)(p,{metaKey:"wp_social_preview_title",label:"Title",placeholder:e.placeholder.wp_social_preview_title})),Object(o.createElement)(s.PanelRow,null,Object(o.createElement)(d,{metaKey:"wp_social_preview_description",label:"Description",placeholder:e.placeholder.wp_social_preview_description})))))}));Object(r.registerPlugin)("wp-social-preview-editor-sidebar",{render:function(){return Object(o.createElement)(o.Fragment,null,Object(o.createElement)(i.PluginSidebarMoreMenuItem,{target:"wp-social-preview-editor-sidebar",icon:"share-alt2"},"WP Social Preview"),Object(o.createElement)(A,null))}})}]);