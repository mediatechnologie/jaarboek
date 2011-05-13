<?php
//@todo[~immeëmosol, lun 2011-05-09, 16:22.46 CEST]
//  uitschrijven van de setter-methodes
class LeerlingData implements IteratorAggregate , ArrayAccess
{
	private $ai;
	public function getIterator ()
	{
		//vd($this->content);
		if ( !( $this->ai instanceof ArrayIterator ) )
			$this->ai  =  new ArrayIterator( $this->content );
		return $this->ai;
	}
	public function offsetExists($offset){
		//dpb();
//var_dump( $this->getIterator() , $offset );
		return $this->getIterator()->offsetExists($offset);}
	public function offsetGet($offset){
		return $this->getIterator()->offsetGet($offset);}
	public function offsetSet($offset,$value){
		return $this->getIterator()->offsetSet($offset,$value);}
	public function offsetUnset($offset){
		return $this->getIterator()->offsetUnset( $offset );}

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

	public function pk ()
	{
		return 'leerling_id';
	}

	//public function __destruct(){vd($this);}
	public function multiSet ( $array )
	{
		foreach ( $array as $k => $v )
		{
			if ( !array_key_exists( $k , $this->content ) )
				die( 'bastard' );
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

