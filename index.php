<?php 
/*------------------------------------------------------------------------
# author    Pascal Link
# copyright Copyright (C) 2012 pl07.de All rights reserved.
# @license  http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Website   http://www.pl07.de
-------------------------------------------------------------------------*/

defined( '_JEXEC' ) or die; 

// variables
$app = JFactory::getApplication();
$doc = JFactory::getDocument(); 
$params = $app->getParams();
$pageclass = $params->get('pageclass_sfx');
$tpath = $this->baseurl.'/templates/'.$this->template;

$this->setGenerator(null);

// load sheets and scripts
//$doc->addStyleSheet($tpath.'/css/template.css.php?v=1.0.0'); 
$doc->addStyleSheet($tpath.'/css/reset.css'); 
$doc->addStyleSheet($tpath.'/css/template.css'); 
$doc->addScript($tpath.'/js/modernizr.js'); // <- this script must be in the head

// unset scripts, put them into /js/template.js.php to minify http requests
unset($doc->_scripts[$this->baseurl.'/media/system/js/mootools-core.js']);
unset($doc->_scripts[$this->baseurl.'/media/system/js/core.js']);
unset($doc->_scripts[$this->baseurl.'/media/system/js/caption.js']);

?><!doctype html>
<!--[if IEMobile]><html  xmlns:fb="http://ogp.me/ns/fb#" class="iemobile" lang="<?php echo $this->language; ?>"> <![endif]-->
<!--[if lt IE 7]> <html  xmlns:fb="http://ogp.me/ns/fb#" class="no-js ie6 oldie" lang="<?php echo $this->language; ?>"> <![endif]-->
<!--[if IE 7]>    <html  xmlns:fb="http://ogp.me/ns/fb#" class="no-js ie7 oldie" lang="<?php echo $this->language; ?>"> <![endif]-->
<!--[if IE 8]>    <html  xmlns:fb="http://ogp.me/ns/fb#" class="no-js ie8 oldie" lang="<?php echo $this->language; ?>"> <![endif]-->
<!--[if gt IE 8]><!-->  <html xmlns:fb="http://ogp.me/ns/fb#" class="no-js" lang="<?php echo $this->language; ?>"> <!--<![endif]-->

