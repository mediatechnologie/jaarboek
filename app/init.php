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
require FRAMEWORK . 'init.php';



$id  =  NULL;
//@todo[~immeëmosol, lun 2011-05-09, 17:13.43 CEST]
//  dit wat netter implementeren ( ophalen van id )
if( isset( $_SERVER['PATH_INFO'] ) )
	$id  =  substr( $_SERVER['PATH_INFO'] , 1 );

$pb  =  new ProfielBeheer( $id );
echo $pb->form();

