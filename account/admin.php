<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin Area</title>

<link href="/assets/css/bootstrap.min.css" rel="stylesheet">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
<form action="fileUpload.php" id="my-detail-form" method="post" enctype="multipart/form-data">
                            
<!-- Header -->
<div id="top-nav" class="navbar navbar-inverse navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <span class="navbar-brand">Quartermaster Section</span>
        </div>
    </div><!-- /container -->
</div>
<!-- /Header -->

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3><i class="glyphicon glyphicon-briefcase"></i> Admin</h3>

            <div class="table-responsive">
                <table class="table">
                <tr>
                    <td><label for="countries">Countries</label></td>
                    <td><select id="countries" name="country">
                    <option value="">--- Select ---</option>
                    <?php
                        require_once $_SERVER['DOCUMENT_ROOT'] . '/config/dbconfig.php'; 
                        require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/db.php';

                        $db = new Zebra_Database();

                        $db->connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);

                        $db->select(
                            'country_id, name',
                            'countries', '', '', 'name ASC'
                        );

                        while ($row = $db->fetch_assoc()) {

                            echo '<option value="' . $row["country_id"] . '">' . $row["name"] . '</option>';								

                        }
                    ?>
                    </select>
                    </td>
                </tr>
                <tr id="trCountryDescription" style="display: none;">
                    <td><label for="countrydescription">Country Description</label></td>
                    <td>
                        <textarea id="countrydescription" style="width: 800px; height: 163px;"></textarea>
                        <button id="btUpdateCountryDescription" type="button" class="btn btn-success">Update</button>
                    </td>
                </tr>
                <tr id="trCategories" style="display: none;">
                    <td><label for="categories">Categories</label></td>
                    <td><select id="categories" name="maincategory">
                            <option value="">--- Select ---</option>
                        </select>
                    </td>
                </tr>
                <tr id="trFileUpload" style="display: none;">
                    <td><label>Upload a picture</label></td>
                    <td>
                        <div class="panel panel-warning ts-file-panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Upload File</h3>
                            </div>
                            <div class="panel-body">
                               <input name="filename" type="file"  placeholder="Browse File." />
                               <button type="submit" class="btn btn-success">UPLOAD</button>
                            </div>
                            <div class="panel-footer">
                                <div class="ts-hidden-bar">
                                    <!--Bootstrap progress bar Markup :start -->
                                    <div class="progress progress-striped active ">
                                        <div class="progress-bar"  role="progressbar" style="width: 0%">
                                            <span class="sr-only">0% Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr id="trCategoryDescription" style="display: none;">
                    <td><label for="categorydescription">Category Description</label></td>
                    <td>
                        <textarea id="categorydescription" style="width: 800px; height: 163px;"></textarea>
                        <button id="btUpdateDescription" type="button" class="btn btn-success">Update</button>
                    </td>
                </tr>
                <tr id="trSubCategories" style="display: none;">
                    <td><label for="sub_categories">Sub Categories</label></td>
                    <td><select id="sub_categories">
                            <option value="">--- Select ---</option>
                        </select>
                    </td>
                </tr>
                <tr id="trSubCategoryDescription" style="display: none;">
                    <td><label for="subcategorydescription">Sub Category Description</label></td>
                    <td>
                        <textarea id="subcategorydescription" style="width: 800px; height: 163px;"></textarea>
                        <button id="btUpdateSubDescription" type="button" class="btn btn-success">Update</button>
                    </td>
                </tr>
                </table>
            </div>
            <div id="newItem" class="table-responsive" style="display: none;">
                <h3>Add new item</h3>
                <table id="tblNewItem" class="table">
                    <tbody>
                    </tbody>
                </table>    
            </div>
            <div id="itemsList" class="table-responsive" style="display: none;">
                <h3>Current items</h3>
                <table id="tblItems" class="table">
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div><!--/row-->
</div><!--/container-->
<script src="/assets/js/jquery.js"></script>
<script src="/assets/js/jquery-ui.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="http://malsup.github.com/jquery.form.js"></script>                                              
<script type="text/javascript">
$(document).ready(function(){
    
    var myApp;
    myApp = myApp || (function () {
        var pleaseWaitDiv = $('<div class="modal" id="pleaseWaitDiv" role="dialog" style="display:none;"><div class="modal-dialog" data-backdrop="static" data-keyboard="false"><div class="modal-content" style="padding:20px;"><h1>Processing...</h1><div class="progress progress-striped active"><div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div></div></div></div>');
        return {
            showPleaseWait: function() {
                pleaseWaitDiv.modal();
            },
            hidePleaseWait: function () {
                pleaseWaitDiv.modal("hide");
            },
        };
    })();
    
    var TS_AJAX_FORM ={
        /*ERROR Message Display Element Reference*/
        MY_MESSAGE_ERR : $(".my-message-error"),

        /*SUCCESS Message Display Element Reference*/
        MY_MESSAGE_SUC : $(".my-message-success"),

        /*Shows the input message and hides it in 5 seconds*/
        showMessage:function(msg, type){

            var message = (type === "ERR")? this.MY_MESSAGE_ERR : this.MY_MESSAGE_SUC,

            txt = $(message).find("a");

            $(txt).html(msg);

            message.fadeIn("fast",function(){

                message.fadeOut(5000);
            })
        },
        /*
         *Handler: success, Once the form is submitted and response
         *arrives, it will be activated.
         */
        successHandler: function(responseText, statusText, xhr, form){
            $(".ts-file-panel .progress-bar").width("100%");
            $(".ts-hidden-bar").delay(1000).fadeOut("fast");
        },

        beforeSubmitHandler:function(arr, form, options){
            var isValid = true;

            $.each(arr,function(index, aField){

                if("filename" === aField.name && aField.value === ""){

                    TS_AJAX_FORM.showMessage("Please Select a File.", "ERR");

                    isValid = false;
                }
            });

            if(isValid){
                $(".ts-hidden-bar").fadeIn();
            }
            return isValid;
        },
        handleUploadProgress: function(event, position, total, percentComplete ){

            $(".ts-file-panel .progress-bar").width(percentComplete+"%");
            $(".ts-file-size").html((total/(1024*1024))+"MB");
            $(".ts-file-completed").html("Position"+position+" event "+event);
        },
        /*Initializing Ajax Form*/
        initMyAjaxForm:function(){
            $("#my-detail-form").ajaxForm({

                beforeSubmit:this.beforeSubmitHandler,

                success:this.successHandler,

                clearForm:false,

                uploadProgress:this.handleUploadProgress
            });
        }
    };
    
    TS_AJAX_FORM.initMyAjaxForm();
    
    $("select#countries").change(function(){

        var country_id = $("select#countries option:selected").attr('value');

        if (country_id.length > 0 ) {

            $.ajax({
                type: "POST",
                url: "fetchdata.php",
                data: {action: 'categories', country_id: country_id},
                cache: false,
                beforeSend: function () {
                    myApp.showPleaseWait();
                },
                success: function(html) {
                    $("select#categories > option:gt(0)").remove();
                    var obj = jQuery.parseJSON(html);
                    $("#countrydescription").val(obj[0].description);
                    $.each(obj, function(key, value) {
                        $("select#categories").append($("<option />").val(value.category_id).text(value.name));
                    });
                    $("tr#trCountryDescription").show();
                    $("tr#trCategories").show();
                    myApp.hidePleaseWait();
                }
            });
            $("tr#trFileUpload").hide();
            $("tr#trSubCategoryDescription").hide();
            $("div#newItem").hide();
            $("div#itemsList").hide();
        }
        else {
            $("tr#trCountryDescription").hide();
            $("tr#trCategories").hide();
            $("tr#trFileUpload").hide();
            $("tr#trCategoryDescription").hide();
            $("tr#trSubCategories").hide();
            $("tr#trSubCategoryDescription").hide();
            $("div#newItem").hide();
            $("div#itemsList").hide();
        }
    });
    
    $("select#categories").change(function(){

        var category_id = $("select#categories option:selected").attr('value');

        if (category_id.length > 0 ) {

            $.ajax({
                type: "POST",
                url: "fetchdata.php",
                data: {action: 'sub_categories', category_id: category_id},
                cache: false,
                beforeSend: function () {
                    myApp.showPleaseWait();
                },
                success: function(html) {
                    $("select#sub_categories > option:gt(0)").remove();
                    var obj = jQuery.parseJSON(html);
                    $("#categorydescription").val(obj[0].description);
                    $.each(obj, function(key, value) {
                        $("select#sub_categories").append($("<option />").val(value.sub_category_id).text(value.name));
                    });
                    $("tr#trFileUpload").show();
                    $("tr#trCategoryDescription").show();
                    $("tr#trSubCategories").show();
                    myApp.hidePleaseWait();
                }
            });
            $("tr#trFileUpload").hide();
            $("tr#trSubCategoryDescription").hide();
            $("div#newItem").hide();
            $("div#itemsList").hide();
        }
        else {
            $("tr#trFileUpload").hide();
            $("tr#trCategoryDescription").hide();
            $("tr#trSubCategories").hide();
            $("tr#trSubCategoryDescription").hide();
            $("div#newItem").hide();
            $("div#itemsList").hide();
        }
    });
    
    $("#btUpdateCountryDescription").click(function() {
        
        var country_id = $("select#countries option:selected").attr('value');
        var description = $("#countrydescription").val();

        if (country_id.length > 0 ) {

            $.ajax({
                type: "POST",
                url: "fetchdata.php",
                data: {action: 'update_country_description', country_id: country_id, description: description},
                cache: false,
                beforeSend: function () {
                    myApp.showPleaseWait();
                },
                success: function() {
                    myApp.hidePleaseWait();
                    alert('Country description updated!');  
                }
            });
        }
    });
    
    $("#btUpdateDescription").click(function() {
        
        var category_id = $("select#categories option:selected").attr('value');
        var description = $("#categorydescription").val();

        if (category_id.length > 0 ) {

            $.ajax({
                type: "POST",
                url: "fetchdata.php",
                data: {action: 'update_description', category_id: category_id, description: description},
                cache: false,
                beforeSend: function () {
                    myApp.showPleaseWait();
                },
                success: function() {
                    myApp.hidePleaseWait();
                    alert('Description updated!');  
                }
            });
        }
    });
    
    $("#btUpdateSubDescription").click(function() {
        
        var sub_category_id = $("select#sub_categories option:selected").attr('value');
        var description = $("#subcategorydescription").val();

        if (sub_category_id.length > 0 ) {

            $.ajax({
                type: "POST",
                url: "fetchdata.php",
                data: {action: 'update_sub_description', sub_category_id: sub_category_id, description: description},
                cache: false,
                beforeSend: function () {
                    myApp.showPleaseWait();
                },
                success: function() {
                    myApp.hidePleaseWait();
                    alert('Sub category description updated!');  
                }
            });
        }
    });
    
    $("select#sub_categories").change(function(){

        var sub_category_id = $("select#sub_categories option:selected").attr('value');

        if (sub_category_id.length > 0 ) {
            GetItems(sub_category_id);
        }
    });
    
    function GetItems(sub_category_id) {
        $.ajax({
            type: "POST",
            url: "fetchdata.php",
            data: {action: 'items', sub_category_id: sub_category_id},
            cache: false,
            beforeSend: function () {
                myApp.showPleaseWait();
            },
            success: function(html) {
                var obj = jQuery.parseJSON(html);
                var category = $("select#categories option:selected").text();

                //Empty rows
                $("table#tblNewItem > tbody:last").children().remove();
                $("table#tblItems > tbody:last").children().remove();

                switch (category)
                {
                    case 'AFVs':
                        showAFVs(obj);
                        break;
                    case 'Artillery':
                        showArtillery(obj);
                        break;
                    case 'Support Vehicles':
                        showSupportVehicles(obj);
                        break;
                    case 'Infantry Weapons':
                        showInfantryWeapons(obj);
                        break;
                    case 'Divisions':
                        showDivisions(obj);
                        break;
                    case 'Companies':
                        showCompanies(obj);
                        break;
                }

                $("tr#trSubCategoryDescription").show();
                $("div#newItem").show();
                $("div#itemsList").show();
                myApp.hidePleaseWait();
            }
        });
    }
    
    function showAFVs(obj) {
        $("table#tblNewItem > tbody:last").append('<tr><th>ID</th><th>Name</th><th>Display Order</th><th>Title</th><th>Friendly Url</th><th>Image</th><th>Image Source</th><th>Short Text</th><th>Year</th><th>Vehicle Type</th><th>Origin & Designer</th><th>Numbers Produced</th><th>Crew</th><th>Main Armament</th><th>Sponson Traverse</th><th>Elevation</th>\n\
                                                  <th>Turret Traverse</th><th>Gun Traverse</th><th>Gun Mount</th><th>Maximum Range</th><th>Armour Penetration</th><th>Gun Sight</th><th>Secondary Armament</th>\n\
                                                  <th>Smoke Discharger</th><th>Ammunition Carried</th><th>Height</th><th>Width</th><th>Length</th><th>Combat Weight</th><th>Ground Clearance</th>\n\
                                                  <th>Fording Depth</th><th>Trench Crossing</th><th>Obstacle Clearance</th><th>Climbing Ability</th><th>Radio</th>\n\
                                                  <th>Armour</th><th>Engine</th><th>Transmission</th><th>Maximum Road Range</th><th>Maximum Cross Country Range</th><th>Maximum Water Range</th><th>Maximum Road Speed</th>\n\
                                                  <th>Maximum Cross Country Speed</th><th>Maximum Water Speed</th><th>Variants</th><th>Notes</th><th></th></tr>\n\
                                                  <tr><td></td><td><input type="text" /></td><td></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td>\n\
                                                  <td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td>\n\
                                                  <td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td>\n\
                                                  <td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td>\n\
                                                  <td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td>\n\
                                                  <td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><textarea></textarea></td><td><textarea></textarea></td><td><button id="btAFVInsert" type="button" class="btn btn-success">Insert</button></td></tr>');
        
        var total_rows;
        var options = new Array();
        
        $.each(obj, function(key, value) {
            if(key == 0) {
                $("#subcategorydescription").val(value);
            }
            else if(key == 1) {
                total_rows = value;
            }
            else {        
                for(var i=1; i <= total_rows; i++)
                {
                    if(i == value.display_order) options.push('<option selected>' + i + '</option>');
                    else options.push('<option>' + i + '</option>');
                }
                
                $("table#tblItems > tbody:last").append('<tr><td>' + value.item_id + '</td><td><input type="text" value="' + value.name + '" /></td><td><select>' + options + '</td><td><input type="text" value="' + value.title + '" /></td><td><input type="text" value="' + value.friendly_url + '" /></td><td><input type="text" value="' + value.thumbnail_image + '" /></td><td><input type="text" value="' + value.image_source + '" /></td><td><input type="text" value="' + value.short_text + '" /></td>\n\
                                                  <td><input type="text" value="' + value.year  + '" /></td><td><input type="text" value="' + value.type  + '" /></td><td><input type="text" value="' + value.designer  + '" /></td><td><input type="text" value="' + value.numbers_produced + '" /></td><td><input type="text" value="' + value.crew + '" /></td><td><input type="text" value="' + value.main_armament + '" /></td><td><input type="text" value="' + value.sponson_traverse + '" /></td><td><input type="text" value="' + value.elevation + '" /></td>\n\
                                                  <td><input type="text" value="' + value.turret_traverse + '" /></td><td><input type="text" value="' + value.gun_traverse + '" /></td><td><input type="text" value="' + value.gun_mounts + '" /></td><td><input type="text" value="' + value.maximum_range + '" /></td><td><input type="text" value="' + value.armour_penetration + '" /></td><td><input type="text" value="' + value.gun_sight + '" /></td><td><input type="text" value="' + value.secondary_armament + '" /></td>\n\
                                                  <td><input type="text" value="' + value.smoke_discharger + '" /></td><td><input type="text" value="' + value.ammunition_carried + '" /></td><td><input type="text" value="' + value.height + '" /></td><td><input type="text" value="' + value.width + '" /></td><td><input type="text" value="' + value.length + '" /></td><td><input type="text" value="' + value.weight + '" /></td><td><input type="text" value="' + value.ground_clearance + '" /></td>\n\
                                                  <td><input type="text" value="' + value.fording_depth + '" /></td><td><input type="text" value="' + value.trench_crossing + '" /></td><td><input type="text" value="' + value.obstacle_clearance + '" /></td><td><input type="text" value="' + value.climbing_ability + '" /></td><td><input type="text" value="' + value.radio + '" /></td>\n\
                                                  <td><input type="text" value="' + value.armour + '" /></td><td><input type="text" value="' + value.engine + '" /></td><td><input type="text" value="' + value.transmission + '" /></td><td><input type="text" value="' + value.maximum_road_range + '" /></td><td><input type="text" value="' + value.maximum_cross_country_range + '" /></td><td><input type="text" value="' + value.maximum_water_range + '" /></td><td><input type="text" value="' + value.maximum_road_speed + '" /></td>\n\
                                                  <td><input type="text" value="' + value.maximum_cross_country_speed + '" /></td><td><input type="text" value="' + value.maximum_water_speed + '" /></td><td><textarea>' + value.variants + '</textarea></td><td><textarea>' + value.notes + '</textarea></td><td><button type="button" class="btn btn-success btAFVUpdate">Update</button></td><td><button type="button" class="btn btn-danger btDeleteItem">Delete</button></td></tr>');
                options = [];
            }
        });
        
        //Attach button clicks
        $(document).on('click', '#btAFVInsert', function(){ 
            insertAFV(this);
        });
        
        $(document).on('click', '.btAFVUpdate', function(){ 
            updateAFV(this);
        });
        
        $(document).on('click', '.btDeleteItem', function(){ 
            deleteItem(this);
        });
    }
    
    function insertAFV(button) {
        var sub_category_id = $("select#sub_categories option:selected").attr('value');
        var row = $(button).closest("tr");
        var name = row.find("td").eq(1).find("input").val();
        var title = row.find("td").eq(2).find("input").val();
        var friendly_url = row.find("td").eq(3).find("input").val();
        var image = row.find("td").eq(4).find("input").val();
        var image_source = row.find("td").eq(5).find("input").val();
        var short_text = row.find("td").eq(6).find("input").val();
        var year = row.find("td").eq(7).find("input").val();
        var type = row.find("td").eq(8).find("input").val();
        var designer = row.find("td").eq(9).find("input").val();
        var numbers_produced = row.find("td").eq(10).find("input").val();
        var crew = row.find("td").eq(11).find("input").val();
        var main_armament = row.find("td").eq(12).find("input").val();
        var sponson_traverse = row.find("td").eq(13).find("input").val();
        var elevation = row.find("td").eq(14).find("input").val();
        var turret_traverse = row.find("td").eq(15).find("input").val();
        var gun_traverse = row.find("td").eq(16).find("input").val();
        var gun_mounts = row.find("td").eq(17).find("input").val();
        var maximum_range = row.find("td").eq(18).find("input").val();
        var armour_penetration = row.find("td").eq(19).find("input").val();
        var gun_sight = row.find("td").eq(20).find("input").val();
        var secondary_armament = row.find("td").eq(21).find("input").val();
        var smoke_discharger = row.find("td").eq(22).find("input").val();
        var ammunition_carried = row.find("td").eq(23).find("input").val();
        var height = row.find("td").eq(24).find("input").val();
        var width = row.find("td").eq(25).find("input").val();
        var length = row.find("td").eq(26).find("input").val();
        var weight = row.find("td").eq(27).find("input").val();
        var ground_clearance = row.find("td").eq(28).find("input").val();
        var fording_depth = row.find("td").eq(29).find("input").val();
        var trench_crossing = row.find("td").eq(30).find("input").val();
        var obstacle_clearance = row.find("td").eq(31).find("input").val();
        var climbing_ability = row.find("td").eq(32).find("input").val();
        var radio = row.find("td").eq(33).find("input").val();
        var armour = row.find("td").eq(34).find("input").val();
        var engine = row.find("td").eq(35).find("input").val();
        var transmission = row.find("td").eq(36).find("input").val();
        var maximum_road_range = row.find("td").eq(37).find("input").val();
        var maximum_cross_country_range = row.find("td").eq(38).find("input").val();
        var maximum_water_range = row.find("td").eq(39).find("input").val();
        var maximum_road_speed = row.find("td").eq(40).find("input").val();
        var maximum_cross_country_speed = row.find("td").eq(41).find("input").val();
        var maximum_water_speed = row.find("td").eq(42).find("input").val();
        var variants = row.find("td").eq(43).find("textarea").val();
        var notes = row.find("td").eq(44).find("textarea").val();

        $.ajax({
            type: "POST",
            url: "fetchdata.php",
            data: {action: 'insertAFV', sub_category_id: sub_category_id, name: name, title: title, friendly_url: friendly_url, image: image, image_source: image_source, short_text: short_text, 
                year: year, type: type, designer: designer, numbers_produced: numbers_produced, crew: crew, main_armament: main_armament, sponson_traverse: sponson_traverse, elevation: elevation, 
                turret_traverse: turret_traverse, gun_traverse: gun_traverse, gun_mounts: gun_mounts, maximum_range: maximum_range, armour_penetration: armour_penetration, gun_sight: gun_sight, secondary_armament: secondary_armament, 
                smoke_discharger: smoke_discharger, ammunition_carried: ammunition_carried, height: height, width: width, length: length, weight: weight, ground_clearance: ground_clearance, 
                fording_depth: fording_depth, trench_crossing: trench_crossing, obstacle_clearance: obstacle_clearance, climbing_ability: climbing_ability,
                radio: radio, armour: armour, engine: engine, transmission: transmission, maximum_road_range: maximum_road_range, maximum_cross_country_range: maximum_cross_country_range, maximum_water_range: maximum_water_range, 
                maximum_road_speed: maximum_road_speed, maximum_cross_country_speed: maximum_cross_country_speed, maximum_water_speed: maximum_water_speed, variants: variants, notes: notes},
            cache: false,
            beforeSend: function () {
                myApp.showPleaseWait();
            },
            success: function(html) {
                myApp.hidePleaseWait();
                var sub_category_id = $("select#sub_categories option:selected").attr('value');
                GetItems(sub_category_id);
                $('html, body').animate({scrollTop:$(document).height()}, 'slow');
                $('html, body').animate({scrollLeft:0}, 'slow');
                alert('Item added!');
                
                setTimeout(function() {
                    $("#tblItems tbody tr:last").css("background-color", "aqua");
                    $('#tblItems tbody tr:last').effect("highlight", {}, 3000);
                }, 2000);
            }
        });
    }
    
    function updateAFV(button) {
        var row = $(button).closest("tr");
        var item_id = row.find("td").eq(0).text();
        var name = row.find("td").eq(1).find("input").val();
        var order = row.find("td").eq(2).find('select :selected').val()
        var title = row.find("td").eq(3).find("input").val();
        var friendly_url = row.find("td").eq(4).find("input").val();
        var image = row.find("td").eq(5).find("input").val();
        var image_source = row.find("td").eq(6).find("input").val();
        var short_text = row.find("td").eq(7).find("input").val();
        var year = row.find("td").eq(8).find("input").val();
        var type = row.find("td").eq(9).find("input").val();
        var designer = row.find("td").eq(10).find("input").val();
        var numbers_produced = row.find("td").eq(11).find("input").val();
        var crew = row.find("td").eq(12).find("input").val();
        var main_armament = row.find("td").eq(13).find("input").val();
        var sponson_traverse = row.find("td").eq(14).find("input").val();
        var elevation = row.find("td").eq(15).find("input").val();
        var turret_traverse = row.find("td").eq(16).find("input").val();
        var gun_traverse = row.find("td").eq(17).find("input").val();
        var gun_mounts = row.find("td").eq(18).find("input").val();
        var maximum_range = row.find("td").eq(19).find("input").val();
        var armour_penetration = row.find("td").eq(20).find("input").val();
        var gun_sight = row.find("td").eq(21).find("input").val();
        var secondary_armament = row.find("td").eq(22).find("input").val();
        var smoke_discharger = row.find("td").eq(23).find("input").val();
        var ammunition_carried = row.find("td").eq(24).find("input").val();
        var height = row.find("td").eq(25).find("input").val();
        var width = row.find("td").eq(26).find("input").val();
        var length = row.find("td").eq(27).find("input").val();
        var weight = row.find("td").eq(28).find("input").val();
        var ground_clearance = row.find("td").eq(29).find("input").val();
        var fording_depth = row.find("td").eq(30).find("input").val();
        var trench_crossing = row.find("td").eq(31).find("input").val();
        var obstacle_clearance = row.find("td").eq(32).find("input").val();
        var climbing_ability = row.find("td").eq(33).find("input").val();
        var radio = row.find("td").eq(34).find("input").val();
        var armour = row.find("td").eq(35).find("input").val();
        var engine = row.find("td").eq(36).find("input").val();
        var transmission = row.find("td").eq(37).find("input").val();
        var maximum_road_range = row.find("td").eq(38).find("input").val();
        var maximum_cross_country_range = row.find("td").eq(39).find("input").val();
        var maximum_water_range = row.find("td").eq(40).find("input").val();
        var maximum_road_speed = row.find("td").eq(41).find("input").val(); 
        var maximum_cross_country_speed = row.find("td").eq(42).find("input").val();
        var maximum_water_speed = row.find("td").eq(43).find("input").val();
        var variants = row.find("td").eq(44).find("textarea").val();
        var notes = row.find("td").eq(45).find("textarea").val();
        
        $.ajax({
            type: "POST",
            url: "fetchdata.php",
            data: {action: 'updateAFV', item_id: item_id, name: name, title: title, friendly_url: friendly_url, image: image, image_source: image_source, short_text: short_text, 
                year: year, type: type, designer: designer, numbers_produced: numbers_produced, crew: crew, main_armament: main_armament, sponson_traverse: sponson_traverse, elevation: elevation, 
                turret_traverse: turret_traverse, gun_traverse: gun_traverse, gun_mounts: gun_mounts, maximum_range: maximum_range, armour_penetration: armour_penetration, gun_sight: gun_sight, secondary_armament: secondary_armament, 
                smoke_discharger: smoke_discharger, ammunition_carried: ammunition_carried, height: height, width: width, length: length, weight: weight, ground_clearance: ground_clearance, 
                fording_depth: fording_depth, trench_crossing: trench_crossing, obstacle_clearance: obstacle_clearance, climbing_ability: climbing_ability,
                radio: radio, armour: armour, engine: engine, transmission: transmission, maximum_road_range: maximum_road_range, maximum_cross_country_range: maximum_cross_country_range, maximum_road_speed: maximum_road_speed, 
                maximum_water_range: maximum_water_range, maximum_water_speed: maximum_water_speed, maximum_cross_country_speed: maximum_cross_country_speed, variants: variants, notes: notes, display_order: order},
            cache: false,
            beforeSend: function () {
                myApp.showPleaseWait();
            },
            success: function(html) {
                myApp.hidePleaseWait();
                alert('Item updated!');
            }
        });
    }
    
    function showArtillery(obj) {
        $("table#tblNewItem > tbody:last").append('<tr><th>ID</th><th>Name</th><th>Display Order</th><th>Title</th><th>Friendly Url</th><th>Image</th><th>Image Source</th><th>Short Text</th><th>Year</th><th>Weapon Type</th><th>Origin & Designer</th><th>Numbers Produced</th><th>Calibre</th><th>Barrel Length</th><th>Carriage</th><th>Gun Shield</th><th>Height</th>\n\
                                                  <th>Width</th><th>Length</th><th>Gun Mounts</th><th>Trailers</th><th>Elevation</th><th>Traverse</th><th>Breech</th><th>Recoil</th><th>Gun Sight</th>\n\
                                                  <th>Muzzle Velocity</th><th>Feed</th><th>Practical Rate of Fire</th><th>Armoured Plate</th><th>Weight</th><th>Round Weight</th><th>Magazine Capacity</th><th>Maximum Ceiling</th>\n\
                                                  <th>Maximum Range</th><th>Maximum Ground Range</th><th>Rate of Fire</th><th>Maximum Rate of Fire</th><th>Armour Penetration</th><th>Crew</th><th>Traction</th>\n\
                                                  <th>Variants</th><th>Notes</th><th></th></tr>\n\
                                                  <tr><td></td><td><input type="text" /></td><td></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td>\n\
                                                  <td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td>\n\
                                                  <td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td>\n\
                                                  <td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" ></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td>\n\
                                                  <td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><textarea></textarea></td><td><textarea></textarea></td><td><button id="btArtilleryInsert" type="button" class="btn btn-success">Insert</button></td></tr>');
        var total_rows;
        var options = new Array();
        
        $.each(obj, function(key, value) {
            if(key == 0) {
                $("#subcategorydescription").val(value);
            }
            else if(key == 1) {
                total_rows = value;
            }
            else {        
                for(var i=1; i <= total_rows; i++)
                {
                    if(i == value.display_order) options.push('<option selected>' + i + '</option>');
                    else options.push('<option>' + i + '</option>');
                }
                $("table#tblItems > tbody:last").append('<tr><td>' + value.item_id + '</td><td><input type="text" value="' + value.name + '" /></td><td><select>' + options + '</select></td><td><input type="text" value="' + value.title + '" /></td><td><input type="text" value="' + value.friendly_url + '" /></td><td><input type="text" value="' + value.thumbnail_image + '" /></td><td><input type="text" value="' + value.image_source + '" /></td><td><input type="text" value="' + value.short_text + '" /></td>\n\
                                                  <td><input type="text" value="' + value.year  + '" /></td><td><input type="text" value="' + value.type  + '" /></td><td><input type="text" value="' + value.designer  + '" /></td><td><input type="text" value="' + value.numbers_produced + '" /></td><td><input type="text" value="' + value.calibre + '" /></td><td><input type="text" value="' + value.barrel_length + '" /></td><td><input type="text" value="' + value.carriage + '" /></td><td><input type="text" value="' + value.gun_shield + '" /></td><td><input type="text" value="' + value.height + '" /></td>\n\
                                                  <td><input type="text" value="' + value.width + '" /></td><td><input type="text" value="' + value.length + '" /></td><td><input type="text" value="' + value.gun_mounts + '" /></td><td><input type="text" value="' + value.trailers + '" /></td><td><input type="text" value="' + value.elevation + '" /></td><td><input type="text" value="' + value.turret_traverse + '" /></td>\n\
                                                  <td><input type="text" value="' + value.breech + '" /></td><td><input type="text" value="' + value.recoil + '" /></td><td><input type="text" value="' + value.gun_sight + '" /></td><td><input type="text" value="' + value.muzzle_velocity + '" /></td><td><input type="text" value="' + value.feed + '" /></td><td><input type="text" value="' + value.practical_rate_of_fire + '" /></td><td><input type="text" value="' + value.armoured_plate + '" /></td><td><input type="text" value="' + value.weight + '" /></td><td><input type="text" value="' + value.round_weight + '" /></td>\n\
                                                  <td><input type="text" value="' + value.magazine_capacity + '" /></td><td><input type="text" value="' + value.maximum_ceiling + '" /></td><td><input type="text" value="' + value.maximum_range + '" /></td><td><input type="text" value="' + value.maximum_ground_range + '" /></td><td><input type="text" value="' + value.rate_of_fire + '" /></td><td><input type="text" value="' + value.maximum_rate_of_fire + '" /></td><td><input type="text" value="' + value.armour_penetration + '" /></td>\n\
                                                  <td><input type="text" value="' + value.crew + '" /></td><td><input type="text" value="' + value.traction + '" /></td><td><textarea>' + value.variants + '</textarea></td><td><textarea>' + value.notes + '</textarea></td><td><button type="button" class="btn btn-success btAFVUpdate">Update</button></td><td><button type="button" class="btn btn-danger btDeleteItem">Delete</button></td></tr>');
                options = [];
            }
        });
        
        //Attach button clicks
        $(document).on('click', '#btArtilleryInsert', function(){ 
            insertArtillery(this);
        });
        
        $(document).on('click', '.btAFVUpdate', function(){ 
            updateArtillery(this);
        });
        
        $(document).on('click', '.btDeleteItem', function(){ 
            deleteItem(this);
        });
    }
    
    function insertArtillery(button) {
        var sub_category_id = $("select#sub_categories option:selected").attr('value');
        var row = $(button).closest("tr");
        var name = row.find("td").eq(1).find("input").val();
        var title = row.find("td").eq(2).find("input").val();
        var friendly_url = row.find("td").eq(3).find("input").val();
        var image = row.find("td").eq(4).find("input").val();
        var image_source = row.find("td").eq(5).find("input").val();
        var short_text = row.find("td").eq(6).find("input").val();
        var year = row.find("td").eq(7).find("input").val();
        var type = row.find("td").eq(8).find("input").val();
        var designer = row.find("td").eq(9).find("input").val();
        var numbers_produced = row.find("td").eq(10).find("input").val();
        var calibre = row.find("td").eq(11).find("input").val();
        var barrel_length = row.find("td").eq(12).find("input").val();
        var carriage = row.find("td").eq(13).find("input").val();   
        var gun_shield = row.find("td").eq(14).find("input").val();   
        var height = row.find("td").eq(15).find("input").val();
        var width = row.find("td").eq(16).find("input").val(); 
        var length = row.find("td").eq(17).find("input").val();      
        var gun_mounts = row.find("td").eq(18).find("input").val();       
        var trailers = row.find("td").eq(19).find("input").val();     
        var elevation = row.find("td").eq(20).find("input").val();
        var turret_traverse = row.find("td").eq(21).find("input").val();
        var breech = row.find("td").eq(22).find("input").val();
        var recoil = row.find("td").eq(23).find("input").val();
        var gun_sight = row.find("td").eq(24).find("input").val();
        var muzzle_velocity = row.find("td").eq(25).find("input").val();
        var feed = row.find("td").eq(26).find("input").val();
        var practical_rate_of_fire = row.find("td").eq(27).find("input").val();
        var armoured_plate = row.find("td").eq(28).find("input").val();
        var weight = row.find("td").eq(29).find("input").val();  
        var round_weight = row.find("td").eq(30).find("input").val();
        var magazine_capacity = row.find("td").eq(31).find("input").val();
        var maximum_ceiling = row.find("td").eq(32).find("input").val();
        var maximum_range = row.find("td").eq(33).find("input").val();
        var maximum_ground_range = row.find("td").eq(34).find("input").val();
        var rate_of_fire = row.find("td").eq(35).find("input").val();
        var maximum_rate_of_fire = row.find("td").eq(36).find("input").val();
        var armour_penetration = row.find("td").eq(37).find("input").val();  
        var crew = row.find("td").eq(38).find("input").val();
        var traction = row.find("td").eq(39).find("input").val();
        var variants = row.find("td").eq(40).find("textarea").val();
        var notes = row.find("td").eq(41).find("textarea").val();

        $.ajax({
            type: "POST",
            url: "fetchdata.php",
            data: {action: 'insertArtillery', sub_category_id: sub_category_id, name: name, title: title, friendly_url: friendly_url, image: image, image_source: image_source, short_text: short_text, 
                year: year, type: type, designer: designer, numbers_produced: numbers_produced, calibre: calibre, barrel_length: barrel_length, carriage: carriage, gun_shield: gun_shield, height: height, 
                width: width, length: length, gun_mounts: gun_mounts, trailers: trailers, elevation: elevation, turret_traverse: turret_traverse, breech: breech, recoil: recoil,
                gun_sight: gun_sight, muzzle_velocity: muzzle_velocity, feed: feed, practical_rate_of_fire: practical_rate_of_fire, armoured_plate: armoured_plate, weight: weight, round_weight: round_weight, 
                magazine_capacity: magazine_capacity, maximum_ceiling: maximum_ceiling, maximum_range: maximum_range, maximum_ground_range: maximum_ground_range, rate_of_fire: rate_of_fire, maximum_rate_of_fire: maximum_rate_of_fire,
                armour_penetration: armour_penetration, crew: crew, traction: traction, variants: variants, notes: notes},
            cache: false,
            beforeSend: function () {
                myApp.showPleaseWait();
            },
            success: function() {
                myApp.hidePleaseWait();
                var sub_category_id = $("select#sub_categories option:selected").attr('value');
                GetItems(sub_category_id);
                $('html, body').animate({scrollTop:$(document).height()}, 'slow');
                $('html, body').animate({scrollLeft:0}, 'slow');
                alert('Item added!');
                
                setTimeout(function() {
                    $("#tblItems tbody tr:last").css("background-color", "aqua");
                    $('#tblItems tbody tr:last').effect("highlight", {}, 3000);
                }, 2000);
            }
        });
    }
    
    function updateArtillery(button) {
        var row = $(button).closest("tr");
        var item_id = row.find("td").eq(0).text();
        var name = row.find("td").eq(1).find("input").val();
        var order = row.find("td").eq(2).find('select :selected').val()
        var title = row.find("td").eq(3).find("input").val();
        var friendly_url = row.find("td").eq(4).find("input").val();
        var image = row.find("td").eq(5).find("input").val();
        var image_source = row.find("td").eq(6).find("input").val();
        var short_text = row.find("td").eq(7).find("input").val();
        var year = row.find("td").eq(8).find("input").val();
        var type = row.find("td").eq(9).find("input").val();
        var designer = row.find("td").eq(10).find("input").val();
        var numbers_produced = row.find("td").eq(11).find("input").val();
        var calibre = row.find("td").eq(12).find("input").val();
        var barrel_length = row.find("td").eq(13).find("input").val();
        var carriage = row.find("td").eq(14).find("input").val();
        var gun_shield = row.find("td").eq(15).find("input").val();
        var height = row.find("td").eq(16).find("input").val();
        var width = row.find("td").eq(17).find("input").val(); 
        var length = row.find("td").eq(18).find("input").val();      
        var gun_mounts = row.find("td").eq(19).find("input").val();       
        var trailers = row.find("td").eq(20).find("input").val();     
        var elevation = row.find("td").eq(21).find("input").val();
        var turret_traverse = row.find("td").eq(22).find("input").val();
        var breech = row.find("td").eq(23).find("input").val();
        var recoil = row.find("td").eq(24).find("input").val();
        var gun_sight = row.find("td").eq(25).find("input").val();
        var muzzle_velocity = row.find("td").eq(26).find("input").val();
        var feed = row.find("td").eq(27).find("input").val();
        var practical_rate_of_fire = row.find("td").eq(28).find("input").val();
        var armoured_plate = row.find("td").eq(29).find("input").val();
        var weight = row.find("td").eq(30).find("input").val();  
        var round_weight = row.find("td").eq(31).find("input").val();
        var magazine_capacity = row.find("td").eq(32).find("input").val();
        var maximum_ceiling = row.find("td").eq(33).find("input").val();     
        var maximum_range = row.find("td").eq(34).find("input").val();
        var maximum_ground_range = row.find("td").eq(35).find("input").val();
        var rate_of_fire = row.find("td").eq(36).find("input").val();
        var maximum_rate_of_fire = row.find("td").eq(37).find("input").val();
        var armour_penetration = row.find("td").eq(38).find("input").val();  
        var crew = row.find("td").eq(39).find("input").val();
        var traction = row.find("td").eq(40).find("input").val();
        var variants = row.find("td").eq(41).find("textarea").val();
        var notes = row.find("td").eq(42).find("textarea").val();
        
        $.ajax({
            type: "POST",
            url: "fetchdata.php",
            data: {action: 'updateArtillery', item_id: item_id, name: name, title: title, friendly_url: friendly_url, image: image, image_source: image_source, short_text: short_text, 
                year: year, type: type, designer: designer, numbers_produced: numbers_produced, calibre: calibre, barrel_length: barrel_length, carriage: carriage, gun_shield: gun_shield, height: height, 
                width: width, length: length, gun_mounts: gun_mounts, trailers: trailers, elevation: elevation, turret_traverse: turret_traverse, breech: breech, recoil: recoil, 
                gun_sight: gun_sight, muzzle_velocity: muzzle_velocity, feed: feed, practical_rate_of_fire: practical_rate_of_fire, armoured_plate: armoured_plate, weight: weight, round_weight: round_weight, 
                magazine_capacity: magazine_capacity, maximum_ceiling: maximum_ceiling, maximum_range: maximum_range, maximum_ground_range: maximum_ground_range, rate_of_fire: rate_of_fire, maximum_rate_of_fire: maximum_rate_of_fire,
                armour_penetration: armour_penetration, crew: crew, traction: traction, variants: variants, notes: notes, display_order: order},
            cache: false,
            beforeSend: function () {
                myApp.showPleaseWait();
            },
            success: function(html) {
                myApp.hidePleaseWait();
                alert('Item updated!');
            }
        });
    }
    
    function showSupportVehicles(obj) {
        $("table#tblNewItem > tbody:last").append('<tr><th>ID</th><th>Name</th><th>Display Order</th><th>Title</th><th>Friendly Url</th><th>Image</th><th>Image Source</th><th>Short Text</th><th>Year</th><th>Vehicle Type</th><th>Origin & Designer</th><th>Numbers Produced</th><th>Crew</th><th>Armament</th><th>Ammunition Carried</th><th>Pay Load</th>\n\
                                                  <th>Towed Load</th><th>Weight</th><th>Height</th><th>Width</th><th>Length</th><th>Ground Clearance</th><th>Fording Depth</th><th>Obstacle Clearance</th><th>Trench Crossing</th>\n\
                                                  <th>Climbing Ability</th><th>Cargo Capacity</th><th>Tow Capacity</th><th>Radio</th><th>Armour</th><th>Engine</th><th>Transmission</th><th>Maximum Road Range</th><th>Maximum Cross Country Range</th><th>Maximum Road Speed</th><th>Maximum Road Speed + Trailer</th>\n\
                                                  <th>Maximum Cross Country Speed</th><th>Maximum Road Towing Speed</th><th>Variants</th><th>Notes</th><th></th></tr>\n\
                                                  <tr><td></td><td><input type="text" /></td><td></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td>\n\
                                                  <td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td>\n\
                                                  <td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td>\n\
                                                  <td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" ></td><td><input type="text" ></td><td><input type="text" ></td><td><input type="text" ></td><td><input type="text" /></td><td><input type="text" /></td><td><textarea></textarea></td><td><textarea></textarea></td><td><button id="btSupportVehicleInsert" type="button" class="btn btn-success">Insert</button></td></tr>');
        var total_rows;
        var options = new Array();
        
        $.each(obj, function(key, value) {
            if(key == 0) {
                $("#subcategorydescription").val(value);
            }
            else if(key == 1) {
                total_rows = value;
            }
            else {        
                for(var i=1; i <= total_rows; i++)
                {
                    if(i == value.display_order) options.push('<option selected>' + i + '</option>');
                    else options.push('<option>' + i + '</option>');
                }
                $("table#tblItems > tbody:last").append('<tr><td>' + value.item_id + '</td><td><input type="text" value="' + value.name + '" /></td><td><select>' + options + '</select></td><td><input type="text" value="' + value.title + '" /></td><td><input type="text" value="' + value.friendly_url + '" /></td><td><input type="text" value="' + value.thumbnail_image + '" /></td><td><input type="text" value="' + value.image_source + '" /></td><td><input type="text" value="' + value.short_text + '" /></td><td><input type="text" value="' + value.year + '" /></td><td><input type="text" value="' + value.type + '" /></td><td><input type="text" value="' + value.designer + '" /></td><td><input type="text" value="' + value.numbers_produced + '" /></td><td><input type="text" value="' + value.crew + '" /></td>\n\
						  <td><input type="text" value="' + value.main_armament + '" /></td><td><input type="text" value="' + value.ammunition_carried + '" /></td><td><input type="text" value="' + value.pay_load + '" /></td><td><input type="text" value="' + value.towed_load + '" /></td><td><input type="text" value="' + value.weight + '" /></td><td><input type="text" value="' + value.height + '" /></td><td><input type="text" value="' + value.width + '" /></td><td><input type="text" value="' + value.length + '" /></td>\n\
						  <td><input type="text" value="' + value.ground_clearance + '" /></td><td><input type="text" value="' + value.fording_depth + '" /></td><td><input type="text" value="' + value.obstacle_clearance + '" /></td><td><input type="text" value="' + value.trench_crossing + '" /></td><td><input type="text" value="' + value.climbing_ability + '" /></td><td><input type="text" value="' + value.cargo_capacity + '" /></td><td><input type="text" value="' + value.tow_capacity + '" /></td><td><input type="text" value="' + value.radio + '" /></td><td><input type="text" value="' + value.armour + '" /></td><td><input type="text" value="' + value.engine + '" /></td><td><input type="text" value="' + value.transmission + '" /></td>\n\
                                                  <td><input type="text" value="' + value.maximum_road_range + '" /></td><td><input type="text" value="' + value.maximum_cross_country_range + '" /></td><td><input type="text" value="' + value.maximum_road_speed + '" /></td><td><input type="text" value="' + value.maximum_road_speed_trailer + '" /></td><td><input type="text" value="' + value.maximum_cross_country_speed + '" /></td><td><input type="text" value="' + value.maximum_road_towing_speed + '" /></td><td><textarea>' + value.variants + '</textarea></td><td><textarea>' + value.notes + '</textarea></td><td><button type="button" class="btn btn-success btSupportVehicleUpdate">Update</button></td><td><button type="button" class="btn btn-danger btDeleteItem">Delete</button></td></tr>');
                options = [];
            }
        });
        
        //Attach button clicks
        $(document).on('click', '#btSupportVehicleInsert', function(){ 
            insertSupportVehicle(this);
        });
        
        $(document).on('click', '.btSupportVehicleUpdate', function(){ 
            updateSupportVehicle(this);
        });
        
        $(document).on('click', '.btDeleteItem', function(){ 
            deleteItem(this);
        });
    }
    
    function insertSupportVehicle(button) {
        var sub_category_id = $("select#sub_categories option:selected").attr('value');
        var row = $(button).closest("tr");
        var name = row.find("td").eq(1).find("input").val();
        var title = row.find("td").eq(2).find("input").val();
        var friendly_url = row.find("td").eq(3).find("input").val();
        var image = row.find("td").eq(4).find("input").val();
        var image_source = row.find("td").eq(5).find("input").val();
        var short_text = row.find("td").eq(6).find("input").val();
        var year = row.find("td").eq(7).find("input").val();
        var type = row.find("td").eq(8).find("input").val();
        var designer = row.find("td").eq(9).find("input").val();
	var numbers_produced = row.find("td").eq(10).find("input").val();
        var crew = row.find("td").eq(11).find("input").val();
        var main_armament = row.find("td").eq(12).find("input").val();
        var ammunition_carried = row.find("td").eq(13).find("input").val();
        var pay_load = row.find("td").eq(14).find("input").val();  
	var towed_load = row.find("td").eq(15).find("input").val();  
        var weight = row.find("td").eq(16).find("input").val();
	var height = row.find("td").eq(17).find("input").val();
        var width = row.find("td").eq(18).find("input").val(); 
        var length = row.find("td").eq(19).find("input").val();              
        var ground_clearance = row.find("td").eq(20).find("input").val();     
        var fording_depth = row.find("td").eq(21).find("input").val();
        var obstacle_clearance = row.find("td").eq(22).find("input").val();
        var trench_crossing = row.find("td").eq(23).find("input").val();
        var climbing_ability = row.find("td").eq(24).find("input").val();
        var cargo_capacity = row.find("td").eq(25).find("input").val();
        var tow_capacity = row.find("td").eq(26).find("input").val();
        var radio = row.find("td").eq(27).find("input").val();
        var armour = row.find("td").eq(28).find("input").val();
        var engine = row.find("td").eq(29).find("input").val();
        var transmission = row.find("td").eq(30).find("input").val();
        var maximum_road_range = row.find("td").eq(31).find("input").val();
        var maximum_cross_country_range = row.find("td").eq(32).find("input").val();
        var maximum_road_speed = row.find("td").eq(33).find("input").val();  
        var maximum_road_speed_trailer = row.find("td").eq(34).find("input").val();
        var maximum_cross_country_speed = row.find("td").eq(35).find("input").val();
        var maximum_road_towing_speed = row.find("td").eq(36).find("input").val();
        var variants = row.find("td").eq(37).find("textarea").val();
        var notes = row.find("td").eq(38).find("textarea").val();

        $.ajax({
            type: "POST",
            url: "fetchdata.php",
            data: {action: 'insertSupportVehicle', sub_category_id: sub_category_id, name: name, title: title, friendly_url: friendly_url, image: image, image_source: image_source, short_text: short_text, 
                year: year, type: type, designer: designer, numbers_produced: numbers_produced, crew: crew, main_armament: main_armament, ammunition_carried: ammunition_carried, pay_load: pay_load, 
                towed_load: towed_load, weight: weight, height: height, width: width, length: length, ground_clearance: ground_clearance, fording_depth: fording_depth, obstacle_clearance: obstacle_clearance, 
		trench_crossing: trench_crossing, climbing_ability: climbing_ability, cargo_capacity: cargo_capacity, tow_capacity: tow_capacity, radio: radio, armour: armour, engine: engine, transmission: transmission, maximum_road_range: maximum_road_range, maximum_cross_country_range: maximum_cross_country_range,
                maximum_road_speed: maximum_road_speed, maximum_road_speed_trailer: maximum_road_speed_trailer, maximum_cross_country_speed: maximum_cross_country_speed, maximum_road_towing_speed: maximum_road_towing_speed, variants: variants, notes: notes},
            cache: false,
            beforeSend: function () {
                myApp.showPleaseWait();
            },
            success: function() {
                myApp.hidePleaseWait();
                var sub_category_id = $("select#sub_categories option:selected").attr('value');
                GetItems(sub_category_id);
                $('html, body').animate({scrollTop:$(document).height()}, 'slow');
                $('html, body').animate({scrollLeft:0}, 'slow');
                alert('Item added!');
                
                setTimeout(function() {
                    $("#tblItems tbody tr:last").css("background-color", "aqua");
                    $('#tblItems tbody tr:last').effect("highlight", {}, 3000);
                }, 2000);
            }
        });
    }
    
    function updateSupportVehicle(button) {
        var row = $(button).closest("tr");
        var item_id = row.find("td").eq(0).text();
        var name = row.find("td").eq(1).find("input").val();
        var order = row.find("td").eq(2).find('select :selected').val()
        var title = row.find("td").eq(3).find("input").val();
        var friendly_url = row.find("td").eq(4).find("input").val();
        var image = row.find("td").eq(5).find("input").val();
        var image_source = row.find("td").eq(6).find("input").val();
        var short_text = row.find("td").eq(7).find("input").val();
        var year = row.find("td").eq(8).find("input").val();
        var type = row.find("td").eq(9).find("input").val();
        var designer = row.find("td").eq(10).find("input").val();
	var numbers_produced = row.find("td").eq(11).find("input").val();
        var crew = row.find("td").eq(12).find("input").val();
        var main_armament = row.find("td").eq(13).find("input").val();
        var ammunition_carried = row.find("td").eq(14).find("input").val();
        var pay_load = row.find("td").eq(15).find("input").val();  
	var towed_load = row.find("td").eq(16).find("input").val();  
        var weight = row.find("td").eq(17).find("input").val();
	var height = row.find("td").eq(18).find("input").val();
        var width = row.find("td").eq(19).find("input").val(); 
        var length = row.find("td").eq(20).find("input").val();              
        var ground_clearance = row.find("td").eq(21).find("input").val();     
        var fording_depth = row.find("td").eq(22).find("input").val();
        var obstacle_clearance = row.find("td").eq(23).find("input").val();
        var trench_crossing = row.find("td").eq(24).find("input").val();
        var climbing_ability = row.find("td").eq(25).find("input").val();
        var cargo_capacity = row.find("td").eq(26).find("input").val();
        var tow_capacity = row.find("td").eq(27).find("input").val();
        var radio = row.find("td").eq(28).find("input").val();
        var armour = row.find("td").eq(29).find("input").val();
        var engine = row.find("td").eq(30).find("input").val();
        var transmission = row.find("td").eq(31).find("input").val();
        var maximum_road_range = row.find("td").eq(32).find("input").val();
        var maximum_cross_country_range = row.find("td").eq(33).find("input").val();
        var maximum_road_speed = row.find("td").eq(34).find("input").val();  
        var maximum_road_speed_trailer = row.find("td").eq(35).find("input").val();
        var maximum_cross_country_speed = row.find("td").eq(36).find("input").val();
        var maximum_road_towing_speed = row.find("td").eq(37).find("input").val();
        var variants = row.find("td").eq(38).find("textarea").val();
        var notes = row.find("td").eq(39).find("textarea").val();
		
	$.ajax({
            type: "POST",
            url: "fetchdata.php",
            data: {action: 'updateSupportVehicle', item_id: item_id, name: name, title: title, friendly_url: friendly_url, image: image, image_source: image_source, short_text: short_text, 
                year: year, type: type, designer: designer, numbers_produced: numbers_produced, crew: crew, main_armament: main_armament, ammunition_carried: ammunition_carried, pay_load: pay_load, 
                towed_load: towed_load, weight: weight, height: height, width: width, length: length, ground_clearance: ground_clearance, fording_depth: fording_depth, obstacle_clearance: obstacle_clearance,
		trench_crossing: trench_crossing, climbing_ability: climbing_ability, cargo_capacity: cargo_capacity, tow_capacity: tow_capacity, radio: radio, armour: armour, engine: engine, transmission: transmission, maximum_road_range: maximum_road_range, 
                maximum_cross_country_range: maximum_cross_country_range, maximum_road_speed: maximum_road_speed, maximum_road_speed_trailer: maximum_road_speed_trailer, maximum_cross_country_speed: maximum_cross_country_speed, 
                maximum_road_towing_speed: maximum_road_towing_speed, variants: variants, notes: notes, display_order: order},
            cache: false,
            beforeSend: function () {
                myApp.showPleaseWait();
            },
            success: function() {
                myApp.hidePleaseWait();
                alert('Item updated!');
            }
        });
    }
    
    function showInfantryWeapons(obj) {
        $("table#tblNewItem > tbody:last").append('<tr><th>ID</th><th>Name</th><th>Display Order</th><th>Title</th><th>Friendly Url</th><th>Image</th><th>Image Source</th><th>Short Text</th><th>Year</th><th>Weapon Type</th><th>Origin & Designer</th><th>Numbers Produced</th><th>Crew</th><th>Calibre</th><th>Elevation</th><th>Traverse</th><th>Cartridge Weight</th><th>Round Weight</th><th>Barrel Length</th>\n\
                                                  <th>Overall Length</th><th>Grenade Types</th><th>Mount</th><th>Combat Weight</th><th>Operation</th><th>Cooling System</th><th>Sights</th><th>Feed</th><th>Practical Rate of Fire</th><th>Maximum Rate of Fire</th><th>Blank Cartridge</th><th>Muzzle Velocity</th><th>Fuel Capacity</th>\n\
                                                  <th>Minimum Range</th><th>Effective Range</th><th>Maximum Range</th><th>Armour Penetration</th><th>Bayonet</th><th>Traction</th><th>Variants</th><th>Notes</th><th></th></tr>\n\
                                                  <tr><td></td><td><input type="text" /></td><td></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td>\n\
                                                  <td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td>\n\
                                                  <td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td>\n\
                                                  <td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><textarea></textarea></td><td><textarea></textarea></td><td><button id="btInfantryWeaponInsert" type="button" class="btn btn-success">Insert</button></td></tr>');
        var total_rows;
        var options = new Array();
        
        $.each(obj, function(key, value) {
            if(key == 0) {
                $("#subcategorydescription").val(value);
            }
            else if(key == 1) {
                total_rows = value;
            }
            else {        
                for(var i=1; i <= total_rows; i++)
                {
                    if(i == value.display_order) options.push('<option selected>' + i + '</option>');
                    else options.push('<option>' + i + '</option>');
                }
                $("table#tblItems > tbody:last").append('<tr><td>' + value.item_id + '</td><td><input type="text" value="' + value.name + '" /></td><td><select>' + options + '</select><td><input type="text" value="' + value.title + '" /></td><td><input type="text" value="' + value.friendly_url + '" /></td><td><input type="text" value="' + value.thumbnail_image + '" /></td><td><input type="text" value="' + value.image_source + '" /></td><td><input type="text" value="' + value.short_text + '" /></td><td><input type="text" value="' + value.year + '" /></td><td><input type="text" value="' + value.type + '" /></td><td><input type="text" value="' + value.designer + '" /></td><td><input type="text" value="' + value.numbers_produced + '" /></td>\n\
                                                  <td><input type="text" value="' + value.crew + '" /></td><td><input type="text" value="' + value.calibre + '" /></td><td><input type="text" value="' + value.elevation + '" /></td><td><input type="text" value="' + value.gun_traverse + '" /></td><td><input type="text" value="' + value.cartridge_weight + '" /></td><td><input type="text" value="' + value.round_weight + '" /></td><td><input type="text" value="' + value.barrel_length + '" /></td><td><input type="text" value="' + value.length + '" /></td><td><input type="text" value="' + value.grenade_types + '" /></td><td><input type="text" value="' + value.gun_mounts + '" /></td><td><input type="text" value="' + value.weight + '" /></td><td><input type="text" value="' + value.operation + '" /></td><td><input type="text" value="' + value.cooling_system + '" /></td><td><input type="text" value="' + value.sights + '" /></td>\n\
                                                  <td><input type="text" value="' + value.feed + '" /></td><td><input type="text" value="' + value.rate_of_fire + '" /></td><td><input type="text" value="' + value.maximum_rate_of_fire + '" /></td><td><input type="text" value="' + value.fuel_capacity + '" /></td><td><input type="text" value="' + value.muzzle_velocity + '" /></td><td><input type="text" value="' + value.blank_cartridge + '" /></td><td><input type="text" value="' + value.minimum_range + '" /></td><td><input type="text" value="' + value.effective_range + '" /></td><td><input type="text" value="' + value.maximum_range + '" /></td><td><input type="text" value="' + value.armour_penetration + '" /></td><td><input type="text" value="' + value.bayonet + '" /></td><td><input type="text" value="' + value.traction + '" /></td><td><textarea>' + value.variants + '</textarea></td><td><textarea>' + value.notes + '</textarea></td><td><button type="button" class="btn btn-success btInfantryWeaponUpdate">Update</button></td><td><button type="button" class="btn btn-danger btDeleteItem">Delete</button></td></tr>');
                options = [];
            }
        });
        
        //Attach button clicks
        $(document).on('click', '#btInfantryWeaponInsert', function(){ 
            insertInfantryWeapons(this);
        });
        
        $(document).on('click', '.btInfantryWeaponUpdate', function(){ 
            updateInfantryWeapons(this);
        });
        
        $(document).on('click', '.btDeleteItem', function(){ 
            deleteItem(this);
        });
    }
    
    function insertInfantryWeapons(button) {
        var sub_category_id = $("select#sub_categories option:selected").attr('value');
        var row = $(button).closest("tr");
        var name = row.find("td").eq(1).find("input").val();
        var title = row.find("td").eq(2).find("input").val();
        var friendly_url = row.find("td").eq(3).find("input").val();
        var image = row.find("td").eq(4).find("input").val();
        var image_source = row.find("td").eq(5).find("input").val();
        var short_text = row.find("td").eq(6).find("input").val();
        var year = row.find("td").eq(7).find("input").val();
        var type = row.find("td").eq(8).find("input").val();
        var designer = row.find("td").eq(9).find("input").val();
	var numbers_produced = row.find("td").eq(10).find("input").val();
        var crew = row.find("td").eq(11).find("input").val();
        var calibre = row.find("td").eq(12).find("input").val();
        var elevation = row.find("td").eq(13).find("input").val();
        var gun_traverse = row.find("td").eq(14).find("input").val();
        var cartridge_weight = row.find("td").eq(15).find("input").val();
        var round_weight = row.find("td").eq(16).find("input").val();
        var barrel_length = row.find("td").eq(17).find("input").val();
	var length = row.find("td").eq(18).find("input").val();
        var grenade_types = row.find("td").eq(19).find("input").val();
        var gun_mounts = row.find("td").eq(20).find("input").val();
        var weight = row.find("td").eq(21).find("input").val();
	var operation = row.find("td").eq(22).find("input").val();
        var cooling_system = row.find("td").eq(23).find("input").val();
        var sights = row.find("td").eq(24).find("input").val(); 
        var feed = row.find("td").eq(25).find("input").val();   
        var rate_of_fire = row.find("td").eq(26).find("input").val();
        var max_rate_of_fire = row.find("td").eq(27).find("input").val();
        var blank_cartridge = row.find("td").eq(28).find("input").val();
        var muzzle_velocity = row.find("td").eq(29).find("input").val();
        var fuel_capacity = row.find("td").eq(30).find("input").val();
        var minimum_range = row.find("td").eq(31).find("input").val();
        var effective_range = row.find("td").eq(32).find("input").val();
        var maximum_range = row.find("td").eq(33).find("input").val();
        var armour_penetration = row.find("td").eq(34).find("input").val();
        var bayonet = row.find("td").eq(35).find("input").val();
        var traction = row.find("td").eq(36).find("input").val();
        var variants = row.find("td").eq(37).find("textarea").val();
        var notes = row.find("td").eq(38).find("textarea").val();

        $.ajax({
            type: "POST",
            url: "fetchdata.php",
            data: {action: 'insertInfantryWeapon', sub_category_id: sub_category_id, name: name, title: title, friendly_url: friendly_url, image: image, image_source: image_source, short_text: short_text, 
                year: year, type: type, designer: designer, numbers_produced: numbers_produced, crew: crew, calibre: calibre, elevation: elevation, gun_traverse: gun_traverse, cartridge_weight: cartridge_weight, round_weight: round_weight, barrel_length: barrel_length, 
                length: length, grenade_types: grenade_types, gun_mounts: gun_mounts, weight: weight, operation: operation, cooling_system: cooling_system, sights: sights, feed: feed, rate_of_fire: rate_of_fire, maximum_rate_of_fire: max_rate_of_fire, blank_cartridge: blank_cartridge, muzzle_velocity: muzzle_velocity, 
		fuel_capacity: fuel_capacity, minimum_range: minimum_range, effective_range: effective_range, maximum_range: maximum_range, armour_penetration: armour_penetration, bayonet: bayonet, traction: traction, variants: variants, notes: notes},
            cache: false,
            beforeSend: function () {
                myApp.showPleaseWait();
            },
            success: function() {
                myApp.hidePleaseWait();
                var sub_category_id = $("select#sub_categories option:selected").attr('value');
                GetItems(sub_category_id);
                $('html, body').animate({scrollTop:$(document).height()}, 'slow');
                $('html, body').animate({scrollLeft:0}, 'slow');
                alert('Item added!');
                
                setTimeout(function() {
                    $("#tblItems tbody tr:last").css("background-color", "aqua");
                    $('#tblItems tbody tr:last').effect("highlight", {}, 3000);
                }, 2000);
            }
        });
    }
    
    function updateInfantryWeapons(button) {
        var row = $(button).closest("tr");
        var item_id = row.find("td").eq(0).text();
        var name = row.find("td").eq(1).find("input").val();
        var order = row.find("td").eq(2).find('select :selected').val()
        var title = row.find("td").eq(3).find("input").val();
        var friendly_url = row.find("td").eq(4).find("input").val();
        var image = row.find("td").eq(5).find("input").val();
        var image_source = row.find("td").eq(6).find("input").val();
        var short_text = row.find("td").eq(7).find("input").val();
        var year = row.find("td").eq(8).find("input").val();
        var type = row.find("td").eq(9).find("input").val();
        var designer = row.find("td").eq(10).find("input").val();
	var numbers_produced = row.find("td").eq(11).find("input").val();
        var crew = row.find("td").eq(12).find("input").val();
        var calibre = row.find("td").eq(13).find("input").val();
        var elevation = row.find("td").eq(14).find("input").val();
        var gun_traverse = row.find("td").eq(15).find("input").val();
        var cartridge_weight = row.find("td").eq(16).find("input").val();
        var round_weight = row.find("td").eq(17).find("input").val();
        var barrel_length = row.find("td").eq(18).find("input").val();
	var length = row.find("td").eq(19).find("input").val();
        var grenade_types = row.find("td").eq(20).find("input").val();
        var gun_mounts = row.find("td").eq(21).find("input").val();
        var weight = row.find("td").eq(22).find("input").val();
	var operation = row.find("td").eq(23).find("input").val();
        var cooling_system = row.find("td").eq(24).find("input").val();
        var sights = row.find("td").eq(25).find("input").val(); 
        var feed = row.find("td").eq(26).find("input").val();   
        var rate_of_fire = row.find("td").eq(27).find("input").val();
        var max_rate_of_fire = row.find("td").eq(28).find("input").val();
        var blank_cartridge = row.find("td").eq(29).find("input").val();
        var muzzle_velocity = row.find("td").eq(30).find("input").val();
        var fuel_capacity = row.find("td").eq(31).find("input").val();
        var minimum_range = row.find("td").eq(32).find("input").val();
        var effective_range = row.find("td").eq(33).find("input").val();
        var maximum_range = row.find("td").eq(34).find("input").val();
        var armour_penetration = row.find("td").eq(35).find("input").val();
        var bayonet = row.find("td").eq(36).find("input").val();
        var traction = row.find("td").eq(37).find("input").val();
        var variants = row.find("td").eq(38).find("textarea").val();
        var notes = row.find("td").eq(39).find("textarea").val();

        $.ajax({
            type: "POST",
            url: "fetchdata.php",
            data: {action: 'updateInfantryWeapon', item_id: item_id, name: name, title: title, friendly_url: friendly_url, image: image, image_source: image_source, short_text: short_text, 
                year: year, type: type, designer: designer, numbers_produced: numbers_produced, crew: crew, calibre: calibre, elevation: elevation, gun_traverse: gun_traverse, cartridge_weight: cartridge_weight, round_weight: round_weight, barrel_length: barrel_length, 
                length: length, grenade_types: grenade_types, gun_mounts: gun_mounts, weight: weight, operation: operation, cooling_system: cooling_system, sights: sights, feed: feed, rate_of_fire: rate_of_fire, maximum_rate_of_fire: max_rate_of_fire, 
                blank_cartridge: blank_cartridge, muzzle_velocity: muzzle_velocity, fuel_capacity: fuel_capacity, minimum_range: minimum_range, effective_range: effective_range, maximum_range: maximum_range, armour_penetration: armour_penetration, bayonet: bayonet, traction: traction, variants: variants, notes: notes, display_order: order},
            cache: false,
            beforeSend: function () {
                myApp.showPleaseWait();
            },
            success: function() {
                myApp.hidePleaseWait();
                alert('Item updated!');
            }
        });
    }
    
    function showDivisions(obj) {
        $("table#tblNewItem > tbody:last").append('<tr><th>ID</th><th>Name</th><th>Display Order</th><th>Title</th><th>Friendly Url</th><th>Image</th><th>Image Source</th><th>Short Text</th><th>Content</th><th></th></tr>\n\
                                                  <tr><td></td><td><input type="text" /></td><td></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><textarea></textarea></td><td><button id="btDivisionInsert" type="button" class="btn btn-success">Insert</button></td></tr>');
        
        var total_rows;
        var options = new Array();
        
        $.each(obj, function(key, value) {
            if(key == 0) {
                $("#subcategorydescription").val(value);
            }
            else if(key == 1) {
                total_rows = value;
            }
            else {
                for(var i=1; i <= total_rows; i++)
                {
                    if(i == value.display_order) options.push('<option selected>' + i + '</option>');
                    else options.push('<option>' + i + '</option>');
                }
                $("table#tblItems > tbody:last").append('<tr><td>' + value.item_id + '</td><td><input type="text" value="' + value.name + '" /></td><td><select>' + options + '</select></td><td><input type="text" value="' + value.title + '" /></td><td><input type="text" value="' + value.friendly_url + '" /></td><td><input type="text" value="' + value.thumbnail_image + '" /></td><td><input type="text" value="' + value.image_source + '" /></td><td><input type="text" value="' + value.short_text + '" /></td><td><textarea>' + value.content + '</textarea></td><td><button type="button" class="btn btn-success btDivisionUpdate">Update</button></td><td><button type="button" class="btn btn-danger btDeleteItem">Delete</button></td></tr>');
                options = [];
            }
        });
        
        //Attach button clicks
        $(document).on('click', '#btDivisionInsert', function(){ 
            insertDivision(this);
        });
        
        $(document).on('click', '.btDivisionUpdate', function(){ 
            updateDivision(this);
        });
        
        $(document).on('click', '.btDeleteItem', function(){ 
            deleteItem(this);
        });
    }
    
    function insertDivision(button) {
        var sub_category_id = $("select#sub_categories option:selected").attr('value');
        var row = $(button).closest("tr");
        var name = row.find("td").eq(1).find("input").val();
        var title = row.find("td").eq(2).find("input").val();
        var friendly_url = row.find("td").eq(3).find("input").val();
        var image = row.find("td").eq(4).find("input").val();
        var image_source = row.find("td").eq(5).find("input").val();
        var short_text = row.find("td").eq(6).find("input").val();
        var content = row.find("td").eq(7).find("textarea").val();

        $.ajax({
            type: "POST",
            url: "fetchdata.php",
            data: {action: 'insertDivision', sub_category_id: sub_category_id, name: name, title: title, friendly_url: friendly_url, image: image, image_source: image_source, short_text: short_text, 
                content: content},
            cache: false,
            beforeSend: function () {
                myApp.showPleaseWait();
            },
            success: function() {
                myApp.hidePleaseWait();
                var sub_category_id = $("select#sub_categories option:selected").attr('value');
                GetItems(sub_category_id);
                $('html, body').animate({scrollTop:$(document).height()}, 'slow');
                $('html, body').animate({scrollLeft:0}, 'slow');
                alert('Item added!');
                
                setTimeout(function() {
                    $("#tblItems tbody tr:last").css("background-color", "aqua");
                    $('#tblItems tbody tr:last').effect("highlight", {}, 3000);
                }, 2000);
            }
        });
    }
    
    function updateDivision(button) {
        var row = $(button).closest("tr");
        var item_id = row.find("td").eq(0).text();
        var name = row.find("td").eq(1).find("input").val();
        var order = row.find("td").eq(2).find('select :selected').val()
        var title = row.find("td").eq(3).find("input").val();
        var friendly_url = row.find("td").eq(4).find("input").val();
        var image = row.find("td").eq(5).find("input").val();
        var image_source = row.find("td").eq(6).find("input").val();
        var short_text = row.find("td").eq(7).find("input").val();
        var content = row.find("td").eq(8).find("textarea").val();
 
        $.ajax({
            type: "POST",
            url: "fetchdata.php",
            data: {action: 'updateDivision', item_id: item_id, name: name, title: title, friendly_url: friendly_url, image: image, image_source: image_source, short_text: short_text, 
                content: content, display_order: order},
            cache: false,
            beforeSend: function () {
                myApp.showPleaseWait();
            },
            success: function() {
                myApp.hidePleaseWait();
                alert('Item updated!');
            }
        });
    }
    
    function showCompanies(obj) {
        $("table#tblNewItem > tbody:last").append('<tr><th>ID</th><th>Name</th><th>Display Order</th><th>Title</th><th>Friendly Url</th><th>Image</th><th>Image Source</th><th>Short Text</th><th>Content</th><th></th></tr>\n\
                                                  <tr><td></td><td><input type="text" /></td><td></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><input type="text" /></td><td><textarea></textarea></td><td><button id="btCompanyInsert" type="button" class="btn btn-success">Insert</button></td></tr>');
        var total_rows;
        var options = new Array();
        
        $.each(obj, function(key, value) {
            if(key == 0) {
                $("#subcategorydescription").val(value);
            }
            else if(key == 1) {
                total_rows = value;
            }
            else {        
                for(var i=1; i <= total_rows; i++)
                {
                    if(i == value.display_order) options.push('<option selected>' + i + '</option>');
                    else options.push('<option>' + i + '</option>');
                }
                $("table#tblItems > tbody:last").append('<tr><td>' + value.item_id + '</td><td><input type="text" value="' + value.name + '" /></td><td><select>' + options + '</select></td><td><input type="text" value="' + value.title + '" /></td><td><input type="text" value="' + value.friendly_url + '" /></td><td><input type="text" value="' + value.thumbnail_image + '" /></td><td><input type="text" value="' + value.image_source + '" /></td><td><input type="text" value="' + value.short_text + '" /></td><td><textarea>' + value.content + '</textarea></td><td><button type="button" class="btn btn-success btCompanyUpdate">Update</button></td><td><button type="button" class="btn btn-danger btDeleteItem">Delete</button></td></tr>');
                options = [];
            }
        });
        
        //Attach button clicks
        $(document).on('click', '#btCompanyInsert', function(){ 
            insertCompany(this);
        });
        
        $(document).on('click', '.btCompanyUpdate', function(){ 
            updateCompany(this);
        });
        
        $(document).on('click', '.btDeleteItem', function(){ 
            deleteItem(this);
        });
    }
    
    function insertCompany(button) {
        var sub_category_id = $("select#sub_categories option:selected").attr('value');
        var row = $(button).closest("tr");
        var name = row.find("td").eq(1).find("input").val();
        var title = row.find("td").eq(2).find("input").val();
        var friendly_url = row.find("td").eq(3).find("input").val();
        var image = row.find("td").eq(4).find("input").val();
        var image_source = row.find("td").eq(5).find("input").val();
        var short_text = row.find("td").eq(6).find("input").val();
        var content = row.find("td").eq(7).find("textarea").val();

        $.ajax({
            type: "POST",
            url: "fetchdata.php",
            data: {action: 'insertCompany', sub_category_id: sub_category_id, name: name, title: title, friendly_url: friendly_url, image: image, image_source: image_source, short_text: short_text, 
                content: content},
            cache: false,
            beforeSend: function () {
                myApp.showPleaseWait();
            },
            success: function() {
                myApp.hidePleaseWait();
                var sub_category_id = $("select#sub_categories option:selected").attr('value');
                GetItems(sub_category_id);
                $('html, body').animate({scrollTop:$(document).height()}, 'slow');
                $('html, body').animate({scrollLeft:0}, 'slow');
                alert('Item added!');
                
                setTimeout(function() {
                    $("#tblItems tbody tr:last").css("background-color", "aqua");
                    $('#tblItems tbody tr:last').effect("highlight", {}, 3000);
                }, 2000);
            }
        });
    }
    
    function updateCompany(button) {
        var row = $(button).closest("tr");
        var item_id = row.find("td").eq(0).text();
        var name = row.find("td").eq(1).find("input").val();
        var order = row.find("td").eq(2).find('select :selected').val()
        var title = row.find("td").eq(3).find("input").val();
        var friendly_url = row.find("td").eq(4).find("input").val();
        var image = row.find("td").eq(5).find("input").val();
        var image_source = row.find("td").eq(6).find("input").val();
        var short_text = row.find("td").eq(7).find("input").val();
        var content = row.find("td").eq(8).find("textarea").val();

        $.ajax({
            type: "POST",
            url: "fetchdata.php",
            data: {action: 'updateCompany', item_id: item_id, name: name, title: title, friendly_url: friendly_url, image: image, image_source: image_source, short_text: short_text, 
                content: content, display_order: order},
            cache: false,
            beforeSend: function () {
                myApp.showPleaseWait();
            },
            success: function() {
                myApp.hidePleaseWait();
                alert('Item updated!');
            }
        });
    }
    
    function deleteItem(button) {
        var check = confirm("Are you sure you want to delete this item?");
        if(check) {
            var row = $(button).closest("tr");
            var item_id = row.find("td").eq(0).text();
            
            $.ajax({
                type: "POST",
                url: "fetchdata.php",
                data: {action: 'deleteItem', item_id: item_id},
                cache: false,
                beforeSend: function () {
                    myApp.showPleaseWait();
                },
                success: function(html) {
                    $(row).hide();
                    myApp.hidePleaseWait();
                    alert('Item deleted!');
                }
            });
        }
    }
});
</script>
</form>
</body>
</html>