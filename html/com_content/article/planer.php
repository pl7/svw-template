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


    <section class="page-item" id="team_HEADER" teamkey="<?php echo $params->get('team_key'); ?>" itemscope itemtype="http://schema.org/Organization" typeof="SportsTeam">
        <?php /*! PAGE HEADER */
         if ($this->params->get('show_page_heading', 1)) : ?>
        <header>
        	<h1>
        	<?php echo $this->escape($this->params->get('page_heading')); ?>
        	</h1>
        </header>
        <?php endif; ?>
        <article class="ac" id="team-info">
            <header>
                <h1 itemprop="name"><?php echo $this->escape($this->params->get('page_heading')); ?></h1>
            </header>
            <?php if ($params->get('access-view')):?>
            <?php if (isset($images->image_fulltext) and !empty($images->image_fulltext)) : ?>
            <?php $imgfloat = (empty($images->float_fulltext)) ? $params->get('float_fulltext') : $images->float_fulltext; ?>
            <div class="teamplaner">
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
                    <img class="timetable-month" itemprop="image"
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
            <?php endif; ?>

        </article>
    </section>
