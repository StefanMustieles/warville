<?php

require "page.inc";

$homepage = new Page();

$homepage->content = '<section id="error" class="container text-center">
                        <h1>404, Page not found</h1>
                        <p>The Page you are looking for doesn\'t exist or an other error occurred.</p>
                        <a class="btn btn-primary" href="/index.php">GO BACK TO THE HOMEPAGE</a>
                    </section><!--/#error-->';

$homepage->title = 'Page Not Found - ' . $homepage->title;

$homepage->canonical = '<link rel="canonical" href="http://' . $_SERVER["HTTP_HOST"] . parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH) . '" />';

$homepage->Display();