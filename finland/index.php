<?php

require $_SERVER['DOCUMENT_ROOT'] . '/page.inc';

$homepage = new Page();

$homepage->content = '<section id="content">
                        <div class="container">
                            <div class="row">
                                <ul class="breadcrumb">
                                    <li><a href="../">Home</a></li>
                                    <li class="active">Finland</li>
                                </ul>
                            </div><!--/.row-->
                        </div><!--/.container-->
                        <div class="container">
                            <div class="row">
                                <h1>Finland Military Force</h1>
                            </div><!--/.row-->
                        </div><!--/.container-->
                        <div class="container">
                            <div class="row">
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed a turpis ac ex ornare consequat ac ac ligula. Phasellus sapien metus, 
                                    luctus et efficitur vel, pretium sit amet nisi. Nullam sed varius nibh. Nunc vehicula neque sit amet urna dapibus tincidunt. 
                                    Maecenas a fringilla urna. Quisque scelerisque purus nec blandit finibus. Duis in risus vel diam mollis euismod nec nec est.
                                    Cras at accumsan ante, nec viverra tellus. Phasellus eget malesuada mi. Vivamus eu bibendum augue, quis tempus metus. Ut malesuada 
                                    enim a vehicula tempor. Aenean ac libero purus. Nulla interdum enim non erat condimentum imperdiet. Aenean mattis imperdiet leo ac 
                                    finibus. Duis quis mi a est fringilla suscipit non id elit. Morbi purus ante, varius id ante in, fringilla semper est. Morbi eu feugiat 
                                    tellus, eget elementum tellus. Nullam iaculis risus vel nibh bibendum tempus. Maecenas cursus lacinia nibh id congue.
                                </p>
                            </div><!--/.row-->
                        </div><!--/.container-->
                        </section><!--/#content-->

                        <section id="content">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-6">
                                    <a href="infantry-weapons/"><button type="button" class="btn btn-danger btn-block fillArea">Infantry Weapons</button></a>
                                </div>
                                <div class="col-sm-6">
                                    <a href="afvs/"><button type="button" class="btn btn-danger btn-block fillArea">AFVs</button></a>
                                </div>
                            </div><!--/.row-->
                        </div><!--/.container-->
                        </section><!--/#content-->

                        <section id="content">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-6">
                                    <a href="artillery/"><button type="button" class="btn btn-danger btn-block fillArea">Artillery</button></a>
                                </div>
                                <div class="col-sm-6">
                                    <a href="companies/"><button type="button" class="btn btn-danger btn-block fillArea">Companies</button></a>
                                </div>
                            </div><!--/.row-->
                        </div><!--/.container-->
                        </section><!--/#content-->';

$homepage->title = $homepage->title . ' - Finland';

$homepage->Display();