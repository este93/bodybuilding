<?php 
	header("Content-type: text/xml");
	require_once "config.php";

	$a = Tekst::getSomething("id,naslov,datum,kategorija");
	$xml = new SimpleXMLElement("<biblioteka />");
	foreach($a as $b){
		$tekst = $xml->addChild("tekst");
		$tekst->addAttribute("id",$b->id);
		foreach($b as $k=>$v){
			if($k=="id") continue;
			$tekst->addChild($k,$v);
		}
	}
	echo $xml->asXML("tekstovi.xml");