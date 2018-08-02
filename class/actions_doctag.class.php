<?php
class ActionsDoctag
{ 
     /** Overloading the doActions function : replacing the parent's function with the one below 
      *  @param      parameters  meta datas of the hook (context, etc...) 
      *  @param      object             the object you want to process (an invoice if you are in invoice module, a propale in propale's module, etc...) 
      *  @param      action             current action (if set). Generally create or edit or null 
      *  @return       void 
      */
    function deleteFile($parameters, &$object, &$action, $hookmanager) {
        
        global $langs,$db;
        
        if (in_array('fileslib',explode(':',$parameters['context']))) 
        {
          /*      define('INC_FROM_DOLIBARR',true);
                dol_include_once('/doctag/config.php');       
            
          
                $res = 0;
                $tag64=GETPOST('tag64');
                if(!empty($tag64)) {
                    $tagcode = getMD5By64($tag64);
                    
                    $PDOdb=new TPDOdb;
                    $tag=new TDocTag;
                    if($tag->loadByTagcode($PDOdb, $tagcode)){
                        
                        $res = count($tag->TTag);
    
                    }
                }
            */
        }
        
        return 0;
    }
      
      
    function printSearchForm($parameters, &$object, &$action, $hookmanager) {
    	
		global $langs,$db;
		
		if (in_array('searchform',explode(':',$parameters['context'])) && DOL_VERSION <= 3.8) 
        {
        	
			$langs->load('doctag@doctag');
			
			$res = '<div class="menu_titre"> '.img_object($langs->trans('Tagit'),'doctag@doctag').' '.$langs->trans('DocumentTags').'<br /></div>';

			
			$res.='<form method="post" action="'.dol_buildpath('/doctag/tagsearch.php',1).'">
				<input type="text" size="10" name="tag" title="'.$langs->trans('TagSearch').'" class="flat">
				<input type="submit" value="'.$langs->trans('Go').'" class="button">
				</form>';
						
        	$this->resprints = $res;
		}
		
		return 0;
    }
	function addSearchEntry($parameters, &$object, &$action, $hookmanager) {
		global $langs;
		
		if (in_array('searchform',explode(':',$parameters['context'])) && DOL_VERSION > 3.8) {
			$search_boxvalue = $parameters['search_boxvalue'];
			
			$langs->load('doctag@doctag');
			
			$this->results = array(
				'doctag' => array(
					'img'=>'object_doctag'
					,'label'=>$langs->trans('DocumentTags')
					,'text'=>img_picto('','object_doctag@doctag').' '.$langs->trans('DocumentTags')
					,'url'=>dol_buildpath('/doctag/tagsearch.php',1).'?keyword='.urlencode($search_boxvalue)
					,'position'=>1000
				)
			);
		}
		
		return 0;
	}
    function formObjectOptions($parameters, &$object, &$action, $hookmanager) 
    {  
      	global $langs,$db;
		if (in_array('ordercard',explode(':',$parameters['context']))) 
        {
        	
		}
		
		return 0;
	}
     
    function formEditProductOptions($parameters, &$object, &$action, $hookmanager) 
    {
		
    	if (in_array('invoicecard',explode(':',$parameters['context'])))
        {
        	
        }
		
        return 0;
    }

	function formAddObjectLine ($parameters, &$object, &$action, $hookmanager) {
		
		global $db;
		
		if (in_array('ordercard',explode(':',$parameters['context'])) || in_array('invoicecard',explode(':',$parameters['context']))) 
        {
        	
        }

		return 0;
	}

	function printObjectLine ($parameters, &$object, &$action, $hookmanager){
		
		global $db;
		
		if (in_array('ordercard',explode(':',$parameters['context'])) || in_array('invoicecard',explode(':',$parameters['context']))) 
        {
        	
        }

		return 0;
	}
}