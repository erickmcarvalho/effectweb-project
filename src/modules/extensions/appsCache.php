<?php

if(CTM_ROOT_AREA == "public")
{
	$appsCache = array
	(
		"core" => array
		(
			"name" => "CTM.EffectWeb",
			"module" => "Home",
		),
	);
}
else
{
	$appsCache = array
	(
		"core" => array
		(
			"name" => "Core",
			"title" => "System",
			"module" => "System",
		),
		"effectweb" => array
		(
			"name" => "CTM.EffectWeb",
			"title" => "Suite",
			"module" => "Main",
		),
	);
}