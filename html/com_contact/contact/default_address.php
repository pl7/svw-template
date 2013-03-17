<?php

/**
 * @package		Joomla.Site
 * @subpackage	com_contact
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

$app =& JFactory::getApplication();   
$tpath = '/templates/'.$app->getTemplate();

/* marker_class: Class based on the selection of text, none, or icons
 * jicon-text, jicon-none, jicon-icon
 */
?>
<?php if (($this->params->get('address_check') > 0) &&  ($this->contact->address || $this->contact->suburb  || $this->contact->state || $this->contact->country || $this->contact->postcode)) : ?>
	<p class="contact-address">
	<?php if ($this->params->get('address_check') > 0) : ?>
		<img src="<?php echo $tpath; ?>/images/icons/location.png" />
		<address>
	<?php endif; ?>
	<?php if ($this->contact->address && $this->params->get('show_street_address')) : ?>
		<span class="contact-street">
			<?php echo nl2br($this->contact->address); ?>
		</span>
	<?php endif; ?>
	<?php if ($this->contact->suburb && $this->params->get('show_suburb')) : ?>
		<span class="contact-suburb">
			<?php echo $this->contact->suburb; ?>
		</span>
	<?php endif; ?>
	<?php if ($this->contact->state && $this->params->get('show_state')) : ?>
		<span class="contact-state">
			<?php echo $this->contact->state; ?>
		</span>
	<?php endif; ?>
	<?php if ($this->contact->postcode && $this->params->get('show_postcode')) : ?>
		<span class="contact-postcode">
			<?php echo $this->contact->postcode; ?>
		</span>
	<?php endif; ?>
	<?php if ($this->contact->country && $this->params->get('show_country')) : ?>
		<span class="contact-country">
			<?php echo $this->contact->country; ?>
		</span>
	<?php endif; ?>
<?php endif; ?>

<?php if ($this->params->get('address_check') > 0) : ?>
	</address>
	</p>
<?php endif; ?>

<?php if($this->params->get('show_email') || $this->params->get('show_telephone')||$this->params->get('show_fax')||$this->params->get('show_mobile')|| $this->params->get('show_webpage') ) : ?>
	<div class="contact-contactinfo">
<?php endif; ?>
<?php if ($this->contact->email_to && $this->params->get('show_email')) : ?>
    <p class="mail">
        <img src="<?php echo $tpath; ?>/images/icons/mail.png" />
        <span itemprop="mail"><?php echo nl2br($this->contact->email_to); ?></span>
    </p>
<?php endif; ?>

<?php if ($this->contact->telephone && $this->params->get('show_telephone')) : ?>
    <p class="telephone">
        <img src="<?php echo $tpath; ?>/images/icons/telephone.png" />
        <span itemprop="telephone"><?php echo nl2br($this->contact->telephone); ?></span>
    </p>
<?php endif; ?>
<?php if ($this->contact->fax && $this->params->get('show_fax')) : ?>
    <p class="fax">
        <img src="<?php echo $tpath; ?>/images/icons/fax.png" />
        <span itemprop="fax"><?php echo nl2br($this->contact->fax); ?></span>
    </p>
<?php endif; ?>
<?php if ($this->contact->mobile && $this->params->get('show_mobile')) :?>
    <p class="mobile">
        <img src="<?php echo $tpath; ?>/images/icons/phone.png" />
        <span itemprop="telephone"><?php echo nl2br($this->contact->mobile); ?></span>
    </p>
<?php endif; ?>
<?php if ($this->contact->webpage && $this->params->get('show_webpage')) : ?>
	<p>
		<span class="<?php echo $this->params->get('marker_class'); ?>" >
		</span>
		<span class="contact-webpage">
			<a href="<?php echo $this->contact->webpage; ?>" target="_blank">
			<?php echo $this->contact->webpage; ?></a>
		</span>
	</p>
<?php endif; ?>
<?php if($this->params->get('show_email') || $this->params->get('show_telephone')||$this->params->get('show_fax')||$this->params->get('show_mobile')|| $this->params->get('show_webpage') ) : ?>
	</div>
<?php endif; ?>
