!function(t){"use strict";t.fn.fitVids=function(e){var r={customSelector:null};return e&&t.extend(r,e),this.each(function(){var e=["iframe[src*='player.vimeo.com']","iframe[src*='www.youtube.com']","iframe[src*='www.youtube-nocookie.com']","iframe[src*='www.dailymotion.com']","iframe[src*='www.kickstarter.com']","object","embed"];r.customSelector&&e.push(r.customSelector),t(this).find(e.join(",")).each(function(){var e=t(this);if(!("embed"===this.tagName.toLowerCase()&&e.parent("object").length||e.parent(".fluid-width-video-wrapper").length)){var r="object"===this.tagName.toLowerCase()||e.attr("height")&&!isNaN(parseInt(e.attr("height"),10))?parseInt(e.attr("height"),10):e.height(),i=isNaN(parseInt(e.attr("width"),10))?e.width():parseInt(e.attr("width"),10),a=r/i;if(!e.attr("id")){var o="fitvid"+Math.floor(999999*Math.random());e.attr("id",o)}e.wrap('<div class="fluid-width-video-wrapper"></div>').parent(".fluid-width-video-wrapper").css("padding-top",100*a+"%"),e.removeAttr("height").removeAttr("width")}})})}}(jQuery);