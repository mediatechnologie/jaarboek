<?php

define(
	'FRAMEWORK' ,
	realpath(
		__DIR__
		. DIRECTORY_SEPARATOR
		//. '..'
		//. DIRECTORY_SEPARATOR
		. 'framework'
	)
	. DIRECTORY_SEPARATOR
);
define(
	'UPLOAD_PATH' ,
	realpath(
		dirname( __DIR__ )
		. DIRECTORY_SEPARATOR
		. 'uploads'
	)
	. DIRECTORY_SEPARATOR
);
define(
	'UPLOAD_HANDLER' ,
	'/index/uploads/'
);
require FRAMEWORK . 'init.php';



if (
	UPLOAD_HANDLER
	===
	substr(
		$_SERVER['REQUEST_URI'] , 0 , strlen( UPLOAD_HANDLER )
	)
)
{
	echo ProfielBeheer::getProfileFile();
	//var_dump( ProfielBeheer::getProfileFile() );
}
else
{
	$id  =  NULL;
	//@todo[~immeëmosol, lun 2011-05-09, 17:13.43 CEST]
	//  dit wat netter implementeren ( ophalen van id )
	if( isset( $_SERVER['PATH_INFO'] ) )
		$id  =  substr( $_SERVER['PATH_INFO'] , 1 );

	$pb  =  new ProfielBeheer( $id );
	echo $pb->form();
}

