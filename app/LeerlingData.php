<?php
//@todo[~immeëmosol, lun 2011-05-09, 16:22.46 CEST]
//  uitschrijven van de setter-methodes
class LeerlingData
{
	private $content  =  array(
		  'leerling_id'     =>  NULL
		, 'voornaam'        =>  NULL
		, 'tussenvoegsels'  =>  NULL
		, 'achternaam'      =>  NULL
		, 'richting'        =>  NULL
		, 'beschrijving'    =>  NULL
		, 'wachtwoord'      =>  NULL
		, 'avatar'          =>  NULL
	);

	public function fromArray( $array )
	{
		//vd( $array );
		foreach ( $array as $k => $v )
		{
			$this->set( $k , $v );
		}
	}
	public function columns ()
	{
		$columns  =  array();
		$columns  =  array_keys( $this->content );
		return $columns;
	}
	private function set ( $k , $v )
	{
		return call_user_func_array(
			array(
				$this ,
				__FUNCTION__ . $k
			) ,
			array(
				$v
			)
		);
	}

	public function __call ( $method , $args )
	{
		$a  =  substr( $method , 0 , 3 );
		if ( 'get' === $a )
		{
			$k  =  substr( $method , 3 );
			$k  =  lcfirst( $k );
			$v  =  @$args[0];
			return $this->content[ $k ];
		}
		elseif ( 'set' === $a )
		{
			$k  =  substr( $method , 3 );
			$k  =  lcfirst( $k );
			$v  =  $args[0];
			$this->content[ $k ]  =  $v;
			return ( $this->content[ $k ] === $v );
		}
	}

}

