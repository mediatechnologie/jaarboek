<?php

class ProfielBeheer
{
	public function __construct ( $a = NULL )
	{
		$this->profiel  =  Leerling::construct( $a );
	}
	public function form ()
	{
		$form  =  '';
		$form .=  ''
			. '<form action="" method="POST">'
			. "\n"
		;
		$elementen  =  $this->profiel->elementen();
		$form .=  '<dl>';
		foreach ( $elementen as $element )
		{
			$id=$name=$element;
			$value  =  '';

			$for    =  ' for="' . $id . '"';
			$id     =  ' id="' . $id . '"';
			$type   =  ' type="text"';
			$name   =  ' name="' . $name . '"';
			$value  =  ' value="' . $value . '"';
			echo ''
				. '<dt>'
				. '<label' . $for . '>' . $element . '</label>'
				. '</dt>'
				. '<dd>'
				. '<input' . $type . $name . $id . $value . ' />'
				. '</dd>'
			;
		}
		$form .=  '</dl>';
		$form .=  ''
			. '<input type="submit" />'
			. '<input type="reset" />'
			. "\n"
			. '</form>'
			. "\n"
		;
		return $form;
	}
}

