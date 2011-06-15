<?php
/**
 *  @file profiel.php
 *  @author immeëmosol (programmer dot willfris at nl) 
 *  @date 2011-06-13
 *  Created: lun 2011-06-13, 15:07.59 CEST
 *  Last modified: mer 2011-06-15, 12:09.33 CEST
**/

//!  php ondersteunde functionaliteiten
require GLOBAL_FW;

//! systeem ondersteunende functionaliteiten
class DataObject implements ArrayAccess
{
	private $data;
	public function __construct ( $data )
	{
		if ( is_null( $this->data[ $data[ 'id' ] ] ) )
			$this->data[ $data[ 'id' ] ]  =  array();
		elseif ( !is_array( $this->data[ $data[ 'id' ] ] ) )
			throw new Exception( 'ghehe' );

		$a  =& $this->data[ $data[ 'id' ] ];
		$a[ 'name' ]  =  $data[ 'name' ];
		$b  =&  $a[ 'data' ];
		foreach ( $data[ 'data' ] as $k => $v )
		{
			if ( !is_object( $v ) )
			{
				$b[ $k ]  =  $v;
				continue;
			}
			if ( is_a( $v , 'DataObjectHolder' ) )
			{
				$v  =  $v->data->sets();
				$k  =  key( $v );
				$b[ $k ]  =  $v[ $k ];
			}
			else
				throw new Exception( 'unimplemented' );
		}
	}

	public function offsetExists ( $offset )
	{
		vd(__METHOD__,$offset);
	}
	public function offsetUnset ( $offset )
	{
		vd(__METHOD__,$offset);
	}
	public function offsetSet ( $offset , $value )
	{
		if ( NULL === $offset )
			$this->data[]  =  $value;
		else
			$this->data[ $offset ]  =  $value;
	}
	public function offsetGet ( $offset )
	{
		vd(__METHOD__,$offset);
	}

	/**
	 *  return array collection of all data that is available,
	 *    can be used by datasets.
	**/
	public function sets ()
	{
		return $this->data;
	}
}
abstract class DataObjectHolder
{
	public $data  =  NULL;
	final public function __construct ()
	{
		$this->_init();
		if ( !( is_a( $this->data , 'DataObject' ) ) )
			echo/** /throw new Exception/**/( 'failed in being DataObjectHolder' );

	}
	//@note[~immeëmosol, mar 2011-06-14, 15:05.56 CEST]
	//  too bad this gives strict-standards-notice when the subclass has obligatory params
	protected function _init (){}
	private function addData ( $data )
	{
		if ( is_a( $data , 'DataObjectHolder' ) )
		{
			return $this->addData( $data->data() );
		}
		elseif ( is_a( $data , 'DataObject' ) )
		{
			$this->data[]  =  $do;
			return TRUE;
		}
		elseif ( is_array( $data ) )
		{
			reset( $data );
			while ( $d  =  current( $data ) )
			{
				if ( !$this->addData( $d ) )
					throw new Exception( 'que¿' );
				next( $data );
			}
		}
		return FALSE;
	}
}
//! domein ondersteunende functionaliteiten
class Info extends DataObjectHolder
{
	private $props  =  array(
		'name' => array(
			'desc'         =>  'Naam' ,
			'placeholder'  =>  'vul hier je naam in' ,
		) ,
		'tuss'  =>  array(
			'desc'  =>  'tussenvoegsels' ,
			'placeholder'  =>  'vul hier je tussenvoegsels in' ,
		) ,
		'surn'  =>  array(
			'desc'  =>  'Achternaam' ,
			'placeholder'  =>  'vul hier je achternaam in' ,
		) ,
		'desc'  =>  array(
			'type'  =>  'textarea' ,
			'desc'  =>  'Beschrijving' ,
			'placeholder'  =>  'geef hier een beschrijving van jezelf' ,
		) ,
		'pass'  =>  array(
			'type'  =>  'password' ,
			'desc'  =>  'Wachwoord' ,
			'placeholder'  =>  'geef hier je wachtwoord op' ,
		) ,
		'avat'  =>  array(
			'type'  =>  'file' ,
			'desc'  =>  'Avatar' ,
			'placeholder'  =>  'voer hier je avatar in' ,
		) ,
	);
	protected function _init ()
	{
		$i  =  array(
			'id' => 'info' ,
			'name' => 'Persoonlijke info' ,
			'data' => $this->props ,
		);
		$this->data  =  new DataObject( $i );
	}
}
class Projecten extends DataObjectHolder
{
	public function _init ()
	{
		$this->projecten    =  array();
		$this->projecten[]  =  new Project();
		$this->projecten[]  =  new Project();

		$i  =  array(
			'id' => 'projects' ,
			'name' => 'Projecten' ,
			'data' => $this->projecten ,
		);
		$this->data  =  new DataObject( $i );
	}
}
class Project extends DataObjectHolder
{
	private $props  =  array(
		'name' => array(
			'desc' => 'Naam' ,
			'placeholder' => 'vul naam project in' ,
		) ,
	);
	public function _init ()
	{
		static $j=0;
		$j++;
		$p['data']['proj1']     =  array();
		$i  =  array(
			'id' => 'p' . $j ,
			'name' => 'project '.$j ,
			'data' =>
				$this->props ,
		);
		$this->data  =  new DataObject( $i );
	}
}
class Gebruiker extends DataObjectHolder
{
	public function _init ()
	{
		$this->info       =  new Info();
		$this->projecten  =  new Projecten();

		$i  =  array(
			'id' => 'user' ,
			'name' => 'Gebruikersinfo' ,
			'data' => array(
				$this->info ,
				$this->projecten ,
			) ,
		);
		$this->data  =  new DataObject( $i );
	}
}

//! Data klaarzetten
$gebruiker  =  new Gebruiker( '' );
$datasets   =  $gebruiker->data->sets();

//! Data omzetten naar bruikbare html
$return  =  form( $datasets );
if(!empty($_POST))vd($_POST);
if(!empty($_FILES))vd($_FILES);
echo $return;

