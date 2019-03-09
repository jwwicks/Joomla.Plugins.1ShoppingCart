# Introduction
A simple Joomla 1.5x plugin to add basic information to a 1ShoppingCart item in an article.

Requires 1ShoppingCart Pro access since it uses the 1ShoppingCart API. Basic attributes displayed are Title, Short Description, Long Description, Image, SKU, Price and Sale Price as well as a link to the shoppingcart.

Before installing the plugin in Joomla you'll want to gather some critical information from your 1ShoppingCart or Private label reseller administration area. You'll also need a Professional version of the 1ShoppingCart product since this plugin relies on API calls that are not available in the AutoResponder, Starter or Basic versions. It is also not available in the Test Drive despite the test drive being a "Professional" version.

**If you don't have 1SC Professional this plugin will not work.**

## Before You Begin
1. Log into your 1ShoppingCart administration area
2. Go to My Account/Status Summary
3. Take note your Merch ID (1SC Merchant ID)
4. Go to My Account/API Settings
5. Take note of the Merchant API Key (1SC Merchant Key)
6. Go to My Account/API Manual
7. Look for the "The quickest way to get started" paragraph. There's a link in that paragraph which should be something like https://www.mcssl.com/API/{1SC Merchant ID}. Just need the first part http://www.mcssl.com/ (1SC API URL)
8. Go to Products/Manage Products
9. Open a product by clicking the link for the Product Name
10. Take note of the Product ID in the Details tab
11. Click the Links tab
12. Take note of the mid (SecureCart Merchant ID) parameter in the cart URL location in the Product Links group. Should be a 32 character ID separated by dashes ?mid=XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX (1SC Secure Cart Merchant ID)
13. Take note of the SecureCart URL. Same cart link as above just need the first part. Something like: http://www.1shoppingcart.com/SecureCart/SecureCart.aspx (1SC Secure Cart URL)

# Install the Plugin
1. Login to the Joomla Administration area
2. Install the plugin using the Extension Manager
3. Go to the Plugin Manager after the install completes
4. Edit the settings using the information from 1ShoppingCart
5. Enable the plugin

# Create a Product Article
1. Go to the Article Manager
2. Create a new article
3. Add the plugin code {jww1shoppingcart product=[0123456]} where 0123456 is the Product ID from 1SC
4. Save and publish the article
5. Repeat for other products as needed
