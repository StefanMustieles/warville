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
                                    <div id="contributorsList">
                                        <ol>
                                           <li><p><em>Jaeger Platoon</em></p></li>
                                           <li><p><em>Winter War</em></p></li>
                                           <li><p><em>David Lehmann</em></p></li>
                                           <li><p><em>Russian Battlefield</em></p></li>
                                           <li><p><em>Dansk Militaerhistorie</em></p></li>
                                           <li><p><em>The Campaign of the<br />Belgian army in May 1940</em></p></li>
                                           <li><p><em>France 1940</em></p></li>
                                           <li><p><em>War Over Holland</em></p></li>
                                           <li><p><em>WarWheels (David Haugh<br />& Patrick Keenan)</em></p></li>
                                           <li><p><em>Olive Drab</em></p></li>
                                           <li><p><em>Bulgarian Artillery<br />1878 – 1918</em></p></li>
                                           <li><p><em>Lone Sentry</em></p></li>
                                           <li><p><em>World Guns</em></p></li>
                                           <li><p><em>Hem.Fyristorg.com</em></p></li>
                                           <li><p><em>Introduction to the Royal Swedish Army in WW2</em></p></li>
                                           <li><p><em>World War 2.ro</em></p></li>
                                           <li><p><em>Delostrelectvo<br />Csarmady 1918-1939</em></p></li>
                                           <li><p><em>World War 2 Greece</em></p></li>
                                           <li><p><em>Chars-francais.net</em></p></li>
                                           <li><p><em>WWII Vehicles</em></p></li>
                                           <li><p><em>WW2 Armed Forces<br />Order of Battle</em></p></li>
                                           <li><p><em>Overvalwagen</em></p></li>
                                           <li><p><em>Tank Encyclopaedia</em></p></li>
                                           <li><p><em>Guns V. Armor</em></p></li>
                                           <li><p><em>Wehrmacht History</em></p></li>
                                           <li><p><em>WW2 Forums</em></p></li>
                                           <li><p><em>Aviarmor</em></p></li>
                                           <li><p><em>Taki\'s Home Page</em></p></li>
                                           <li><p><em>Valka.cz</em></p></li>
                                           <li><p><em>Comando Supremo</em></p></li>
                                           <li><p><em>British Equipment of the Second World War</em></p></li>
                                           <li><p><em>Hungary WW2</em></p></li>
                                           <li><p><em>Axis History Forum</em></p></li>
                                           <li><p><em>The AFV Data Base</em></p></li>
                                           <li><p><em>WWII Day By Day</em></p></li>
                                           <li><p><em>PIBWL Military Site</em></p></li>
                                           <li><p><em>1939 Kampania<br />Wrzesniowa</em></p></li>
                                           <li><p><em>US Anti-tank Artillery<br />1941-45 (Osprey)</em></p></li>
                                           <li><p><em>The Profile AFV Series<br />(Profile Publications)</em></p></li>
                                           <li><p><em>German Infantry Weapons (US Army Military History Institute)</em></p></li>
                                           <li><p><em>German Anti-aircraft<br />Artillery (US Army Military History Institute)</em></p></li>
                                           <li><p><em>Centurion Universal Tank (Osprey)</em></p></li>
                                           <li><p><em>The Romanian Army of<br />World War Two (Osprey)</em></p></li>
                                           <li><p><em>Infantry Mortars of<br />World War Two (Osprey)</em></p></li>
                                           <li><p><em>The British Reconnaissance Corps in World War Two (Osprey)</em></p></li>
                                           <li><p><em>US Army Order of Battle<br />1919-1941 (Combat Studies) </em></p></li>
                                           <li><p><em>Japanese Tank and<br />Anti-tank Warfare (Military Intelligence Division)</em></p></li>
                                           <li><p><em>Japanese Field Artillery (Military Intelligence Division)</em></p></li>
                                           <li><p><em>US Field Artillery of<br />World War Two (Osprey)</em></p></li>
                                           <li><p><em>Evolution of the US Army<br />Infantry Battalion 1939-1968<br />(Combat Operations Research Group)</em></p></li>
                                        </ol>
                                    </div>
                                </div><!--/.col-md-12-->    
                            </div><!--/.row-->
                        </div><!--/.container-->
                    </section><!--/about-us-->';

$homepage->title = 'Sources - ' . $homepage->title;

$homepage->canonical = '<link rel="canonical" href="http://' . $_SERVER["HTTP_HOST"] . parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH) . '" />';

$homepage->Display();