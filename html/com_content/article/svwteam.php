<?php
/**
 * @package		Joomla.Site
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

// Create shortcuts to some parameters.
$params		= $this->item->params;
$images = json_decode($this->item->images);
$urls = json_decode($this->item->urls);
$canEdit	= $this->item->params->get('access-edit');
$user		= JFactory::getUser();
$app = JFactory::getApplication(); 
$templateparams	= $app->getTemplate(true)->params;

?>

<?php if($templateparams->get('svw_area',0) < 5) : ?>
    <section class="page-item" id="team_HEADER" teamkey="<?php echo $params->get('team_key'); ?>" itemscope itemtype="http://schema.org/Organization" typeof="SportsTeam">
        <article class="ac" id="team-info">
            <header>
                <h1 itemprop="name"><?php echo $this->escape($this->params->get('page_heading')); ?></h1>
            </header>
			<?php if ($params->get('show_team_pic')): ?>
				<div class="team-image-preview noPrint">
					<?php  if (isset($images->image_intro) and !empty($images->image_intro)) : ?> 
						<img id="<?php echo $params->get('team_key')."-team-picture"; ?>" 
							<?php if ($images->image_intro_caption) echo 'title="'.htmlspecialchars($images->image_intro_caption) .'"'; ?>
							src="<?php echo htmlspecialchars($images->image_intro); ?>" alt="<?php echo htmlspecialchars($images->image_intro_alt); ?>"
							width="75%" itemprop="image" onclick="toggleFullSizeImage(this, '<?php echo $params->get('team_key');?>')"/>
							
							<?php if ($params->get('team_pic_caption')):
								echo '<p  id="'.$params->get('team_key').'"-team-picture" class="team-pic-caption">'.$params->get('team_pic_caption').'</p>';
							endif; ?>
					<?php else : ?>
						<img class="team-preview" height="150px" itemprop="image" src="/images/default_team.png">
					<?php endif; ?>
					
					<? /*! FACEBOOK LIKE BUTTON */ ?>
					<?php if(!is_null($params->get('fb_like')) && $params->get('fb_like') == 1) : ?>
    					<div class="noPrint">
    						<div class="fb-like">
    							<fb:like href="http://www.svwiesbaden1899.de<?php echo $_SERVER['REQUEST_URI']; ?>" send="true" width="450" show_faces="false"></fb:like>
    						</div>
    					</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>
            <div class="content">
                <?php echo $this->item->introtext; ?>
            </div>
        </article>
    </section>
<?php else : ?>
<?php
if (!empty($this->item->pagination) AND $this->item->pagination && !$this->item->paginationposition && $this->item->paginationrelative)
{
 echo $this->item->pagination;
}
 ?>
<section class="page-item ac image-left <?php echo $this->pageclass_sfx;?>">

<?php /*! PAGE HEADER */
 if ($this->params->get('show_page_heading', 1)) : ?>
<header>
	<h1>
	<?php echo $this->escape($this->params->get('page_heading')); ?>
	</h1>
</header>
<?php endif; ?>
<article id="page-article" class="item-page<?php echo $this->pageclass_sfx?> group" itemscope itemtype="http://schema.org/Article">
<? /*! HEADER */ ?>

<?php if ($params->get('show_title')) : ?>
<header>
	<h2  itemprop="headline">
	<?php if ($params->get('link_titles') && !empty($this->item->readmore_link)) : ?>
		<a href="<?php echo $this->item->readmore_link; ?>"><span  itemprop="name">
		<?php echo $this->escape($this->item->title); ?></span></a>
	<?php else : ?>
		<span  itemprop="name"><?php echo $this->escape($this->item->title); ?></span>
	<?php endif; ?>
	</h2>
	
<? /*! DETAILS */ ?>
<?php $useDefList = (($params->get('show_author')) or ($params->get('show_category')) or ($params->get('show_parent_category'))
	or ($params->get('show_create_date')) or ($params->get('show_modify_date')) or ($params->get('show_publish_date'))
	or ($params->get('show_hits'))); ?>
