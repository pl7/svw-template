<?php
/**
 * @package		Joomla.Site
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers');

/* Facebook App - SV Wiesbaden Homepage 
  require_once("./fb-sdk/facebook.php");

  $config = array();
  $config["appId"] = '367134453372608';
  $config["secret"] = 'fd1e26448eb2829129aa516226c43b23';
  $config["fileUpload"] = false; // optional

  $facebook = new Facebook($config);
    
/**/

$canEdit = JFactory::getUser()->authorise('core.edit', 'com_languages');

?>
<?php if($this->pageclass_sfx === 'cat-all') : ?>
<section class="contentMenu" id="newsSelection">
    <nav class="top noPrint">
    	<ul id="menu" class="menu">
            <li class=""><a href="#newsSelection" onclick="selectCategory('svw-news-all')">Alle</a></li>
            <li class=""><a href="#newsSelection" onclick="selectCategory('svw-news-profis')">1. Mannschaft</a></li>
            <li class=""><a href="#newsSelection" onclick="selectCategory('svw-news-reserve')">2. Mannschaft</a></li>
            <li class=""><a href="#newsSelection" onclick="selectCategory('svw-news-jugend')">Jugend</a></li>
            <li class=""><a href="#newsSelection" onclick="selectCategory('svw-news-general')">Allgemein</a></li>
        </ul>					
    </nav>
</section>
<?php endif; ?>
<section class="page-item ac image-left <?php echo $this->pageclass_sfx;?>">

    <?php if ($this->params->get('show_page_heading', 1)) : ?>
    <header>
    	<h1 class="page-heading">
    		<?php echo $this->escape($this->params->get('page_heading')); ?>
    	</h1>
    </header>
    <?php endif; ?>

	<?php if ($this->params->get('show_category_title', 1) or $this->params->get('page_subheading')) : ?>
	<h2 class="page-subheading">
		<?php echo $this->escape($this->params->get('page_subheading')); ?>
		<?php if ($this->params->get('show_category_title')) : ?>
			<span class="subheading-category"><?php echo $this->category->title;?></span>
		<?php endif; ?>
	</h2>
	<?php endif; ?>

	<?php $leadingcount=0 ; ?>
	<?php if (!empty($this->lead_items)) : ?>	
		<?php foreach ($this->lead_items as &$item) : ?>
			<?php $this->item = &$item; ?>
			<?php echo $this->loadTemplate('item'); ?>
			<?php $leadingcount++; ?>
		<?php endforeach; ?>		
	<?php endif; ?>
	
	<?php
		$introcount=(count($this->intro_items));
		$counter=0;
	?>
	
	<?php if (!empty($this->intro_items)) : ?>
		<?php foreach ($this->intro_items as $key => &$item) : ?>
		<?php
			$key= ($key-$leadingcount)+1;
		?>
			<?php
				$this->item = &$item;
				echo $this->loadTemplate('item');
			?>
		<?php $counter++; ?>
		<?php endforeach; ?>
	<?php endif; ?>
	<footer class="more-items">
	<?php if (!empty($this->link_items)) : ?>

		<?php echo $this->loadTemplate('links'); ?>

	<?php endif; ?>


		<?php if (!empty($this->children[$this->category->id])&& $this->maxLevel != 0) : ?>
			<div class="cat-children">
			<h3>
	<?php echo JTEXT::_('JGLOBAL_SUBCATEGORIES'); ?>
	</h3>
				<?php echo $this->loadTemplate('children'); ?>
			</div>
		<?php endif; ?>

	<?php if (($this->params->def('show_pagination', 1) == 1  || ($this->params->get('show_pagination') == 2)) && ($this->pagination->get('pages.total') > 1)) : ?>
			<div class="pagination">
							<?php  if ($this->params->def('show_pagination_results', 1)) : ?>
							<p class="counter">
									<?php echo $this->pagination->getPagesCounter(); ?>
							</p>

					<?php endif; ?>
					<?php echo $this->pagination->getPagesLinks(); ?>
			</div>
	<?php  endif; ?>
	</footer>
</section>
