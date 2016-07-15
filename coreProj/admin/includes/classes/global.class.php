<?php

Class GlobalClass extends Application{
	
		
	public static function get_state_name($state_id){	
		global $app;
		$app->tablename = 'states';
		 $states = $app->find(array('state_name'), array('conditions' => array('state_id= ' => $state_id)  ));	
		 	
		 if(!empty($states)){
			 foreach($states as $state){
				 $state_name = $state['state_name'];
			 }
			return $state_name; 
		 }
		 return false; 
	}
	
	public static function get_country_name($country_id){	
		global $app;
		$app->tablename = 'countries';
		$countries = $app->find(array('country_name'), array('conditions' => array('country_id= ' => $country_id)  ));	
		 	
		 if(!empty($countries)){
			 foreach($countries as $country){
				 $country_name = $country['country_name'];
			 }
			return $country_name; 
		 }
		 return false; 
	}
	
	public static function paginate($reload, $page, $tpages) {
        $adjacents = 2;
        $prevlabel = "&lsaquo; Prev";
        $nextlabel = "Next &rsaquo;";
        $out = "";
        // previous
        if ($page == 1) {
            $out.= "<span>".$prevlabel."</span>\n";
        } elseif ($page == 2) {
            $out.="<li><a href=\"".$reload."\">".$prevlabel."</a>\n</li>";
        } else {
            $out.="<li><a href=\"".$reload."&amp;page=".($page - 1)."\">".$prevlabel."</a>\n</li>";
        }
        $pmin=($page>$adjacents)?($page - $adjacents):1;
        $pmax=($page<($tpages - $adjacents))?($page + $adjacents):$tpages;
        for ($i = $pmin; $i <= $pmax; $i++) {
            if ($i == $page) {
                $out.= "<li class=\"active\"><a href=''>".$i."</a></li>\n";
            } elseif ($i == 1) {
                $out.= "<li><a href=\"".$reload."\">".$i."</a>\n</li>";
            } else {
                $out.= "<li><a href=\"".$reload. "&amp;page=".$i."\">".$i. "</a>\n</li>";
            }
        }
        
        if ($page<($tpages - $adjacents)) {
            $out.= "<a style='font-size:11px' href=\"" . $reload."&amp;page=".$tpages."\">" .$tpages."</a>\n";
        }
        // next
        if ($page < $tpages) {
            $out.= "<li><a href=\"".$reload."&amp;page=".($page + 1)."\">".$nextlabel."</a>\n</li>";
        } else {
            $out.= "<li><span style='font-size:11px'>".$nextlabel."</span>\n</li>";
        }
        $out.= "";
        return $out;
    }
	
}
