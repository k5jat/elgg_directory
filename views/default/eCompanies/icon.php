<?php

	$company = $vars['entity'];

	if ($company instanceof ElggObject && $company->getSubtype() == 'company') {

	// Get size
	if (!in_array($vars['size'],array('small','medium','large','tiny','master','topbar')))
		$vars['size'] = "medium";

	// Get any align and js
	if (!empty($vars['align'])) {
		$align = " align=\"{$vars['align']}\" ";
	} else {
		$align = "";
	}

?>


<img src="<?php echo $vars['entity']->getIcon($vars['size']); ?>" border="0" <?php echo $align; ?> title="<?php echo $vars['entity']->title; ?>" <?php echo $vars['js']; ?> />


<?php

	}

?>