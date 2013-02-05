<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_articles_category
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
?>
<section id="slideShow">
<header style="display:none">
    <h2>Slideshow</h2>
</header>
<div class="slideWindow category-module<?php echo $moduleclass_sfx; ?>">
<div id="slider">
<?php if ($grouped) : ?>
	<?php foreach ($list as $group_name => $group) : ?>
   <div class="slideItemGroupList">
		<h<?php echo $item_heading; ?>><?php echo $group_name; ?></h<?php echo $item_heading; ?>>
		<div class="slideItemGroup">
   			<?php foreach ($group as $item) : ?>
   			  <div class="slideItem">
					<h<?php echo $item_heading+1; ?>>
					   	<?php if ($params->get('link_titles') == 1) : ?>
						<a class="mod-articles-category-title <?php echo $item->active; ?>" 
						      href="<?php echo  JRoute::_(ContentHelperRoute::getCategoryRoute($item->parent_id)); ?>">
						<?php echo $item->title; ?>
				        <?php if ($item->displayHits) :?>
							<span class="mod-articles-category-hits">
				            (<?php echo $item->displayHits; ?>)  </span>
				        <?php endif; ?></a>
				        <?php else :?>
				        <?php echo $item->title; ?>
				        	<?php if ($item->displayHits) :?>
							<span class="mod-articles-category-hits">
				            (<?php echo $item->displayHits; ?>)  </span>
				        <?php endif; ?></a>
				            <?php endif; ?>
			        </h<?php echo $item_heading+1; ?>>


				<?php if ($params->get('show_author')) :?>
					<span class="mod-articles-category-writtenby">
					<?php echo $item->displayAuthorName; ?>
					</span>
				<?php endif;?>

				<?php if ($item->displayCategoryTitle) :?>
					<span class="mod-articles-category-category">
					(<?php echo $item->displayCategoryTitle; ?>)
					</span>
				<?php endif; ?>
				<?php if ($item->displayDate) : ?>
					<span class="mod-articles-category-date"><?php echo $item->displayDate; ?></span>
				<?php endif; ?>
				<?php if ($params->get('show_introtext')) :?>
			<p class="mod-articles-category-introtext">
			<?php echo $item->displayIntrotext; ?>
			</p>
		<?php endif; ?>

		<?php if ($params->get('show_readmore')) :?>
			<p class="mod-articles-category-readmore">
				<a class="mod-articles-category-title <?php echo $item->active; ?>" href="<?php echo $item->link; ?>">
				<?php if ($item->params->get('access-view')== FALSE) :
						echo JText::_('MOD_ARTICLES_CATEGORY_REGISTER_TO_READ_MORE');
					elseif ($readmore = $item->alternative_readmore) :
						echo $readmore;
						echo JHtml::_('string.truncate', $item->title, $params->get('readmore_limit'));
						if ($params->get('show_readmore_title', 0) != 0) :
							echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
						endif;
					elseif ($params->get('show_readmore_title', 0) == 0) :
						echo JText::sprintf('MOD_ARTICLES_CATEGORY_READ_MORE_TITLE');
					else :

						echo JText::_('MOD_ARTICLES_CATEGORY_READ_MORE');
						echo JHtml::_('string.truncate', ($item->title), $params->get('readmore_limit'));
					endif; ?>
	        </a>
			</p>
			<?php endif; ?>
			</div><? // slideItem ?> 
			<?php endforeach; ?>
        </div><? // slideItemGroup ?>
	</div><? // slideItemGroupList ?>
	<?php endforeach; ?>
