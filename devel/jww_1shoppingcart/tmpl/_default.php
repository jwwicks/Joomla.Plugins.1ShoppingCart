<?php 
/**
 * @version $Id$
 * @package jww_1shoppingcart
 * @author John Wicks
 * @copyright Copyright (C) 2010 JWWicks. All rights reserved.
 * @license GNU/GPL
 *
 */

// no direct access
defined('_JEXEC') or die('Restricted access');
jimport('joomla.methods');

$cartLink = $this->secureCartURI.'?mid='.$this->secureMerchantId.'&pid='.$this->productInfo['vals'][$this->productInfo['index']['VisibleId'][0]]['value'];
if($this->checkoutSteps==2) {$cartLink .= '&bn=1';}

?>
<div class="ProductContainer">
	<h1 class="ProductName"><?php echo $this->productInfo['vals'][$this->productInfo['index']['ProductName'][0]]['value'];?></h1>
	<div id="<?php echo $this->productId; ?>" class="ProductInfo" >
	<a class="ProductImageUrl" href="<?php echo $cartLink; ?>" title="<?php echo $this->productInfo['vals'][$this->productInfo['index']['ProductName'][0]]['value']; ?>" >
		<img src="<?php echo $this->apiURI.$this->productInfo['vals'][$this->productInfo['index']['ImageUrl'][0]]['value']; ?>" alt="<?php echo $this->productInfo['vals'][$this->productInfo['index']['ImageUrl'][0]]['value']; ?>" width="200" height="250" />
	</a>
	<ul class="ProductDetails">
		<li class="ProductShortDescription"><p><?php echo $this->productInfo['vals'][$this->productInfo['index']['ShortDescription'][0]]['value']?></p></li>
		<li class="ProductSku"><?php echo JText::_('SKU'); ?>: <span><?php echo $this->productInfo['vals'][$this->productInfo['index']['ProductSku'][0]]['value'];?></span></li>
		<li class="ProductWeight"><?php echo JText::_('Weight'); ?>: <span><?php echo $this->productInfo['vals'][$this->productInfo['index']['ProductWeight'][0]]['value'];?></span></li>
		<li class="ProductPrice"><?php echo JText::_('Price'); ?>: <span><?php echo $this->productInfo['vals'][$this->productInfo['index']['ProductPrice'][0]]['value'];?></span></li>
		<?php if($this->productInfo['vals'][$this->productInfo['index']['UseSalePrice'][0]]['value']==true):?>
		 <li class="ProductSalePrice"><?php echo JText::_('Sale Price'); ?>: <span><?php echo $this->productInfo['vals'][$this->productInfo['index']['SalePrice'][0]]['value'];?></span></li>
		<?php endif;?>
		<li class="ProductCartLink"><a href="<?php echo $cartLink;?>"><img src="<?php echo $this->juri_base.'plugins/content/jww_1shoppingcart/styles/images/cart_button.gif'; ?>" alt="cart_button.gif" height="25" width="101"/></a></li>
	</ul>
	<p class="ProductLongDescription"><?php echo $this->productInfo['vals'][$this->productInfo['index']['LongDescription'][0]]['value']?></p>
	</div>
</div>
