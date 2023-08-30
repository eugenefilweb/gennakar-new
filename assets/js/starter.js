var editors = []; // for editors. important. dont delete
var checkAllAccessModule = function(self) {
    var is_checked = $(self).is(':checked');
    if (is_checked) {
        $('input[name="modules[]"]').prop('checked', true);
    }
    else {
        $('input[name="modules[]"]').prop('checked', false);
    }
}


var checkAllActions = function(self) {
    var is_checked = $(self).is(':checked');
    var controller = $(self).data('controller');

    if (is_checked) {
        $('input[data-belongs_to="'+ controller +'"]').prop('checked', true);
    }
    else {
        $('input[data-belongs_to="'+ controller +'"]').prop('checked', false);
    }
}

var checkAllModule = function(self) {
    var is_checked = $(self).is(':checked');

    if (is_checked) {
        $('input.module_access').prop('checked', true);
    }
    else {
        $('input.module_access').prop('checked', false);
    }
}

var checkAllRole = function(self) {
    var is_checked = $(self).is(':checked');

    if (is_checked) {
        $('.role_access').prop('checked', true);
    }
    else {
        $('.role_access').prop('checked', false);
    }
}

let popupCenter = (url, title='Print Report', w=1000, h=700) => {
    // Fixes dual-screen position                             Most browsers      Firefox
    const dualScreenLeft = window.screenLeft !==  undefined ? window.screenLeft : window.screenX;
    const dualScreenTop = window.screenTop !==  undefined   ? window.screenTop  : window.screenY;
    const width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
    const height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;
    const systemZoom = width / window.screen.availWidth;
    const left = (width - w) / 2 / systemZoom + dualScreenLeft
    const top = (height - h) / 2 / systemZoom + dualScreenTop

    const newWindow = window.open(url, title, 
      `
      scrollbars=yes,
      width=(w/systemZoom), 
      height=(h/systemZoom), 
      left=${left}, top=${top}, width=${w}, height=${h}
      `
    )
    // if (window.focus) newWindow.print();
}

$(document).ready(function() {
    $(document).on('keydown', '[prevent-default="enter"]', function(e) {
        if(e.key == 'Enter') {
            e.preventDefault();
        }
    });

    $(document).on('change', 'input[name="selection[]"]', function() {
        var is_checked = $(this).is(':checked');
        var tr = $(this).closest('tr');

        if (is_checked) {
            tr.css('border', '2px solid #1BC5BD');
            tr.css('background', '#deffe7');
        }
        else {
            tr.css('border', '');
            tr.css('background', '');
        }
    });


    function captureNetworkRequest(e) {
        var capture_network_request = [];
        var capture_resource = performance.getEntriesByType("resource");
        for (var i = 0; i < capture_resource.length; i++) {
            if (capture_resource[i].initiatorType == "xmlhttprequest" || capture_resource[i].initiatorType == "script" || capture_resource[i].initiatorType == "img" || capture_resource[i].initiatorType == "link") {
                if (capture_resource[i].name.indexOf(app.baseUrl) > -1) {
                    capture_network_request.push(capture_resource[i].name)
                }
            }
        }
        return capture_network_request;
    }

    const getTransferSize = () => {
        let totalTransferSize = 0;
        performance.getEntriesByType('resource').map((resource) => {
            const data = resource.toJSON();
            totalTransferSize += data.encodedBodySize;
        });

        $.ajax({
            url: app.baseUrl + 'site/transfer-size',
            data: {totalTransferSize},
            method: 'post',
            dataType: 'json',
            cache: false,
            success: (s) => {

            },
            error: (e) => {
                console.log(e)
            }
        })
    }
    getTransferSize();
})