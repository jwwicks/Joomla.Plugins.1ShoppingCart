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

jimport('joomla.plugin.plugin');

if (!class_exists('JWW_1ShoppingCart')) {
	require_once(dirname(__FILE__).'/jww_1shoppingcart/1shoppingcart.php');
}

class plgContentJWW_1ShoppingCart extends JPlugin {
    
	// plugin line params
	var $parameter;

	/**
	 * Constructor
	 *
	 * @param object $subject The object to observe
	 * @param object $params  The object that holds the plugin parameters
	 * @since 0.0.99
	 */
	function plgContentJWW_1ShoppingCart(&$subject, $params) {
		parent::__construct($subject, $params);
	}
	
	function onPrepareContent(&$article, &$params, $limitstart) {

		// simple performance check to determine whether bot should process further
		if (JString::strpos($article->text, 'jww1shoppingcart') === false) {
			return true;
		}

		// get plugin info
		$plugin       =& JPluginHelper::getPlugin('content', 'jww_1shoppingcart');
	 	$pluginParams = new JParameter($plugin->params);

	 	// expression to search for
		$regex = "#{jww1shoppingcart\s*(.*?)}#s";

		// check whether plugin has been unpublished
		if (!$pluginParams->get('enabled', 1)) {
			$article->text = preg_replace($regex, '', $article->text);
			return true;
		}

		// perform the replacement
		preg_match_all($regex, $article->text, $matches);
	
	 	if ($count = count($matches[0])) {
	 		$this->replace($article, $matches, $count, $regex, $pluginParams);
		}
    }

	function replace(&$article, &$matches, $count, $regex, $pluginParams) {
		for ($i = 0; $i < $count; $i++) {

			// set line params
		 	$this->setParams($matches[1][$i], array('product' => null));

			// set params
		 	$params = new JParameter('');
			$params->bind($pluginParams->toArray());
			$params->bind($this->parameter);
			$params->set('plgin_path', 'plugins/content/jww_1shoppingcart/');
			$params->set('juri_base', JURI::base());
			$params->set('jroot_path', JPATH_ROOT);

			// render cartItem
			$cartItem = new JWW_1ShoppingCart($params);
			$replace = $cartItem->render();

			// replace
			$article->text = str_replace($matches[0][$i], $replace, $article->text);
	 	}
	}

	function setParams($param_line, $default = array()) {
		$matches = array();
		$this->parameter = $default;
		
		preg_match_all("#(\w+)=\[(.*?)\]#s", $param_line, $matches);
	    for ($i = 0; $i < count($matches[1]); $i++) {
			$this->parameter[strtolower($matches[1][$i])] = $matches[2][$i];
	    }
	}

}