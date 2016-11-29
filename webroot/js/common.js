/**
 * Main Javascript process
 */

$(document).ajaxStart(function () {
    Pace.restart();
});

$(document).on('submit', '.box-search form, .box-update form', function () {
    Pace.restart();
});

$(document).ready(function ($) {
    // Disable button toggle
    $('.toggle').show();
    $('.toggle-event').change(function(){
        toggleChange(this);
    });
    
    // Buttons action
    $(".btn-disable").click(function () {
        return disableEnableMulti('disable');
    });
    $(".btn-enable").click(function () {
        return disableEnableMulti('enable');
    });
    $(".btn-addnew").click(function () {
        location.href = baseUrl + '/' + controller + '/update';
        return false;
    });
    
    // Autocomplete product
    $('#product_search').unbind('keyup').bind('keyup', function() {
        var val = $(this).val();
        var result = $('#product_result');
        var data = {
            name: val
        };
        $.ajax({
            type: "POST",
            url: baseUrl + '/ajax/autocompleteproduct',
            data: data,
            success: function (response) {
                console.log(response);
                if (response) {
                    result.html(response);
                }
            }
        });
    });
});

/**
 * Update multi (enable/disable)
 * @param {string} type
 * @returns {Boolean}
 */
function disableEnableMulti(type) {
    var items = getItemsChecked('items[]', ',');
    if (items == '') {
        showAlertModal(LABEL_CHOOSE_ONE);
        return false;
    }
    $("#action").val(type);
    return true;
}

/**
 * Get list item checked
 * @param {type} strItemName
 * @param {type} sep
 * @returns {String}
 */
function getItemsChecked(strItemName, sep) {
    var x = document.getElementsByName(strItemName);
    var p = "";
    for (var i = 0; i < x.length; i++) {
        if (x[i].checked) {
            p += x[i].value + sep;
        }
    }
    var result = (p != '' ? p.substr(0, p.length - 1) : '');
    return result;
}

/**
 * Check all item in data search result
 */
function checkAll(strItemName, value) {
    var x = document.getElementsByName(strItemName);
    for (var i = 0; i < x.length; i++) {
        if (value == 1 && !x[i].disabled) {
            if (!x[i].checked) {
                x[i].checked = 'checked';
            }
        } else {
            if (x[i].checked) {
                x[i].checked = '';
            }
        }
    }
}

/**
 * On change toggle
 * 
 * @param {object} item
 */
function toggleChange(item) {
    var revertClassFlg = 'reverted';
    if ($(item).hasClass(revertClassFlg)) {
        return false;
    }
    
    // Init
    var _this = $(item);
    var id = _this.val();
    var data_field = _this.attr('data-field');
    var data_controller = controller;
    var classList = _this.attr('class').split(/\s+/);//get controller in case there are multi-controllers on a screen
    if (classList.length == 2) {
        data_controller = classList[1];
    }
    
    // Select action
    if (data_field == 'disable') {
        var disable = $(item).prop('checked') ? 1 : 0;
        var data = {
            controller: data_controller,
            action: action,
            id: id,
            disable: disable
        };
        $.ajax({
            type: "POST",
            url: baseUrl + '/ajax/disable',
            data: data,
            success: function (response) {
                if (response) {
                    // Revert checkbox
                    $(item).addClass(revertClassFlg);
                    $(item).prop('checked', disable == 0).change();
                    $(item).removeClass(revertClassFlg);
                    
                    // Show error
                    showAlertModal(response);
                }
            }
        });
    }
    
    return false;
}

/**
 * Show alert using bootstrap modal
 * @param {string} message
 */
function showAlertModal(message) {
    $('#modal_alert_body').html(message);
    $('#modal_alert').modal('show');
}

/**
 * Go back
 */
function back(redirect) {
    if (typeof redirect !== 'undefined' && redirect !== '') {
        location.href = redirect;
    } else if (referer.indexOf(url) === -1) {
        location.href = referer;
    } else {
        location.href = '/' + controller;
    }
    return false;
}
