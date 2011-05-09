<?php

// php v. 5.3 +

define(
	'WEB_DIR' ,
	__DIR__
);
define(
	'APP_DIR' ,
	realpath(
		__DIR__ . DIRECTORY_SEPARATOR
		. '..'
		. DIRECTORY_SEPARATOR
		. 'app'
	)
	. DIRECTORY_SEPARATOR
);

require APP_DIR . 'init.php';

