// This is modified from http://drupal.org/project/widgeditor

run();




function run()
{
	var oldOnload = window.onload;

	if (typeof(window.onload) != "function")
	{
		window.onload = notepagesEditorInit;
	}
	else
	{
		window.onload = function()
		{
			oldOnload();
			notepagesEditorInit();
		}
	}
}




function notepagesEditorInit()
{
  //Add notepages editor div to body
  var editor_div_html = '	<div id="notepages_editor">\
	  <div id="notify" class="drop-shadow">\
  <span class="message"></span>\
  </div>\
  <div id="notepages_page" class="drop-shadow">\
  <div id="output">\
	  <div></div>\
	  <div class="clear"></div>\
  </div>\
  <div id="footer">\
	  Notepag.es was created by <a href="http://blog.chris-spencer.co.uk">Chris\
		  Spencer</a> and is <a href="https://github.com/fivesixty/notepages">Open\
		  Source</a>\
  </div>\
  </div>\
  <div id="toolpanel" class="readonly">\
  <a id="edit" href="#edit" class="readonly">edit\
	  <div id="pencil_24_png" class="sprites"></div>\
  </a><a id="cancel" href="#edit" class="edit">close\
	  <div id="cancel_24_png" class="sprites"></div>\
  </a><a id="save" href="#edit" class="edit">save\
	  <div id="save_24_png" class="sprites"></div>\
  </a><a id="preview" href="#edit" class="edit">\
	  <span id="preview_label">preview</span>\
	  <div id="magnifier_24_png" class="sprites"></div>\
  </a>\
  </div>\
  <div id="editpanel">\
  <div id="dragger"></div>\
  <div id="acetools"></div>\
  <div id="ace"></div>\
  <div id="settings">\
	  <select>\
		  <optgroup label="Editor Mode">\
			  <option>Markdown</option>\
		  </optgroup>\
	  </select> <select id="themeselect">\
		  <optgroup label="Editor Themes">\
			  <option value="ace/theme/clouds">Clouds</option>\
			  <option value="ace/theme/dawn">Dawn</option>\
			  <option value="ace/theme/eclipse">Eclipse</option>\
		  </optgroup>\
		  <optgroup>\
			  <option value="ace/theme/clouds_midnight">Clouds Midnight</option>\
			  <option value="ace/theme/cobalt">Cobalt</option>\
			  <option value="ace/theme/idle_fingers">idleFingers</option>\
			  <option value="ace/theme/kr_theme">krTheme</option>\
			  <option value="ace/theme/mono_industrial">Mono Industrial</option>\
			  <option value="ace/theme/monokai">Monokai</option>\
			  <option value="ace/theme/merbivore">Merbivore</option>\
			  <option value="ace/theme/merbivore_soft">Merbivore Soft</option>\
			  <option value="ace/theme/pastel_on_dark">Pastel on dark</option>\
			  <option value="ace/theme/twilight" selected="selected">Twilight</option>\
			  <option value="ace/theme/vibrant_ink">Vibrant Ink</option>\
		  </optgroup>\
	  </select> <select id="tabselect">\
		  <optgroup label="Tab Size">\
			  <option value="2" selected="selected">Soft: 2</option>\
			  <option value="4">Soft: 4</option>\
		  </optgroup>\
	  </select> <select id="wrapselect">\
		  <optgroup label="Wrapping Mode">\
			  <option value="soft" selected="selected">Soft Wrap</option>\
			  <option value="none">No Wrap</option>\
		  </optgroup>\
	  </select>\
  </div>\
  </div>\
  </div>';
  jQuery("body").prepend(editor_div_html);
  
  // If there's no 100ms delay, ace editor will be blank white...
  // This can be solved by preview/exit preview
  closeNotepagesEditor();
//  setTimeout("closeNotepagesEditor()", 1000);

	var theTextareas = document.getElementsByTagName("textarea");

	for (var i = 0; i < theTextareas.length; i++)
	{
		var theTextarea = theTextareas[i];
	
		if (theTextarea.id == "")
		{
			theTextarea.id = theTextarea.name;
		}
	
	
		setTimeout("notepagesEditor('" + theTextarea.id + "')", 50 * (i));
	}
	
	return true;
}


