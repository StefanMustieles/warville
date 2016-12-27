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
                                    <p>Therefore, the team at <a href="https://quartermastersection.com">Quartermaster Section</a> want to wish a heartfelt thank you to the following comrades.</p>
                                    <div id="contributorsList">
                                        <ol>
                                           <li><p><em>Andrew Mollo</em></p></li>
                                           <li><p><em>Bruce Quarrie</em></p></li>
                                           <li><p><em>Chris Ellis</em></p></li>
                                           <li><p><em>Christopher Chant</em></p></li>
                                           <li><p><em>Donald Featherstone</em></p></li>
                                           <li><p><em>George Forty</em></p></li>
                                           <li><p><em>George Nafziger</em></p></li>
                                           <li><p><em>Hilary Doyle</em></p></li>
                                           <li><p><em>Ian V. Hogg</em></p></li>
                                           <li><p><em>Martin Windrow</em></p></li>
                                           <li><p><em>Peter Chamberlain</em></p></li>
                                           <li><p><em>Steve Zaloga</em></p></li>
                                           <li><p><em>Terry Gander</em></p></li>
                                        </ol>
                                    </div>
                                </div><!--/.col-md-12-->
                            </div><!--/.row-->
                        </div><!--/.container-->
                    </section><!--/about-us-->';

$homepage->title = 'Contributors - ' . $homepage->title;

$homepage->canonical = '<link rel="canonical" href="https://' . $_SERVER["HTTP_HOST"] . parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH) . '" />';

$homepage->Display();