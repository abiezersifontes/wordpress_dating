!function(t){function e(o){if(i[o])return i[o].exports;var n=i[o]={exports:{},id:o,loaded:!1};return t[o].call(n.exports,n,n.exports,e),n.loaded=!0,n.exports}var i={};return e.m=t,e.c=i,e.p="",e(0)}([function(t,e,i){t.exports=i(1)},function(t,e,i){"use strict";i(2),UxBuilder.controller("block",i(3)["default"]),UxBuilder.controller("col",i(9)["default"]),UxBuilder.controller("col_grid",i(10)["default"]),UxBuilder.controller("tabgroup",i(11)["default"]),UxBuilder.controller("text",i(12)["default"]),UxBuilder.controller("ux_banner",i(13)["default"]),UxBuilder.controller("ux_banner_grid",i(14)["default"]),UxBuilder.controller("ux_slider",i(15)["default"]),UxBuilder.controller("ux_hotspot",i(16)["default"]),UxBuilder.controller("scroll_to",i(17)["default"]),UxBuilder.controller("map",i(18)["default"]),UxBuilder.controller("text_box",i(19)["default"]),UxBuilder.on("shortcode-attached",function(t){console.debug("+ shortcode-attached",t.tag),Flatsome.attach(t.$element)}),UxBuilder.on("shortcode-moved",function(t){console.debug("⬍ shortcode-moved",t.tag),"scroll_to"===t.tag&&Flatsome.attach("scroll-to",t.$element)}),UxBuilder.on("shortcode-detached",function(t){console.debug("- shortcode-detached",t.tag),Flatsome.detach(t.$element)}),UxBuilder.addfilter("shortcode-content",function(t){return t.replace(/data-animate="(.*?)"/g,'data-animate="$1" data-animated="true"')}),UxBuilder.on("shortcode-content-change",function(t){console.debug("~ shortcode-content-change",t.tag)}),UxBuilder.on("shortcode-content-mcetoggleformat",function(t,e,i){console.debug("~ shortcode-content-mcetoggleformat",t.tag,e,i),Flatsome.detach(t.$element),Flatsome.attach(t.$element)})},function(t,e){"use strict";angular.module("uxBuilder").component("uxBannerTool",{controller:["app","$element",function(t,e){this.highlightHorizontalCenter=function(t){e.find(".grid-h-center").toggleClass("active",t)},this.highlightVerticalCenter=function(t){e.find(".grid-v-center").toggleClass("active",t)}}],controllerAs:"grid",template:'\n      <div class="grid-v-center"></div>\n      <div class="grid-h-center"></div>\n    '})},function(t,e,i){(function(t){"use strict";function o(t){return t&&t.__esModule?t:{"default":t}}Object.defineProperty(e,"__esModule",{value:!0});var n=i(4),s=o(n),r=i(5),l=o(r),c=function(){function e(t,i){(0,s["default"])(this,e),this.app=t,this.shortcode=i}return e.$inject=["app","shortcode"],(0,l["default"])(e,[{key:"$getShortcodeInfo",value:function(){var e=this;return this.shortcode._blockId!==this.shortcode.options.id&&(this.shortcode._blockId=this.shortcode.options.id,jQuery.get(t.flatsomeVars.ajaxurl,{action:"flatsome_block_title",block_id:this.shortcode.options.id},function(t){var i=t.data;e.shortcode._blockTitle=i.block_title,e.app.apply()})),this.shortcode._blockTitle}}]),e}();e["default"]=c}).call(e,function(){return this}())},function(t,e){"use strict";e.__esModule=!0,e["default"]=function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}},function(t,e,i){"use strict";function o(t){return t&&t.__esModule?t:{"default":t}}e.__esModule=!0;var n=i(6),s=o(n);e["default"]=function(){function t(t,e){for(var i=0;i<e.length;i++){var o=e[i];o.enumerable=o.enumerable||!1,o.configurable=!0,"value"in o&&(o.writable=!0),(0,s["default"])(t,o.key,o)}}return function(e,i,o){return i&&t(e.prototype,i),o&&t(e,o),e}}()},function(t,e,i){t.exports={"default":i(7),__esModule:!0}},function(t,e,i){var o=i(8);t.exports=function(t,e,i){return o.setDesc(t,e,i)}},function(t,e){var i=Object;t.exports={create:i.create,getProto:i.getPrototypeOf,isEnum:{}.propertyIsEnumerable,getDesc:i.getOwnPropertyDescriptor,setDesc:i.defineProperty,setDescs:i.defineProperties,getKeys:i.keys,getNames:i.getOwnPropertyNames,getSymbols:i.getOwnPropertySymbols,each:[].forEach}},function(t,e,i){"use strict";function o(t){return t&&t.__esModule?t:{"default":t}}function n(t,e,i){var o=t.$element.offset().left+i/2-t.parent.$element.offset().left;return Math.floor(o/i)}Object.defineProperty(e,"__esModule",{value:!0});var s=i(4),r=o(s),l=i(5),c=o(l),a=function(){function t(e,i,o){(0,r["default"])(this,t),this.app=e,this.shortcode=i,this.$element=o,this.minColumns=1,this.maxColumns=12}return t.$inject=["app","shortcode","$element"],(0,c["default"])(t,[{key:"onResizeStart",value:function(t){this.screenWidth=window.innerWidth,this.rowWidth=this.shortcode.parent.$element.width(),this.columnWidth=this.rowWidth/this.maxColumns,this.currentColumn=n(this.shortcode,this.rowWidth,this.columnWidth),this.currentColumnSpans=this.shortcode.options.span,this.nextColumnSpans=this.shortcode.nextSibling?this.shortcode.nextSibling.options.span:this.maxColumns,this.shortcode.$element.addClass("uxb-is-resizing"),this.shortcode.nextSibling&&this.shortcode.nextSibling.$element.addClass("uxb-is-resizing")}},{key:"onResizeMove",value:function(t){var e=Math.floor((t.deltaX+this.columnWidth/2)/this.columnWidth);this.currentColumnSpans+e<this.minColumns&&(e=-(this.currentColumnSpans-1)),this.currentColumnSpans+e>this.maxColumns&&(e=this.maxColumns-this.currentColumnSpans),this.screenWidth>600&&this.shortcode.nextSibling&&(this.nextColumnSpans-e<this.minColumns&&(e=this.nextColumnSpans-1),this.currentColumn+this.currentColumnSpans+this.nextColumnSpans<=this.maxColumns&&(this.shortcode.nextSibling.options.span=this.nextColumnSpans-e,this.shortcode.nextSibling.apply())),this.shortcode.options.span=this.currentColumnSpans+e}},{key:"onResizeEnd",value:function(t){this.shortcode.$element.removeClass("uxb-is-resizing"),this.shortcode.nextSibling&&this.shortcode.nextSibling.$element.removeClass("uxb-is-resizing"),delete this.screenWidth,delete this.rowWidth,delete this.columnWidth,delete this.currentColumn,delete this.currentColumnSpans,delete this.nextColumnSpans}}]),t}();e["default"]=a},function(t,e,i){"use strict";function o(t){return t&&t.__esModule?t:{"default":t}}Object.defineProperty(e,"__esModule",{value:!0});var n=i(4),s=o(n),r=i(5),l=o(r),c=function(){function t(e,i,o){(0,s["default"])(this,t),this.app=e,this.shortcode=i}return t.$inject=["app","shortcode","$element"],(0,l["default"])(t,[{key:"onResizeRightStart",value:function(t){this.initColumns=this.shortcode.options.span,this.maxColumns=12}},{key:"onResizeRightMove",value:function(t){var e=this.shortcode.parent.$element.width()/12,i=Math.floor((t.deltaX+e/2)/e);i<=-this.initColumns+1&&(i=-this.initColumns+1),i>=this.maxColumns-1&&(i=this.maxColumns-1),this.shortcode.options.span=this.initColumns+i}},{key:"onResizeRightEnd",value:function(t){delete this.currentColumnSpans,delete this.maxColumns}},{key:"onResizeBottomStart",value:function(t){this.containerHeight=this.shortcode.parent.options.height,this.initElementHeight=this.shortcode.$element.height(),this.initOptionHeight=this.shortcode.options.height}},{key:"onResizeBottomMove",value:function(t){var e=this.shortcode.parent.options.height/4,i=(this.initElementHeight+(t.deltaY+e/2))/this.containerHeight;i>=1?this.shortcode.options.height="1":i>=.75?this.shortcode.options.height="3-4":i>=.66?this.shortcode.options.height="2-3":i>=.5?this.shortcode.options.height="1-2":i>=.33?this.shortcode.options.height="1-3":i>=.25&&(this.shortcode.options.height="1-4")}},{key:"onResizeBottomEnd",value:function(t){delete this.containerHeight,delete this.initElementHeight,delete this.initOptionHeight}}]),t}();e["default"]=c},function(t,e,i){"use strict";function o(t){return t&&t.__esModule?t:{"default":t}}Object.defineProperty(e,"__esModule",{value:!0});var n=i(4),s=o(n),r=i(5),l=o(r),c=function(){function t(e,i,o,n,r,l){var c=this;(0,s["default"])(this,t),this.app=i,this.targets=o,this.shortcode=n,this.shortcode.states.activeTab=0,r(function(){c.targets.disable(c.shortcode.children),c.targets.enable(c.shortcode.childAt(0))},0,!1),e.$watch(function(){return i.states.selectedShortcode},function(t){t&&t.isChildOf(c.shortcode)&&t.index!==c.shortcode.states.activeTab&&c.setTab(t.index)}),e.$on(l.DETACHED,function(t,e){e.isChildOf(c.shortcode)&&c.setTab(e.index-1)})}return t.$inject=["$scope","app","targets","shortcode","$timeout","ShortcodeEvent"],(0,l["default"])(t,[{key:"setTab",value:function(t){t=t<0?0:t,this.shortcode.states.activeTab=t,this.targets.disable(this.shortcode.children),this.targets.enable(this.shortcode.childAt(t)),this.app.selectShortcode(this.shortcode.childAt(t)),this.app.configureShortcode(this.shortcode.childAt(t))}}]),t}();e["default"]=c},function(t,e,i){"use strict";function o(t){return t&&t.__esModule?t:{"default":t}}Object.defineProperty(e,"__esModule",{value:!0});var n=i(4),s=o(n),r=["app","shortcode","tools","$scope","$element",function l(t,e,i,o,n){function r(){t("stack").openTextEditor(o.shortcode)}(0,s["default"])(this,l),n.on("dblclick",r),o.$on("$destroy",function(){n.off("dblclick",r)})}];e["default"]=r},function(t,e,i){"use strict";function o(t){return t&&t.__esModule?t:{"default":t}}Object.defineProperty(e,"__esModule",{value:!0});var n=i(4),s=o(n),r=["app","shortcode","$scope","$element","$timeout","$interpolate","DragEvent","ShortcodeEvent",function l(t,e,i,o,n,r,c,a){function h(t,e,i){t.removeClass(function(t,e){return(e.match(/([a-z\-]+)?[xy]\d+/g)||[]).join(" ")}).addClass("x"+e+" y"+i)}function d(i){var o=null,n=null,s=5,r=i.innerY,l=i.constrains.width-(i.innerX+i.virtual.width),c=i.constrains.height-(i.innerY+i.virtual.height),a=i.innerX,h=_.min([{name:"right",distance:l},{name:"left",distance:a}],function(t){return t.distance}),d=_.min([{name:"top",distance:r},{name:"bottom",distance:c}],function(t){return t.distance}),u=Math.abs(r-c)<i.constrains.height/100*s,f=Math.abs(a-l)<i.constrains.width/100*s;return t("tools").getTool(e.$id).scope().grid.highlightHorizontalCenter(u),t("tools").getTool(e.$id).scope().grid.highlightVerticalCenter(f),o=round(h.distance/i.constrains.width*100,s),n=round(d.distance/i.constrains.height*100,s),"right"===h.name&&(o=100-o),"bottom"===d.name&&(n=100-n),u&&(n=50),f&&(o=50),o=o>=100?100:o,o=o<=0?0:o,n=n>=100?100:n,n=n<=0?0:n,{x:o,y:n}}(0,s["default"])(this,l),t("tools").addTool(e.$id,'<ux-banner-tool id="'+e.$id+'"/>',o.find(".banner-layers")),i.$on(c.START,function(i,o){o.shortcode.isChildOf(e)&&(o.preventDefault(),o.setContainment(e.$element.find(".banner-layers")),t("tools").showTool(e.$id))}),i.$on(c.MOVE,function(t,i){if(i.shortcode.isChildOf(e)){var o=d(i);i.shortcode.$element.addClass("text-box-dragging"),i.shortcode.options.positionX=o.x,i.shortcode.options.positionY=o.y}}),i.$on(c.END,function(i,o){o.shortcode.isChildOf(e)&&(o.shortcode.$element.removeClass("text-box-dragging"),t("tools").hideTool(e.$id))}),i.$on(a.CHANGED,function(t,i){i.shortcode.isChildOf(e)&&(i.shortcode.data.template||i.options.positionX===i.oldOptions.positionX&&i.options.positionY===i.oldOptions.positionY||(i.shortcode.$noRecompile=!0,h(i.shortcode.$element,i.options.positionX,i.options.positionY),n(function(){delete i.shortcode.$noRecompile},0,!1)))}),i.$on(a.ATTACHED,function(t,i){i.isChildOf(e)&&h(i.$element,i.options.positionX,i.options.positionY)}),i.$on("$destroy",function(){t("tools").removeTool(e.$id)}),i.$watch(function(){return e.options.height},function(t,i){t!==i&&e.parent.is("ux_slider")&&e.parent.$scope.$customCtrl.setHeight()})}];e["default"]=r},function(t,e,i){"use strict";function o(t){return t&&t.__esModule?t:{"default":t}}Object.defineProperty(e,"__esModule",{value:!0});var n=i(4),s=o(n),r=i(5),l=o(r),c=function(){function t(e,i,o,n,r,l,c){var a=this;(0,s["default"])(this,t),this.app=e,this.shortcode=i,this.$element=o,this.$iframe=n,this.$scope=r,this.$timeout=l,this.$row=o.find(".row"),this.options={gutter:0,percentPosition:!0,itemSelector:".col",columnWidth:".grid-size",transitionDuration:"250ms"},this.packery=new Packery(this.$row.get(0),this.options),r.$watchCollection("shortcode.children",this.onChildrenChange.bind(this)),r.$watchCollection("shortcode.options",this.onOptionsChange.bind(this)),r.$on(c.START,this.onDragStart.bind(this)),r.$on(c.MOVE,this.onDragMove.bind(this)),r.$on(c.END,this.onDragEnd.bind(this)),r.$on("$destroy",function(){return a.packery.destroy()})}return t.$inject=["app","shortcode","$element","$iframe","$scope","$timeout","DragEvent"],(0,l["default"])(t,[{key:"onChildrenChange",value:function(t,e){var i=this,o=t!==e?_.difference(t,e):t;o.length&&t!==e&&this.$timeout(function(){i.$iframe().contents().find("body").scrollToElement(o[0].$element)},250,!1),_.each(o,function(t){i.$scope.$watchCollection(function(){return t.options},i.onChildOptionsChange.bind(i))}),this.$timeout(function(){i.packery.reloadItems(),i.packery.layout()},0,!1)}},{key:"onChildOptionsChange",value:function(t,e){var i=this,o=!1;t.span!==e.span&&(o=!0),t.height!==e.height&&(o=!0),t.spacing!==e.spacing&&(o=!0),o&&this.$timeout(function(){return i.packery.layout()},0,!1)}},{key:"onOptionsChange",value:function(t,e){var i=this;this.$timeout(function(){return i.packery.layout()},0,!1)}},{key:"onDragStart",value:function(t,e){e.shortcode.isChildOf(this.shortcode)&&(e.preventDefault(),e.setContainment(this.$row),this.packery.itemDragStart(e.shortcode.$element.get(0)))}},{key:"onDragMove",value:function(t,e){e.shortcode.isChildOf(this.shortcode)&&(e.shortcode.$element.css({left:e.innerX,top:e.innerY}),this.packery.itemDragMove(e.shortcode.$element.get(0),e.innerX,e.innerY))}},{key:"onDragEnd",value:function(t,e){e.shortcode.isChildOf(this.shortcode)&&(this.packery.itemDragEnd(e.shortcode.$element.get(0)),this.reorderChildren())}},{key:"reorderChildren",value:function(){var t=this.shortcode.children,e=this.packery.getItemElements();_.each(e,function(t,e){angular.element(t).shortcode().$$order=e}),this.shortcode.children=_.sortBy(t,"$$order"),_.each(this.shortcode.children,function(t){delete t.$$order})}}]),t}();e["default"]=c},function(t,e,i){"use strict";function o(t){return t&&t.__esModule?t:{"default":t}}Object.defineProperty(e,"__esModule",{value:!0});var n=i(4),s=o(n),r=i(5),l=o(r),c=function(){function t(e,i,o,n,r,l,c,a){var h=this;(0,s["default"])(this,t),this.app=e,this.shortcode=i,this.targets=o,this.$element=r,this.$timeout=l,this.$slider=r.find(".slider"),this.isInitializing=!1,this.flickity=null,this.options={initialIndex:0,cellAlign:"center",imagesLoaded:!0,freeScroll:"true"===this.shortcode.options.freescroll,wrapAround:"true"===this.shortcode.options.infinitive,prevNextButtons:"true"===this.shortcode.options.arrows,contain:!0,percentPosition:!0,pageDots:"true"===this.shortcode.options.bullets,selectedAttraction:.1,friction:.6,rightToLeft:!1,draggable:!1},n.$watch(function(){return e.states.selectedShortcode},function(t){if(t){for(var e=0;e<h.shortcode.children.length;e++)if(t.isSelfOrDescendantOf(h.shortcode.children[e])){h.flickity.select(e);break}t.isAncestorOf(h.shortcode)&&h.$timeout(function(){return h.setHeight()},0,!1)}}),n.$watchCollection(function(){return h.shortcode.children},function(t,e){if(t.length&&t.length===e.length){var i=h.flickity?h.flickity.selectedIndex:0;h.options.initialIndex=e[i].index,h.initialize()}}),n.$watchCollection(function(){return h.shortcode.options},function(t,e){var i=!1,o=!1;t!==e&&(t.slideAlign!==e.slideAlign&&(h.options.cellAlign=t.slideAlign,i=!0),t.visibility!==e.visibility&&(i=!0),t.arrows!==e.arrows&&(h.options.prevNextButtons="true"===t.arrows,i=!0),t.bullets!==e.bullets&&(h.options.pageDots="true"===t.bullets,i=!0),t.parallax!==e.parallax&&(h.options.parallax=t.parallax,i=!0),t.freescroll!==e.freescroll&&(h.options.freeScroll="true"===t.freescroll,i=!0),t.infinitive!==e.infinitive&&(h.options.wrapAround="true"===t.infinitive,i=!0),t.slideWidth!==e.slideWidth&&(o=!0),t.style!==e.style&&(o=!0),i&&h.initialize(),!i&&o&&h.$timeout(function(){return h.$slider.flickity("resize")},100,!1))}),n.$on(a.REMOVED,function(t,e){e.isChildOf(h.shortcode)&&h.initialize()}),n.$on(a.ADDED,function(t,e){e.isChildOf(h.shortcode)&&(h.options.initialIndex=e.index,h.initialize())}),n.$on(c.ATTACHED,function(t,e){e.isChildOf(h.shortcode)&&(e.data.template||h.initialize())}),n.$on("$destroy",function(){h.destroy(),h.$slider=null})}return t.$inject=["app","shortcode","targets","$scope","$element","$timeout","ShortcodeEvent","ChildEvent"],(0,l["default"])(t,[{key:"initialize",value:function(){var t=this;this.isInitializing||(this.isInitializing=!0,this.flickity&&this.destroy(),this.$timeout(function(){if(t.flickity=t.$slider.flickity(t.options).data("flickity"),t.flickity.on("cellSelect",t.onCellSelect.bind(t)),t.flickity.on("settle",t.onSettle.bind(t)),t.options.parallax){var e=jQuery(t.$slider).find(".bg, .flickity-slider > .img img"),i=t.flickity,o=t.options.parallax;jQuery(t.$slider).addClass("slider-has-parallax"),t.flickity.on("scroll",function(t,n){i.slides.forEach(function(t,n){var s=e[n],r=(t.target+i.x)*-1/o;s&&(s.style.transform="translateX( "+r+"px)")})})}t.$slider.on("click",t.onClick.bind(t)),t.enableCurrentSlideTargets(),t.isInitializing=!1},0,!1))}},{key:"destroy",value:function(){this.flickity&&(this.flickity.off("cellSelect",this.onCellSelect),this.flickity.off("settle",this.onSettle),this.$slider.off("click",this.onSliderClick),this.flickity.destroy(),this.flickity=null)}},{key:"onClick",value:function(t){var e=this.flickity.selectedIndex;this.app.configureShortcode(this.shortcode.childAt(e)),this.shortcode.apply(),t.stopPropagation()}},{key:"onCellSelect",value:function(){this.$slider.find(".banner:not(.is-selected) .video").trigger("pause"),this.$slider.find(".banner.is-selected .video").trigger("play"),this.$slider.hasClass("slider-auto-height")&&this.$slider.find(".flickity-viewport").css({height:this.$slider.find(".is-selected").outerHeight()})}},{key:"onSettle",value:function(){this.options.initialIndex=this.flickity.selectedIndex,this.enableCurrentSlideTargets()}},{key:"setHeight",value:function(t){this.$element.find(".flickity-viewport").css({height:t||this.flickity?this.flickity.selectedElement.offsetHeight:null})}},{key:"enableCurrentSlideTargets",value:function(){var t=this;this.shortcode.children.forEach(function(e,i){i===t.flickity.selectedIndex?t.targets.enableElement(e.$element.get(0)):t.targets.disableElement(e.$element.get(0))})}}]),t}();e["default"]=c},function(t,e,i){"use strict";function o(t){return t&&t.__esModule?t:{"default":t}}Object.defineProperty(e,"__esModule",{value:!0});var n=i(4),s=o(n),r=["$scope","shortcode","$element","$timeout",function l(t,e,i,o){var n=this;(0,s["default"])(this,l),this.shortcode=e,this.$element=i,this.$timeout=o,t.$watchCollection(function(){return n.shortcode.options},function(t,e){t!==e&&"text"===t.type&&n.$timeout(function(){jQuery(i).find(".tooltip").tooltipster("content",t.text)},100,!1)})}];e["default"]=r},function(t,e,i){"use strict";function o(t){return t&&t.__esModule?t:{"default":t}}Object.defineProperty(e,"__esModule",{value:!0});var n=i(4),s=o(n),r=["$scope","shortcode","$element","$timeout",function l(t,e,i,o){var n=this;(0,s["default"])(this,l),this.shortcode=e,this.$element=i,this.$timeout=o,t.$watchCollection(function(){return n.shortcode.options},function(t,e){})}];e["default"]=r},function(t,e,i){(function(t){"use strict";function o(t){return t&&t.__esModule?t:{"default":t}}Object.defineProperty(e,"__esModule",{value:!0});var n=i(4),s=o(n),r=i(5),l=o(r),c=function(){function e(t,i,o,n,r){var l=this;(0,s["default"])(this,e),this.app=t,this.shortcode=i,this.mapElement=n.find("#map_"+i.$id).get(0),this.map=null,this.marker=null,this.initializeMap(),o.$watchCollection(function(){return l.shortcode.options},function(t,e){if(t!==e){var i=l.getOptions(t);l.map.setOptions(i),l.marker.setPosition(i.center),l.map.mapTypes.set("flatsome",l.getStyle(t))}}),o.$on("$destroy",function(){l.map=null,l.marker=null})}return e.$inject=["app","shortcode","$scope","$element","$window"],(0,l["default"])(e,[{key:"initializeMap",value:function(){var e=t.google,i=this.getOptions(this.shortcode.options),o=this.getStyle(this.shortcode.options);this.map=new e.maps.Map(this.mapElement,i),this.map.mapTypes.set("flatsome",o),this.marker=new t.google.maps.Marker({position:i.center,map:this.map,title:""})}},{key:"getOptions",value:function(e){var i=t.google,o="true"===e.controls;return{zoom:e.zoom,center:new i.maps.LatLng(e.lat,e["long"]),disableDefaultUI:!0,mapTypeId:"flatsome",draggable:!1,zoomControl:o&&"true"===e.zoomControl,zoomControlOptions:{position:i.maps.ControlPosition.TOP_LEFT},mapTypeControl:o&&"true"===e.mapTypeControl,mapTypeControlOptions:{position:i.maps.ControlPosition.TOP_LEFT},streetViewControl:o&&"true"===e.streetViewControl,streetViewControlOptions:{position:i.maps.ControlPosition.TOP_LEFT},scrollwheel:!1,disableDoubleClickZoom:!0}}},{key:"getStyle",value:function(e){var i=t.google,o=e.color,n=e.saturation;return new i.maps.StyledMapType([{featureType:"administrative",stylers:[{visibility:"on"}]},{featureType:"road",stylers:[{visibility:"on"},{hue:o}]},{stylers:[{visibility:"on"},{hue:o},{saturation:n}]}],{name:"flatsome"})}}]),e}();e["default"]=c}).call(e,function(){return this}())},function(t,e,i){"use strict";function o(t){return t&&t.__esModule?t:{"default":t}}function n(t,e){var i=t.$element.offset(),o=t.$element.width();return i.left+o/2===e/2}Object.defineProperty(e,"__esModule",{value:!0});var s=i(4),r=o(s),l=i(5),c=o(l),a=function(){function t(e,i,o){(0,r["default"])(this,t),this.app=e,this.shortcode=i,this.$element=o}return t.$inject=["app","shortcode","$element"],(0,c["default"])(t,[{key:"onResizeRightStart",value:function(t){this.maxWidth=this.shortcode.parent.$element.width(),this.initWidth=this.shortcode.options.width,this.isCenterX=n(this.shortcode,this.maxWidth)}},{key:"onResizeRightMove",value:function(t){var e=t.deltaX*(this.isCenterX?2:1),i=this.initWidth+e/this.maxWidth*100;i>100&&(i=100),i<0&&(i=0),this.shortcode.options.width=parseInt(i,10)}},{key:"onResizeBottomMove",value:function(t){delete this.maxWidth,delete this.initWidth}}]),t}();e["default"]=a}]);