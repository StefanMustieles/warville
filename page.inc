<?php

require 'classes/minifer.php';

class Page
{
    //class Page's attributes
    public $content;
    public $title = "Quartermaster Section";
    public $canonical;
    public $contentpagescripts;
    public $metadescription;
    public $wholePage;

    /** 
     *  class Page's operations
     */
    public function Display()
    {
        $this->wholePage = '<!DOCTYPE html><html lang=\"en\"><head>';
        $this->DisplayTitle();
	$this->DisplayMetaTags();
	$this->DisplayCanonicalTag();
        $this->DisplayStyleSheets();
        $this->DisplayHeaderJavaScripts();
	$this->DisplayFavIcon();

        $this->wholePage .= '</head><body class="homepage">';
        $this->DisplayGoogleAnalytics();
        $this->DisplayHeader();

        $this->wholePage .= $this->content;
        $this->DisplayFooter();
        
        $this->DisplayDeferScripts();
        $this->DisplayContentPageScripts();
        $this->wholePage .= "</body></html>";
        echo minify_html($this->wholePage);
    }

    private function DisplayTitle() {
        $this->wholePage .= "<title>" . $this->title . "</title>";
    }
	
    private function DisplayMetaTags() {
        $this->wholePage .= '<meta charset="utf-8">
              <meta http-equiv="X-UA-Compatible" content="IE=edge">
              <meta name="viewport" content="width=device-width, initial-scale=1.0">
              <meta name="description" content="' . $this->metadescription . '">';
    }
    
    private function DisplayCanonicalTag() {
        $this->wholePage .= $this->canonical;
    }
	
    private function DisplayStyleSheets() {
        $this->wholePage .= '<!-- core CSS -->
            <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
            <link href="/assets/css/font-awesome.min.css" rel="stylesheet">
            <link href="/assets/css/responsive.min.css" rel="stylesheet">
            <link href="/assets/css/flag-icon.min.css" rel="stylesheet">
            <link href="/assets/css/main.min.css" rel="stylesheet">';
    }
    
    private function DisplayHeaderJavaScripts() {
        $this->wholePage .= '<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
                <!--[if lt IE 9]>
                  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
                  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
                <![endif]-->';
    }
	
    private function DisplayFavIcon() {
        $this->wholePage .= '<link rel="shortcut icon" href="/assets/images/favicon.png">
                             <!-- For Chrome for Android: -->
                            <link rel="icon" sizes="192x192" href="/assets/images/touch-icon-192x192.png">
                            <!-- For iPhone 6 Plus with @3× display: -->
                            <link rel="apple-touch-icon-precomposed" sizes="180x180" href="/assets/images/apple-touch-icon-180x180-precomposed.png">
                            <!-- For iPad with @2× display running iOS ≥ 7: -->
                            <link rel="apple-touch-icon-precomposed" sizes="152x152" href="/assets/images/apple-touch-icon-152x152-precomposed.png">
                            <!-- For iPad with @2× display running iOS ≤ 6: -->
                            <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/assets/images/apple-touch-icon-144x144-precomposed.png">
                            <!-- For iPhone with @2× display running iOS ≥ 7: -->
                            <link rel="apple-touch-icon-precomposed" sizes="120x120" href="/assets/images/apple-touch-icon-120x120-precomposed.png">
                            <!-- For iPhone with @2× display running iOS ≤ 6: -->
                            <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/assets/images/apple-touch-icon-114x114-precomposed.png">
                            <!-- For the iPad mini and the first- and second-generation iPad (@1× display) on iOS ≥ 7: -->
                            <link rel="apple-touch-icon-precomposed" sizes="76x76" href="/assets/images/apple-touch-icon-76x76-precomposed.png">
                            <!-- For the iPad mini and the first- and second-generation iPad (@1× display) on iOS ≤ 6: -->
                            <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/assets/images/apple-touch-icon-72x72-precomposed.png">
                            <!-- For non-Retina iPhone, iPod Touch, and Android 2.1+ devices: -->
                            <link rel="apple-touch-icon-precomposed" href="/assets/images/apple-touch-icon-precomposed.png"><!-- 57×57px -->';
    }

