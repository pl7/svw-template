<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_articles_news
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
$cssCategory = $params->get('moduleclass_sfx');
$item_heading = $params->get('item_heading', 'h4');
$canEdit = JFactory::getUser()->authorise('core.edit', 'com_languages');

?>
<section class="page-item ac image-left <?php echo $cssCategory;?>">
    <header>
        <h1><?php echo $params->get('newsTitle'); ?></h1>
    </header>
<?php foreach ($list as $item) :?>
<article itemscope itemtype="http://schema.org/Article" <?php if ($item->state == 0)  echo ' class="system-unpublished"'; ?>  class="<?php echo 'cat-'.$item->catid.' parent-'.$item->parent_id; ?>">

    <? /* !BLOG ITEM CATEGORY */ ?>
    
    <h6 class="category cat" property="genre">
    	<?php if ($item->parent_id != 1) : ?>
    		<?php $title = $item->parent_title;
    		$url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($item->parent_id)) . '">' . $title . '</a>'; ?>
    		<?php echo JText::sprintf('COM_CONTENT_PARENT_SHORT', $url); ?>
    	<?php endif; ?>
    	
        <?php if($item->parent_id != 1) : ?><img src="./media/system/images/arrow.png"/><?php endif; ?>
        
        <?php  $title = $item->category_title;
    	       echo JText::sprintf('COM_CONTENT_CATEGORY_SHORT', $title); ?>
    </h6>    
    
    <?php /*!IMAGE */  ?>
    <?php $images = json_decode($item->images); ?>
	<div class="image-feat" style="width:100px;">
	<a href="<?php echo $item->link; ?>">
    	<img itemprop="image" alt="<?php echo htmlspecialchars($images->image_intro_alt); ?>" src="<?php echo htmlspecialchars($images->image_intro); ?>" title="<?php echo $item->title;?>"/>
	</a>
	</div>
	    
    <?php // HEADER ?>
    <header>
    	<?php echo'<a href="'.$item->link.'">'; ?>
    		<h2 class="title" itemprop="headline"><?php echo $item->title; ?></h2>
    	<?php echo'</a>'; ?>
    </header>

    	
    <?php // MENU ?>
    <?php if ($params->get('show_print_icon') || $params->get('show_email_icon') || $canEdit) : ?>
    <menu>
    	<ul class="actions">
    		<?php if ($params->get('show_print_icon')) : ?>
    		<li class="print-icon">
    			<?php echo JHtml::_('icon.print_popup', $item, $params); ?>
    		</li>
    		<?php endif; ?>
    		<?php if ($params->get('show_email_icon')) : ?>
    		<li class="email-icon">
    			<?php echo JHtml::_('icon.email', $item, $params); ?>
    		</li>
    		<?php endif; ?>
    		<?php if ($canEdit) : ?>
    		<li class="edit-icon">
    			<?php echo JHtml::_('icon.edit', $item, $params); ?>
    		</li>
    		<?php endif; ?>
    	</ul>
    </menu>
    <?php endif; ?>
    
    <?php /* !CONTENT */ ?>
    <div class="content">
    <?php echo $item->introtext.$params->get('access-view'); ?>
    
    <?php if (isset($item->link) && $item->readmore != 0 && $params->get('readmore')) : ?>
    <p style="text-align:right;"><a class="readmore" itemprop="url" href="<?php echo $item->link; ?>">
    <?php 
        echo $item->linkText; 
    ?>
    </a></p>
    <?php endif; ?>
    </div>
    
    <?php //! FOOTER ?>
    <footer style="margin-left: 115px;">
        <header style="display:none"><h3>Beitragsinformationen: <?php echo $item->title; ?></h3></header>	
    	<?php //! AUTHOR AND PUBLISHED DATE ?>
		<ul class="meta">
			<li class="published"><?php echo JHtml::_('date', $item->publish_up, JText::_('DATE_FORMAT_LC2')); ?></li>
			<li itemprop="datePublished" style="display:none"><?php echo $item->publish_up; ?></li>
			<li class="createdby">
			<?php   
				$author = $item->author; 
			    $author = ($item->created_by_alias ? $item->created_by_alias : $author);
			    echo $item->author; 
			?>
			</li>
		</ul>
    </footer>

</article>
<?php endforeach; ?>
</section>

