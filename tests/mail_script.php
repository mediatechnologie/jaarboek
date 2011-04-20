<?php
$to  = '07113@ma-web.nl' . ', ';
$to .= 'w.fris@ma-web.nl';

$subject = 'Jaarboek 2011';

$message = "
<html>
<head>
  <title>Jaarboek 2011</title>
</head>
<body>
  <p>Vergeet je account niet te activeren op het jaarboek van 2011</p>
  <table>
    <tr>
      <td>ga naar <a href='http://www.markspier.nl'>jaarboek.nl</a> en activeer je account</td>
    </tr>
    <tr>
      <td>Vergeet niet om wat van je projecten te uploaden en schrijf iets leuks over jezelf</td>
    </tr>
  </table>
</body>
</html>
";

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

//$headers .= 'To: Mark Spier<spier8338@hotmail.com>' . "\r\n";
$headers .= 'From: Jaarboek 2011 <spier8338@hotmail.com>' . "\r\n";
//$headers .= 'Cc: spier8338@hotmail.com' . "\r\n";
//$headers .= 'Bcc: spier8338@hotmail.com' . "\r\n";

mail($to, $subject, $message, $headers);
?>