    private function DisplayHeader() {
        $this->wholePage .= '<header id="header">
                <div class="top-bar">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-lg-8">
                                <a class="navbar-brand" href="https://www.quartermastersection.com"><img src="/assets/images/logo-white.png" alt="QuartermasterSection" class="mainLogo" /></a>
                            </div>
                            <div class="col-xs-6 col-lg-4 searcher">
                                <div class="social">
                                    <form role="form" method="GET" action="/search.php">
                                        <input name="query" type="text" class="search-form" autocomplete="off" placeholder="Search">
                                        <i class="fa fa-search"></i>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div><!--/.container-->
                </div><!--/.top-bar-->

                <!-- Fixed navbar -->
                <div class="navbar navbar-custom navbar-inverse navbar-static-top" id="nav">
                    <div class="container">
                      <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                              <span class="icon-bar"></span>
                            </button>
                      </div>
                      <div class="collapse navbar-collapse">
                            <ul class="nav navbar-nav nav-justified">
                              <li class="dropdown"><a href="/american/">
                                    <div class="flag flag-icon-background flag-icon-us"></div>
                                    <span>American Army</span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="/american/afvs/">American AFVs</a></li>
                                        <li><a href="/american/artillery/">American Artillery</a></li>
                                        <li><a href="/american/companies/">American Companies</a></li>
                                        <li><a href="/american/divisions/">American Divisons</a></li>
                                        <li><a href="/american/infantry-weapons/">American Infantry Weapons</a></li>
                                        <li><a href="/american/support-vehicles/">American Support Vehicles</a></li>
                                    </ul>
                              </li>
                              <li class="dropdown"><a href="/british/">
                                    <div class="flag flag-icon-background flag-icon-gb"></div>
                                    <span>British Army</span>
                                    <ul class="dropdown-menu">
                                        <li><a href="/british/afvs/">British AFVs</a></li>
                                        <li><a href="/british/artillery/">British Artillery</a></li>
                                        <li><a href="/british/companies/">British Companies</a></li>
                                        <li><a href="/british/infantry-weapons/">British Infantry Weapons</a></li>
                                    </ul>
                              </a></li>
                              <li class="dropdown"><a href="/french/">
                                    <div class="flag flag-icon-background flag-icon-fr"></div>
                                    <span>French Army</span>
                                    <ul class="dropdown-menu">
                                        <li><a href="/french/afvs/">French AFVs</a></li>
                                        <li><a href="/french/artillery/">French Artillery</a></li>
                                        <li><a href="/french/companies/">French Companies</a></li>
                                        <li><a href="/french/infantry-weapons/">French Infantry Weapons</a></li>
                                        <li><a href="/french/support-vehicles/">French Support Vehicles</a></li>
                                    </ul>
                              </a></li>
                              <li class="dropdown"><a href="/german/">
                                    <div class="flag flag-icon-background flag-icon-de"></div>
                                    <span>German Army</span>
                                    <ul class="dropdown-menu">
                                        <li><a href="/german/afvs/">German AFVs</a></li>
                                        <li><a href="/german/artillery/">German Artillery</a></li>
                                        <li><a href="/german/companies/">German Companies</a></li>
                                        <li><a href="/german/infantry-weapons/">German Infantry Weapons</a></li>
                                        <li><a href="/german/support-vehicles/">German Support Vehicles</a></li>
                                        <li><a href="/german/captured-afvs/">German Captured Vehicles and Conversions</a></li>
										<li><a href="/german/divisions/">German Divisons</a></li>
                                    </ul>
                              </a></li>
                              <li class="dropdown"><a href="/hungarian/">
                                    <div class="flag flag-icon-background flag-icon-hu"></div>
                                    <span>Hungarian Army</span>
                                    <ul class="dropdown-menu">
                                        <li><a href="/hungarian/afvs/">Hungarian AFVs</a></li>
                                        <li><a href="/hungarian/artillery/">Hungarian Artillery</a></li>
                                        <li><a href="/hungarian/companies/">Hungarian Formations</a></li>
                                        <li><a href="/hungarian/infantry-weapons/">Hungarian Infantry Weapons</a></li>
                                        <li><a href="/hungarian/support-vehicles/">Hungarian Support Vehicles</a></li>
                                    </ul>
                              </a></li>
                              <li class="dropdown"><a href="/italian/">
                                    <div class="flag flag-icon-background flag-icon-it"></div>
                                    <span>Italian Army</span>
                                    <ul class="dropdown-menu">
                                        <li><a href="/italian/afvs/">Italian AFVs</a></li>
                                        <li><a href="/italian/artillery/">Italian Artillery</a></li>
                                        <li><a href="/italian/companies/">Italian Companies</a></li>
                                        <li><a href="/italian/infantry-weapons/">Italian Infantry Weapons</a></li>
                                        <li><a href="/italian/support-vehicles/">Italian Support Vehicles</a></li>
                                    </ul>
                              </a></li>
                              <li class="dropdown"><a href="/japanese/">
                                    <div class="flag flag-icon-background flag-icon-jp"></div>
                                    <span>Japanese Army</span>
                                    <ul class="dropdown-menu">
                                        <li><a href="/japanese/afvs/">Japanese AFVs</a></li>
                                        <li><a href="/japanese/artillery/">Japanese Artillery</a></li>
                                        <li><a href="/japanese/companies/">Japanese Companies</a></li>
                                        <li><a href="/japanese/infantry-weapons/">Japanese Infantry Weapons</a></li>
                                    </ul>
                              </a></li>
                              <li class="dropdown"><a href="/polish/">
                                    <div class="flag flag-icon-background flag-icon-pl"></div>
                                    <span>Polish Army</span>
                                    <ul class="dropdown-menu">
                                        <li><a href="/polish/afvs/">Polish AFVs</a></li>
                                        <li><a href="/polish/artillery/">Polish Artillery</a></li>
                                        <li><a href="/polish/companies/">Polish Companies</a></li>
                                        <li><a href="/polish/infantry-weapons/">Polish Infantry Weapons</a></li>
                                    </ul>
                              </a></li>
                              <li class="dropdown"><a href="/romanian/">
                                    <div class="flag flag-icon-background flag-icon-ro"></div>
                                    <span>Romanian Army</span>
                                    <ul class="dropdown-menu">
                                        <li><a href="/romanian/afvs/">Romanian AFVs</a></li>
                                        <li><a href="/romanian/artillery/">Romanian Artillery</a></li>
                                        <li><a href="/romanian/companies/">Romanian Companies</a></li>
                                        <li><a href="/romanian/infantry-weapons/">Romanian Infantry Weapons</a></li>
                                    </ul>
                              </a></li>
                              <li class="dropdown"><a href="/russian/">
                                    <div class="flag flag-icon-background flag-icon-ru"></div>
                                    <span>Russian Army</span>
                                    <ul class="dropdown-menu">
                                        <li><a href="/russian/afvs/">Russian AFVs</a></li>
                                        <li><a href="/russian/artillery/">Russian Artillery</a></li>
                                        <li><a href="/russian/companies/">Russian Companies</a></li>
                                        <li><a href="/russian/infantry-weapons/">Russian Infantry Weapons</a></li>
                                        <li><a href="/russian/support-vehicles/">Russian Support Vehicles</a></li>
                                    </ul>
                              </a></li>
                              <li class="dropdown">
                                    <a href="javascript: void(0);" class="dropdown-toggle" data-toggle="dropdown">More <b class="caret"></b></a>
                                    <ul class="dropdown-menu pull-right list-inline more">
                                      <li><a href="/belgian/">
                                        <div class="moreflag flag-icon-background flag-icon-be"></div>
                                        <span>Belgian Army</span>
                                      </a>
                                      </li>
                                      <li><a href="/bulgarian/">
                                        <div class="moreflag flag-icon-background flag-icon-bg"></div>
                                        <span>Bulgarian Army</span>
                                      </a>
                                      </li>
                                      <li><a href="/czechoslovakian/">
                                        <div class="moreflag flag-icon-background flag-icon-cz"></div>
                                        <span>Czechoslovakian Army</span>
                                      </a>
                                      </li>
                                      <li><a href="/danish/">
                                        <div class="moreflag flag-icon-background flag-icon-dk"></div>
                                        <span>Danish Army</span>
                                      </a>
                                      </li>
                                      <li><a href="/dutch/">
                                        <div class="moreflag flag-icon-background flag-icon-nl"></div>
                                        <span>Dutch Army</span>
                                      </a>
                                      </li>
                                      <li><a href="/dutch-east-indies/">
                                        <div class="moreflag flag-icon-background flag-icon-an"></div>
                                        <span>Dutch East Indies Army</span>
                                      </a>
                                      </li>
                                      <li><a href="/estonian/">
                                        <div class="moreflag flag-icon-background flag-icon-ee"></div>
                                        <span>Estonian Army</span>
                                      </a>
                                      </li>
                                      <li><a href="/finnish/">
                                        <div class="moreflag flag-icon-background flag-icon-fi"></div>
                                        <span>Finnish Army</span>
                                      </a>
                                      </li>
                                      <li><a href="/greek/">
                                        <div class="moreflag flag-icon-background flag-icon-gr"></div>
                                        <span>Greek Army</span>
                                      </a>
                                      </li>
                                      <li><a href="/latvian/">
                                        <div class="moreflag flag-icon-background flag-icon-lv"></div>
                                        <span>Latvian Army</span>
                                      </a>
                                      </li>
                                      <li><a href="/lithuanian/">
                                        <div class="moreflag flag-icon-background flag-icon-lt"></div>
                                        <span>Lithuanian Army</span>
                                      </a>
                                      </li>
                                      <li><a href="/norwegian/">
                                        <div class="moreflag flag-icon-background flag-icon-no"></div>
                                        <span>Norwegian Army</span>
                                      </a>
                                      </li>
                                      <li><a href="/swedish/">
                                        <div class="moreflag flag-icon-background flag-icon-se"></div>
                                        <span>Swedish Army</span>
                                      </a>
                                      </li>
                                      <li><a href="/yugoslavian/">
                                        <div class="moreflag flag-icon-background flag-icon-yg"></div>
                                        <span>Yugoslavian Army</span>
                                      </a>
                                      </li>
                                    </ul>
                              </li>
                            </ul>
                      </div><!--/.nav-collapse -->
                    </div><!--/.container -->
                </div><!--/.navbar -->
        </header><!--/header-->';
    }

