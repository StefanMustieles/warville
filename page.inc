<?php

class Page
{
    //class Page's attributes
    public $content;
    public $title = "Quartermaster Section";
    public $canonical;
    public $contentpagescripts;
    public $metadescription;

    /** 
     *  class Page's operations
     */
    public function Display()
    {
        echo "<!DOCTYPE html>\n<html lang=\"en\">\n<head>";
        $this->DisplayTitle();
	$this->DisplayMetaTags();
	$this->DisplayCanonicalTag();
        $this->DisplayStyleSheets();
        $this->DisplayHeaderJavaScripts();
	$this->DisplayFavIcon();

        echo '</head><body class="homepage">';
        $this -> DisplayHeader();

        echo $this->content;
        $this->DisplayFooter();
        
        $this->DisplayDeferScripts();
        $this->DisplayContentPageScripts();
        $this->DisplayGoogleAnalytics();
        echo "</body>\n</html>\n";
    }

    private function DisplayTitle() {
        echo "<title>" . $this->title . "</title>";
    }
	
    private function DisplayMetaTags() {
        echo '<meta charset="utf-8">
              <meta http-equiv="X-UA-Compatible" content="IE=edge">
              <meta name="viewport" content="width=device-width, initial-scale=1.0">
	      <meta name="robots" content="NOINDEX, NOFOLLOW">
              <meta name="description" content="' . $this->metadescription . '">
              <meta name="google-site-verification" content="ETr9EcP9rwEPnlQdP3s8oA2DS-PAFxL9cVUOEOozeww" />';
    }
    
    private function DisplayCanonicalTag() {
        echo $this->canonical;
    }
	
    private function DisplayStyleSheets() {
        echo '<!-- core CSS -->
            <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
            <link href="/assets/css/font-awesome.min.css" rel="stylesheet">
            <link href="/assets/css/responsive.min.css" rel="stylesheet">
            <link href="/assets/css/flag-icon.min.css" rel="stylesheet">
            <link href="/assets/css/main.min.css" rel="stylesheet">';
    }
    
    private function DisplayHeaderJavaScripts() {
        echo '<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
                <!--[if lt IE 9]>
                  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
                  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
                <![endif]-->';
    }
	
    private function DisplayFavIcon() {
        echo '<link rel="shortcut icon" href="/assets/images/favicon.ico">';
    }

