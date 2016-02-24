<?php

require "page.inc";

$homepage = new Page();

$homepage->metadescription = '';

$homepage->content = '<section id="about-us">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12"> 
                                    <h1>About Quartermaster Section</h1>
                                    <p>
                                        I have developed this web site in an aim to provide data and information for military enthusiasts, 
                                        war gamers and researchers. I have been interested in military history since the late 1960s and was 
                                        once an avid war gamer. On this site you will find data that spans the decades from 1920 to 1950. 
                                        This was the period when armoured vehicles, anti-tank guns and anti-aircraft guns began to be introduced 
                                        in large numbers with many different calibres and types being changed and up-graded as the years went by. 
                                        This development saw tanks go from tiny two man vehicles to mighty machines manned by a dozen crew and tank 
                                        armament grow from machine guns to huge calibre weapons.
                                    </p>
                                    <p>
                                        Infantry weapons also changed in this period with the introduction of the light machine gun. Sub-machine 
                                        guns too started to be issued at squad level and some countries saw the benefit of the automatic rifle as 
                                        the main infantry weapon. Lighter and more potent tank killing weapons started to appear which fired hollow 
                                        charged projectiles which replaced the defunct anti-tank rifle.
                                    </p>
                                    <p>
                                        I have also included a company organisation to accompany each nation, mainly to aid some of the many table 
                                        top war gamers out there who like to war game using company size units.
                                    </p>
                                    <p>
                                        As you browse <a href="http://quartermastersection.com">QuartermasterSection.com</a>, you will notice it is 
                                        still in the process of being completed with lots of areas still needing attention to detail. I have in many 
                                        cases used field manuals and other military documents to aid my data base, but if anyone out there can see 
                                        any discrepancies then I would like to hear from you. Also if you have any feedback on any part of the site 
                                        please feel free to <a href="http://quartermastersection.com/contact.php">Contact Us</a>.
                                    </p>
                                    <p>
                                        I have also tried to place a source to any image used and this process has taken me all around the world and 
                                        hours of e-mailing to try and get permission, if anyone finds an image that belongs to them and can verify 
                                        this, then we will be happy to place a credit to you in the form of a link to the original source. 
                                    </p>
                                    <p>
                                        So I hope this site can be a source of help for everyone from amateur to expert.
                                    </p>
                                    <p>
                                        I must add that my family have been a constant help, and many thanks must go to three young people whose 
                                        dedication and hard work have enabled this site to be developed and up and running, these are Daniel, 
                                        Stefan and Hannah. Many thanks for their help and patience, as this site has taken nearly two years to 
                                        develop.
                                    </p>
                                    <p>
                                        A last thought must go to my late Father who gave over twenty years’ service to the <a href="http://quartermastersection.com/british/">British Army</a> 
                                        an artillery man and Warrant officer, and served in Britain, France and Germany including landing on Juno 
                                        beach in Normandy and finishing the war in Osnabruck Ge.
                                    </p>
                                    <p>
                                        So enjoy your time here, take away what you can and spread the word. We want this site to become the 
                                        number one resource for military weapons and history.
                                    </p>
                                </div><!--/.col-md-12-->    
                            </div><!--/.row-->
                        </div><!--/.container-->
                    </section><!--/about-us-->';

$homepage->title = 'About - ' . $homepage->title;

$homepage->canonical = '<link rel="canonical" href="http://' . $_SERVER["HTTP_HOST"] . parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH) . '" />';

$homepage->Display();