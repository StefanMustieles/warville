$(function() {
        $(".list-group a").click(function(e) {
            $("#loading").show();
            var href = $(this).attr("href");
            var sub_id = $(this).attr("id");

            loadContent(href, sub_id, null);

            // HISTORY.PUSHSTATE
            history.pushState("", "New URL: "+href, href);
            e.preventDefault();				
        });

        // THIS EVENT MAKES SURE THAT THE BACK/FORWARD BUTTONS WORK AS WELL
        window.onpopstate = function(event) {
            $("#loading").show();
            var urlParts = location.pathname.split("/");
            var sub_id = $('a[href="' + urlParts[3] + '"]').attr("id");
            loadContent(urlParts[3], sub_id, urlParts[1]);
        };
    });

function loadContent(url, sub_id, country){
    // USES JQUERY TO LOAD THE CONTENT
    if(url == "index.php" || url == "") {
        url = country;
    }
    $.getJSON("../../webservices/content.php", {cid: url, id: sub_id, format: "json"}, function(json) {

        // EMPTY ITEMS
        $(".itemHolder .row").empty();

        // PUT CONTENT INTO THE RIGHT PLACES

        $.each(json, function(key, value){
            if(key == 0) {
                $("#contentHeader").empty();
                $("#contentHeader").text(value);
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