function openNotepagesEditor(textarea_id){
//  jQuery("#page").hide();
  adjustPanels();
  editing_textarea_id = textarea_id;
  editor.getSession().setValue($("#"+textarea_id).val());
  $("#preview").click();
  setTimeout('\
		  while (notepages_previewing)\
			  $("#preview").click();', 500);
  jQuery("#notepages_editor").show();
  jQuery('html, body').animate({ scrollTop: 0 }, 0);
  editor.focus();
  editor_warning = true;
}

function closeNotepagesEditor(){
//  jQuery("#page").show();
  jQuery("#notepages_editor").hide();
  editor_warning = false;
}

function adjustPanels(){
  var height = jQuery("#toolbar").height() + jQuery("body").offset().top;
  jQuery("#toolpanel").css("top", height+"px");
  jQuery("#editpanel").css("top", (height+35)+"px");
}

function notepagesEditor(textareaID)
{
	var theTextarea = document.getElementById(textareaID);
	var theButton = document.createElement("a");
	theButton.setAttribute("onclick", "openNotepagesEditor('"+textareaID+"');");
	theButton.href = "javascript:void(0)";
	theButton.textContent = "Edit by Notepages Editor";
	theTextarea.parentNode.insertBefore(theButton, theTextarea);
	return true;
}

var script = document.createElement("script");
script.type = "text/javascript";
script.src  = "https://d3eoax9i5htok0.cloudfront.net/mathjax/1.1-latest/MathJax.js";

// The following is pasted from mathjax module to configure mathjax
var config = 'MathJax.Hub.Config({' +
     'extensions: ["tex2jax.js"],' +
     'TeX: {extensions: ["AMSmath.js", "AMSsymbols.js"]},' +
     'jax: ["input/TeX","output/HTML-CSS"],' +
     'tex2jax: {' +
       'inlineMath: [ [\'%%\',\'%%\'], [\'\\\\(\',\'\\\\)\'] ],' +  // look for $...$ and \(...\) as delimiters for inline math
       'displayMath: [ [\'$$\',\'$$\'], [\'\\\\[\',\'\\\\]\'] ],' + // look for $$...$$ and \[...\] as delimiters for display math
       'processEscapes: true' +
     '}' +
   '});' +
   'MathJax.Hub.Startup.onload();';

if (window.opera) {script.innerHTML = config}
   else {script.text = config}

document.getElementsByTagName("head")[0].appendChild(script);


// The following is modified from https://github.com/fivesixty/notepages

var editing = true;
var pagename = "l4J5U9";
var passreq = false;

var protocol = 'https:' == document.location.protocol ? 'https://' : 'http://';
$LAB
		.script(
				"modules/notepages_editor/javascripts/jquery-1.6.4.min.js")
		.wait()
		.script("modules/notepages_editor/javascripts/browser-uncompressed.js")
		.script(
				protocol
						+ "d3eoax9i5htok0.cloudfront.net/mathjax/latest/MathJax.js?config=default");
var _gaq = _gaq || [];
_gaq.push([ '_setAccount', 'UA-13129098-3' ]);
_gaq.push([ '_trackPageview' ]);
(function() {
	var ga = document.createElement('script');
	ga.type = 'text/javascript';
	ga.async = true;
	ga.src = ('https:' == document.location.protocol ? 'https://ssl'
			: 'http://www')
			+ '.google-analytics.com/ga.js';
	var s = document.getElementsByTagName('script')[0];
	s.parentNode.insertBefore(ga, s);
})();

window.onbeforeunload = function() {
	if (editor_warning) {
		return 'You change (if any) will be lost by leaving without clicking "save"';
	}
}
