Search & Replace Plugin

To install the plugin, modify config file (newsletterbuilder\config.js) as follow:

	_cb.settings.plugins = ['searchreplace'];

This plugin will add a 'Search & Replace' button on the 'More' popup on toolbar (click the 'More' button).

You can also add the "searchreplace" button on the buttons or buttonsMore parameters: 

	var obj = $.newsletterbuilder({
		...
		buttons: [..., "searchreplace", ...]
	});

	or

	var obj = $.newsletterbuilder({
		...
		buttonsMore: [..., "searchreplace", ...]
	});

For more info about buttons or buttonsMore parameters, please check the NewsletterBuilder.js readme.txt.
