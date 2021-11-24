/*jshint esversion: 6 */
require('what-input');
const $ = jQuery;

/** */
import { Foundation } from 'foundation-sites';
Foundation.addToJquery($);
$(() => ($(document).foundation()));

/** */
import device from "current-device";
//const currentDevice = device.noConflict();
const is_mobile = () => device.mobile() || Foundation.MediaQuery.upTo('small');

/** */
/** */

$(() => {
    // Remove empty P tags created by WP inside of Accordion and Orbit
    $('.accordion p:empty, .orbit p:empty').remove();

    // Adds Flex Video to YouTube and Vimeo Embeds
    $('iframe[src*="youtube.com"], iframe[src*="vimeo.com"]').each(() => {
        if ($(this).innerWidth() / $(this).innerHeight() > 1.5) {
            $(this).wrap("<div class='widescreen responsive-embed'/>");
        } else {
            $(this).wrap("<div class='responsive-embed'/>");
        }
    });

    /*tabs + none cookie*/
    const _tabs_wrapper = $(".w-filter-tabs");
    _tabs_wrapper.each((index, el) => {
        const _tabs = $(el).find(".filter-tabs");
        const _tabs_content = $(el).find(".filter-tabs-content");
        _tabs.find('a:first').addClass('current');
        _tabs_content.find('.tabs-panel:first').show();

        _tabs.find('a').on("click", function (e) {
            e.preventDefault();
            _tabs.find('a.current').removeClass("current");
            _tabs_content.find('.tabs-panel:visible').hide();
            $(this.hash).fadeIn();
            $(this).addClass("current");
        });
    });

    /**attribute target="_blank" is not W3C compliant*/
    const _blanks = [...document.querySelectorAll('a._blank, a.blank, a[target="_blank"]')];
    Array.prototype.forEach.call(_blanks, (el) => {
        el.removeAttribute('target');
        el.setAttribute('target', '_blank');
        if (!1 === el.hasAttribute('rel')) {
            el.setAttribute('rel', 'noopener noreferrer nofollow');
        }
    });

    /*footer*/
    const footerDropdownBtns = [...document.querySelectorAll(".footer-widget .widget_nav_menu .widget-title")];
    const footerDropdownContent = [...document.querySelectorAll(".footer-widget .widget_nav_menu")];
    footerDropdownBtns.forEach((item, i) => item.addEventListener("click", () => {
        $(footerDropdownContent[i].lastElementChild).find('ul.menu').slideToggle();
        $(footerDropdownContent[i].firstElementChild).toggleClass("open");
    }));

    /*toggle menu*/
    const _toggle_menu = $(".toggle_menu");
    _toggle_menu.find("li.is-active.has-submenu-toggle").find(".submenu-toggle").trigger('click');
});

/** */
/** */

