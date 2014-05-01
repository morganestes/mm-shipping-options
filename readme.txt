=== Custom Shipping Options for MemberMouse ===
Contributors: morganestes
Tags: membermouse, shipping, checkout, ecommerce, extension
Requires at least: 3.8
Tested up to: 3.9
Stable tag: 0.1.0
License: GPLv2 or later
License URI: https://github.com/morganestes/mm-shipping-options/blob/master/LICENSE

Adds a filter to the MemberMouse WordPress plugin to show/hide shipping options on a checkout form.

== Description ==
By default, MemberMouse adds *every* shipping option you have configured to an order form, even if you don\'t want them displayed (like ones that are internal use, free shipping options, etc.).

Custom Shipping Options for MemberMouse enables you to filter out those extra options by specifying which ones you _do_ want displayed. Only want U.S. and International shipping as choices (leaving free shipping for your Customer Service reps, or as a special offer)? No problem! Just add it to your URL and you\'re good to go.

== Installation ==
1. This plugin can only be used in conjunction with MemberMouse.com\'s paid plugin. It must be installed and activated prior to using this one.
2. Follow standard plugin installation and activation methods.

== Frequently Asked Questions ==
=== How do I filter out specific shipping methods? ===

Add a query string to the URL of your checkout page and specify the IDs of the methods you want to offer.
For example `https://shop.example.com/cool-product/?mm-so=1,4` will only show shipping methods 1 and 4.

=== Can I filter the methods prior to them being displayed? ===

Not at this time.

=== What if JavaScript is disabled? ===

MemberMouse relies on JavaScript for the sales process. If it\'s disabled in the browser, none of it will work properly.

== Changelog ==
0.1.0
- Initial release.
- Enable JavaScript filter through URL parameter.