    private function IsURLCurrentPage($url) {
        if(\strpos($_SERVER['PHP_SELF'], $url ) === false) {
            return false;
        }
        else {
            return true;
        }
    }

    private function DisplayFooter() {
        $this->wholePage .= '<footer id="footer" class="midnight-blue">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            &copy; ' . date("Y") . ' <a target="_blank" href="https://www.quartermastersection.com" title="">QuartermasterSection</a>. All Rights Reserved.
                        </div>
                        <div class="col-sm-6">
                            <ul class="pull-right">
                                <li><a href="/about.php">About Us</a></li>
                                <li><a href="/contact.php">Contact Us</a></li>
                                <li><a href="/contributors.php">Contributors</a></li>
				<li><a href="/sources.php">Sources</a></li>
                                <li><a href="/sitemap.php">Sitemap</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer><!--/#footer-->';
    }

    private function DisplayDeferScripts() {
        $this->wholePage .= '<script src="/assets/js/jquery.js"></script>
	      <script src="/assets/js/bootstrap.min.js"></script>';
    }
    
    private function DisplayContentPageScripts() {
        $this->wholePage .= $this->contentpagescripts;
    }

    private function DisplayGoogleAnalytics() {
        $this->wholePage .= '<!-- Google Tag Manager -->
            <noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-MCSN53"
            height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
            <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({\'gtm.start\':
            new Date().getTime(),event:\'gtm.js\'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!=\'dataLayer\'?\'&l=\'+l:\'\';j.async=true;j.src=
            \'//www.googletagmanager.com/gtm.js?id=\'+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,\'script\',\'dataLayer\',\'GTM-MCSN53\');</script>
            <!-- End Google Tag Manager -->';
    }
}