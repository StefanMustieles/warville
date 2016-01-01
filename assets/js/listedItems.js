$(function() {
        $(".list-group a").click(function(e) {
            myApp.showPleaseWait();
            var href = $(this).attr("href");
            var sub_id = $(this).attr("id");

            if(sub_id == 'All') {
                var urlParts = location.pathname.split("/");
                href = urlParts[0] + '/' + urlParts[1] + '/' + urlParts[2] + '/';
                //Remove previously added breadcrumb if it exists
                if($('ul.breadcrumb li').length == 4) {
                    $('ul.breadcrumb li:last-child').remove();
                    $('ul.breadcrumb li:last-child').addClass('active');
                    var linkText = $('ul.breadcrumb li:last-child a').text();
                    $('ul.breadcrumb li:last-child').empty();
                    $('ul.breadcrumb li:last-child').text(linkText);
                }
                
                window.history.pushState("object", href, href);
                href = '';
                loadContent(href, sub_id, urlParts[1], urlParts[2]);
            } 
            else { 
                loadContent(href, sub_id, null, null);
                //Remove previously added breadcrumb if it exists
                if($('ul.breadcrumb li').length == 4) {
                    $('ul.breadcrumb li:last-child').remove();
                    $('ul.breadcrumb li:last-child').addClass('active');
                }
                var categoryText = $('ul.breadcrumb li.active').text();
                var urlParts = location.pathname.split("/");
                var categoryLink = urlParts[0] + '/' + urlParts[1] + '/' + urlParts[2] + '/';
                $('ul.breadcrumb li.active').empty();
                $('ul.breadcrumb li.active').append('<a href="' + categoryLink + '">' + categoryText + '</a>');
                $('ul.breadcrumb li.active').removeClass('active');
                //Add active link to breadcrumbs
                var linkText = $(this).text();
                $('ul.breadcrumb').append('<li class="active">' + linkText + '</li>');
                //Push history
                window.history.pushState("object", href, href);
            }
            $('link[rel="canonical"]').attr('href', window.location.href);
            e.preventDefault();				
        });

        // THIS EVENT MAKES SURE THAT THE BACK/FORWARD BUTTONS WORK AS WELL
        window.onpopstate = function(event) {
            myApp.showPleaseWait();
            var urlParts = location.pathname.split("/");
            var sub_id;
            if(urlParts[3] == "index.php" || urlParts[3] == "") {
                sub_id = "All";
            }
            else {
                sub_id = $('a[href="' + urlParts[3] + '"]').attr("id");
            }
            loadContent(urlParts[3], sub_id, urlParts[1], urlParts[2]);
            $('link[rel="canonical"]').attr('href', window.location.href);
        };
    });

var myApp;
myApp = myApp || (function () {
    var pleaseWaitDiv = $('<div class="modal hide" id="pleaseWaitDialog" data-backdrop="static" data-keyboard="false"><div class="modal-header"><h1>Processing...</h1></div><div class="modal-body"><div class="progress progress-striped active"><div class="bar" style="width: 100%;"></div></div></div></div>');
    return {
        showPleaseWait: function() {
            pleaseWaitDiv.modal();
        },
        hidePleaseWait: function () {
            pleaseWaitDiv.modal('hide');
        },

    };
})();

function loadContent(url, sub_id, country, mainCat){
    // USES JQUERY TO LOAD THE CONTENT
    if(url == "index.php" || url == "") {
        url = country;
    }
    $.getJSON("../../webservices/content.php", 
        {cid: url, id: sub_id, category: mainCat === null ? "" : mainCat, format: "json"}, 
    function(json) {
        // EMPTY ITEMS
        $(".itemHolder .row").empty();

        // PUT CONTENT INTO THE RIGHT PLACES

        $.each(json, function(key, value){
            if(key == 0) {
                $("#contentHeader").empty();
                $("#contentHeader").text(value);
                // Update the title tag
                document.title = value + ' ' + document.title.substring(document.title.indexOf('-'));
            }
            else if (key == 1) {
                $("#description").empty();
                $("#description").html(value);
            }
            else {
                $(".itemHolder .row").append(value);
            }
        });
        myApp.hidePleaseWait();
    });

    // FILTER LIST REFLECTS THE CURRENT URL
    $(".list-group a").each(function(key, value) {
        $(value).removeClass("active");
    });
    
    if(sub_id == "All") {
        $('a[id="All"]').addClass("active");
    }
    else {
        $('a[href=\"' + url + '\"]').addClass("active");   
    }
}