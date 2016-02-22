<?php

require "page.inc";

$homepage = new Page();

$homepage->metadescription = '';

$homepage->content = '<section id="about-us">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12"> 
                                    <h2>About Quartermaster Section</h2>
                                    <p>
                                    </p>
                                </div><!--/.col-md-12-->    
                            </div><!--/.row-->
                        </div><!--/.container-->
                    </section><!--/about-us-->';

$homepage->title = 'About - ' . $homepage->title;

$homepage->canonical = '<link rel="canonical" href="http://' . $_SERVER["HTTP_HOST"] . parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH) . '" />';

$homepage->Display();