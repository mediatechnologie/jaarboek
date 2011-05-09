<?php

class DataProvider
{
	private $provider;
	private $tabel;
	public function __construct ( $provider , $tabel )
	{
		$this->provider  =  $provider;
		$this->tabel     =  $tabel;
	}
	public function getRow ( $c , $v )
	{
		$column  =  $this->provider->real_escape_string( $c );
		$value  =  $this->provider->real_escape_string( $v );
		$sql  =  ''
			. 'SELECT * FROM'
			. ' `' . $this->tabel . '`'
			. ' ' . 'WHERE' . ''
			. ' `' . $column . '`'
			. ' ' . '=' . ''
			. ' \'' . $value . '\''
			. ' '
		;
		$result =  $this->provider->query( $sql );
		$result_set  =  array();
		while ( $r = $result->fetch_assoc() )
		{
			$result_set[]  =  $r;
		}
		if ( 1 === count( $result_set ) )
			return current( $result_set );

		throw new Exception( 'houston we\'ve got a problem' );
	}
	public static function get (){
		$a=func_get_args();
		return call_user_func_array( 'DataProviders::get' , $a );
	}
}
class DataProviders
{
	private static $connections  =  array();
	public static function get ( $database , $tabel = NULL )
	{
		if (
			array_key_exists(
				$database ,
				self::$connections
			)
			&&
			array_key_exists(
				$tabel ,
				self::$connections[ $database ]
			)
		)
			return self::$connections[ $database ][ $tabel ];

		self::$connections[ $database ][ $tabel ]  =  NULL;
		$c =& self::$connections[ $database ][ $tabel ];
		$c  =  new DataProvider(
			new MySQLi( 'localhost' , 'php' , 'php' , $database )
			, $tabel
		);
		return self::get( $database , $tabel );
	}
}

