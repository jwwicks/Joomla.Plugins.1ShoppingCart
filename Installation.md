# Introduction #

<p>Before installing the plugin in Joomla you'll want to gather some critical information from your <a href='http://www.1shoppingcart.com/app/?pr=1&id=172687'>1ShoppingCart</a> or Private label reseller administration area. You'll also need a Professional version of the 1ShoppingCart product since this plugin relies on API calls that are not available in the AutoResponder, Starter or Basic versions. It is also not available in the Test Drive despite the test drive being a "Professional" version.</p>
<p><b>If you don't have 1SC Professional this plugin will not work</b>.</p>

## Before You Begin ##
  1. Log into your 1ShoppingCart administration area
  1. Go to My Account/Status Summary
  1. Take note your Merch ID (**1SC Merchant ID**)
  1. Go to My Account/API Settings
  1. Take note of the Merchant API Key (**1SC Merchant Key**)
  1. Go to My Account/API Manual
  1. Look for the "The quickest way to get started" paragraph. There's a link in that paragraph which should be something like https://www.mcssl.com/API/{1SC Merchant ID}. Just need the first part http://www.mcssl.com/ (**1SC API URL**)
  1. Go to Products/Manage Products
  1. Open a product by clicking the link for the Product Name
  1. Take note of the Product ID in the Details tab
  1. Click the Links tab
  1. Take note of the mid (**SecureCart Merchant ID**) parameter in the cart URL location in the Product Links group. Should be a 32 character ID separated by dashes ?mid=XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX (**1SC Secure Cart Merchant ID**)
  1. Take note of the SecureCart URL. Same cart link as above just need the first part. Something like: http://www.1shoppingcart.com/SecureCart/SecureCart.aspx (**1SC Secure Cart URL**)

# Install the Plugin #
  1. Login to the Joomla Administration area
  1. Install the plugin using the Extension Manager
  1. Go to the Plugin Manager after the install completes
  1. Edit the settings using the information from 1ShoppingCart
  1. Enable the plugin

# Create a Product Article #
  1. Go to the Artcile Manager
  1. Create a new article
  1. Add the plugin code `{jww1shoppingcart product=[0123456]}` where 0123456 is the Product ID from 1SC
  1. Save and publish the article
  1. Repeat for other products as needed