<?php

require "page.inc";

$homepage = new Page();

$homepage->content = '<section id="about-us">
                            <div class="container">
                                            <div class="center">
                                                    <h2>Contributors</h2>
                                                    <p class="lead">
                                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sed faucibus ante. Ut sed massa nisi. Interdum et malesuada fames ac ante ipsum primis in faucibus. Vivamus rutrum vel sapien pellentesque blandit. Donec cursus dictum luctus. Praesent sit amet tellus condimentum, interdum nulla quis, aliquam quam. Sed pulvinar varius nibh. Proin cursus vitae ipsum eget imperdiet. Mauris diam leo, mattis at vulputate et, consequat nec sem. Integer maximus massa est.

                                                            Phasellus tristique ex nec luctus finibus. Sed lectus metus, commodo eleifend efficitur eget, tristique sed tellus. Donec nisl justo, maximus sed ultrices ut, lacinia vitae neque. In ultrices turpis vitae finibus commodo. Cras auctor nunc leo, at rhoncus sem volutpat sed. Donec condimentum porta fringilla. Sed in ex sit amet elit mattis molestie quis at elit. Ut tellus diam, aliquam quis velit id, pretium pretium massa. Morbi eget quam quis est rutrum gravida. Aenean libero leo, hendrerit et porttitor semper, egestas volutpat lectus.

                                                            Sed porttitor aliquam nunc, eget venenatis felis sollicitudin a. Vivamus mattis nisl sit amet porta eleifend. Nulla in urna volutpat sapien rhoncus tincidunt a vitae nunc. Aliquam eu condimentum eros. Quisque maximus elementum ante, non pellentesque ex vulputate id. Phasellus massa dui, convallis non erat quis, ultrices hendrerit felis. Ut rutrum nisl nunc, id fringilla nulla ornare porta. Fusce sagittis et nisi et ullamcorper. Phasellus viverra lorem sit amet varius lobortis. Sed egestas sem nec placerat ultricies.

                                                            Curabitur arcu urna, suscipit faucibus dapibus eget, sagittis id ipsum. Aliquam quis cursus turpis. Sed justo dui, rutrum quis tempus non, maximus eu augue. Nullam vestibulum ex nibh, a placerat ante tincidunt et. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nulla a nisi dapibus, vehicula quam et, condimentum sapien. Maecenas tincidunt justo arcu, eget eleifend risus laoreet eget. Cras dictum, magna aliquam vulputate convallis, augue dui vestibulum purus, id lacinia purus nisi sagittis dui. Praesent enim neque, lobortis eget rhoncus volutpat, ullamcorper vel magna. Vestibulum vitae nunc vitae ante commodo accumsan. Suspendisse potenti. Etiam suscipit ut tellus ultricies egestas. Duis commodo quis augue ut facilisis. Duis quis augue at erat blandit scelerisque ut eu leo.

                                                            Quisque et vulputate libero. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus metus urna, semper in sollicitudin ut, placerat dictum odio. Aenean viverra suscipit mauris, vel fringilla massa bibendum sed. Vivamus lectus nisi, tincidunt at fringilla ac, maximus a est. Aliquam id iaculis orci. Nam sagittis aliquam dolor, ac viverra enim euismod in. Mauris sed facilisis lectus, in pulvinar augue.
                                                    </p>
                                            </div>
                                    </div><!--/.container-->
                        </section><!--/about-us-->';

$homepage->title = 'Contributors - ' . $homepage->title;

$homepage->canonical = '<link rel="canonical" href="http://' . $_SERVER["HTTP_HOST"] . parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH) . '" />';

$homepage->Display();