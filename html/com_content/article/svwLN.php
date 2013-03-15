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

<?php /*! PAGE HEADER */
if ($this->params->get('show_page_heading', 1)) : ?>

    <section class="page-item" id="fussball-de-header" teamkey="<?php echo $params->get('team_key'); ?>" itemscope itemtype="http://schema.org/Organization" typeof="SportsTeam">    
        <header>
        	<h1>
        	<?php echo $this->escape($this->params->get('page_heading')); ?>
        	</h1>
        </header>
    </section>
<?php endif; ?>
