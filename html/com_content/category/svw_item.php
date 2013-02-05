<?php
/**
 * @package		Joomla.Site
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

// Create a shortcut for params.
$params = &$this->item->params;
$images = json_decode($this->item->images);
$canEdit	= $this->item->params->get('access-edit');
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');

?>
<article itemscope itemtype="http://schema.org/Article" <?php if ($this->item->state == 0)  echo ' class="system-unpublished"'; ?>  class="ac <?php echo 'cat-'.$this->item->catid.' parent-'.$this->item->parent_id; ?>">

<? /* !BLOG ITEM CATEGORY */ ?>
<?php if ($params->get('show_category') or ($params->get('show_parent_category'))) : ?>
<h6 class="category cat" property="genre">
	<?php if ($params->get('show_parent_category') && $this->item->parent_id != 1) : ?>
		<?php $title = $this->escape($this->item->parent_title);
			$url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->parent_id)) . '">' . $title . '</a>'; ?>
		<?php if ($params->get('link_parent_category')) : ?>
			<?php echo JText::sprintf('COM_CONTENT_PARENT_SHORT', $url); ?>
		<?php else : ?>
			<?php echo JText::sprintf('COM_CONTENT_PARENT_SHORT', $title); ?>
		<?php endif; ?>
	<?php endif; ?>
	    <?php if($params->get('show_parent_category')) : ?><img src="./media/system/images/arrow.png"/><?php endif; ?>
    <?php $title = $this->escape($this->item->category_title);
			$url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catid)) . '">' . $title . '</a>'; ?>
	<?php if ($params->get('link_category')) : ?>
		<?php echo JText::sprintf('COM_CONTENT_CATEGORY_SHORT', $url); ?>
		<?php else : ?>
		<?php echo JText::sprintf('COM_CONTENT_CATEGORY_SHORT', $title); ?>
	<?php endif; ?> 
</h6>
<?php endif; ?>

<?php // IMAGE  ?>
<?php  if (isset($images->image_intro) and !empty($images->image_intro)) : ?>
	<div class="image-feat" style="width:100px;">
	<a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid)); ?>">
    	<img itemprop="image"
    		<?php if ($images->image_intro_caption):
    			echo 'class="img-caption"'.' title="' .htmlspecialchars($images->image_intro_caption) .'"';
    		endif; ?>
    		src="<?php echo htmlspecialchars($images->image_intro); ?>" alt="<?php echo htmlspecialchars($images->image_intro_alt); ?>"/>
	</a>
	<?php if ($images->image_intro_caption):
		echo '<p class="img-caption-text">'.htmlspecialchars($images->image_intro_caption) .'</p>';
	endif; ?>
	</div>
<?php endif; ?>

<?php // !HEADER 
?>
<header>
	<?php if ($params->get('show_title')) : ?>
    <div style="float: left;margin-right: 1em;">
        <div class="svwDate month"><?php echo JHtml::_('date', $this->item->created, JText::_('DATE_FORMAT_SVW_MONTH')); ?></div>
        <div class="svwDate date"><?php echo JHtml::_('date', $this->item->created, JText::_('DATE_FORMAT_SVW_DATE')); ?></div>
        <div class="svwDate day"><?php echo JHtml::_('date', $this->item->created, JText::_('DATE_FORMAT_SVW_DAY')); ?></div>
    </div>
	<?php if ($params->get('link_titles') && $params->get('access-view')) echo'<a href="'.JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid)).'">'; ?>
        <h2 class="title" itemprop="headline">
            <?php echo $this->escape($this->item->title); ?>
        </h2>
	<?php if ($params->get('link_titles') && $params->get('access-view')) echo'</a>'; ?>
	<h6 class="subtitle" property="alternativeHeadline" style="display:none">Untertitle</h6>
	<?php endif; ?>	
	
	<?php // !MENU ?>
	<?php if ($params->get('show_print_icon') || $params->get('show_email_icon') || $canEdit) : ?>
	<menu>
		<ul class="actions">
			<?php if ($params->get('show_print_icon')) : ?>
			<li class="print-icon">
				<?php echo JHtml::_('icon.print_popup', $this->item, $params); ?>
			</li>
			<?php endif; ?>
			<?php if ($params->get('show_email_icon')) : ?>
			<li class="email-icon">
				<?php echo JHtml::_('icon.email', $this->item, $params); ?>
			</li>
			<?php endif; ?>
			<?php if ($canEdit) : ?>
			<li class="edit-icon">
				<?php echo JHtml::_('icon.edit', $this->item, $params); ?>
			</li>
			<?php endif; ?>
		</ul>
	</menu>
	<?php endif; ?>
</header>


<?php // !CONTENT ?>
<div class="content">
<?php echo $this->item->introtext;?>

<?php if ($params->get('show_readmore') && $this->item->readmore) :
	if ($params->get('access-view')) :
		$link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
	else :
		$menu = JFactory::getApplication()->getMenu();
		$active = $menu->getActive();
		$itemId = $active->id;
		$link1 = JRoute::_('index.php?option=com_users&view=login&Itemid=' . $itemId);
		$returnURL = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
		$link = new JURI($link1);
		$link->setVar('return', base64_encode($returnURL));
	endif;
?><p style="text-align:right;"><a class="readmore" itemprop="url" href="<?php echo $link; ?>">
		<?php if (!$params->get('access-view')) :
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
		endif; ?></a></p>
<?php endif; ?>
</div>

<?php // FOOTER ?>
<?php if (($params->get('show_author')) or ($params->get('show_category')) or ($params->get('show_parent_category')) or ($params->get('show_publish_date'))) : ?>
<footer style="margin-left: 115px;">
    <header style="display:none"><h3>Beitragsinformationen: <?php echo $this->escape($this->item->title); ?></h3></header>	
	<?php // AUTHOR AND PUBLISHED DATE ?>
	<?php if ($params->get('show_publish_date') or ($params->get('show_author') && !empty($this->item->author ))) : ?>
		<ul class="meta">
			<?php // CREATE DATE ?>
			<?php if ($params->get('show_create_date')) : ?>
				<li class="created"><?php echo JText::sprintf('COM_CONTENT_CREATED_DATE_ON', JHtml::_('date', $this->item->created, JText::_('DATE_FORMAT_LC2'))); ?></li>
			<?php endif; ?>			
			<?php // CREATE DATE ?>
			<?php if ($params->get('show_modify_date')) : ?>
				<li class="modified"><?php echo JText::sprintf('COM_CONTENT_LAST_UPDATED', JHtml::_('date', $this->item->modified, JText::_('DATE_FORMAT_LC2'))); ?></li>
			<?php endif; ?>
			<?php // HITS ?>
			<?php if ($params->get('show_hits')) : ?>
					<li class="hits"><?php echo JText::sprintf('COM_CONTENT_ARTICLE_HITS', $this->item->hits); ?></li>
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
					<?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', JHtml::_('link', JRoute::_($cntlink), $author)); ?>
				<?php else: ?>
					<?php echo $this->item->author; ?>
				<?php endif; ?>
				</li>
			<?php endif; ?>
		</ul>
	<?php endif; ?>
	
</footer>
<?php endif; ?>

</article>