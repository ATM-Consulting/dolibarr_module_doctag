<?php
	if (!defined('NOTOKENRENEWAL')) define('NOTOKENRENEWAL', 1);

    require('../config.php');

    $get = GETPOST('get', 'none');

    switch($get) {
        case 'tag64exist':

            $res = 0;
            $tag64=GETPOST('tag64', 'none');
            if(!empty($tag64)) {
                $tagcode = getMD5By64($tag64);

                $PDOdb=new TPDOdb;
                $tag=new TDocTag;
                if($tag->loadByTagcode($PDOdb, $tagcode)){

                    $res = count($tag->TTag);

                }
            }

            echo $res;

            break;
    }
