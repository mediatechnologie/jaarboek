<?php
class FormElement
{
	public $type;
	public $value;
	public $name;
	public $id;

	public function __construct ( $properties = NULL )
	{
		if ( NULL === $properties )
			return;

		foreach ( $properties as $k=>$v )
		{
			$k  =  'set' . $k;
			$this->$k( $v );
		}
	}
	public function __call ( $method , $args )
	{
		$method  =  substr( $method , 3 );
		$this->$method  =  $args[ 0 ];
	}

	public function type ()
	{
		if ( !$this->type )
			return 'text';
		return $this->type;
	}
	public function value ()
	{
		return $this->value;
	}
	public function name ()
	{
		return $this->name;
	}
	public function id ()
	{
		return $this->id;
	}
	public function desc ()
	{
		$desc  =  '';
		$desc .=  $this->name();
		return $desc;
	}
}
