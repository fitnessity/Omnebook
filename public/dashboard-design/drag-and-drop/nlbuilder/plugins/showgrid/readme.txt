Show Grid Plugin

To install the plugin, modify config file (newsletterbuilder\config.js) as follow:

	_cb.settings.plugins = ['showgrid'];

This plugin will add a 'show grid outline' button on the 'More' popup on toolbar (click the 'More' button).

You can also add the "showgrid" button on the buttons or buttonsMore parameters: 

	var obj = $.newsletterbuilder({
		...
		buttons: [..., "showgrid", ...]
	});

	or

	var obj = $.newsletterbuilder({
		...
		buttonsMore: [..., "showgrid", ...]
	});

For more info about buttons or buttonsMore parameters, please check the NewsletterBuilder.js readme.txt.
