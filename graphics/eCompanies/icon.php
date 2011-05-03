<?php
	/**
	 * Icon display
	 * 
	 * @package ElggGroups
	 */

	global $CONFIG;
	require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . "/engine/start.php");

	$company_guid = get_input('company_guid');
	$company = get_entity($company_guid);
	
	$size = strtolower(get_input('size'));
	if (!in_array($size,array('large','medium','small','tiny','master','topbar')))
		$size = "medium";
	
	$success = false;
	
	$filehandler = new ElggFile();
	$filehandler->owner_guid = $company->owner_guid;
	$filehandler->setFilename("company/" . $company->guid . $size . ".jpg");
	
	$success = false;
	if ($filehandler->open("read")) {
		if ($contents = $filehandler->read($filehandler->size())) {
			$success = true;
		} 
	}
	
	if (!$success) {
		$contents = @file_get_contents($CONFIG->pluginspath . "eCompanies/graphics/eCompanies/default{$size}.gif");
	}
	
	header("Content-type: image/jpeg");
	header('Expires: ' . date('r',time() + 864000));
	header("Pragma: public");
	header("Cache-Control: public");
	header("Content-Length: " . strlen($contents));
	echo $contents;
?>