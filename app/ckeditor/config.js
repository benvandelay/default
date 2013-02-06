/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{

	config.toolbar = 'Custom';

	config.toolbar_Full =
	[
	    ['Source','-','Save','NewPage','Preview','-','Templates'],
	    ['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'],
	    ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
	    ['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'],
	    ['BidiLtr', 'BidiRtl'],
	    '/',
	    ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
	    ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'],
	    ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
	    ['Link','Unlink','Anchor'],
	    ['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],
	    '/',
	    ['Styles','Format','Font','FontSize'],
	    ['TextColor','BGColor'],
	    ['Maximize', 'ShowBlocks','-','About']
	];

	config.toolbar_Custom =
	[
		['Source','-','ShowBlocks','-'],
		['Format'],
		['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],

		['NumberedList','BulletedList','-','Blockquote'],
		['Link','Unlink'],
		['Image','Flash','Table','SpecialChar'],

		['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'],
		['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],

		['Maximize']

	];
	
	config.toolbar_Ben =
    [
        ['Source','-'],
        //['Format'],
        ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],

        ['NumberedList','BulletedList','-','Blockquote'],
        ['Link','Unlink'],

        ['Maximize']

    ];
    config.removePlugins = 'scayt,menubutton,contextmenu';
    config.disableNativeSpellChecker = false;
    config.browserContextMenuOnCtrl = true;
    config.autoGrow_onStartup = true;
	config.skin = "kama";
	config.resize_enabled = false;

};
