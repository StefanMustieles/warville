<?php

require "page.inc";

$homepage = new Page();

$homepage->metadescription = '';

$homepage->content = '<section id="about-us">
                        <div class="container">
                            <div class="center">
                                <h2>About Quartermaster Section</h2>
                                <p class="lead">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sed faucibus ante. Ut sed massa nisi. Interdum et malesuada fames ac ante ipsum primis in faucibus. Vivamus rutrum vel sapien pellentesque blandit. Donec cursus dictum luctus. Praesent sit amet tellus condimentum, interdum nulla quis, aliquam quam. Sed pulvinar varius nibh. Proin cursus vitae ipsum eget imperdiet. Mauris diam leo, mattis at vulputate et, consequat nec sem. Integer maximus massa est.
                                </p>
                            </div>
                        </div><!--/.container-->
                    </section><!--/about-us-->';

$homepage->title = 'About - ' . $homepage->title;

$homepage->canonical = '<link rel="canonical" href="http://' . $_SERVER["HTTP_HOST"] . parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH) . '" />';

$homepage->Display();