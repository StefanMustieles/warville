<?php

require "page.inc";

$homepage = new Page();

$homepage->metadescription = '';

$homepage->content = '<section id="about-us">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12"> 
                                    <h1>Contributors</h1>
                                    <p>As you can see throughout this site, the information, data and images have taken years to collate and this could not have been done without the help of some very important people.</p>
                                    <p>Therefore, the team at <a href="http://quartermastersection.com">Quartermaster Section</a> want to wish a heartfelt thank you to the following comrades.</p>
                                </div><!--/.col-md-12-->
                            </div><!--/.row-->
                        </div><!--/.container-->
                    </section><!--/about-us-->';

$homepage->title = 'Contributors - ' . $homepage->title;

$homepage->canonical = '<link rel="canonical" href="http://' . $_SERVER["HTTP_HOST"] . parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH) . '" />';

$homepage->Display();