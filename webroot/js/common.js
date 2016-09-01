
$(document).ready(function ($) {
    // Bottom navigation
    $('#nav_bot_back').on('click', function(e){
        e.preventDefault();
        window.history.back();
    });
    
    $('#nav_bot_forward').on('click', function(e){
        e.preventDefault();
        window.history.forward();
    });
    
    // Fix Japanese text
    $('.kerning').kerning();
    
    // Show popup search
    $('#top_search_icon').on('click', function (event) {
        event.preventDefault();
        show_popup_search();
    });
    
    // Show popup search keyword
    $('#search_form_line_keyword').on('click', function(event){
        event.preventDefault();
        show_popup_search_keyword();
    });
    
    // Show popup sort
    $('#list_tools_sort').on('click', function(event){
        event.preventDefault();
        show_popup_sort();
    });
    
    // Show popup filter
    $('#list_tools_filter').on('click', function(event){
        event.preventDefault();
        show_popup_filter();
    });
    
    // Show popup filter
    $('#list_tools_filter').on('click', function(event){
        event.preventDefault();
        show_popup_filter();
    });
    
    // Hide popup search
    $('#search_form_close').on('click', function(event){
        event.preventDefault();
        if ($('#search_form_keyword').css('display') == 'block') {
            $('#search_form_container').css('visibility', 'visible');
            $('#search_form_keyword').css('display', 'none');
        } else {
            hide_popup_search();
        }
    });
    
    // Hide popup announce
    $('#announce_form_close, #sort_form_close, #filter_form_close').on('click', function(event){
        event.preventDefault();
        hide_popup();
    });
    
    // Fix font-size
    fix_font_size();
    
    // fix break line
    fix_break_line();
    
    // Slider on Top page
    $('.top_group').flickity({
        adaptiveHeight: true,
        cellAlign: 'left',
        lazyLoad: false,
        percentPosition: true,
        prevNextButtons: false,
        pageDots: false,
        resize: true
    });
    
    // Select filter list
    $('.filter_select li').on('click', function(e){
        e.preventDefault();
        select_filter_item(this);
    });
    
    // Clear filter
    $('#btn_filter_clear').on('click', function(e){
        e.preventDefault();
        clear_filter();
    });
    
    // Filter action
    $('#btn_filter_search').on('click', function(e){
        e.preventDefault();
        filter_action();
    });
});

$(window).on('resize', function () {
    setTimeout(function () {
        fix_font_size();
        fix_break_line();
    }, 10);
});

/**
 * Change font-size to fit with container
 * 
 * Ref: https://github.com/jquery-textfill/jquery-textfill
 */
function fix_font_size() {
    $('.jtextfill').textfill({
        maxFontPixels: 19,
        debug: true
    });
}

/**
 * Add 3 dot to fit break line
 * 
 * Ref: http://dotdotdot.frebsite.nl/
 */
function fix_break_line() {
    $('.dotdotdot').dotdotdot();
}

$(document).on('click touchend', function (e) {
    if ($('.popup_wrap').length > 0) {
        // Check if click outside of search form
        if ($('#search_form').length > 0) {
            var search_form = $('#search_form');
            var wrap_search = $('#popup_wrap_search');
            
            if (wrap_search.is(e.target) && !search_form.is(e.target) && search_form.has(e.target).length === 0) {
                e.preventDefault();
                hide_popup_search();
            }
        }
        
        // Check if click outside of announce form
        if ($('#announce_form').length > 0) {
            var announce_form = $('#announce_form');
            var wrap_announce = $('#popup_wrap_announce');
            
            if (wrap_announce.is(e.target) && !announce_form.is(e.target) && announce_form.has(e.target).length === 0) {
                e.preventDefault();
                hide_popup();
            }
        }
        
        // Check if click outside of sort form
        if ($('#sort_form').length > 0) {
            var sort_form = $('#sort_form');
            var wrap_sort = $('#popup_wrap_sort');
            
            if (wrap_sort.is(e.target) && !sort_form.is(e.target) && sort_form.has(e.target).length === 0) {
                e.preventDefault();
                hide_popup();
            }
        }
        
        // Check if click outside of filter form
        if ($('#filter_form').length > 0) {
            var filter_form = $('#filter_form');
            var wrap_filter = $('#popup_wrap_filter');
            
            if (wrap_filter.is(e.target) && !filter_form.is(e.target) && filter_form.has(e.target).length === 0) {
                e.preventDefault();
                hide_popup();
            }
        }
    }
});

