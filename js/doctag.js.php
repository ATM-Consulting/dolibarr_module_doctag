<?php
	if(is_file('../../master.inc.php'))  require('../../master.inc.php');
	else require('../../../master.inc.php');
	
	$langs->load('doctag@doctag');
	//echo $langs->trans('PreviewOf');
?>

function docTag_set_link() {
	$('a[href]').each(function() {
		
		var url = $(this).attr('href');
		
		if(url.indexOf('document.php?')!=-1 && url.indexOf('action=delete')==-1  && url.indexOf('file=')!=-1) {
			filename = $(this).text();
			if(filename == '') filename = $(this).find('img').attr('alt');
			
			url = "javascript:docTag_pop('<?php echo dol_buildpath('/doctag/tag.php',1) ?>?tag64="+ window.btoa(url)+"','"+filename+"')";
			link = '&nbsp;<a href="'+url+'"><?php echo img_object($langs->trans('Tagit'),'doctag@doctag') ?></a>';
			
			$(this).after(link);
		}
		
	});
}

function docTag_pop(url, filename) {
	
	$('#docTag').remove();
	
	if($('#docTag').length==0) {
		$('body').append('<div id="docTag"><iframe src="#" width="100%" height="100%" allowfullscreen webkitallowfullscreen frameborder="0"></iframe></div>');
	}
	
	$('#docTag').dialog({
		title: "<?php echo $langs->trans('TagsOfThis') ?> "
		,resize:'auto'
		,width:800
		,height:500
		,modal:true
		,resizable: true
		,close:function() {
			$('#docTag iframe').attr('src', '#');
		}
	});
	
	$('#docTag iframe').attr('src', url);
	
}

$(document).ready(function() {
	docTag_set_link();
});
