<?php

class Leerlingen
{
	private static $database  =  'php_ma-jaarboek';
	private static $tabel     =  'leerling';

	public static function nieuw ()
	{
		$leerling  =  new Leerling();
		//vd($leerling);
		return $leerling;
	}
	public static function haal ( LeerlingIdentificatie $id )
	{
		$leerling  =  new Leerling( $id );
		$dp  =  DataProvider::get( self::$database , self::$tabel );
		$data  =  $dp->getRow( $id->column() , $id->value() );
		$leerling->set( $data );
		//vd($leerling);
		return $leerling;
	}
}

