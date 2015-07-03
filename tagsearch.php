<?php

	require('config.php');
	
    dol_include_once('/core/lib/files.lib.php');
    
	llxHeader('', $langs->Trans('TagsOfThis'));
	
	$tagsearch = GETPOST('tag');
	
	?>
	<div class="fiche">
		<?php
			print_fiche_titre($langs->Trans('TagsOfThis'));
		?>
			<div class="tabBar">
				
				<form name="formtag" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
				<input class="flat" size="80" name="tag" value="<?php echo $tagsearch ?>" />
				<input type="submit" value="<?php echo $langs->trans('Search') ?>" />
				</form>
	<?php
	
		if(true /*!empty($tagsearch)*/) {
			
			$ATMdb=new TPDOdb;
			
			$l=new TListviewTBS('list-tag');
			
			$sql="SELECT tagcode,url,title,description,tags
			FROM ".MAIN_DB_PREFIX."doctag 
			WHERE 1 ".natural_search(array('title','tags'), $tagsearch)." ";
			
			$TOrder = array('title'=>'DESC');
			if(isset($_REQUEST['orderDown']))$TOrder = array($_REQUEST['orderDown']=>'DESC');
			if(isset($_REQUEST['orderUp']))$TOrder = array($_REQUEST['orderUp']=>'ASC');
			
			
			print $l->render($ATMdb, $sql, array(
				'limit'=>array(
					'page'=>(isset($_REQUEST['page']) ? $_REQUEST['page'] : 1)
					,'nbLine'=>'30'
				)
				,'hide'=>array('tagcode','url')
				,'title'=>array(
					'title'=>$langs->trans('Title')
					,'tags'=>$langs->trans('Tags')
					,'description'=>$langs->trans('Description')
				)
				,'liste'=>array(
					'titre'=>$langs->trans('TagsList')
					,'image'=>img_picto('','doctag.png@doctag', '', 0)
					,'picto_precedent'=>img_picto('','back.png', '', 0)
					,'picto_suivant'=>img_picto('','next.png', '', 0)
					,'noheader'=> 0
					,'messageNothing'=>$langs->transnoentities('NoRecDossierToDisplay')
					,'order_down'=>img_picto('','1downarrow.png', '', 0)
					,'order_up'=>img_picto('','1uparrow.png', '', 0)
				)
				,'eval'=>array(
					'title'=>'_showMyDoc("@url@", "@val@")'
				)
				,'orderBy'=>$TOrder));
			
			
		}
	
	
	$form = new TFormCore($_SERVER['PHP_SELF'],'formscore','POST');
	
	echo $form->hidden('action', 'save_etape');
	
	?></div>
	</div>
	<?php
	
	llxFooter();
	
function _showMyDoc($url, $title) {
global $langs,$conf;	
	
	if(empty($title)) {
		$title=$langs->trans('NullTitle');
	}
	
	list($modulepart,$file) = docTagParseUrl($url);
    
    if(!empty($conf->$modulepart->dir_output) && !dol_is_file($conf->$modulepart->dir_output.'/'.$file) ) {
        $ret = $title.' '.img_picto($langs->trans('Deleted'), 'editdelete');
        
        $tagcode = getMD5By64('', $url);
        $ret.='<a href="javascript:docTag_pop(\''.dol_buildpath('/doctag/tag.php?tagcode='.$tagcode,1).'\',\''.$title.'\')">'.img_object($langs->trans('Tagit'),'doctag@doctag').'</a>';
    }
    else{
        $ret = '<a href="'.$url.'">'.$title.'</a>';    
    }
	
    

	return $ret;
}
