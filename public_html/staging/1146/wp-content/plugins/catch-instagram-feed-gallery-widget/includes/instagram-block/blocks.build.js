!function(e){var t={};function n(r){if(t[r])return t[r].exports;var l=t[r]={i:r,l:!1,exports:{}};return e[r].call(l.exports,l,l.exports,n),l.l=!0,l.exports}n.m=e,n.c=t,n.d=function(e,t,r){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:r})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var r=Object.create(null);if(n.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var l in e)n.d(r,l,function(t){return e[t]}.bind(null,l));return r},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=724)}({724:function(e,t,n){"use strict";n(734);var r=wp.blocks.registerBlockType,l=wp.components,o=l.PanelBody,u=l.RangeControl,c=l.ServerSideRender,a=wp.element.Fragment,i=wp.editor.InspectorControls,s=wp.i18n.__;r("social-gallery-block/social-gallery-block",{title:"Social Gallery Block",icon:"share-alt",category:"widgets",edit:function(e){var t=e.attributes,n=e.setAttributes,r=t.number;return wp.element.createElement(a,null,wp.element.createElement(i,null,wp.element.createElement(o,null,wp.element.createElement(u,{label:s("Number of posts","catch-instagram-feed-gallery-widget"),value:r,onChange:function(e){return n({number:e})},min:1,max:30}))),wp.element.createElement(c,{block:"social-gallery-block/social-gallery-block",attributes:t}))},save:function(){return null}})},734:function(e,t){}});