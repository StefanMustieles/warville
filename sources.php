<?php

require "page.inc";

$homepage = new Page();

$homepage->metadescription = '';

$homepage->content = '<section id="about-us">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12"> 
                                    <h1>Sources</h1>
                                    <p>
                                        As well as people, the Quartermaster Sections data and information was helped populated by a number of historical books, 
                                        websites and companies. Therefore we would like to give them an honourable mention below, as without them the 
                                        <a href="http://quartermastersection.com">Quartermaster Section</a> would not be possible.
                                    </p>
                                </div><!--/.col-md-12-->    
                            </div><!--/.row-->
                        </div><!--/.container-->
                    </section><!--/about-us-->';

$homepage->title = 'Sources - ' . $homepage->title;

$homepage->canonical = '<link rel="canonical" href="http://' . $_SERVER["HTTP_HOST"] . parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH) . '" />';

$homepage->Display();