
/**
 * Shows popup message with OK|Cancel buttons. Best to use before deleting objects, on Delete button.
 * @param {type} message
 * @returns {Boolean}
 */
function confirmDelete(message, disallowPleaseWaitOverlay) {
    if (!message) {
        message = "Are you sure you want to delete?";
    }

    if (confirm(message)) {
        if (!disallowPleaseWaitOverlay) {
            showPleaseWait();
        }
        return true;
    } else {
        return false;
    }
}

/**
 * Shows popup message with OK|Cancel buttons. Best to use before deleting objects, on Delete button.
 * @param {type} message
 * @returns {Boolean}
 */
function confirmMessage(message) {
    if (!message) {
        message = "Are you sure?";
    }

    if (confirm(message)) {
        return true;
    } else {
        return false;
    }
}

/**
 * Displays overlay with "Please wait" text. Based on bootstrap modal. Contains animated progress bar.
 */
function showPleaseWait() {
    var modalLoading = '<div class="modal" id="pleaseWaitDialog" data-backdrop="static" data-keyboard="false role="dialog">\
        <div class="modal-dialog">\
            <div class="modal-content">\
                <div class="modal-header">\
                    <h4 class="modal-title">Please wait...</h4>\
                </div>\
                <div class="modal-body">\
                    <div class="progress">\
                      <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar"\
                      aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%; height: 40px">\
                      </div>\
                    </div>\
                </div>\
            </div>\
        </div>\
    </div>';
    $(document.body).append(modalLoading);
    $("#pleaseWaitDialog").modal("show");
}

/**
 * Hides "Please wait" overlay. See function showPleaseWait().
 */
function hidePleaseWait() {
    $("#pleaseWaitDialog").modal("hide");
}

/**
 * Shows nice spinner to the content of given selector.
 */
function spinner(element) {
    $(element).html('<div class="progress active" style="height: 25px; max-width: 350px; margin: 0 auto;">'
            + '<div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" '
            + 'style="width: 100%; border-radius: 5px;">'
            + '</div></div>');
}

function scrollToElement(selector, miliseconds) {
    if (!miliseconds) {
        miliseconds = 1500;
    }
    $('html, body').animate({
        scrollTop: $(selector).offset().top
    }, miliseconds);
}

function setCookie(cookieName, value, expireSecond) {
    var d = new Date();
    d.setTime(d.getTime() + (expireSecond * 1000));
    var expires = "expires=" + d.toGMTString();
    document.cookie = cookieName + "=" + value + "; " + expires;
}

function getCookie(cookieName) {
    var name = cookieName + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ')
            c = c.substring(1);
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

/**
 * When using gulp --production it removes all console.log references.
 * This function allows to display this information even then.
 */
function log(text) {
    var con = console;
    con.log(text);
}

function rand(min, max) {
    return Math.floor((Math.random() * max) + min);
}

function replaceAll(str, find, replace) {
    return str.replace(new RegExp(find, 'g'), replace);
}

// === Array =====================================================================

function array_get(array, field) {
    if (field in array) {
        return array[field];
    } else {
        return undefined;
    }
}

// === Ajax load page/element ====================================================

function loadPage(url) {
    showPleaseWait();
    document.location = url;
}

function ajaxRequest(url, requestData) {
    showPleaseWait();
    var request = $.ajax({
        type: "POST",
        data: requestData,
        url: url
    })
            .done(function (result) {
                hidePleaseWait(); // Hide overlay with please wait
                document.location = url;
            })
            .fail(function (error) {
                hidePleaseWait(); // Hide overlay with please wait
                alert("AN ERROR HAS OCCURED!\n\nPlease check your internet connection or try again in a while.");
            });
}

/*
 *
 */
function nicelyLoadPOST(url, selectorLoadTo, successCallback, hideErrorAlert) {
    $.post(url,
            {'_token': $('meta[name="csrf-token"]').attr('content')},
            function (data) {
                $(selectorLoadTo).html(data);
                if (successCallback) {
                    successCallback(data);
                }
            })
            .fail(function (data) {
                console.log(data);
                if (!hideErrorAlert) {
                    alert("Error has occured\n\nCheck your internet connection and try again after few seconds");
                }
            })
            .always(function () {

                // Hide please wait overlay
                hidePleaseWait();
            });
}

/*
 *
 */
function nicelyLoadGET(url, selectorLoadTo, options) {
    if (options == undefined) {
        options = [];
    }


    // =========================================================================

    $.get(url,
            {'_token': $('meta[name="csrf-token"]').attr('content')},
            function (data) {
                var successCallback = array_get(options, 'success');

                $(selectorLoadTo).html(data);
                if (successCallback) {
                    successCallback(data);
                }
            })
            .fail(function (data) {
                var error = array_get(options, 'error');
                var hideErrorAlert = array_get(options, 'hideErrorAlert');

                console.log(data);

                // === Error callback =============================================================
                if (error === undefined) {
                    $(selectorLoadTo).html(data.responseText);
                } else {
                    error();
                }

                // === Show error alert =============================================================

                if (!hideErrorAlert) {
                    alert("Error has occured\n\nCheck your internet connection and try again after few seconds");
                }
            })
            .always(function () {

                // Hide please wait overlay
                hidePleaseWait();
            });
}

function nicelyLoadElementGET(url, selectorLoadTo, options) {
    $(selectorLoadTo).fadeOut(250);

    var fadeInFunction = function () {
        $(selectorLoadTo).fadeIn(350);
    };

    return nicelyLoadGET(url, selectorLoadTo, {
        'success': function () {
            fadeInFunction();
            initializeProjectJs();
        },
        'error': fadeInFunction,
    });
}

function requestDelete(element) {
    var url = $(element).attr('data-href');
    var token = $(element).attr('data-token');
    if (!token) {
        alert("Undefined data-token attribute!");
    } else {
        var redirectForm = $('<form action="' + url + '" method="POST">' +
                '<input type="hidden" name="_method" value="DELETE" />' +
                '<input type="hidden" name="_token" value="' + token + '" />' +
                '</form>');
        $('body').append(redirectForm);
        redirectForm.submit();
    }
}