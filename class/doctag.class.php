<?php

 
class TDocTag extends TObjetStd {
	function __construct() { /* declaration */
		global $langs;

		parent::set_table(MAIN_DB_PREFIX.'doctag');
		parent::add_champs('title,tags,tagcode','type=chaine;index;');
		parent::add_champs('description','type=texte;');
		parent::add_champs('url','type=chaine;');
				
		parent::_init_vars();
		parent::start();
        $this->TTag=array();
	}
	
	function loadByTagcode(&$PDOdb, $code) {
		
		$PDOdb->Execute("SELECT rowid FROM ".$this->get_table()." WHERE tagcode='".$code."'");
		if($PDOdb->Get_line()) {
			return $this->load($PDOdb, $PDOdb->Get_field('rowid'));
		}
		else{
			return false;
		}
		
	}
    
    function load(&$PDOdb, $id) {
        $res = parent::load($PDOdb, $id);
        
        if(!empty($this->tags)) $this->TTag = explode(',', $this->tags);
        
        return $res;
    }
	
}