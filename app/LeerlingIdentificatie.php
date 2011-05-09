<?php

class LeerlingIdentificatie
{
	private $value   =  'NULL';
	private $column  =  'leerling_id';

	public function __construct ( $a )
	{
		$this->value  =  $a;

		if ( isset( $unusable_identifier ) )
			throw new Exception( 'unknown identifier for Leerling' );
	}

	public function column ()
	{
		return $this->column;
	}
	public function value ()
	{
		return $this->value;
	}
}

