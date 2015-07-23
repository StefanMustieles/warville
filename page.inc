<?php

class Page
{
    //class Page's attributes
    public $content;
    public $title = "Quartermaster Section";
    public $canonical;
    public $contentpagescripts;

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
	      <meta name="robots" content="INDEX, FOLLOW">';
    }
    
	private function DisplayCanonicalTag() {
            echo $this->canonical;
	}
	
	private function DisplayStyleSheets()
    {
        echo '<!-- core CSS -->
            <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
            <link href="/assets/css/font-awesome.min.css" rel="stylesheet">
            <link href="/assets/css/responsive.css" rel="stylesheet">
            <link href="/assets/css/flag-icon.min.css" rel="stylesheet">
            <link href="/assets/css/main.css" rel="stylesheet">';
    }
    
    private function DisplayHeaderJavaScripts() {
        echo '<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
                <!--[if lt IE 9]>
                  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
                  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
                <![endif]-->';
    }
	
    private function DisplayFavIcon() {
        echo '<link rel="shortcut icon" href="images/favicon.ico">';
    }

    private function DisplayHeader() {
        echo '<header id="header">
				<div class="top-bar">
					<div class="container">
						<div class="row">
							<div class="col-sm-6 col-xs-4">
								<a class="navbar-brand" rel="home" href="http://quartermastersection.com"><img src="/assets/images/logo-white.png" alt="QuartermasterSection" /></a>
							</div>
							<div class="col-sm-6 col-xs-8">
							   <div class="social">
									<ul class="social-share">
										<li><a href="#"><i class="fa fa-facebook"></i></a></li>
										<li><a href="#"><i class="fa fa-twitter"></i></a></li>
									</ul>
									<div class="search">
										<form role="form">
											<input type="text" class="search-form" autocomplete="off" placeholder="Search">
											<i class="fa fa-search"></i>
										</form>
								   </div>
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
						  <li><a href="/america">
							<div class="flag flag-icon-background flag-icon-us"></div>
						  </a></li>
						  <li><a href="/britain">
							<div class="flag flag-icon-background flag-icon-gb"></div>
						  </a></li>
						  <li><a href="/france">
							<div class="flag flag-icon-background flag-icon-fr"></div>
						  </a></li>
						  <li><a href="/germany">
							<div class="flag flag-icon-background flag-icon-de"></div>
						  </a></li>
						  <li><a href="/hungary">
							<div class="flag flag-icon-background flag-icon-hu"></div>
						  </a></li>
						  <li><a href="/italy">
							<div class="flag flag-icon-background flag-icon-it"></div>
						  </a></li>
						  <li><a href="/japan">
							<div class="flag flag-icon-background flag-icon-jp"></div>
						  </a></li>
						  <li><a href="/poland">
							<div class="flag flag-icon-background flag-icon-pl"></div>
						  </a></li>
						  <li><a href="/romania">
							<div class="flag flag-icon-background flag-icon-ro"></div>
						  </a></li>
						  <li><a href="/russia">
							<div class="flag flag-icon-background flag-icon-ru"></div>
						  </a></li>
						  <li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">More <b class="caret"></b></a>
							<ul class="dropdown-menu">
							  <li><a href="/belgium">
								<div class="moreflag flag-icon-background flag-icon-be"></div>
							  </a>
							  </li>
							  <li><a href="/bulgaria">
								<div class="moreflag flag-icon-background flag-icon-bg"></div>
							  </a>
							  </li>
							  <li><a href="/czechslovakia">
								<div class="moreflag flag-icon-background flag-icon-cz"></div>
							  </a>
							  </li>
							  <li><a href="/denmark">
								<div class="moreflag flag-icon-background flag-icon-dk"></div>
							  </a>
							  </li>
							  <li><a href="/estonia">
								<div class="moreflag flag-icon-background flag-icon-ee"></div>
							  </a>
							  </li>
							  <li><a href="/finland">
								<div class="moreflag flag-icon-background flag-icon-fi"></div>
							  </a>
							  </li>
							  <li><a href="/greece">
								<div class="moreflag flag-icon-background flag-icon-gr"></div>
							  </a>
							  </li>
							  <li><a href="/holland">
								<div class="moreflag flag-icon-background flag-icon-nl"></div>
							  </a>
							  </li>
							  <li><a href="/latvia">
								<div class="moreflag flag-icon-background flag-icon-lv"></div>
							  </a>
							  </li>
							  <li><a href="/lithuania">
								<div class="moreflag flag-icon-background flag-icon-lt"></div>
							  </a>
							  </li>
							  <li><a href="/norway">
								<div class="moreflag flag-icon-background flag-icon-no"></div>
							  </a>
							  </li>
							  <li><a href="/sweden">
								<div class="moreflag flag-icon-background flag-icon-se"></div>
							  </a>
							  </li>
							  <li><a href="/yugoslavia">
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