<?php 
/*------------------------------------------------------------------------
# author    Pascal Link
# copyright Copyright (C) 2012 pl07.de All rights reserved.
# @license  http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Website   http://www.pl07.de
-------------------------------------------------------------------------*/

defined('_JEXEC') or die;

function modChrome_slider($module, &$params, &$attribs) {
	echo JHtml::_('sliders.panel',JText::_($module->title),'module'.$module->id);
	echo $module->content;
}

function modChrome_mystyle($module, &$params, &$attribs) { 
	echo'<script type="text/javascript" src="'; echo htmlspecialchars($params->get('moduleclass_sfx')); echo'"/>';
}

?>
