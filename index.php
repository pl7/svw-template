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
$templateparams	= $app->getTemplate(true)->params;

// customize head title

if (is_object($app->getMenu()->getActive())){

    /*
        parent title = pt
        short club name = scn
        document title = dt
        
    */
	$parent_title = $app->getMenu()->getItem($app->getMenu()->getActive()->tree[0])->title;
	$shortClubName = $templateparams->get("short-club-name");
	$currentMenuName = JSite::getMenu()->getActive()->title;
	$currentDocTitle = $this->getTitle();
//	$docParent = $doc->parent->getTitle();
	$browseTitle = "";
	// pt exist UND pt IST NICHT dc
	if(strlen($parent_title) > 0 && strlen($shortClubName) > 0) {
	   // dt enthält pt 
	   if(strpos($parent_title,$currentDocTitle)!==false) {
	       // dt enthält scn
	       if(strpos($shortClubName,$currentDocTitle)!==false){
    	       $browseTitle = $currentDocTitle;
	       }
	       // dt enhält nicht scn
	       else {
    	       $browseTitle = $shortClubName.' - '.$currentDocTitle;
	       }
	   } // dt enthält nicht pt und pt enhält scn
       elseif(strpos($parent_title,$shortClubName)!==false) {
           if(strpos($currentDocTitle,$shortClubName)!==false) {
               $browseTitle = $parent_title.' - '.$this->getTitle();
           } // dt enthält nicht pt und pt enhält nicht scn
           else{
               $browseTitle = $shortClubName.' - '.$parent_title.' - '.$currentDocTitle;
           }   
       } else {
           $browseTitle = $shortClubName.' - '.$parent_title.' - '.$currentDocTitle;
       }
    }
	else {
    	$browseTitle = $app->getCfg( 'sitename' ) . ' - ' . $this->getTitle();
	}
	$this->setTitle($browseTitle);
}
$this->setGenerator(null);

// load sheets and scripts
//$doc->addStyleSheet($tpath.'/css/template.css.php?v=1.0.0'); 
$doc->addStyleSheet($tpath.'/css/reset.css'); 
$doc->addStyleSheet($tpath.'/css/articles.css'); 
$doc->addStyleSheet($tpath.'/css/articles_ie8.css'); 
$doc->addStyleSheet($tpath.'/css/template.css'); 
$doc->addStyleSheet($tpath.'/css/print.css', 'text/css','print',''); 
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
            </script>';
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
			?><meta http-equiv="last-modified" content="date <?php echo $article->get("publish_up"); ?>" /><?
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
        echo '<body onLoad="checkFussballDeWidget()"  itemscope itemtype="http://schema.org/WebPage">';
    }
    else {
        echo '<body itemscope itemtype="http://schema.org/WebPage">';
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
<section id="wrapper">
  <header class="noPrint">
    <img itemprop="image" src="<?php echo $tpath; ?>/images/svw_banner_01.png" title="SV Wiesbaden 1899 e.V" alt="SV Wiesbaden 1899 Logo"> 
    <h1 class="print"><?php echo $app->getCfg('sitename'); ?></h1>
  </header>
  <div id="overall">
	<!-- Navigation -->
    <nav class="top noPrint" id="mainMenu">
        <header style="display:none"><h2>Hauptnavigation</h2></header>
        <jdoc:include type="modules" name="position-1" />
    </nav>
    <div id="main">
        <div class="inmain">			
            <section id="content" class="<?php if($pageclass == 'cat-all') echo 'svw-news-all'; else echo $pageclass;?>">
                <header style="display:none"><h2><?php echo $doc->getTitle(); ?></h2></header>

                	<jdoc:include type="modules" name="position-4" />
                    
				    <jdoc:include type="modules" name="svw-team-menu" />
									
                    <?php if ($view=="category") : ?>
                    	<jdoc:include type="modules" name="Slideshow" />
                	<?php endif; ?>
                    
					<jdoc:include type="modules" name="content-navigation" />
					
                    <jdoc:include type="modules" name="SVW Pre Content" />
					
					<jdoc:include type="component" />
					
                    <jdoc:include type="modules" name="svw-content" />

                    <jdoc:include type="modules" name="SVW Team" />

                    <jdoc:include type="modules" name="fussball-de-widget-00" />
            </section>
            <aside class="noPrint">
                <header style="display:none"><h2>Sidebar</h2></header>
				<nav id="subMenu">
					<jdoc:include type="modules" name="position-5" />
				</nav>
                <jdoc:include type="modules" name="FB-LIKE-SIDEBAR" />
				<jdoc:include type="modules" name="position-6" />
            </aside>
    	</div>
    </div><!-- wrapper -->
    <jdoc:include type="message" />
  </div>  
</section> 
  <footer id="footer" class="group noPrint">
        <div class="infooter">
            <section>
                <header style="display:none"><h2>Homepage Informationen</h2></header>
        		<p class="center">Created & Designed by <a itemprop="author" href="http://plus.google.com/111996881846771358377/posts">PL07</a> &#169; 2012 &#124; All rights reserved.</p>
        		<p class="center">
        			<a href="#top">zum Seitenanfang</a>
        		</p>
            </section>
        </div>
	</footer>
  <jdoc:include type="modules" name="debug" />
  <script type="text/javascript" src="<?php echo $tpath; ?>/js/svwNews.js"></script> 
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