    private function DisplayHeader() {
        echo '<header id="header">
                <div class="top-bar">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-lg-8">
                                <a class="navbar-brand" href="http://quartermastersection.com"><img src="/assets/images/logo-white.png" alt="QuartermasterSection" class="mainLogo" /></a>
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
                                    <span>America</span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="/american/afvs/">American AFVs</a></li>
                                        <li><a href="/american/artillery/">American Artillery</a></li>
                                        <li><a href="/american/companies/">American Companies</a></li>
                                        <li><a href="/american/divisions/">American Divisons</a></li>
                                        <li><a href="/american/infantry-weapons/">American Infantry Weapons</a></li>
                                        <li><a href="/american/support-vehicles/">American Support Vehicles</a></li>
                                        <li><a href="/american/afvs/tanks">American Tanks</a></li>
                                    </ul>
                              </li>
                              <li class="dropdown"><a href="/british/">
                                    <div class="flag flag-icon-background flag-icon-gb"></div>
                                    <span>Britain</span>
                                    <ul class="dropdown-menu">
                                        <li><a href="/british/afvs/">British AFVs</a></li>
                                        <li><a href="/british/artillery/">British Artillery</a></li>
                                        <li><a href="/british/companies/">British Companies</a></li>
                                        <li><a href="/british/infantry-weapons/">British Infantry Weapons</a></li>
                                        <li><a href="/british/afvs/tanks">British Tanks</a></li>
                                    </ul>
                              </a></li>
                              <li class="dropdown"><a href="/french/">
                                    <div class="flag flag-icon-background flag-icon-fr"></div>
                                    <span>France</span>
                                    <ul class="dropdown-menu">
                                        <li><a href="/french/afvs/">French AFVs</a></li>
                                        <li><a href="/french/artillery/">French Artillery</a></li>
                                        <li><a href="/french/companies/">French Companies</a></li>
                                        <li><a href="/french/infantry-weapons/">French Infantry Weapons</a></li>
                                        <li><a href="/french/support-vehicles/">French Support Vehicles</a></li>
                                        <li><a href="/french/afvs/tanks">French Tanks</a></li>
                                    </ul>
                              </a></li>
                              <li class="dropdown"><a href="/german/">
                                    <div class="flag flag-icon-background flag-icon-de"></div>
                                    <span>German</span>
                                    <ul class="dropdown-menu">
                                        <li><a href="/german/afvs/">German AFVs</a></li>
                                        <li><a href="/german/artillery/">German Artillery</a></li>
                                        <li><a href="/german/companies/">German Companies</a></li>
                                        <li><a href="/german/infantry-weapons/">German Infantry Weapons</a></li>
                                        <li><a href="/german/support-vehicles/">German Support Vehicles</a></li>
                                        <li><a href="/german/afvs/tanks">German Tanks</a></li>
                                    </ul>
                              </a></li>
                              <li class="dropdown"><a href="/hungarian/">
                                    <div class="flag flag-icon-background flag-icon-hu"></div>
                                    <span>Hungary</span>
                                    <ul class="dropdown-menu">
                                        <li><a href="/hungarian/afvs/">Hungarian AFVs</a></li>
                                        <li><a href="/hungarian/artillery/">Hungarian Artillery</a></li>
                                        <li><a href="/hungarian/companies/">Hungarian Companies</a></li>
                                        <li><a href="/hungarian/infantry-weapons/">Hungarian Infantry Weapons</a></li>
                                        <li><a href="/hungarian/support-vehicles/">Hungarian Support Vehicles</a></li>
                                    </ul>
                              </a></li>
                              <li class="dropdown"><a href="/italian/">
                                    <div class="flag flag-icon-background flag-icon-it"></div>
                                    <span>Italy</span>
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
                                    <span>Japan</span>
                                    <ul class="dropdown-menu">
                                        <li><a href="/japanese/afvs/">Japanese AFVs</a></li>
                                        <li><a href="/japanese/artillery/">Japanese Artillery</a></li>
                                        <li><a href="/japanese/companies/">Japanese Companies</a></li>
                                        <li><a href="/japanese/infantry-weapons/">Japanese Infantry Weapons</a></li>
                                    </ul>
                              </a></li>
                              <li class="dropdown"><a href="/polish/">
                                    <div class="flag flag-icon-background flag-icon-pl"></div>
                                    <span>Polish</span>
                                    <ul class="dropdown-menu">
                                        <li><a href="/polish/afvs/">Polish AFVs</a></li>
                                        <li><a href="/polish/artillery/">Polish Artillery</a></li>
                                        <li><a href="/polish/companies/">Polish Companies</a></li>
                                        <li><a href="/polish/infantry-weapons/">Polish Infantry Weapons</a></li>
                                    </ul>
                              </a></li>
                              <li class="dropdown"><a href="/romanian/">
                                    <div class="flag flag-icon-background flag-icon-ro"></div>
                                    <span>Romania</span>
                                    <ul class="dropdown-menu">
                                        <li><a href="/polish/afvs/">Romanian AFVs</a></li>
                                        <li><a href="/polish/artillery/">Romanian Artillery</a></li>
                                        <li><a href="/polish/companies/">Romanian Companies</a></li>
                                        <li><a href="/polish/infantry-weapons/">Romanian Infantry Weapons</a></li>
                                    </ul>
                              </a></li>
                              <li class="dropdown"><a href="/russian/">
                                    <div class="flag flag-icon-background flag-icon-ru"></div>
                                    <span>Russia</span>
                                    <ul class="dropdown-menu">
                                        <li><a href="/russian/afvs/">Russian AFVs</a></li>
                                        <li><a href="/russian/artillery/">Russian Artillery</a></li>
                                        <li><a href="/russian/companies/">Russian Companies</a></li>
                                        <li><a href="/russian/infantry-weapons/">Russian Infantry Weapons</a></li>
                                        <li><a href="/russian/afvs/tanks">Russian Tanks</a></li>
                                    </ul>
                              </a></li>
                              <li class="dropdown">
                                    <a href="javascript: void(0);" class="dropdown-toggle" data-toggle="dropdown">More <b class="caret"></b></a>
                                    <ul class="dropdown-menu more">
                                      <li><a href="/belgian/">
                                            <div class="moreflag flag-icon-background flag-icon-be"></div>
                                      </a>
                                      </li>
                                      <li><a href="/bulgarian/">
                                            <div class="moreflag flag-icon-background flag-icon-bg"></div>
                                      </a>
                                      </li>
                                      <li><a href="/czechoslovakian/">
                                            <div class="moreflag flag-icon-background flag-icon-cz"></div>
                                      </a>
                                      </li>
                                      <li><a href="/danish/">
                                            <div class="moreflag flag-icon-background flag-icon-dk"></div>
                                      </a>
                                      </li>
                                      <li><a href="/dutch-east-indies/">
                                            <div class="moreflag flag-icon-background flag-icon-an"></div>
                                      </a>
                                      </li>
                                      <li><a href="/estonian/">
                                            <div class="moreflag flag-icon-background flag-icon-ee"></div>
                                      </a>
                                      </li>
                                      <li><a href="/finnish/">
                                            <div class="moreflag flag-icon-background flag-icon-fi"></div>
                                      </a>
                                      </li>
                                      <li><a href="/greek/">
                                            <div class="moreflag flag-icon-background flag-icon-gr"></div>
                                      </a>
                                      </li>
                                      <li><a href="/holland/">
                                            <div class="moreflag flag-icon-background flag-icon-nl"></div>
                                      </a>
                                      </li>
                                      <li><a href="/latvian/">
                                            <div class="moreflag flag-icon-background flag-icon-lv"></div>
                                      </a>
                                      </li>
                                      <li><a href="/lithuanian/">
                                            <div class="moreflag flag-icon-background flag-icon-lt"></div>
                                      </a>
                                      </li>
                                      <li><a href="/norwegian/">
                                            <div class="moreflag flag-icon-background flag-icon-no"></div>
                                      </a>
                                      </li>
                                      <li><a href="/swedish/">
                                            <div class="moreflag flag-icon-background flag-icon-se"></div>
                                      </a>
                                      </li>
                                      <li><a href="/yugoslavian/">
                                            <div class="moreflag flag-icon-background flag-icon-yg"></div>
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
        echo '<footer id="footer" class="midnight-blue">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            &copy; ' . date("Y") . ' <a target="_blank" href="http://quartermastersection.com" title="">QuartermasterSection</a>. All Rights Reserved.
                        </div>
                        <div class="col-sm-6">
                            <ul class="pull-right">
                                <li><a href="/about.php">About Us</a></li>
                                <li><a href="/contact.php">Contact Us</a></li>
                                <li><a href="/contributors.php">Contributors</a></li>
								<li><a href="/sources.php">Sources</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer><!--/#footer-->';
    }

    private function DisplayDeferScripts() {
        echo '<script src="/assets/js/jquery.js"></script>
	      <script src="/assets/js/bootstrap.min.js"></script>';
    }
    
    private function DisplayContentPageScripts() {
        echo $this->contentpagescripts;
    }

    private function DisplayGoogleAnalytics() {
        echo '';
    }
}