<?php if ($useDefList) : ?>
	<ul class="meta article-info">
	<li class="subtitle article-info-term" itemprop="genre">
		<?php if ($params->get('show_parent_category') && $this->item->parent_slug != '1:root') : ?>
			<?php	$title = $this->escape($this->item->parent_title);
			$url = '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->parent_slug)).'">'.$title.'</a>';?>
			<?php if ($params->get('link_parent_category') and $this->item->parent_slug) : ?><? /*! PARENT CATEGORY */ ?>
				<?php echo JText::sprintf('TPL_SVW_COM_CONTENT_PARENT', $url); ?>
			<?php else : ?>
				<?php echo JText::sprintf('TPL_SVW_CONTENT_PARENT', $title); ?>
			<?php endif; ?>
		<?php endif; ?>
	</li><li>
		<?php if ($params->get('show_category')) : ?><? /*! CATEGORY  */ ?>
		<?php 	$title = $this->escape($this->item->category_title);
		$url = '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catslug)).'">'.$title.'</a>';?>
		<?php if ($params->get('link_category') and $this->item->catslug) : ?>
			<?php echo JText::sprintf('TPL_SVW_COM_CONTENT_CATEGORY', $url); ?>
		<?php else : ?>
			<?php echo JText::sprintf('TPL_SVW_COM_CONTENT_CATEGORY', $title); ?>
		<?php endif; ?>
		<?php endif; ?>	
	</li>	
	<?php if ($params->get('show_create_date')) : ?><? /*! CREATE DATE */ ?>
		<li class="create">
		<?php echo JText::sprintf('TPL_SVW_COM_CONTENT_CREATED_DATE_ON', JHtml::_('date', $this->item->created, JText::_('DATE_FORMAT_LC2'))); ?>
		</li>
		<li itemprop="dateCreated" style="display:none"><?php echo $this->item->created; ?></li>
	<?php endif; ?>
	<?php if ($params->get('show_modify_date')) : ?><? /*! MODIFY */ ?>
		<li class="modified">
		<?php echo JText::sprintf('TPL_SVW_COM_CONTENT_LAST_UPDATED', JHtml::_('date', $this->item->modified, JText::_('DATE_FORMAT_LC2'))); ?>	
		</li>
		<li itemprop="dateModified" style="display:none"><?php echo $this->item->modified; ?></li>
	<?php endif; ?>
	<?php if ($params->get('show_publish_date')) : ?><? /*! PUBLISHED */ ?>
		<li class="published"><?php echo JHtml::_('date', $this->item->publish_up, JText::_('DATE_FORMAT_LC2')); ?></li>
		<li itemprop="datePublished" style="display:none"><?php echo $this->item->publish_up; ?></li>
	<?php endif; ?>
	<?php if ($params->get('show_author') && !empty($this->item->author )) : ?>
		<li class="createdby">
		<?php $author = $this->item->author; ?>
		<?php $author = ($this->item->created_by_alias ? $this->item->created_by_alias : $author); ?>
		<?php if (!empty($this->item->contactid) && $params->get('link_author') == true): ?>
		<?php
			$needle = 'index.php?option=com_contact&view=contact&id=' . $this->item->contactid;
			$menu = JFactory::getApplication()->getMenu();
			$item = $menu->getItems('link', $needle, true);
			$cntlink = !empty($item) ? $needle . '&Itemid=' . $item->id : $needle;
		?>
			<?php echo JText::sprintf('TPL_SVW_COM_CONTENT_WRITTEN_BY', JHtml::_('link', JRoute::_($cntlink), $author)); ?>
		<?php else: ?>
			<?php echo $author; ?>
		<?php endif; ?>
		</li>
		<li  itemprop="author" style="display:none"><?php echo $author; ?></li>
	<?php endif; ?>
	<?php if ($params->get('show_hits')) : ?>
		<li class="hits">
		<?php echo JText::sprintf('TPL_SVW_COM_CONTENT_ARTICLE_HITS', $this->item->hits); ?>
		</li>
	<?php endif; ?>
<?php endif; ?>
<?php if ($useDefList) : ?>
	</ul>
<?php endif; ?>
</header>
<?php endif; ?>

<?php  if (!$params->get('show_intro')) :
	echo $this->item->event->afterDisplayTitle;
endif; ?>

<? /*! MENU */ ?>
<?php if ($canEdit ||  $params->get('show_print_icon') || $params->get('show_email_icon')) : ?>	
<menu>
	<ul class="meta">			
	<?php if (!$this->print) : ?>
		<?php if ($params->get('show_print_icon')) : ?>
			<li class="print-icon">
			<?php echo JHtml::_('icon.print_popup',  $this->item, $params); ?>
			</li>
		<?php endif; ?>

		<?php if ($params->get('show_email_icon')) : ?>
			<li class="email-icon">
			<?php echo JHtml::_('icon.email',  $this->item, $params); ?>
			</li>
		<?php endif; ?>

		<?php if ($canEdit) : ?>
			<li class="edit-icon">
			<?php echo JHtml::_('icon.edit', $this->item, $params); ?>
			</li>
		<?php endif; ?>
	<?php else : ?>
		<li>
		<?php echo JHtml::_('icon.print_screen',  $this->item, $params); ?>
		</li>
	<?php endif; ?>
	</ul>
</menu>
<?php endif; ?>


<? /*! FACEBOOK LIKE BUTTON */ ?>
<?php if(!is_null($params->get('fb_like')) && $params->get('fb_like') == 1) : ?>
<? /*    <div class="fb-like" data-href="http://www.svwiesbaden1899.de<?php echo $_SERVER['REQUEST_URI']; ?>" data-send="true" data-width="450" data-show-faces="false"></div> */?>
    <div class="fb-like">
        <fb:like href="http://www.svwiesbaden1899.de<?php echo $_SERVER['REQUEST_URI']; ?>" send="true" width="450" show_faces="false"></fb:like>
    </div>