<?php else : ?>
    <?php $item_count = 1; ?>
	<?php foreach ($list as $item) : ?>
	<?php 
	   $images = json_decode($item->images); 
	   $img_url = htmlspecialchars($images->image_intro);
	   if(strlen($img_url) == 0)
	       $img_url = '/images/bg/default_teaser.png';
	?>
		<div id="slideItem_<?php echo $item_count;?>" class="slideItem" style="background-image: url('<?php echo $img_url; ?>');">		  
            <style type="text/css">
        	#slideItem_<?php echo $item_count;?>, .slideWindow .select_pos<?php echo $item_count;?> {
            	filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo $img_url; ?>', sizingMethod='scale');
                -ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo $img_url; ?>', sizingMethod='scale')";    
            }
        	</style>
    		<?php $item_count++ ?>
    		
            <div class="teaserText">
            
        		<?php if ($item->displayCategoryTitle) :?>
        			<span class="mod-articles-category-category">
        			<?php echo $item->displayCategoryTitle; ?>
        			</span>
        		<?php endif; ?>
                
        	   	<h<?php echo $item_heading; ?>>
        	   	<?php if ($params->get('link_titles') == 1) : ?>
        		<a class="mod-articles-category-title <?php echo $item->active; ?>" 
        		  href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($item->slug, $item->catid)); ?>">
        		<?php echo $item->title; ?>
                <?php if ($item->displayHits) :?>
        			<span class="mod-articles-category-hits">
                    (<?php echo $item->displayHits; ?>)  </span>
                <?php endif; ?></a>
                <?php else :?>
                <?php echo $item->title; ?>
                	<?php if ($item->displayHits) :?>
        			<span class="mod-articles-category-hits">
                    (<?php echo $item->displayHits; ?>)  </span>
                <?php endif; ?></a>
                    <?php endif; ?>
                </h<?php echo $item_heading; ?>>
                
               	<?php if ($params->get('show_author')) :?>
               		<span class="mod-articles-category-writtenby">
        			<?php echo $item->displayAuthorName; ?>
        			</span>
        		<?php endif;?>
        		<?php if ($item->displayDate) : ?>
        			<span class="mod-articles-category-date"><?php echo $item->displayDate; ?></span>
        		<?php endif; ?>

        		<?php # if ($params->get('show_introtext')) :
            		if (false) :
        		?>
        			<a class="mod-articles-category-title <?php echo $item->active; ?>" 
        			 href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($item->slug, $item->catid)); ?>">
            			<p class="mod-articles-category-introtext">
                			<?php echo $item->displayIntrotext; ?>
            			</p>
        			</a>
        		<?php endif; ?>
        
        		<?php if ($params->get('show_readmore')) :?>
        			<p class="mod-articles-category-readmore">
        				<a class="mod-articles-category-title <?php echo $item->active; ?>" href="<?php echo $item->link; ?>">
        		        <?php if ($item->params->get('access-view')== FALSE) :
        						echo JText::_('MOD_ARTICLES_CATEGORY_REGISTER_TO_READ_MORE');
        					elseif ($readmore = $item->alternative_readmore) :
        						echo $readmore;
        						echo JHtml::_('string.truncate', $item->title, $params->get('readmore_limit'));
        					elseif ($params->get('show_readmore_title', 0) == 0) :
        						echo JText::sprintf('MOD_ARTICLES_CATEGORY_READ_MORE_TITLE');
        					else :
        						echo JText::_('MOD_ARTICLES_CATEGORY_READ_MORE');
        						echo JHtml::_('string.truncate', $item->title, $params->get('readmore_limit'));
        					endif; ?>
        	        </a>
        			</p>
        		<?php endif; ?>
            </div>
		</div><? // slideItem ?>
	<?php endforeach; ?>
<?php endif; ?>
</div><? // SLIDE CONTAINER ?>

	<?php $item_count = 1; ?>
	<?php if(sizeof($list) > 1) : ?>
	<?php foreach ($list as $item) : ?>
    	<?php 
    	   $images = json_decode($item->images); 
    	   $img_url = $images->image_intro;
    	   if(strlen($img_url) == 0){
        	   $img_url = "images/bg/default_teaser.png";
    	   }
    	?>
		<div id="slideItemSelect_<?php echo $item_count; ?>" class="slideItemSelect select_pos<?php echo $item_count; ?>" style="background-image: url('<?php echo $img_url; ?>');" onclick="clickSlide(<?php echo $item_count; ?>)">&nbsp;</div>
		<?php $item_count++;?>
	<?php endforeach; ?>
	<?php endif; ?>
	
</div><? // SLIDE WINDOW /*?>
<script type="text/javascript">slideShow();</script>
</section>