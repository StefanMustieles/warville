<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin Area</title>

<link href="/assets/css/bootstrap.min.css" rel="stylesheet">
<link href="/assets/css/jquery-ui.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/css/jtable.min.css" rel="stylesheet" type="text/css" />

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>                         
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
            <h3><i class="glyphicon glyphicon-briefcase"></i> SEO Admin</h3>

            <div class="table-responsive">
                <table class="table">
                <tr>
                    <td><label for="tables">Tables</label></td>
                    <td><select id="tables" name="country">
                        <option value="">--- Select ---</option>
                        <option value="1">Countries</option>
                        <option value="2">Categories</option>
                        <option value="3">Sub Categories</option>
                        <option value="4">Items</option>
                    </select>
                    </td>
                </tr>
                </table>
            </div>
            <div id="DataTable">
            </div>
        </div>
    </div><!--/row-->
</div><!--/container-->
<script src="/assets/js/jquery.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/jquery-ui.min.js"></script>
<script src="/assets/js/jquery.jtable.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        
        $("select#tables").change(function(){

            var table = $("select#tables option:selected").attr('value');

            if (table.length > 0 ) {
                switch (table)
                {
                    case "1":
                        $("#DataTable").jtable({
                            title: "Countries",
                            actions: {
                                listAction: "seoData.php?action=listCountries",
                                updateAction: "seoData.php?action=updateCountries"
                            },
                            fields: {
                                country_id: {
                                    key: true,
                                    list: false
                                },
                                name: {
                                    title: "Country Name",
                                    edit: false
                                },
                                meta_description: {
                                    title: "Description Meta Tag"
                                }
                            }
                        }).jtable("load");
                        break;
                    case 2:
                        break;
                    case 3:
                        break;
                }
            }
        });
    });
</script>
</body>
</html>