<?php endif; ?>

<?php echo $this->item->event->beforeDisplayContent; ?>


<? /* TOC */ ?>
<?php if (isset ($this->item->toc)) : ?>
	<?php echo $this->item->toc; ?>
<?php endif; ?>

<?php if (isset($urls) AND ((!empty($urls->urls_position) AND ($urls->urls_position=='0')) OR  ($params->get('urls_position')=='0' AND empty($urls->urls_position) ))
		OR (empty($urls->urls_position) AND (!$params->get('urls_position')))): ?>
<?php echo $this->loadTemplate('links'); ?>
<?php endif; ?>

<?php if ($params->get('access-view')):?>
<?php  if (isset($images->image_fulltext) and !empty($images->image_fulltext)) : ?>
<?php $imgfloat = (empty($images->float_fulltext)) ? $params->get('float_fulltext') : $images->float_fulltext; ?>
<div class="image-feat" style="width:150px;">
    <?php 
        $pdf_url = substr(htmlspecialchars($images->image_fulltext),0,-4).".pdf";
		$full_img_url = str_replace("_tb","",htmlspecialchars($images->image_fulltext));
        echo '<!-- '.$pdf_url.' -->';
        if(file_exists($pdf_url)) :
    ?>
		<a href="<?php echo $pdf_url; ?>" title="PDF herunterladen" target="_blank">
			<?php endif; ?>
			<?php if(!file_exists($pdf_url)) : ?>
					<a href="<?php if(file_exists($full_img_url)) echo htmlspecialchars($full_img_url); else echo htmlspecialchars($images->image_fulltext); ?>" title="Bild im neuem Tab &ouml;ffnen" target="_blank">
			<?php endif; ?>			
        <? /* IMG FILE */ ?>
        <img itemprop="image"
        	<?php if ($images->image_fulltext_caption):
        		echo 'class="img-caption"'.' title="' .htmlspecialchars($images->image_fulltext_caption) .'"';
        	endif; ?>
        	src="<?php echo htmlspecialchars($images->image_fulltext); ?>" alt="<?php echo htmlspecialchars($images->image_fulltext_alt); ?>"/>
        <? /* IMG FILE END */ ?>
		</a>
		<?php if ($images->image_intro_caption):
			echo '<p class="img-caption-text">'.htmlspecialchars($images->image_intro_caption) .'</p>';
		endif; ?>
</div>
<?php endif; ?>

<?php
if (!empty($this->item->pagination) AND $this->item->pagination AND !$this->item->paginationposition AND !$this->item->paginationrelative):
	echo $this->item->pagination;
 endif;
?>
<div class="content">
<?php echo $this->item->text; ?>
</div>
<?php
if (!empty($this->item->pagination) AND $this->item->pagination AND $this->item->paginationposition AND!$this->item->paginationrelative):
	 echo $this->item->pagination;?>
<?php endif; ?>

<?php if (isset($urls) AND ((!empty($urls->urls_position)  AND ($urls->urls_position=='1')) OR ( $params->get('urls_position')=='1') )): ?>
<?php echo $this->loadTemplate('links'); ?>
<?php endif; ?>
	<?php //optional teaser intro text for guests ?>
<?php elseif ($params->get('show_noauth') == true and  $user->get('guest') ) : ?>
	<?php echo $this->item->introtext; ?>
	<?php //Optional link to let them register to see the whole article. ?>
	<?php if ($params->get('show_readmore') && $this->item->fulltext != null) :
		$link1 = JRoute::_('index.php?option=com_users&view=login');
		$link = new JURI($link1);?>
		<p class="readmore">
		<a href="<?php echo $link; ?>">
		<?php $attribs = json_decode($this->item->attribs);  ?>
		<?php
		if ($attribs->alternative_readmore == null) :
			echo JText::_('COM_CONTENT_REGISTER_TO_READ_MORE');
		elseif ($readmore = $this->item->alternative_readmore) :
			echo $readmore;
			if ($params->get('show_readmore_title', 0) != 0) :
			    echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
			endif;
		elseif ($params->get('show_readmore_title', 0) == 0) :
			echo JText::sprintf('COM_CONTENT_READ_MORE_TITLE');
		else :
			echo JText::_('COM_CONTENT_READ_MORE');
			echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
		endif; ?></a>
		</p>
	<?php endif; ?>
<?php endif; ?>
<?php
if (!empty($this->item->pagination) AND $this->item->pagination AND $this->item->paginationposition AND $this->item->paginationrelative):
	 echo $this->item->pagination;?>
<?php endif; ?>

<?php echo $this->item->event->afterDisplayContent; ?>
</article>
</section>

<? endif;  // areatype or else ?>