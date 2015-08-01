$(function() {
        $(".list-group a").click(function(e) {
            $("#loading").show();
            var href = $(this).attr("href");
            var sub_id = $(this).attr("id");

            if(sub_id == 'All') {
                var urlParts = location.pathname.split("/");
                href = urlParts[0] + '/' + urlParts[1] + '/' + urlParts[2] + '/' + 'index.php';
                history.pushState("", "New URL: "+href, href);
                href = '';
                loadContent(href, sub_id, urlParts[1], urlParts[2]);
            } 
            else { 
                loadContent(href, sub_id, null, null);
                history.pushState("", "New URL: "+href, href);
            }
            $('link[rel="canonical"]').attr('href', window.location.href);
            e.preventDefault();				
        });

        // THIS EVENT MAKES SURE THAT THE BACK/FORWARD BUTTONS WORK AS WELL
        window.onpopstate = function(event) {
            $("#loading").show();
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
                $("#description").text(value);
            }
            else {
                $(".itemHolder .row").append(value);
            }
        });
        $("#loading").hide();
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