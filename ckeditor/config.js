/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	config.language = 'ru';
	//config.uiColor = '#cccccc';
	config.skin = 'moono';//office2013,kama,moono,bootstrapck,moono-dark,icy_orange 
	config.disableNativeSpellChecker = false;//подключение  проверки орфографии браузером
	//config.fullPage= false;// оплетка для редактируемого документа. Если установлено true то редактируемая область будет содержать полноценный html документ, если false - только контент.
	//config.removePlugins = 'elementspath';//отключение  нижней панели
	config.resize_enabled = false;//отключение  кнопки растягивания окна
	config.extraPlugins = 'textselection,autogrow,confighelper,spoiler,wordcount,htmlwriter,notification,autosave,ckawesome';
	//ckawesome - шрифты fontawesome
	//textselection - чтобы посмотреть или исправить HTML-код. В режиме WYSIWYG мы выделяем нужный нам фрагмент, 
	//переключаемся в режим исходного кода и сразу попадаем в нужное нам место — причем исхоодный код также выделен: 
	//autogrow- подключение  увеличения размера окна до размера контента
	//confighelper-подключение  placeholder
	//spoiler -спойлер
	//autosave -автосохранение
	//fontawesome -шрифты fontawesome необходимы widget,lineutils,widgetselection и др
	//wordcount-подключение  подсчет символов контента (нижняя понель) зависит от htmlwriter, notification
	config.wordcount = {//config подсчет символов контента
    showParagraphs: true,
    showWordCount: true,
    showCharCount: true,
    countSpacesAsChars: false,
    countHTML: false,   
    };
	config.removePlugins = 'liststyle,tabletools,scayt,menubutton,contextmenu';//отключение  контекстного меню
	//config.placeholder = 'Пояснение'; // текст placeholder
	config.colorButton_colors =
    '000,800000,8B4513,2F4F4F,008080,000080,4B0082,696969,' +
    'B22222,A52A2A,DAA520,006400,40E0D0,0000CD,800080,808080,' +
    'F00,FF8C00,FFD700,008000,0FF,00F,EE82EE,A9A9A9,' +
    'FFA07A,FFA500,FFFF00,00FF00,AFEEEE,ADD8E6,DDA0DD,D3D3D3,' +
    'FFF0F5,FAEBD7,FFFFE0,F0FFF0,F0FFFF,F0F8FF,E6E6FA,FFF';	//
	
	config.autosave_SaveKey = 'autosaveKey';//config автосохранение
	config.autosave_NotOlderThen = 60;	
	
	//config.extraPlugins = 'fontawesome';
    //config.contentsCss = '../template/css/font-awesome.min.css';
    //config.allowedContent = true;
	
    config.fontawesomePath = '../template/css/font-awesome.min.css';//config ckawesome
	
	config.toolbar =
    [
        ['Source','-'],
		['Maximize', 'ShowBlocks'],
        ['Cut','Copy','Paste','-','Print'],
        ['Undo','Redo','-','Find','Replace','-','SelectAll','CopyFormatting','RemoveFormat'],
        ['Spoiler','FontAwesome','ckawesome','Table','HorizontalRule','Smiley','SpecialChar','Link','Unlink','Anchor','PageBreak'],
		['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
        '/',
        ['Bold','Italic','Underline','Strike','-','Subscript','Superscript','TextColor','BGColor'],
        ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
        ['Styles','Format','Font','FontSize'],
    ];
};	
	
	// Media (oEmbed) Plugin - позволяет значительно упростить процесс вставки видео, фото, аудио и прочего. Поддерживает просто какое-то невероятное количество разнообразных сайтов. 
    // Code Snippet - Позволяет вставлять исходный код в ваше сообщение, который будет иметь подсветку синтаксиса — очень много вариантов подсветки. Удобно и красиво.
	// Insert Symbol - Позволяет вставить специальные символы в текст
	// fontawesome -CKEditor4.6 ???