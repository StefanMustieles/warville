<?php

require "page.inc";

$homepage = new Page();

$homepage->metadescription = '';

$homepage->content = '<section id="content">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <h1>Welcome to the Quartermaster Section</h1>
                                </div>
                            </div><!--/.row-->
                        </div><!--/.container-->
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed a turpis ac ex ornare consequat ac ac ligula. Phasellus sapien metus, 
                                        luctus et efficitur vel, pretium sit amet nisi. Nullam sed varius nibh. Nunc vehicula neque sit amet urna dapibus tincidunt. 
                                        Maecenas a fringilla urna. Quisque scelerisque purus nec blandit finibus. Duis in risus vel diam mollis euismod nec nec est.
                                        Cras at accumsan ante, nec viverra tellus. Phasellus eget malesuada mi. Vivamus eu bibendum augue, quis tempus metus. Ut malesuada 
                                        enim a vehicula tempor. Aenean ac libero purus. Nulla interdum enim non erat condimentum imperdiet. Aenean mattis imperdiet leo ac 
                                        finibus. Duis quis mi a est fringilla suscipit non id elit. Morbi purus ante, varius id ante in, fringilla semper est. Morbi eu feugiat 
                                        tellus, eget elementum tellus. Nullam iaculis risus vel nibh bibendum tempus. Maecenas cursus lacinia nibh id congue.
                                    </p>
                                </div>
                            </div><!--/.row-->
                        </div><!--/.container-->
                </section><!--/#content-->

                <section id="content">
                        <div class="container">
                                <div class="row">
                                        <div class="col-sm-6">
                                                Image
                                        </div>
                                        <div class="col-sm-6">
                                                Carousel
                                        </div>
                                </div><!--/.row-->
                        </div><!--/.container-->
                </section><!--/#content-->

                <section id="content">
                        <div class="container">
                                <div class="row">
                                        <div class="col-sm-6">
                                                <p>
                                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed a turpis ac ex ornare consequat ac ac ligula. Phasellus sapien metus, 
                                                        luctus et efficitur vel, pretium sit amet nisi. Nullam sed varius nibh. Nunc vehicula neque sit amet urna dapibus tincidunt. 
                                                        Maecenas a fringilla urna. Quisque scelerisque purus nec blandit finibus. Duis in risus vel diam mollis euismod nec nec est.
                                                        Cras at accumsan ante, nec viverra tellus. Phasellus eget malesuada mi. Vivamus eu bibendum augue, quis tempus metus. Ut malesuada 
                                                        enim a vehicula tempor. Aenean ac libero purus. Nulla interdum enim non erat condimentum imperdiet. Aenean mattis imperdiet leo ac 
                                                        finibus. Duis quis mi a est fringilla suscipit non id elit. Morbi purus ante, varius id ante in, fringilla semper est. Morbi eu feugiat 
                                                        tellus, eget elementum tellus. Nullam iaculis risus vel nibh bibendum tempus. Maecenas cursus lacinia nibh id congue.
                                                </p>
                                        </div>
                                        <div class="col-sm-6">
                                                Image
                                        </div>
                                </div><!--/.row-->
                        </div><!--/.container-->
                </section><!--/#content-->';

$homepage->canonical = '<link rel="canonical" href="http://' . $_SERVER["HTTP_HOST"] . parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH) . '" />';

$homepage->Display();