<head>
  <script type="text/javascript" src="<?php echo $tpath.'/js/template.js.php'; ?>"></script>
  <jdoc:include type="head" />
  <META NAME="Content-Language" CONTENT="de">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" /> <!-- mobile viewport -->
  <link rel="stylesheet" media="only screen and (max-width: 768px)" href="<?php echo $tpath; ?>/css/tablet.css" type="text/css" />
  
  <link rel="stylesheet" media="only screen and (min-width: 320px) and (max-width: 480px)" href="<?php echo $tpath; ?>/css/phone.css" type="text/css" />
  <!--[if IEMobile]><link rel="stylesheet" media="screen" href="<?php echo $tpath; ?>/css/phone.css" type="text/css" /><![endif]--> <!-- iemobile -->
  <link rel="apple-touch-icon-precomposed" href="<?php echo $tpath; ?>/apple-touch-icon-57x57.png"> <!-- iphone, ipod, android -->
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $tpath; ?>/apple-touch-icon-72x72.png"> <!-- ipad -->
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $tpath; ?>/apple-touch-icon-114x114.png"> <!-- iphone retina -->
  <!--[if lte IE 8]>
    <style> 
      {behavior:url(<?php echo $tpath; ?>/js/PIE.htc);}	
    </style>
  <![endif]-->
  <!--[if IE 7]>
	<link rel="stylesheet" media="screen" href="<?php echo $tpath; ?>/css/template_ie7.css" type="text/css" />
  <![endif]-->
  <!--[if gt IE 8]>
	<link rel="stylesheet" media="screen" href="<?php echo $tpath; ?>/css/template_ie9.css" type="text/css" />
  <![endif]-->
  <!--[if IE 8]> 
	<link rel="stylesheet" media="screen" href="<?php echo $tpath; ?>/css/template_ie8.css" type="text/css" />
  <![endif]-->
  <?php 
  /*! Fussball.de Widget */
  /*    pl07.de 304C7452AD2414DFB513E527B893884BA6A7D927 
        svw.pl07.de BC144B3F5C3D92B4D39FE78DB00F642193F071C9 
  */
    $module = JModuleHelper::getModule('fussball_de_widget');
    $moduleParams = new JRegistry();
    $is_fb_de_widget = false;
    if(is_object($moduleParams) && is_object($module)){
        $moduleParams->loadString($module->params);
    
        $param = $moduleParams->get('table_id');
        $is_fb_de_widget = !is_null($param);
        if (!is_null($param))    {
			
			echo '<script type="text/javascript" 
            src="http://static.fussball.de/fbdeAPI/js/fbdeAPIFunctions.js?schluessel=1EFDFDC2617005E99366EA8A617815B41EB5CE0D">
            </script>
			<link rel="stylesheet" media="screen" href="'.$tpath.'/css/fb_de.css" type="text/css" />
			<link rel="stylesheet" media="screen" href="'.$tpath.'/css/fb_de_print.css" type="text/css" />';
        }        
    }
  ?>
  <?php /*! Google Analytics */ ?>
	<script type="text/javascript">

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-35509846-1']);
    _gaq.push(['_setDomainName', 'svwiesbaden1899.de']);
    _gaq.push(['_setAllowLinker', true]);
    _gaq.push(['_trackPageview']);
    
    (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();
	  
	</script>

    <?php 
        $option = JRequest::getCmd('option');
        $view = JRequest::getCmd('view');
        $og_desc_output = "SV Wiesbaden ist der Traditionsverein in der hessischen Landeshauptstadt Wiesbaden.";
        $og_type_output = "sports_team";
        $og_title_output = $doc->getTitle();
        $image_output = "/images/icons/svw_logo_traditon_aus_leidenschaft.jpg";
        
        if ($option=="com_content" && $view=="article") {
            $ids = explode(':',JRequest::getString('id'));
            $article_id = $ids[0];
            $article =& JTable::getInstance("content");
            $article->load($article_id);
            $images = json_decode($article->get("images"));
            $og_type_output = "article";
            if(strlen($article->get("metadesc")) > 0){
                $og_desc_output = $article->get("metadesc");
            } elseif(strlen($article->get("introtext")) > 0){
                $og_desc_output = htmlspecialchars(strip_tags($article->get("introtext")));
            } else {
                $og_desc_output = "Neues beim SVW! Schaut jetzt nach auf www.svwiesbaden1899.de !";
            }
            $og_title_output = $article->get("title");
            
            if(!is_null($images->image_intro) && strlen($images->image_intro) > 0){
                $image_output = htmlspecialchars($images->image_intro);
            }
        } 

    ?>	
    <meta property="og:title" content="<?php echo $og_title_output; ?>">
    <meta property="og:description" content="<?php echo $og_desc_output; ?>">
    <meta property="og:url" content="http://www.svwiesbaden1899.de<?php echo $_SERVER['REQUEST_URI']; ?>">
    <meta property="og:type" content="<?php echo $og_type_output;?>">
    <meta property="fb:admins" content="1421683534">
    <meta property="og:image" content="http://www.svwiesbaden1899.de/<?php echo $image_output; ?>">
    <meta property="og:site_name" content="SV Wiesbaden 1899 e.V. - Homepage" />
	<meta property="og:locale" content="de_DE" />
	
	<?php
	    $module = JModuleHelper::getModule('fb_like_svw');
        if (is_null($module)){
            $module = JModuleHelper::getModule('fb_box_svw');
        }

		$moduleParams = new JRegistry();
		if(is_object($moduleParams) && is_object($module))
        $moduleParams->loadString($module->params);
		
		if($moduleParams->get('pluginWidth') > 0) :?><script src="js/ga.js" type="text/javascript"></script><?php endif; ?>
</head>
<?php 
    if($is_fb_de_widget){
        echo '<body onLoad="checkFussballDeWidget()">';
    }
    else {
        echo '<body>';
    }
    
    if($moduleParams->get('pluginWidth') > 0) :
?>
<div id="fb-root"></div>
<script>
	window.fbAsyncInit = function() {
		FB.init({
		appId      : '367134453372608', // ENTER your FB App ID
		//channelUrl : '//WWW.YOUR_DOMAIN.COM/channel.html', // Channel File
		status     : true, // check login status
		cookie     : true, // enable cookies to allow the server to access the session
		xfbml      : true  // parse XFBML
		});
	};
	(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/de_DE/all.js";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
</script>
<?php endif; ?>
<div id="wrapper">
<div id="header">
  <header class="inheader">
    <img src="<?php echo $tpath; ?>/images/svw_banner_01.png" title="SV Wiesbaden 1899 e.V" alt="SV Wiesbaden 1899 Logo"> 
    <h1 style="display:none"><?php echo $app->getCfg('sitename'); ?></h1>
  </header>
</div>
  <div id="overall">
    <nav class="top" id="topMenu">
        <header style="display:none"><h2>Hauptnavigation</h2></header>
        <jdoc:include type="modules" name="position-1" />
        <jdoc:include type="modules" name="position-2" />
        <jdoc:include type="modules" name="position-3" />
    </nav>
    <!-- Navigation -->
    <div id="main">
        <div class="inmain">			
            <section id="content">
                <header style="display:none"><h2><?php echo $doc->getTitle(); ?></h2></header>
                	<div id="breadcrumbs">
                    	<jdoc:include type="modules" name="position-4" />
                    </div>
                <jdoc:include type="component" />
                    <jdoc:include type="modules" name="last-news" />

                    <jdoc:include type="modules" name="kader-gk" />
                    <jdoc:include type="modules" name="kader-df" />
                    <jdoc:include type="modules" name="kader-mf" />
                    <jdoc:include type="modules" name="kader-fw" />

                    <jdoc:include type="modules" name="fussball-de-widget-00" />
                    <jdoc:include type="modules" name="fussball-de-widget-01" />
                    <jdoc:include type="modules" name="fussball-de-widget-02" />
                    <jdoc:include type="modules" name="fussball-de-widget-03" />
                    <jdoc:include type="modules" name="fussball-de-widget-04" />
                    <jdoc:include type="modules" name="fussball-de-widget-05" />
                    <jdoc:include type="modules" name="fussball-de-widget-06" />
            </section>
            <aside>
                <header style="display:none"><h2>Sidebar</h2></header>
                <section id="position-5">
                    <nav class="top" id="subMenu">
                        <jdoc:include type="modules" name="position-5" />
                    </nav>
                </section>
                <section id="position-6">
                    <jdoc:include type="modules" name="position-6" />
                </section>
                <jdoc:include type="modules" name="Facebook Like SVW Sidbar" />
            </aside>
    	</div>
    </div>
    <jdoc:include type="message" />
  </div>  
</div>
  <footer id="footer" class="group">
        <div class="infooter">
            <section>
                <header style="display:none"><h2>Homepage Informationen</h2></header>
        		<p class="center">Created & Designed by PL07 &#169; 2012 &#124; All rights reserved.</p>
        		<p class="center">
        			<a href="#top">zum Seitenanfang</a>
        		</p>
            </section>
        </div>
	</footer>
  <jdoc:include type="modules" name="debug" />
<? /* <script type="text/javascript" src="<?php echo $tpath; ?>/js/jquery-latest.min.js"></script> */ ?>
  <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
  <script type="text/javascript">
  $(function() {
	  if ($.browser.msie && $.browser.version.substr(0,1)<7)
	  {
			$('li').has('ul').mouseover(function(){
					$(this).children('ul').css('visibility','visible');
					}).mouseout(function(){
					$(this).children('ul').css('visibility','hidden');
					})
	  }
	});
	
    /* Mobile */
    $('#topMenu').prepend('<div id="menu-trigger">Menu</div>');
    $("#menu-trigger").on("click", function(){
            $("#menu").slideToggle();
    });
    
    // iPad
    var isiPad = navigator.userAgent.match(/iPad/i) != null;
    if (isiPad) $('#menu ul').addClass('no-transition');

 </script>
	<?php if($moduleParams->get('pluginWidth') > 0) :?>
		<!-- Google Analytics tracking -->
		<script>
			_ga.trackFacebook();
		</script>
	<?php endif; ?>
</body>
</html>

