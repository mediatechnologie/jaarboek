<?php
class Leerling implements Profiel
{
	private $id;
	private $data;

	public function __construct ( LeerlingIdentificatie $id = NULL )
	{
		$this->data  =  new LeerlingData();
		$this->id  =  $id;
	}
	public static function construct ( $identificatie = NULL )
	{
		if ( NULL === $identificatie )
			return Leerlingen::nieuw();

		$id  =  new LeerlingIdentificatie( $identificatie );
		return Leerlingen::haal( $id );
	}

	public function id ()
	{
		return $this->id;
	}
	public function data ()
	{
		return $this->data;
	}
	public function set ( $a )
	{
		if ( is_array( $a ) )
			return $this->data->multiSet( $a );

		throw new Exception( 'not yet implemented' );
	}

	public function elementen ()
	{
		$elementen  =  array();
		$_elementen  =  $this->data->columns();
		foreach ( $_elementen as $_element )
		{
			$element                   =  array();
			$element[ 'name' ]         =  $_element;
			$element[ 'id' ]           =  $_element;
			$element[ 'placeholder' ]  =  $_element;

			$element[ 'type' ]         =  'text';
			if ( 'wachtwoord' === $element['name'] )
				$element[ 'type' ]  =  'password';
			if ( 'leerling_id' === $element['name'] )
				$element[ 'type' ]  =  'hidden';
			if ( 'avatar' === $element['name'] )
				$element[ 'type' ]  =  'file';
			if ( 'beschrijving' === $element['name'] )
				$element[ 'type' ]  =  'textarea';

			$element[ 'value' ]  =  '';
			if ( isset( $_POST[ $element[ 'name' ] ] ) )
				$element[ 'value' ]  =  $_POST[ $element[ 'name' ] ];

			$elementen[ $_element ]  =  new FormElement( $element );
		}
		return $elementen;
	}
}
