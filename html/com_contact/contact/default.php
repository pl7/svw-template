<?php
 /**
 * @package		Joomla.Site
 * @subpackage	com_contact
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$doc =& JFactory::getDocument();   
$doc->addStylesheet("/templates/svw/css/contact.css");
$doc->addScript("/templates/svw/js/menuTabs.js");

$cparams = JComponentHelper::getParams ('com_media');

$default_tab = isset($_GET['tab']) ? $_GET['tab'] : 'basic-details';
$is_basic_active = isset($_GET['tab']) &&  $_GET['tab'] == 'basic-details';
$is_display_form = isset($_GET['tab']) &&  $_GET['tab'] == 'display-form';

if(!$is_display_form && !$is_basic_active) { $is_basic_active = true;}

?>
<script type="text/javascript">
    var currentContactTab = '<?php echo $default_tab; ?>';
</script>

<section class="panel-item ac <?php echo $this->pageclass_sfx?>" id="contact-page">
    <?php  if ($this->params->get('presentation_style')=='tabs') : ?>
    <menu id="tabMenu" class="contact-tabs active-<?php echo $default_tab ?>"> 
	    <?php /* !Contact Tab */ ?>
	    <ul>
   		    <li class="basic-details <?php if($is_basic_active) echo 'active'; ?>">
   		       <a onclick="toggleContactTab('basic-details')"><?php echo JText::_('COM_CONTACT_DETAILS'); ?></a>
   		    </li>
   		    <?php if ($this->params->get('show_email_form') && ($this->contact->email_to || $this->contact->user_id)) : ?>
   		    <li class="display-form <?php if($is_display_form) echo 'active'; ?>">
   		       <a onclick="toggleContactTab('display-form')"><?php echo JText::_('COM_CONTACT_EMAIL_FORM'); ?></a>
   		    </li>
		    <?php endif;  ?>
	    </ul>
	</menu>
    <?php endif; ?>
    <?php /* !Header */ ?>
    <header class="border-top-orange" <?php if ($this->params->get('show_page_heading')) echo 'style="display:none"'; ?>>
        <h1><?php echo $this->escape($this->params->get('page_heading')); ?></h1>
    </header>
    
    <article  class="border-top-blue <?php echo $default_tab ?>-tab" id="contact-page-item">
    	<?php if ($this->contact->image && $this->params->get('show_image')) : ?>
		<div class="contact-image">
			<?php echo JHtml::_('image', $this->contact->image, JText::_('COM_CONTACT_IMAGE_DETAILS'), array('align' => 'middle')); ?>
		</div>
    	<?php endif; ?>
        <?php /* !Contact Page Item */ ?>
    	<header <?php if (!($this->contact->name && $this->params->get('show_name'))) echo 'style="display:none"'; ?>>
    		<h2>
    			<span class="contact-name"><?php echo $this->contact->name; ?></span>
    		</h2>
    		<h4 <?php if (!($this->params->get('show_contact_category') == 'show_no_link') && !($this->params->get('show_contact_category') == 'show_with_link')) echo 'style="display:none"'; ?>>
        		<?php if($this->params->get('show_contact_category') == 'show_with_link') : ?>
        		<?php $contactLink = ContactHelperRoute::getCategoryRoute($this->contact->catid);?>
        		<span class="contact-category"><a href="<?php echo $contactLink; ?>">
    				<?php echo $this->escape($this->contact->category_title); ?></a>
    			</span>
        		<?php elseif($this->params->get('show_contact_category') == 'show_no_link') : ?>
    			<span class="contact-category"><?php echo $this->contact->category_title; ?></span>
    			<?php endif;  ?>
    		</h4>
    	</header>
    	
        <?php /* !CONTACT LIST */ ?>
    	<?php if ($this->params->get('show_contact_list') && count($this->contacts) > 1) : ?>
    		<form action="#" method="get" name="selectForm" id="selectForm">
    			<?php echo JText::_('COM_CONTACT_SELECT_CONTACT'); ?>
    			<?php echo JHtml::_('select.genericlist',  $this->contacts, 'id', 'class="inputbox" onchange="document.location.href = this.value"', 'link', 'name', $this->contact->link);?>
    		</form>
    	<?php endif; ?>
    	
    	<?php if ($this->params->get('presentation_style')=='plain'):?>
    		<?php  echo '<h3>'. JText::_('COM_CONTACT_DETAILS').'</h3>';  ?>
    	<?php endif; ?>
    	
        <?php /* !CONTACT Details */ ?>
        <div class="contact-details">
    
    	<?php if ($this->contact->con_position && $this->params->get('show_position')) : ?>
    		<h5 class="contact-position"><?php echo $this->contact->con_position; ?></h5>
    	<?php endif; ?>
        <?php /* !ADDRESS */ ?>
    	<?php echo $this->loadTemplate('address'); ?>
    
    	<?php if ($this->params->get('allow_vcard')) :	?>
    		<?php echo JText::_('COM_CONTACT_DOWNLOAD_INFORMATION_AS');?>
    			<a href="<?php echo JRoute::_('index.php?option=com_contact&amp;view=contact&amp;id='.$this->contact->id . '&amp;format=vcf'); ?>">
    			<?php echo JText::_('COM_CONTACT_VCARD');?></a>
    	<?php endif; ?>
        </div>
    	<p></p>
        <?php /* !E-MAIL FORM */ ?>
        <div class="e-mail-form">
    	<?php if ($this->params->get('show_email_form') && ($this->contact->email_to || $this->contact->user_id)) : ?>
        	<h4 class="show-email-form-header">
        		<?php  echo JText::_('COM_CONTACT_EMAIL_FORM');  ?>
    		</h4>
    		<?php  echo $this->loadTemplate('form');  ?>
    	<?php endif; ?>
        </div>

        <?php /* !LINKS */ ?>     	
    	<?php if ($this->params->get('show_links')) : ?>
    		<?php echo $this->loadTemplate('links'); ?>
    	<?php endif; ?>
    	
        <?php /* !ARTICLES */ ?>     	
    	<?php if ($this->params->get('show_articles') && $this->contact->user_id && $this->contact->articles) : ?>
    		<?php if ($this->params->get('presentation_style')!='plain'):?>
    			<?php echo JHtml::_($this->params->get('presentation_style').'.panel', JText::_('JGLOBAL_ARTICLES'), 'display-articles'); ?>
    			<?php endif; ?>
    			<?php if  ($this->params->get('presentation_style')=='plain'):?>
    			<?php echo '<h3>'. JText::_('JGLOBAL_ARTICLES').'</h3>'; ?>
    			<?php endif; ?>
    			<?php echo $this->loadTemplate('articles'); ?>
    	<?php endif; ?>

        <?php /* !PROFILE  */ ?>
    	<?php if ($this->params->get('show_profile') && $this->contact->user_id && JPluginHelper::isEnabled('user', 'profile')) : ?>
    		<?php if ($this->params->get('presentation_style')!='plain'):?>
    			<?php echo JHtml::_($this->params->get('presentation_style').'.panel', JText::_('COM_CONTACT_PROFILE'), 'display-profile'); ?>
    		<?php endif; ?>
    		<?php if ($this->params->get('presentation_style')=='plain'):?>
    			<?php echo '<h3>'. JText::_('COM_CONTACT_PROFILE').'</h3>'; ?>
    		<?php endif; ?>
    		<?php echo $this->loadTemplate('profile'); ?>
    	<?php endif; ?>
    	<?php if ($this->contact->misc && $this->params->get('show_misc')) : ?>
    		<?php if ($this->params->get('presentation_style')!='plain'){?>
    			<?php echo JHtml::_($this->params->get('presentation_style').'.panel', JText::_('COM_CONTACT_OTHER_INFORMATION'), 'display-misc');} ?>
    		<?php if ($this->params->get('presentation_style')=='plain'):?>
    			<?php echo '<h3>'. JText::_('COM_CONTACT_OTHER_INFORMATION').'</h3>'; ?>
    		<?php endif; ?>
    				<div class="contact-miscinfo">
    					<div class="<?php echo $this->params->get('marker_class'); ?>">
    						<?php echo $this->params->get('marker_misc'); ?>
    					</div>
    					<div class="contact-misc">
    						<?php echo $this->contact->misc; ?>
    					</div>
    				</div>
    	<?php endif; ?>
    	<?php if ($this->params->get('presentation_style')!='plain'){?>
    			<?php echo JHtml::_($this->params->get('presentation_style').'.end');} ?>
    </article>
</section>
