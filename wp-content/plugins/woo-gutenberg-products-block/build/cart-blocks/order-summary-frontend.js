(window.webpackWcBlocksJsonp=window.webpackWcBlocksJsonp||[]).push([[29],{149:function(e,t,n){"use strict";var c=n(4),a=n.n(c),o=n(26),r=n.n(o),s=n(0),i=["srcElement","size"];function l(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var c=Object.getOwnPropertySymbols(e);t&&(c=c.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,c)}return n}t.a=function(e){var t=e.srcElement,n=e.size,c=void 0===n?24:n,o=r()(e,i);return Object(s.isValidElement)(t)?Object(s.cloneElement)(t,function(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?l(Object(n),!0).forEach((function(t){a()(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):l(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}({width:c,height:c},o)):null}},154:function(e,t){},156:function(e,t){},212:function(e,t,n){"use strict";var c=n(21),a=n.n(c),o=n(26),r=n.n(o),s=n(39),i=["className","size"],l=function(e){var t=e.className,n=e.size,c=r()(e,i);return React.createElement(s.SVG,a()({xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 20 20",className:t,width:n,height:n},c),React.createElement("path",{d:"M14.95 6.46L11.41 10l3.54 3.54-1.41 1.41L10 11.42l-3.53 3.53-1.42-1.42L8.58 10 5.05 6.47l1.42-1.42L10 8.58l3.54-3.53z"}))},p=React.createElement(l,null);t.a=p},217:function(e,t,n){"use strict";var c=n(21),a=n.n(c),o=n(26),r=n.n(o),s=(n(9),n(8)),i=n.n(s),l=n(1),p=n(149),u=n(212),d=(n(156),["text","screenReaderText","element","className","radius","children"]),b=function(e){var t=e.text,n=e.screenReaderText,c=void 0===n?"":n,o=e.element,s=void 0===o?"li":o,l=e.className,p=void 0===l?"":l,u=e.radius,b=void 0===u?"small":u,m=e.children,g=void 0===m?null:m,f=r()(e,d),v=s,h=i()(p,"wc-block-components-chip","wc-block-components-chip--radius-"+b),O=Boolean(c&&c!==t);return React.createElement(v,a()({className:h},f),React.createElement("span",{"aria-hidden":O,className:"wc-block-components-chip__text"},t),O&&React.createElement("span",{className:"screen-reader-text"},c),g)},m=["ariaLabel","className","disabled","onRemove","removeOnAnyClick","text","screenReaderText"];t.a=function(e){var t=e.ariaLabel,n=void 0===t?"":t,c=e.className,o=void 0===c?"":c,s=e.disabled,d=void 0!==s&&s,g=e.onRemove,f=void 0===g?function(){}:g,v=e.removeOnAnyClick,h=void 0!==v&&v,O=e.text,R=e.screenReaderText,_=void 0===R?"":R,j=r()(e,m),w=h?"span":"button";if(!n){var E=_&&"string"==typeof _?_:O;n="string"!=typeof E?
/* translators: Remove chip. */
Object(l.__)("Remove","woo-gutenberg-products-block"):Object(l.sprintf)(
/* translators: %s text of the chip to remove. */
Object(l.__)('Remove "%s"',"woo-gutenberg-products-block"),E)}var y={"aria-label":n,disabled:d,onClick:f,onKeyDown:function(e){"Backspace"!==e.key&&"Delete"!==e.key||f()}},k=h?y:{},C=h?{"aria-hidden":!0}:y;return React.createElement(b,a()({},j,k,{className:i()(o,"is-removable"),element:h?"button":j.element,screenReaderText:_,text:O}),React.createElement(w,a()({className:"wc-block-components-chip__remove"},C),React.createElement(p.a,{className:"wc-block-components-chip__remove-icon",srcElement:u.a,size:16})))}},271:function(e,t,n){"use strict";var c=n(21),a=n.n(c),o=n(172);t.a=function(e){return function(t){return function(n){var c=Object(o.a)(e,n);return React.createElement(t,a()({},n,c))}}}},272:function(e,t,n){"use strict";var c=n(21),a=n.n(c),o=n(26),r=n.n(o),s=n(8),i=n.n(s),l=(n(9),n(273),["children","className","headingLevel"]);t.a=function(e){var t=e.children,n=e.className,c=e.headingLevel,o=r()(e,l),s=i()("wc-block-components-title",n),p="h".concat(c);return React.createElement(p,a()({className:s},o),t)}},273:function(e,t){},274:function(e,t,n){"use strict";t.a=function(e){var t=e.label,n=e.secondaryLabel,c=e.description,a=e.secondaryDescription,o=e.id;return React.createElement("div",{className:"wc-block-components-radio-control__option-layout"},React.createElement("div",{className:"wc-block-components-radio-control__label-group"},t&&React.createElement("span",{id:o&&"".concat(o,"__label"),className:"wc-block-components-radio-control__label"},t),n&&React.createElement("span",{id:o&&"".concat(o,"__secondary-label"),className:"wc-block-components-radio-control__secondary-label"},n)),React.createElement("div",{className:"wc-block-components-radio-control__description-group"},c&&React.createElement("span",{id:o&&"".concat(o,"__description"),className:"wc-block-components-radio-control__description"},c),a&&React.createElement("span",{id:o&&"".concat(o,"__secondary-description"),className:"wc-block-components-radio-control__secondary-description"},a)))}},275:function(e,t,n){"use strict";var c=n(4),a=n.n(c),o=n(8),r=n.n(o),s=n(274);t.a=function(e){var t,n=e.checked,c=e.name,o=e.onChange,i=e.option,l=i.value,p=i.label,u=i.description,d=i.secondaryLabel,b=i.secondaryDescription;return React.createElement("label",{className:r()("wc-block-components-radio-control__option",{"wc-block-components-radio-control__option-checked":n}),htmlFor:"".concat(c,"-").concat(l)},React.createElement("input",{id:"".concat(c,"-").concat(l),className:"wc-block-components-radio-control__input",type:"radio",name:c,value:l,onChange:function(e){return o(e.target.value)},checked:n,"aria-describedby":r()((t={},a()(t,"".concat(c,"-").concat(l,"__label"),p),a()(t,"".concat(c,"-").concat(l,"__secondary-label"),d),a()(t,"".concat(c,"-").concat(l,"__description"),u),a()(t,"".concat(c,"-").concat(l,"__secondary-description"),b),t))}),React.createElement(s.a,{id:"".concat(c,"-").concat(l),label:p,secondaryLabel:d,description:u,secondaryDescription:b}))}},276:function(e,t,n){"use strict";var c=n(21),a=n.n(c),o=n(26),r=n.n(o),s=n(82),i=n(8),l=n.n(i),p=n(167),u=(n(278),["className","showSpinner","children"]);t.a=function(e){var t=e.className,n=e.showSpinner,c=void 0!==n&&n,o=e.children,i=r()(e,u),d=l()("wc-block-components-button",t,{"wc-block-components-button--loading":c});return React.createElement(s.a,a()({className:d},i),c&&React.createElement(p.a,null),React.createElement("span",{className:"wc-block-components-button__text"},o))}},278:function(e,t){},285:function(e,t,n){"use strict";var c=n(8),a=n.n(c),o=n(25),r=n(275);n(286),t.a=Object(o.withInstanceId)((function(e){var t=e.className,n=e.instanceId,c=e.id,o=e.selected,s=e.onChange,i=e.options,l=void 0===i?[]:i,p=c||n;return l.length&&React.createElement("div",{className:a()("wc-block-components-radio-control",t)},l.map((function(e){return React.createElement(r.a,{key:"".concat(p,"-").concat(e.value),name:"radio-control-".concat(p),checked:e.value===o,option:e,onChange:function(t){s(t),"function"==typeof e.onChange&&e.onChange(t)}})})))}))},286:function(e,t){},288:function(e,t){},289:function(e,t){},294:function(e,t,n){"use strict";var c=n(26),a=n.n(c),o=n(1),r=n(0),s=n(33),i=n(168),l=n(29),p=n(321),u=n(41),d=n(43),b=n(8),m=n.n(b),g=n(31),f=n(48),v=n(5),h=n.n(v),O=n(22),R=n.n(O),_=n(128),j=n(53),w=function(e){var t;return null===(t=e.find((function(e){return e.selected})))||void 0===t?void 0:t.rate_id},E=n(285),y=n(274),k=n(63),C=n(85),S=n(2),N=function(e){var t=Object(S.getSetting)("displayCartPricesIncludingTax",!1)?parseInt(e.price,10)+parseInt(e.taxes,10):parseInt(e.price,10);return{label:Object(g.decodeEntities)(e.name),value:e.rate_id,description:React.createElement(React.Fragment,null,Number.isFinite(t)&&React.createElement(C.a,{currency:Object(k.getCurrencyFromPriceResponse)(e),value:t}),Number.isFinite(t)&&e.delivery_time?" — ":null,Object(g.decodeEntities)(e.delivery_time))}},x=function(e){var t=e.className,n=e.noResultsMessage,c=e.onSelectRate,a=e.rates,o=e.renderOption,r=void 0===o?N:o,s=e.selected;if(0===a.length)return n;if(a.length>1)return React.createElement(E.a,{className:t,onChange:function(e){c(e)},selected:s,options:a.map(r)});var i=r(a[0]),l=i.label,p=i.secondaryLabel,u=i.description,d=i.secondaryDescription;return React.createElement(y.a,{label:l,secondaryLabel:p,description:u,secondaryDescription:d})},I=(n(289),function(e){var t=e.packageId,n=e.className,c=e.noResultsMessage,a=e.renderOption,s=e.packageData,i=e.collapsible,p=void 0!==i&&i,u=e.collapse,d=void 0!==u&&u,b=e.showItems,v=void 0!==b&&b,O=function(e,t){var n=Object(j.a)().dispatchCheckoutEvent,c=Object(_.a)(),a=c.selectShippingRate,o=c.isSelectingRate,s=Object(r.useState)((function(){return w(t)})),i=h()(s,2),l=i[0],p=i[1],u=Object(r.useRef)(t);return Object(r.useEffect)((function(){R()(u.current,t)||(u.current=t,p(w(t)))}),[t]),{selectShippingRate:Object(r.useCallback)((function(t){p(t),a(t,e),n("set-selected-shipping-rate",{shippingRateId:t})}),[e,a,n]),selectedShippingRate:l,isSelectingRate:o}}(t,s.shipping_rates),E=O.selectShippingRate,y=O.selectedShippingRate,k=React.createElement(React.Fragment,null,(v||p)&&React.createElement("div",{className:"wc-block-components-shipping-rates-control__package-title"},s.name),v&&React.createElement("ul",{className:"wc-block-components-shipping-rates-control__package-items"},Object.values(s.items).map((function(e){var t=Object(g.decodeEntities)(e.name),n=e.quantity;return React.createElement("li",{key:e.key,className:"wc-block-components-shipping-rates-control__package-item"},React.createElement(f.a,{label:n>1?"".concat(t," × ").concat(n):"".concat(t),screenReaderLabel:Object(o.sprintf)(
/* translators: %1$s name of the product (ie: Sunglasses), %2$d number of units in the current cart package */
Object(o._n)("%1$s (%2$d unit)","%1$s (%2$d units)",n,"woo-gutenberg-products-block"),t,n)}))})))),C=React.createElement(x,{className:n,noResultsMessage:c,rates:s.shipping_rates,onSelectRate:E,selected:y,renderOption:a});return p?React.createElement(l.Panel,{className:"wc-block-components-shipping-rates-control__package",initialOpen:!d,title:k},C):React.createElement("div",{className:m()("wc-block-components-shipping-rates-control__package",n)},k,C)}),P=["package_id"],T=["extensions","receiveCart"],L=function(e){var t=e.packages,n=e.collapse,c=e.showItems,o=e.collapsible,r=e.noResultsMessage,s=e.renderOption;return t.length?React.createElement(React.Fragment,null,t.map((function(e){var t=e.package_id,i=a()(e,P);return React.createElement(I,{key:t,packageId:t,packageData:i,collapsible:o,collapse:n,showItems:c,noResultsMessage:r,renderOption:s})}))):null};t.a=function(e){var t=e.shippingRates,n=e.shippingRatesLoading,c=e.className,b=e.collapsible,m=void 0!==b&&b,g=e.noResultsMessage,f=e.renderOption;Object(r.useEffect)((function(){if(!n){var e=Object(p.a)(t),c=Object(p.b)(t);1===e?Object(s.speak)(Object(o.sprintf)(
/* translators: %d number of shipping options found. */
Object(o._n)("%d shipping option was found.","%d shipping options were found.",c,"woo-gutenberg-products-block"),c)):Object(s.speak)(Object(o.sprintf)(
/* translators: %d number of shipping packages packages. */
Object(o._n)("Shipping option searched for %d package.","Shipping options searched for %d packages.",e,"woo-gutenberg-products-block"),e)+" "+Object(o.sprintf)(
/* translators: %d number of shipping options available. */
Object(o._n)("%d shipping option was found","%d shipping options were found",c,"woo-gutenberg-products-block"),c))}}),[n,t]);var v=Object(u.a)(),h=v.extensions,O=(v.receiveCart,{className:c,collapsible:m,noResultsMessage:g,renderOption:f,extensions:h,cart:a()(v,T),components:{ShippingRatesControlPackage:I}}),R=Object(d.a)().isEditor;return React.createElement(i.a,{isLoading:n,screenReaderLabel:Object(o.__)("Loading shipping rates…","woo-gutenberg-products-block"),showSpinner:!0},R?React.createElement(L,{packages:t,noResultsMessage:g,renderOption:f}):React.createElement(React.Fragment,null,React.createElement(l.ExperimentalOrderShippingPackages.Slot,O),React.createElement(l.ExperimentalOrderShippingPackages,null,React.createElement(L,{packages:t,noResultsMessage:g,renderOption:f}))))}},299:function(e,t){},300:function(e,t){},301:function(e,t){},305:function(e,t){},312:function(e,t,n){"use strict";n.d(t,"a",(function(){return v}));var c=n(4),a=n.n(c),o=n(1),r=n(11),s=n(7),i=n(31),l=n(41),p=n(0),u=n(255);function d(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var c=Object.getOwnPropertySymbols(e);t&&(c=c.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,c)}return n}function b(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?d(Object(n),!0).forEach((function(t){a()(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):d(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}var m=n(169),g=n(60);function f(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var c=Object.getOwnPropertySymbols(e);t&&(c=c.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,c)}return n}var v=function(){var e=Object(l.a)(),t=e.cartCoupons,n=e.cartIsLoading,c=Object(g.a)().addErrorNotice,d=function(){var e=Object(u.b)(),t=e.notices,n=e.createSnackbarNotice,c=e.removeSnackbarNotice,a=e.setIsSuppressed,o=Object(p.useRef)(t);Object(p.useEffect)((function(){o.current=t}),[t]);var r=Object(p.useMemo)((function(){return{removeNotices:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null;o.current.forEach((function(t){null!==e&&t.status!==e||c(t.id)}))},removeSnackbarNotice:c}}),[c]),s=Object(p.useMemo)((function(){return{addSnackbarNotice:function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{};n(e,t)}}}),[n]);return b(b(b({notices:t},r),s),{},{setIsSuppressed:a})}().addSnackbarNotice,v=Object(m.b)().setValidationErrors;return function(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?f(Object(n),!0).forEach((function(t){a()(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):f(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}({appliedCoupons:t,isLoading:n},Object(r.useSelect)((function(e,t){var n=t.dispatch,a=e(s.CART_STORE_KEY),r=a.isApplyingCoupon(),l=a.isRemovingCoupon(),p=n(s.CART_STORE_KEY),u=p.applyCoupon,b=p.removeCoupon,m=p.receiveApplyingCoupon;return{applyCoupon:function(e){u(e).then((function(t){!0===t&&d(Object(o.sprintf)(
/* translators: %s coupon code. */
Object(o.__)('Coupon code "%s" has been applied to your cart.',"woo-gutenberg-products-block"),e),{id:"coupon-form"})})).catch((function(e){v({coupon:{message:Object(i.decodeEntities)(e.message),hidden:!1}}),m("")}))},removeCoupon:function(e){b(e).then((function(t){!0===t&&d(Object(o.sprintf)(
/* translators: %s coupon code. */
Object(o.__)('Coupon code "%s" has been removed from your cart.',"woo-gutenberg-products-block"),e),{id:"coupon-form"})})).catch((function(e){c(e.message,{id:"coupon-form"}),m("")}))},isApplyingCoupon:r,isRemovingCoupon:l}}),[c,d]))}},321:function(e,t,n){"use strict";n.d(t,"a",(function(){return c})),n.d(t,"b",(function(){return a}));var c=function(e){return e.length},a=function(e){return e.reduce((function(e,t){return e+t.shipping_rates.length}),0)}},350:function(e,t,n){"use strict";var c=n(1),a=n(168),o=n(217),r=(n(9),n(29)),s=n(2),i=(n(299),{context:"summary"});t.a=function(e){var t=e.cartCoupons,n=void 0===t?[]:t,l=e.currency,p=e.isRemovingCoupon,u=e.removeCoupon,d=e.values,b=d.total_discount,m=d.total_discount_tax,g=parseInt(b,10);if(!g&&0===n.length)return null;var f=parseInt(m,10),v=Object(s.getSetting)("displayCartPricesIncludingTax",!1)?g+f:g,h=Object(r.__experimentalApplyCheckoutFilter)({arg:i,filterName:"coupons",defaultValue:n});return React.createElement(r.TotalsItem,{className:"wc-block-components-totals-discount",currency:l,description:0!==h.length&&React.createElement(a.a,{screenReaderLabel:Object(c.__)("Removing coupon…","woo-gutenberg-products-block"),isLoading:p,showSpinner:!1},React.createElement("ul",{className:"wc-block-components-totals-discount__coupon-list"},h.map((function(e){return React.createElement(o.a,{key:"coupon-"+e.code,className:"wc-block-components-totals-discount__coupon-list-item",text:e.label,screenReaderText:Object(c.sprintf)(
/* translators: %s Coupon code. */
Object(c.__)("Coupon: %s","woo-gutenberg-products-block"),e.label),disabled:p,onRemove:function(){u(e.code)},radius:"large",ariaLabel:Object(c.sprintf)(
/* translators: %s is a coupon code. */
Object(c.__)('Remove coupon "%s"',"woo-gutenberg-products-block"),e.label)})})))),label:v?Object(c.__)("Discount","woo-gutenberg-products-block"):Object(c.__)("Coupons","woo-gutenberg-products-block"),value:v?-1*v:"-"})}},351:function(e,t,n){"use strict";var c=n(5),a=n.n(c),o=n(1),r=n(0),s=n(276),i=n(325),l=n(48),p=n(168),u=(n(9),n(25)),d=n(169),b=n(293),m=n(29);n(300),t.a=Object(u.withInstanceId)((function(e){var t=e.instanceId,n=e.isLoading,c=void 0!==n&&n,u=e.initialOpen,g=void 0!==u&&u,f=e.onSubmit,v=void 0===f?function(){}:f,h=Object(r.useState)(""),O=a()(h,2),R=O[0],_=O[1],j=Object(r.useRef)(!1),w=Object(d.b)(),E=w.getValidationError,y=w.getValidationErrorId,k=E("coupon");Object(r.useEffect)((function(){j.current!==c&&(c||!R||k||_(""),j.current=c)}),[c,R,k]);var C="wc-block-components-totals-coupon__input-".concat(t);return React.createElement(m.Panel,{className:"wc-block-components-totals-coupon",hasBorder:!1,initialOpen:g,title:React.createElement(l.a,{label:Object(o.__)("Coupon code","woo-gutenberg-products-block"),screenReaderLabel:Object(o.__)("Apply a coupon code","woo-gutenberg-products-block"),htmlFor:C})},React.createElement(p.a,{screenReaderLabel:Object(o.__)("Applying coupon…","woo-gutenberg-products-block"),isLoading:c,showSpinner:!1},React.createElement("div",{className:"wc-block-components-totals-coupon__content"},React.createElement("form",{className:"wc-block-components-totals-coupon__form"},React.createElement(i.a,{id:C,errorId:"coupon",className:"wc-block-components-totals-coupon__input",label:Object(o.__)("Enter code","woo-gutenberg-products-block"),value:R,ariaDescribedBy:y(C),onChange:function(e){_(e)},validateOnMount:!1,focusOnMount:!0,showError:!1}),React.createElement(s.a,{className:"wc-block-components-totals-coupon__button",disabled:c||!R,showSpinner:c,onClick:function(e){e.preventDefault(),v(R)},type:"submit"},Object(o.__)("Apply","woo-gutenberg-products-block"))),React.createElement(b.a,{propertyName:"coupon",elementId:C}))))}))},355:function(e,t,n){"use strict";var c=n(26),a=n.n(c),o=n(1),r=n(0),s=n(85),i=(n(9),n(29)),l=n(41),p=n(2),u=(n(305),["receiveCart"]);t.a=function(e){var t=e.currency,n=e.values,c=Object(p.getSetting)("taxesEnabled",!0)&&Object(p.getSetting)("displayCartPricesIncludingTax",!1),d=n.total_price,b=n.total_tax,m=Object(l.a)(),g=(m.receiveCart,a()(m,u)),f=Object(i.__experimentalApplyCheckoutFilter)({filterName:"totalLabel",defaultValue:Object(o.__)("Total","woo-gutenberg-products-block"),extensions:g.extensions,arg:{cart:g}}),v=parseInt(b,10);return React.createElement(i.TotalsItem,{className:"wc-block-components-totals-footer-item",currency:t,label:f,value:parseInt(d,10),description:c&&0!==v&&React.createElement("p",{className:"wc-block-components-totals-footer-item-tax"},Object(r.createInterpolateElement)(Object(o.__)("Including <TaxAmount/> in taxes","woo-gutenberg-products-block"),{TaxAmount:React.createElement(s.a,{className:"wc-block-components-totals-footer-item-tax-value",currency:t,value:v})}))})}},374:function(e,t,n){"use strict";var c=n(21),a=n.n(c),o=n(5),r=n.n(o),s=n(8),i=n.n(s),l=n(1),p=n(0),u=n(41),d=n(29),b=n(2),m=function(e){var t=e.selectedShippingRates;return React.createElement("div",{className:"wc-block-components-totals-item__description wc-block-components-totals-shipping__via"},Object(l.__)("via","woo-gutenberg-products-block")," ",t.join(", "))},g=n(152),f=n(294),v=function(e){var t=e.hasRates,n=e.shippingRates,c=e.shippingRatesLoading,a=t?Object(l.__)("Shipping options","woo-gutenberg-products-block"):Object(l.__)("Choose a shipping option","woo-gutenberg-products-block");return React.createElement("fieldset",{className:"wc-block-components-totals-shipping__fieldset"},React.createElement("legend",{className:"screen-reader-text"},a),React.createElement(f.a,{className:"wc-block-components-totals-shipping__options",collapsible:!0,noResultsMessage:React.createElement(g.a,{isDismissible:!1,className:i()("wc-block-components-shipping-rates-control__no-results-notice","woocommerce-error")},Object(l.__)("No shipping options were found.","woo-gutenberg-products-block")),shippingRates:n,shippingRatesLoading:c}))},h=n(81),O=n(276),R=n(22),_=n.n(R),j=n(169),w=(n(288),n(373)),E=function(e){var t=e.address,n=e.onUpdate,c=e.addressFields,a=Object(p.useState)(t),o=r()(a,2),s=o[0],i=o[1],u=Object(j.b)(),d=u.hasValidationErrors,b=u.showAllValidationErrors;return React.createElement("form",{className:"wc-block-components-shipping-calculator-address"},React.createElement(w.a,{fields:c,onChange:i,values:s}),React.createElement(O.a,{className:"wc-block-components-shipping-calculator-address__button",disabled:_()(s,t),onClick:function(e){if(e.preventDefault(),b(),!d)return n(s)},type:"submit"},Object(l.__)("Update","woo-gutenberg-products-block")))},y=function(e){var t=e.onUpdate,n=void 0===t?function(){}:t,c=e.addressFields,a=void 0===c?["country","state","city","postcode"]:c,o=Object(h.b)(),r=o.shippingAddress,s=o.setShippingAddress;return React.createElement("div",{className:"wc-block-components-shipping-calculator"},React.createElement(E,{address:r,addressFields:a,onUpdate:function(e){s(e),n(e)}}))},k=n(23),C=n.n(k),S=n(31),N=function(e){var t=e.address;if(0===Object.values(t).length)return null;var n=Object(b.getSetting)("shippingCountries",{}),c=Object(b.getSetting)("shippingStates",{}),a="string"==typeof n[t.country]?Object(S.decodeEntities)(n[t.country]):"",o="object"===C()(c[t.country])&&"string"==typeof c[t.country][t.state]?Object(S.decodeEntities)(c[t.country][t.state]):t.state,r=[];r.push(t.postcode.toUpperCase()),r.push(t.city),r.push(o),r.push(a);var s=r.filter(Boolean).join(", ");return s?React.createElement("span",{className:"wc-block-components-shipping-address"},Object(l.sprintf)(
/* translators: %s location. */
Object(l.__)("Shipping to %s","woo-gutenberg-products-block"),s)+" "):null},x=(n(301),function(e){var t=e.label,n=void 0===t?Object(l.__)("Calculate","woo-gutenberg-products-block"):t,c=e.isShippingCalculatorOpen,a=e.setIsShippingCalculatorOpen;return React.createElement("button",{className:"wc-block-components-totals-shipping__change-address-button",onClick:function(){a(!c)},"aria-expanded":c},n)}),I=function(e){var t=e.showCalculator,n=e.isShippingCalculatorOpen,c=e.setIsShippingCalculatorOpen,a=e.shippingAddress;return React.createElement(React.Fragment,null,React.createElement(N,{address:a}),t&&React.createElement(x,{label:Object(l.__)("(change address)","woo-gutenberg-products-block"),isShippingCalculatorOpen:n,setIsShippingCalculatorOpen:c}))},P=function(e){var t=e.showCalculator,n=e.isShippingCalculatorOpen,c=e.setIsShippingCalculatorOpen;return t?React.createElement(x,{isShippingCalculatorOpen:n,setIsShippingCalculatorOpen:c}):React.createElement("em",null,Object(l.__)("Calculated during checkout","woo-gutenberg-products-block"))};t.a=function(e){var t=e.currency,n=e.values,c=e.showCalculator,o=void 0===c||c,s=e.showRateSelector,g=void 0===s||s,f=e.className,h=Object(p.useState)(!1),O=r()(h,2),R=O[0],_=O[1],j=Object(u.a)(),w=j.shippingAddress,E=j.cartHasCalculatedShipping,k=j.shippingRates,C=j.shippingRatesLoading,S=Object(b.getSetting)("displayCartPricesIncludingTax",!1)?parseInt(n.total_shipping,10)+parseInt(n.total_shipping_tax,10):parseInt(n.total_shipping,10),N=k.some((function(e){return e.shipping_rates.length}))||S,x={isShippingCalculatorOpen:R,setIsShippingCalculatorOpen:_},T=k.flatMap((function(e){return e.shipping_rates.filter((function(e){return e.selected})).flatMap((function(e){return e.name}))}));return React.createElement("div",{className:i()("wc-block-components-totals-shipping",f)},React.createElement(d.TotalsItem,{label:Object(l.__)("Shipping","woo-gutenberg-products-block"),value:E?S:React.createElement(P,a()({showCalculator:o},x)),description:React.createElement(React.Fragment,null,E&&React.createElement(React.Fragment,null,React.createElement(m,{selectedShippingRates:T}),React.createElement(I,a()({shippingAddress:w,showCalculator:o},x)))),currency:t}),o&&R&&React.createElement(y,{onUpdate:function(){_(!1)}}),g&&E&&React.createElement(v,{hasRates:N,shippingRates:k,shippingRatesLoading:C}))}},402:function(e,t,n){"use strict";n.r(t);var c=n(271),a=n(26),o=n.n(a),r=n(1),s=n(350),i=n(351),l=n(374),p=n(355),u=n(29),d=n(63),b=n(41),m=n(312),g=n(2),f=n(272),v=["extensions","receiveCart"],h={isShippingCalculatorEnabled:{type:"boolean",default:Object(g.getSetting)("isShippingCalculatorEnabled",!0)},showRateAfterTaxName:{type:"boolean",default:Object(g.getSetting)("displayCartPricesIncludingTax",!1)},lock:{type:"object",default:{move:!0,remove:!0}}};t.default=Object(c.a)(h)((function(e){var t=e.className,n=e.showRateAfterTaxName,c=void 0!==n&&n,a=e.isShippingCalculatorEnabled,h=void 0===a||a,O=Object(b.a)(),R=O.cartFees,_=O.cartTotals,j=O.cartNeedsShipping,w=Object(m.a)(),E=w.applyCoupon,y=w.removeCoupon,k=w.isApplyingCoupon,C=w.isRemovingCoupon,S=w.appliedCoupons,N=Object(d.getCurrencyFromPriceResponse)(_),x=Object(b.a)(),I=x.extensions,P=(x.receiveCart,o()(x,v)),T={extensions:I,cart:P},L={extensions:I,cart:P};return React.createElement("div",{className:t},React.createElement(f.a,{headingLevel:"2",className:"wc-block-cart__totals-title"},Object(r.__)("Cart totals","woo-gutenberg-products-block")),React.createElement(u.TotalsWrapper,null,React.createElement(u.Subtotal,{currency:N,values:_}),React.createElement(u.TotalsFees,{currency:N,cartFees:R}),React.createElement(s.a,{cartCoupons:S,currency:N,isRemovingCoupon:C,removeCoupon:y,values:_})),Object(g.getSetting)("couponsEnabled",!0)&&React.createElement(u.TotalsWrapper,null,React.createElement(i.a,{onSubmit:E,isLoading:k})),React.createElement(u.ExperimentalDiscountsMeta.Slot,L),j&&React.createElement(u.TotalsWrapper,null,React.createElement(l.a,{showCalculator:h,showRateSelector:!0,values:_,currency:N})),!Object(g.getSetting)("displayCartPricesIncludingTax",!1)&&parseInt(_.total_tax,10)>0&&React.createElement(u.TotalsWrapper,null,React.createElement(u.TotalsTaxes,{showRateAfterTaxName:c,currency:N,values:_})),React.createElement(u.TotalsWrapper,null,React.createElement(p.a,{currency:N,values:_})),React.createElement(u.ExperimentalOrderMeta.Slot,T))}))},85:function(e,t,n){"use strict";var c=n(21),a=n.n(c),o=n(4),r=n.n(o),s=n(26),i=n.n(s),l=n(127),p=n(8),u=n.n(p),d=(n(154),["className","value","currency","onValueChange","displayType"]);function b(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var c=Object.getOwnPropertySymbols(e);t&&(c=c.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,c)}return n}function m(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?b(Object(n),!0).forEach((function(t){r()(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):b(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}t.a=function(e){var t=e.className,n=e.value,c=e.currency,o=e.onValueChange,r=e.displayType,s=void 0===r?"text":r,p=i()(e,d),b="string"==typeof n?parseInt(n,10):n;if(!Number.isFinite(b))return null;var g=b/Math.pow(10,c.minorUnit);if(!Number.isFinite(g))return null;var f=u()("wc-block-formatted-money-amount","wc-block-components-formatted-money-amount",t),v=m(m(m({},p),function(e){return{thousandSeparator:e.thousandSeparator,decimalSeparator:e.decimalSeparator,decimalScale:e.minorUnit,fixedDecimalScale:!0,prefix:e.prefix,suffix:e.suffix,isNumericString:!0}}(c)),{},{value:void 0,currency:void 0,onValueChange:void 0}),h=o?function(e){var t=e.value*Math.pow(10,c.minorUnit);o(t)}:function(){};return React.createElement(l.a,a()({className:f,displayType:s},v,{value:g,onValueChange:h}))}}}]);