<?php

class Leerling
{
	private $data;

	public function __construct ()
	{
		$this->data  =  new LeerlingData();
	}
	public static function construct ( $identificatie = NULL )
	{
		if ( NULL === $identificatie )
			return Leerlingen::nieuw();

		$id  =  new LeerlingIdentificatie( $identificatie );
		return Leerlingen::haal( $id );
	}

	public function get ( $a )
	{
		if ( is_array( $a ) )
			return $a = $this->data->fromArray();

		throw new Exception( 'not yet implemented' );
	}
	public function set ( $a )
	{
		if ( is_array( $a ) )
			return $this->data->fromArray( $a );

		throw new Exception( 'not yet implemented' );
	}

	public function elementen ()
	{
		$elementen  =  array();
		$elementen  =  $this->data->columns();
		return $elementen;
	}
}