/**
 * Show search popup
 */
function show_popup_search() {
    hideBodyScroll();
    $('#search_form_container').css('visibility', 'visible');
    $('#search_form_keyword').css('display', 'none');
    $('#popup_wrap_search').fadeIn('fast', function () {
        $('#popup_wrap_search').stop().animate({scrollTop: 0});
    });
}

/**
 * Show search keyword poopup
 */
function show_popup_search_keyword() {
    $('#search_form_container').css('visibility', 'hidden');
    $('#search_form_keyword').css('display', 'block');
    $('#search_form_keyword_txt').focus();
}

/**
 * Show sort popup
 */
function show_popup_sort() {
    hideBodyScroll();
    $('#popup_wrap_sort').fadeIn('fast', function () {
        $('#sort_list').stop().animate({scrollTop: 0});
    });
}

/**
 * Show filter popup
 */
function show_popup_filter() {
    hideBodyScroll();
    $('#popup_wrap_filter').fadeIn('fast', function () {
        
    });
}

/**
 * Hide search popup
 */
function hide_popup_search() {
    showBodyScroll();
    $('#popup_wrap_search').hide();
}

/**
 * Hide popup
 */
function hide_popup() {
    showBodyScroll();
    $('.popup_wrap').hide();
}

/**
 * Hide scroll when show popup
 */
function hideBodyScroll() {
    var scrolWidth = getScrollBarWidth();
    
    $('html').css('overflow', 'hidden');
    $('#container').css('paddingRight', scrolWidth);
}

/**
 * Show scroll when hide popup
 */
function showBodyScroll() {
    $('html').css('overflow', '');
    $('#container').css('paddingRight', '');
}

/**
 * Select item in list filter
 * 
 * @param {object} item
 */
function select_filter_item(item) {
    // Get value
    var value = $(item).attr('data-value');
    var txt = $(item).text();
    var ul = $(item).closest('ul.filter_select');
    var panel = ul.closest('li.panel');

    // Set value
    panel.attr('data-value', value);
    panel.find('.filter_value_text').text(txt);

    // Hide panel
    $('.filter_select.in').collapse('hide');
}

/**
 * Submit filter
 */
function filter_action() {
    //show_main_loader();
}

/**
 * Clear search filter
 */
function clear_filter() {
    $('#filter_list li.panel').each(function () {
        $(this).attr('data-value', '');
        $(this).find('.filter_value_text').text('');
    });
}

/**
 * Show main loader
 */
function show_main_loader() {
    hideBodyScroll();
    $('#main_loader').show();
}

/**
 * Hide main loader
 */
function hide_main_loader() {
    showBodyScroll();
    $('#main_loader').hide();
}

/**
 * Get scrollbar width
 */
function getScrollBarWidth() {
    var inner = document.createElement('p');
    inner.style.width = "100%";
    inner.style.height = "200px";

    var outer = document.createElement('div');
    outer.style.position = "absolute";
    outer.style.top = "0px";
    outer.style.left = "0px";
    outer.style.visibility = "hidden";
    outer.style.width = "200px";
    outer.style.height = "150px";
    outer.style.overflow = "hidden";
    outer.appendChild(inner);

    document.body.appendChild(outer);
    var w1 = inner.offsetWidth;
    outer.style.overflow = 'scroll';
    var w2 = inner.offsetWidth;
    if (w1 == w2) {
        w2 = outer.clientWidth;
    }

    document.body.removeChild(outer);

    return (w1 - w2);
}

$.preloadImages = function () {
    for (var i = 0; i < arguments.length; i++) {
        $("<img />").attr("src", arguments[i]);
    }
};