const goToTop = () => window.scrollTo(0, 0);
const stripHtml = html => (new DOMParser().parseFromString(html, 'text/html')).body.textContent || '';
const stringReverse = str => str.split("").reverse().join("");
const round = (n, d) => Number(Math.round(n + "e" + d) + "e-" + d);
const getParameters = (URL) => JSON.parse('{"' + decodeURI(URL.split("?")[1]).replace(/"/g, '\\"').replace(/&/g, '","').replace(/=/g, '":"') + '"}');
const touchSupported = () => {
    ('ontouchstart' in window || window.DocumentTouch && document instanceof window.DocumentTouch);
};
const clearCookies = document.cookie.split(';').forEach(cookie => document.cookie = cookie.replace(/^ +/, '').replace(/=.*/, `=;expires=${new Date(0).toUTCString()};path=/`));
const randomNumberInRange = (min = 0, max = 100) => Math.floor(Math.random() * (max - min + 1)) + min;
const randomBoolean = () => Math.random() >= 0.5;
const random_string = (n) => {
    if (!n) {
        n = 5;
    }
    let text = '';
    let possible = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789_-';
    for (let i = 0; i < n; i++) {
        text += possible.charAt(Math.floor(Math.random() * possible.length));
    }
    return text;
};
const offsetTop = () => {
    let supportPageOffset = window.pageYOffset !== undefined;
    let isCSS1Compat = ((document.compatMode || "") === "CSS1Compat");
    return supportPageOffset ? window.pageYOffset : isCSS1Compat ? document.documentElement.scrollTop : document.body.scrollTop;
};

/** */

import { Fancybox } from "@fancyapps/ui";
Fancybox.bind(".wp-block-gallery .blocks-gallery-item a, .popup-box", {
    groupAll: true, // Group all items
});

/** */
/** */

// import Swiper bundle with all modules installed
import { Swiper } from 'swiper/bundle';
const _swiper_container = [...document.querySelectorAll('.w-swiper')];
_swiper_container.forEach((el, index) => {
    const _rand = random_string(12),
        _class = 'swiper-' + _rand,
        _next_class = 'next-' + _rand,
        _prev_class = 'prev-' + _rand,
        _pagination_class = 'pagination-' + _rand,
        _scrollbar_class = 'scrollbar-' + _rand;

    el.classList.add(_class);
    const el_swiper_wrapper = el.querySelector('.swiper-wrapper');
    let _row_data = el_swiper_wrapper.dataset.row,
        _autoview_data = el_swiper_wrapper.dataset.autoview,
        _desktop_data = el_swiper_wrapper.dataset.desktop,
        _tablet_data = el_swiper_wrapper.dataset.tablet,
        _mobile_data = el_swiper_wrapper.dataset.mobile,
        _pagination_data = el_swiper_wrapper.dataset.pagination,
        _navigation_data = el_swiper_wrapper.dataset.navigation,
        _autoplay_data = el_swiper_wrapper.dataset.autoplay,
        _freeMode_data = el_swiper_wrapper.dataset.freemode,
        _fade_data = el_swiper_wrapper.dataset.fade,
        _loop_data = el_swiper_wrapper.dataset.loop,
        _gap_data = el_swiper_wrapper.dataset.gap,
        _vertical_data = el_swiper_wrapper.dataset.vertical,
        _autoHeight_data = el_swiper_wrapper.dataset.autoheight,
        _slidesPerGroup_data = el_swiper_wrapper.dataset.group,
        _delay_data = el_swiper_wrapper.dataset.delay,
        _speed_data = el_swiper_wrapper.dataset.speed,
        _observer_data = el_swiper_wrapper.dataset.observer,
        _parallax_data = el_swiper_wrapper.dataset.parallax,
        _scrollbar_data = el_swiper_wrapper.dataset.scrollbar,
        _progress_data = el_swiper_wrapper.dataset.progressbar,
        _centered_data = el_swiper_wrapper.dataset.centered,
        _marquee_data = el_swiper_wrapper.dataset.marquee,
        _reverse_data = el_swiper_wrapper.dataset.reverse;

    /* swiper controls*/
    let _controls = el.closest('.swiper-section').querySelector('.swiper-controls');
    if (_controls == null) {
        _controls = document.createElement("div");
        _controls.classList.add('swiper-controls');
        el.after(_controls);
    }

    /*get data value*/
    if (!_desktop_data) _desktop_data = 1;
    if (!_tablet_data) _tablet_data = 1;
    if (!_mobile_data) _mobile_data = 1;

    let _options = {};
    if (_gap_data) {
        _options.spaceBetween = 20;
    }

    if (_autoview_data) {
        _options.slidesPerView = 'auto';
        _options.loopedSlides = 12;
        if (_gap_data) {
            _options.breakpoints = {
                640: { spaceBetween: 30 }
            };
        }
    } else {
        _options.slidesPerView = parseInt(_mobile_data);
        if (_gap_data) {
            _options.breakpoints = {
                640: {
                    spaceBetween: 30,
                    slidesPerView: parseInt(_tablet_data)
                },
                1024: {
                    spaceBetween: 30,
                    slidesPerView: parseInt(_desktop_data)
                },
            };
        } else {
            _options.breakpoints = {
                640: { slidesPerView: parseInt(_tablet_data) },
                1024: { slidesPerView: parseInt(_desktop_data) },
            };
        }
    }

    if (_autoview_data || _options.slidesPerView > 1) {
        _options.watchSlidesVisibility = !0;
    }

    _options.grabCursor = !0;
    _options.allowTouchMove = !0;
    _options.threshold = 0.5;
    //_options.watchSlidesProgress = !0;
    //_options.watchSlidesVisibility = !0;
    //_options.keyboard = { enabled: !0 };
    //_options.mousewheel = !1;
    //_options.hashNavigation = { watchState: !1 };
    _options.hashNavigation = !1;

    if (_centered_data) {
        _options.centeredSlides = !0;
    }

    if (!_speed_data) {
        _speed_data = randomNumberInRange(600, 1200);
    }
    _options.speed = parseInt(_speed_data);

    if (_observer_data) {
        _options.observer = !0;
        _options.observeParents = !0;
    }

    if (_slidesPerGroup_data && !_autoview_data) {
        _options.slidesPerGroupSkip = !0;
        _options.loopFillGroupWithBlank = !0;
        _options.slidesPerGroup = parseInt(_slidesPerGroup_data);
    }
    if (_fade_data) {
        _options.effect = 'fade';
        _options.fadeEffect = { crossFade: !0 };
    }
    if (_autoHeight_data) {
        _options.autoHeight = !0;
    }
    if (_freeMode_data) {
        _options.freeMode = !0;
    }
    if (_loop_data && !_row_data) {
        _options.loop = !0;
        _options.loopFillGroupWithBlank = !0;
    }
    if (_autoplay_data) {
        if (_delay_data) {
            _options.autoplay = {
                disableOnInteraction: !1,
                delay: parseInt(_delay_data),
            };
        } else {
            // default delay
            _options.autoplay = {
                disableOnInteraction: !1,
                delay: 6000,
            };
        }
        if (_reverse_data) {
            _options.reverseDirection = !0;
        }
    }

    if (_row_data) {
        _options.direction = 'horizontal';
        _options.loop = !1;
        _options.grid = {
            rows: parseInt(_row_data),
            fill: 'row',
        };
    }

    /*navigation*/
    if (_navigation_data) {
        const _section = el.closest('.swiper-section');
        let _btn_prev = _section.querySelector('.swiper-button-prev');
        let _btn_next = _section.querySelector('.swiper-button-next');
        if (_btn_prev && _btn_next) {
            _btn_prev.classList.add(_prev_class);
            _btn_next.classList.add(_next_class);
        } else {

            _btn_prev = document.createElement("div");
            _btn_next = document.createElement("div");
            if (_parallax_data) {
                _btn_prev.classList.add('swiper-button', 'parallax-layer', 'swiper-button-prev', _prev_class);
                _btn_next.classList.add('swiper-button', 'parallax-layer', 'swiper-button-next', _next_class);
            } else {
                _btn_prev.classList.add('swiper-button', 'swiper-button-prev', _prev_class);
                _btn_next.classList.add('swiper-button', 'swiper-button-next', _next_class);
            }
            _controls.appendChild(_btn_prev);
            _controls.appendChild(_btn_next);
            _btn_prev.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="currentColor"><path d="M0 0h24v24H0z" fill="none"/><path d="M11.67 3.87L9.9 2.1 0 12l9.9 9.9 1.77-1.77L3.54 12z"/></svg>';
            _btn_next.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="currentColor"><g><path d="M0,0h24v24H0V0z" fill="none"/></g><g><polygon points="6.23,20.23 8,22 18,12 8,2 6.23,3.77 14.46,12"/></g></svg>';
        }

        _options.navigation = {
            nextEl: '.' + _next_class,
            prevEl: '.' + _prev_class,
        };
    }

    if (_pagination_data) {
        let _swiper_pagination = document.createElement("div");
        if (_parallax_data) {
            _swiper_pagination.classList.add('swiper-pagination', 'parallax-layer', _pagination_class);
        } else {
            _swiper_pagination.classList.add('swiper-pagination', _pagination_class);
        }

        _controls.appendChild(_swiper_pagination);
        if (_pagination_data === 'fraction') {
            _options.pagination = {
                el: '.' + _pagination_class,
                type: 'fraction',
            };
        } else if (_pagination_data === 'progressbar') {
            _options.pagination = {
                el: '.' + _pagination_class,
                type: "progressbar",
            };
        } else if (_pagination_data === 'dynamic') {
            _options.pagination = {
                dynamicBullets: !0,
                el: '.' + _pagination_class,
            };
        } else {
            _options.pagination = {
                dynamicBullets: !1,
                el: '.' + _pagination_class,
            };
        }

        _options.pagination.clickable = !0;
    }

    if (_scrollbar_data) {
        let _swiper_scrollbar = document.createElement("div");
        if (_parallax_data) {
            _swiper_scrollbar.classList.add('swiper-scrollbar', 'parallax-layer', _scrollbar_class);
        } else {
            _swiper_scrollbar.classList.add('swiper-scrollbar', _scrollbar_class);
        }
        _controls.appendChild(_swiper_scrollbar);
        _options.scrollbar = {
            hide: !0,
            el: '.' + _scrollbar_class,
        };
    }

    if (_vertical_data) {
        _options.direction = 'vertical';
    }

    /**parallax*/
    if (_parallax_data) {
        _options.parallax = !0;
    }

    /**_marquee**/
    if (_marquee_data) {
        _options.centeredSlides = !0;
        _options.autoplay = {
            delay: 1,
            disableOnInteraction: !1
        };
        _options.loop = !0;
        _options.allowTouchMove = !0;
    }

    /*cssMode*/
    if (!_marquee_data && !_centered_data && !_freeMode_data && !_progress_data && is_mobile() && !el.classList.contains('sync-swiper')) {
        _options.cssMode = !0; /*sử dụng API CSS Scroll Snap */
    }

    /*progress*/
    if (_progress_data) {
        let _swiper_progress = document.createElement("div");
        if (_parallax_data) {
            _swiper_progress.classList.add('swiper-progress', 'parallax-layer');
        } else {
            _swiper_progress.classList.add('swiper-progress');
        }

        _controls.appendChild(_swiper_progress);
    }

    let _swiper_progress = _controls.querySelector('.swiper-progress');

    /** init*/
    _options.on = {
        init: function () {
            let t = this;
            if (_parallax_data) {
                t.autoplay.stop();
                t.touchEventsData.formElements = "*";
                const parallax = el.querySelectorAll('.--bg');
                [].slice.call(parallax).map((elem) => {
                    let p = elem.dataset.swiperParallax.replace("%", "");
                    if (!p) p = 95;
                    elem.dataset.swiperParallax = p / 100 * t.width;
                });
            }
            if (_progress_data) {
                _swiper_progress.classList.add('progress');
            }
        },
        slideChange: function () {
            if (_progress_data) {
                _swiper_progress.classList.remove('progress');
            }

            // sync
            let t = this;
            if (el.classList.contains('sync-swiper')) {
                const el_closest = el.closest('section.section');
                const sync_swipers = Array.from(el_closest.querySelectorAll('.sync-swiper:not(.sync-exclude)'));
                sync_swipers.forEach((item, i) => {
                    let _local_swiper = item.swiper;
                    if (_loop_data) {
                        _local_swiper.slideToLoop(t.activeIndex, parseInt(_speed_data), true);
                    } else {
                        _local_swiper.slideTo(t.activeIndex, parseInt(_speed_data), true);
                    }
                });
            }
        },
        slideChangeTransitionEnd: function () {
            if (_progress_data) {
                _swiper_progress.classList.add('progress');
            }
        }
    };

    /*console.log(_options);*/
    let _swiper = new Swiper('.' + _class, _options);
    if (!_autoplay_data && !_marquee_data) {
        _swiper.autoplay.stop();
    }

    /* now add mouseover and mouseout events to pause and resume the autoplay;*/
    el.addEventListener('mouseover', () => {
        _swiper.autoplay.stop();
    });
    el.addEventListener('mouseout', () => {
        if (_autoplay_data) {
            _swiper.autoplay.start();
        }
    });
});

/** */
/** */

/*! draggable - https://www.kirupa.com/html5/drag.htm */
const draggable_container = [...document.querySelectorAll(".draggable, #arcontactus")];
draggable_container.forEach((el, index) => {
    const _rand = random_string(6);
    el.classList.add('draggable-' + _rand);
    var active = false, currentX, currentY, initialX, initialY, xOffset = 0, yOffset = 0;
    el.addEventListener("touchstart", dragStart, false);
    el.addEventListener("touchend", dragEnd, false);
    el.addEventListener("touchmove", drag, false); el.addEventListener("mousedown", dragStart, false);
    el.addEventListener("mouseup", dragEnd, false); el.addEventListener("mousemove", drag, false);
    function dragStart(e) {
        if (e.type === "touchstart") {
            initialX = e.touches[0].clientX - xOffset; initialY = e.touches[0].clientY - yOffset;
        } else {
            initialX = e.clientX - xOffset; initialY = e.clientY - yOffset;
        }
        active = true;
    }
    function dragEnd(e) {
        initialX = currentX; initialY = currentY;
        active = false;
    }
    function drag(e) {
        if (active) {
            e.preventDefault();
            if (e.type === "touchmove") {
                currentX = e.touches[0].clientX - initialX; currentY = e.touches[0].clientY - initialY;
            } else {
                currentX = e.clientX - initialX; currentY = e.clientY - initialY;
            }
            xOffset = currentX;
            yOffset = currentY;
            el.style.transform = "translate3d(" + currentX + "px, " + currentY + "px, 0)";
        }
    }
});