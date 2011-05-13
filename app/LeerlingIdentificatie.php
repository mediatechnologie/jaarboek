<?php

class LeerlingIdentificatie
{
	private $value   =  'NULL';
	private $column  =  'leerling_id';

	public function __construct ( $a )
	{
		if ( isset( $unusable_identifier ) )
			throw new Exception( 'unknown identifier for Leerling' );

		$this->value  =  $a;
	}

	public function column ()
	{
		return $this->column;
	}
	public function value ()
	{
		return $this->value;
	}

	public function __toString ()
	{
		return (string) $this->value();
	}
}

