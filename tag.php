<?php

	require('config.php');
	$langs->load('doctag@doctag');
	
	
	$tag64=GETPOST('tag64');
	if(!empty($tag64)) {
		$tagcode = getMD5By64($tag64);
	}
	else{
		$tagcode = GETPOST('tagcode');
	}
	
	if(empty($tagcode) ) exit('ErrorOfTag');
	
	$PDOdb=new TPDOdb;
	$tag=new TDocTag;
	if($tag->loadByTagcode($PDOdb, $tagcode)){
		$url = $tag->url;
        if(empty($url) && !empty($tag64)) {
            $url = base64_decode($tag64);
            $tag->save($PDOdb);  
        }
	}
    else{
        if(empty($url) && !empty($tag64)) {
            $url = base64_decode($tag64);
        }
    }

    

    $action = 	GETPOST('action');	
	if($action=='SAVE') {
		
		$tag->set_values($_POST);
		$tag->save($PDOdb);
		
		setEventMessage($langs->Trans('TagsSaved'));
	}
    else if($action=='DELETE') {
        
        $tag->delete($PDOdb);
        
        top_htmlhead('', $langs->Trans('TagsOfThis'), 1, 0, array(), array());
        main_area($langs->Trans('TagsOfThis'));
   //  setEventMessage($langs->trans('TagDeleted') );
       
        echo '<div class="info">'.$langs->trans('TagDeleted').'</div>';
    
        llxFooter();
        
        exit;
    }
	
    top_htmlhead('', $langs->Trans('TagsOfThis'), 1, 0, array(), array());
	main_area($langs->Trans('TagsOfThis'));
	
	
	
?>	
<script type="text/javascript" src="<?php echo dol_buildpath('/includes/jquery/js/jquery-latest.min.js',1) ?>"></script>
<script type="text/javascript" src="<?php echo dol_buildpath('/includes/jquery/plugins/jnotify/jquery.jnotify.min.js',1) ?>"></script>
<script type="text/javascript" src="<?php echo dol_buildpath('/core/js/jnotify.js',1) ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo dol_buildpath('/includes/jquery/plugins/jnotify/jquery.jnotify-alt.min.css',1) ?>" />
<script type="text/javascript">
function deleteIt() {
    

    if(window.confirm('<?php echo $langs->transnoentities('DeleteIt'); ?>') ) {
        
        document.location.href="?action=DELETE&tagcode=<?php echo $tagcode ?>";
        
    }
}    
</script>
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
						  <input type="button" class="butActionDelete" value="<?php echo $langs->trans('delete') ?>" onclick="deleteIt();" />&nbsp;&nbsp;
                          <input type="submit" class="butAction" value="<?php echo $langs->trans('Save') ?>" />
                        </div>
						
					</div>
					
				</form>
			</div>
		</div>
<?php

	llxFooter();
