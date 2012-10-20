<?php 
/*------------------------------------------------------------------------
# author    Pascal Link
# copyright Copyright (C) 2012 pl07.de All rights reserved.
# @license  http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Website   http://www.pl07.de
-------------------------------------------------------------------------*/

/* initialize ob_gzhandler to send and compress data */
ob_start ("ob_gzhandler");
/* initialize compress function for whitespace removal */
ob_start("compress");
/* required header info and character set */
header("Content-type: application/x-javascript");
/* cache control to process */
header("Cache-Control: must-revalidate");
/* duration of cached content (1 hour) */
$offset = 60 * 60 ;
/* expiration header format */
$ExpStr = "Expires: " . gmdate("D, d M Y H:i:s",time() + $offset) . " GMT";
/* send cache expiration header to broswer */
header($ExpStr);

require('../../../media/system/js/mootools-core.js');
require('../../../media/system/js/core.js');
require('../../../media/system/js/caption.js');
?>