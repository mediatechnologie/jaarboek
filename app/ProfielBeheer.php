<?php
// Profiel-Handler ?
class ProfielBeheer
{
	public function __construct ( $a = NULL )
	{
		$this->profiel  =  Leerling::construct( $a );
	}
	//public function __destruct(){vd($this->profiel);}
	public function __destruct ()
	{
		$db  =  new MySQLi( 'localhost' , 'php' , 'php' , 'php_ma-jaarboek' );
		$_data  =  $this->profiel->data();
		$pk  =  $_data->pk();
		$columns  =  $_data->columns();

		$id  =  $this->profiel->id();
		//$id  =  1*(''.$this->profiel->id());
		$ww  =  $db->real_escape_string( $_POST['wachtwoord'] );
		$sql  =  ''
			. 'SELECT * FROM leerling WHERE'
			. ' leerling_id = \'' . $id . '\''
			. ' AND '
			. ' wachtwoord = \'' . $ww . '\''
		;
		$r   =  $db->query( $sql );
		vd($r);
		ep($sql.';');
		ep(mysqli_error($db));

		$r2=mysqli_query( $db , $sql );
		//vd($r2);
		echo mysqli_error($db);
		if ( 1 !== mysqli_affected_rows( $db ) )
			die( 'verkeerd wachtwoord' );
		vd(mysqli_fetch_array($r2));

		$data  =  array();
		foreach ( $_data as $k => $v )
		{
			$k  =  $db->real_escape_string( $k );
			$v  =  $db->real_escape_string( $v );
			$data[$k]=$v;
		}
		$sql   =  'INSERT INTO leerling ('
			. implode( ',' , $columns )
			. ') VALUES ('
		;
		foreach ( $data as $k => $v )
		{
			$sql .=  '\'' . $v . '\' , ';
		}
		$sql   =  substr( $sql , 0 , -2 ) . ')';
		$sql .=  'ON DUPLICATE KEY UPDATE ';//leerling SET ';
		foreach ( $data as $k => $v )
		{
			if ( $pk === $k )
			{
				//$sql .=  $pk.' = LAST_INSERT_ID('.$pk.') , ';
				continue;
			}
			$sql .=  $k . ' = \'' . $v . '\' , ';
		}
		$sql   =  substr( $sql , 0 , -2 )
			//. ' WHERE ' . $pk . '=\'' . $data[$pk] . '\''
		;
		//vd(mysqli_affected_rows($db),$db->affected_rows,mysqli_insert_id($db),$db->insert_id);
		//vd($sql);die;
		//ep($sql);
		$result  =  $db->query( $sql );
		if ( !$result )
		{
			if ( defined('DEV') )
			{
				var_dump( $db );
				echo ( mysqli_error( $db ) );
				ep($sql.';');
			}
			die( 'Vette pech...' );
		}
	}
	public function form ()
	{
		$form  =  '';
		$form .=  ''
			. '<form action="" method="POST" enctype="multipart/form-data">'
			. "\n"
		;
		$profile_id  =  $this->profiel->id();
		$new_data  =  $_POST;
		$new_data[ 'avatar' ]  =  $this->haalAvatarUri( $profile_id );
		$data  =  $this->profiel->data();
		$data->multiSet( $new_data );
		$elementen   =  $this->profiel->elementen();
		$form .=  '<dl>';
		foreach ( $elementen as $element )
		{
			$pre_label   =  '';
			$post_label  =  '';
			$pre_input   =  '';
			$post_input  =  '';

			$type   =  $element->type();
			$id     =  $element->id();
			$name   =  $element->name();
			$value  =  $element->value();
			if ( empty( $value ) && isset( $data[ $name ] ) )
				$value  =  $data[ $name ];

			$desc   =  $element->desc();

			$id     =  htmlspecialchars( $id );
			$type   =  htmlspecialchars( $type );
			$name   =  htmlspecialchars( $name );
			$value  =  htmlspecialchars( $value );

			if ( 'file' === $type )
			{
				if (
					!isset( $_FILES[ $name ] )
					||
					'' === $_FILES[ $name ][ 'name' ]
				)
				{
					$file_handle['location']  =
						$this->haalAvatarUri( $profile_id );
				}
				else
				{
					$file_handle  =  $this->handleProfileFile(
						$profile_id ,
						$name ,
						$_FILES[ $name ] ,
						TRUE
					);
					if ( isset( $file_handle['errors'] ) )
						$pre_input .=  ''
							. '<p class="err">'
							. implode( ', ' , $file_handle['errors'] )
							. '</p>'
							. "\n"
						;
				}
				$pre_input .=  '<img src="'
					. $file_handle[ 'location' ] . '" />'
				;
			}

			$for    =  ' for="' . $id . '"';
			$id     =  ' id="' . $id . '"';
			$name   =  ' name="' . $name . '"';

			if ( 'hidden' === $type )
			{
				$label  =  '<!-- h4ck m3 \'n\' m4k3 m1 d4y. -->';
			}
			else
			{
				$pre_label  =  '<dt>' . $pre_label;
				$label  =  '<label' . $for . '>' . $desc . '</label>';
				$post_label .=  '</dt>';
				$pre_input  =  '<dd>' . $pre_input;
				$post_input .=  '</dd>';
			}

			if ( 'textarea' === $type )
			{
				$input  =  ''
					. '<textarea' . $name . $id . '>' . $value . '</textarea>';
			}
			elseif ( 'password' === $type )
			{
				$type   =  ' type="' . $type . '"';
				$value  =  ' value="' . $value . '"';

				$input  =  '<input' . $type . $name
					. $id . /** $value . /**/' />';
				$input .= ''
					. '<a href="/reset/' . $profile_id
					. '">reset wachtwoord</a>'
				;
			}
			else
			{
				$type   =  ' type="' . $type . '"';
				$value  =  ' value="' . $value . '"';

				$input  =  '<input' . $type . $name . $id . $value . ' />';
			}

			$form  .=  ''
				. $pre_label
				. $label
				. $post_label
				. $pre_input
				. $input
				. $post_input
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
	/**
	 *  returns location to uploaded file
	 *  and/or errors/notices.
	**/
	private function handleProfileFile (
		$profile_id ,
		$formElement_name ,
		$properties ,
		$avatar  =  FALSE
	)
	{
		$file_name  =  $_FILES[ $formElement_name ][ 'name' ];
		if ( TRUE === $avatar )
			$file_name  =  'avatar';// only for avatar
		$user_dir   =  $profile_id . DIRECTORY_SEPARATOR;
		if ( !is_dir( UPLOAD_PATH . $user_dir ) && !mkdir( UPLOAD_PATH . $user_dir ) )
			throw new Exception( 'could not create user_dir' );
		$file_handle  =  array();

		$to         =  UPLOAD_PATH . $user_dir . $file_name;
		$from       =  $_FILES[ $formElement_name ][ 'tmp_name' ];

		$file_handle['location']  =  UPLOAD_HANDLER . $user_dir . $file_name;
		$file_handle['from']  =  $from;

		if ( !is_uploaded_file( $from ) )
			$file_handle[ 'errors' ][]  =  'file is not valid';

		if ( TRUE !== $avatar && file_exists( $to ) )
			$file_handle[ 'errors' ][]  =  'file with same name already exists';
		elseif ( !move_uploaded_file( $from , $to ) )
			$file_handle[ 'errors' ][]  =  'could not copy file to location';

		return $file_handle;
	}
	public static function getProfileFile ()
	{
		$contents      =  array();

		$loc  =  substr( $_SERVER[ 'PATH_INFO' ] , strlen( '/uploads/' ) );
		$file  =  UPLOAD_PATH . $loc;

		$contents    =  file_get_contents( $file );

		$finfo = finfo_open( FILEINFO_MIME_TYPE );
		$mimetype  =  finfo_file( $finfo , $file );

		header( 'Content-type: ' . $mimetype );
		return $contents;
	}
	public static function haalAvatarUri ( $profile_id )
	{
		return UPLOAD_HANDLER . $profile_id . '/avatar';
	}
}

