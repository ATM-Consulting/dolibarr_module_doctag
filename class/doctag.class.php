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

	}
	
	function loadByTagcode(&$ATMdb, $code) {
		
		$ATMdb->Execute("SELECT rowid FROM ".$this->get_table()." WHERE tagcode='".$code."'");
		if($ATMdb->Get_line()) {
			return $this->load($ATMdb, $ATMdb->Get_field('rowid'));
		}
		else{
			return false;
		}
		
	}
	
}