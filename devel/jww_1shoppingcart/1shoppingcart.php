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

jimport('joomla.filesystem.file');
jimport('joomla.methods');

if (!class_exists('OneShopAPI')) {
	require_once(dirname(__FILE__).'/lib/class.OneShopAPI.php');
}

class JWW_1ShoppingCart {
    
	var $params; 
	var $plgin_path;
    var $shop;
	var $uri;
	var $juri_base;
	var $jroot_path;
	var $merchantId;
	var $merchantKey;
	var $apiURI;
	var $checkoutSteps;
	var $secureMerchantId;
	var $secureCartURI;
	var $_rawXML;
	var $_rawIndex;
	var $_rawVals;
	var $_rawHTML;
	var $productInfo;
	var $productId;

	function JWW_1ShoppingCart($params) {
		$this->params = $params;
		$this->jroot_path  = $params->get('jroot_path');
		$this->juri_base   = $params->get('juri_base');
		$this->plgin_path   = $params->get('plgin_path');
		$this->uri    = $this->juri_base.$this->plgin_path;
		$this->merchantId = $params->get('merchantId');
		$this->merchantKey = $params->get('merchantKey');
		$this->apiURI = $params->get('apiURI');
		$this->checkoutSteps = $params->get('checkoutSteps');
		$this->secureMerchantId = $params->get('secureMerchantId');
		$this->secureCartURI = $params->get('secureCartURI');
		$this->shop = new OneShopAPI($this->merchantId, $this->merchantKey, $this->apiURI);
		$this->productInfo = array();
	}

	function render() {
			
			// init vars
			$title         = $this->params->get('title', '');
			$style         = $this->params->get('style', '_default');
			$tmpl_style    = dirname(__FILE__).DS.'tmpl'.DS.$style.'.php';
			
			JPlugin::loadLanguage('plg_jww_1shoppingcart', JPATH_ADMINISTRATOR);
			
			// check template files
			if (!is_readable($tmpl_style)) {
				return $this->genAlertMessage("Unable to read the style template file");
			}
			
			// check if Merchant ID, Merchant Key and ApiURI exists
			$apiMethods = $this->shop->GetAvailableApiMethods();
			if (!$apiMethods) {
				return $this->genAlertMessage("Unable to connect to 1ShoppingCart using current merchant data");
			}

			// check if Item exists
			$this->_rawXML = $this->shop->GetProductById($this->params->get('product'));			
			if (!$this->_rawXML) {
				return $this->genAlertMessage("Unable to find the product specified");
			}
			else{
				$this->productInfo = $this->getProductInfo();
			}
			
			// add css
			if (!defined('1SHOPPINGCART_CSS')) {
				define('1SHOPPINGCART_CSS', true);
				$css_file = '/plugins/content/jww_1shoppingcart/styles/styles.css';
				$document =& JFactory::getDocument();
				$document->addStyleSheet($css_file);			
			}

			// init template vars
			$this->productId = '1shoppingcart-'.$this->params->get('product');

			// get template output
			$html = '';
			ob_start();
			include($tmpl_style);
			$html = ob_get_contents();
			ob_end_clean();		
		
			return $html;
	}

	function genAlertMessage($msg) {
		return "<div class=\"alert\"><strong>".JTEXT::_($msg)."</strong></div>\n";
	}
	
	function getProductInfo(){
		$retVal = array();
		
		$xmlParser = xml_parser_create('utf-8');
		xml_parser_set_option($xmlParser, XML_OPTION_CASE_FOLDING, FALSE);
		xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
		//xml_set_element_handler($xmlParser, 'xmlBeginTagHandler', 'xmlEndTagHandler');
		//xml_set_character_data_handler( $xmlParser, 'xmlTagDataHandler');
		//xml_parse($xmlParser, $this->_rawXML, TRUE);
		xml_parse_into_struct($xmlParser, $this->_rawXML, $this->_rawVals, $this->_rawIndex);
		//xml_parse_into_struct($xmlParser, $this->_rawXML, $values, $tags);
		$xmlError = xml_get_error_code($xmlParser);
		
		if( $xmlError == XML_ERROR_NONE ){
			//echo 'Processed the result with no errors';
			$retVal["index"]= $this->_rawIndex;
			$retVal["vals"] = $this->_rawVals;
			//$retVal["index"]= $tags;
			//$retVal["vals"] = $values;
		}
		else{
			 $retVal['Error']= 'XML Parsing error: '.$xmlError.' - '.xml_error_string($xmlError);
		}
		xml_parser_free($xmlParser);
		
		return $retVal;
	}

	function xmlBeginTagHandler( $parser, $tag, $attributes )
	{
	}

	function xmlEndTagHandler( $parser, $tag )
	{
	}

	function xmlTagDataHandler( $parser, $data )
	{
	}
}