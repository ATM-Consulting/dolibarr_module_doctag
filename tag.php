<?php

	require('config.php');
	$langs->load('doctag@doctag');
	
	$tagcode=GETPOST('tag');
	$url = base64_decode($tagcode);
	
	top_htmlhead('', $langs->Trans('TagsOfThis'), 1, 0, array(), array());
	main_area($langs->Trans('TagsOfThis'));
	
	
?>	<div class="fiche">
			<div class="tabBar">
				<form name="formtag" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
					<input type="hidden" name="tagcode" value="<?php echo $tagcode ?>" />			
					<table class="border" width="100%">
						<tr>
							<td><?php echo $langs->trans('Title') ?></td><td><input type="text" name="title" value="" size="80" /></td>
						</tr>
						
						<tr>
							<td><?php echo $langs->trans('Description') ?></td><td><textarea name="description" cols="60"></textarea></td>
						</tr>
						
						<tr>
							<td><?php echo $langs->trans('Tags') ?> <small>(<?php echo $langs->trans('SeparatedByComma') ?>)</small></td><td><input type="text" name="tags" value="" size="80" /></td>
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
