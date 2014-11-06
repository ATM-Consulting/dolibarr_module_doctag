<?php

	require('config.php');
	$langs->load('doctag@doctag');
	
	define('OBJETSTD_MAKETABLEFORME', true);
	
	$tag64=GETPOST('tag64');
	if(!empty($tag64)) {
		
		$url = base64_decode($tag64);
		$TUrl = parse_url($url);
		
		$TParam = array();
		parse_str($TUrl['query'], $TParam);
		
		$modulepart = $TParam['modulepart'];
		$file = $TParam['file'];
		
		if($modulepart=='facture')$modulepart='invoice';
		elseif($modulepart=='commande')$modulepart='order';
		elseif($modulepart=='produit')$modulepart='product';
		
		$tagcode = md5($modulepart.'='.$file );
		
	}
	else{
		$tagcode = GETPOST('tagcode');
		
	}
	
	if(empty($tagcode) ) exit('ErrorOfTag');
	
	$ATMdb=new TPDOdb;
	$tag=new TDocTag;
	if($tag->loadByTagcode($ATMdb, $tagcode)){
		$url = $tag->url;
	}
		
	if(GETPOST('action')=='SAVE') {
		
		$tag->set_values($_POST);
		$tag->save($ATMdb);
		
		setEventMessage($langs->Trans('TagsSaved'));
	}
	
	
	top_htmlhead('', $langs->Trans('TagsOfThis'), 1, 0, array(), array());
	main_area($langs->Trans('TagsOfThis'));
	
	
	
?>	
<script type="text/javascript" src="<?php echo dol_buildpath('/includes/jquery/js/jquery-latest.min.js',1) ?>"></script>
<script type="text/javascript" src="<?php echo dol_buildpath('/includes/jquery/plugins/jnotify/jquery.jnotify.min.js',1) ?>"></script>
<script type="text/javascript" src="<?php echo dol_buildpath('/core/js/jnotify.js',1) ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo dol_buildpath('/includes/jquery/plugins/jnotify/jquery.jnotify-alt.min.css',1) ?>" />

<div class="fiche">
			<div class="tabBar">
				<form name="formtag" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
					<input type="hidden" name="action" value="SAVE" />			
					<input type="hidden" name="tagcode" value="<?php echo $tagcode ?>" />			
					<input type="hidden" name="url" value="<?php echo $url ?>" />			
					<table class="border" width="100%">
						<tr>
							<td><?php echo $langs->trans('Title') ?></td><td><input type="text" name="title" value="<?php echo $tag->title ?>" size="80" /></td>
						</tr>
						
						<tr>
							<td><?php echo $langs->trans('Description') ?></td><td><textarea name="description" cols="60"><?php echo $tag->description ?></textarea></td>
						</tr>
						
						<tr>
							<td><?php echo $langs->trans('Tags') ?> <small>(<?php echo $langs->trans('SeparatedByComma') ?>)</small></td><td><input type="text" name="tags" value="<?php echo $tag->tags ?>" size="80" /></td>
						</tr>
						
					</table>
					
					<div class="tabsAction">
						
						<div class="inline-block divButAction">
							<input type="submit" class="butAction" value="<?php echo $langs->trans('Save') ?>" />
						</div>
						
					</div>
					
				</form>
			</div>
		</div>
<?php

	llxFooter();
