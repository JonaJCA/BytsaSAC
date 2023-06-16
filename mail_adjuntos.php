<?php 

include ('mailer/src/Exception.php');
include ('mailer/src/PHPMailer.php');
include ('mailer/src/SMTP.php');
include ('index.html');

?>

<!-- Sweet Alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<!-- Alertify JS -->
<link href="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/alertify.min.css" rel="stylesheet"/>
<script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/alertify.min.js"></script>

<?php

$Nombre=$_GET['Nombre'];
$Apellidos=$_GET['Apellidos'];
$Email=$_GET['E-mail'];
$archivo1=$_GET['archivo1'];
$emailTo="jonathan_corro@hotmail.com";//aca es donde llega...

echo "$Nombre $Apellidos $Email $emailTo";
//$registro = "https://bytsasac.000webhostapp.com//#work_area";

        try {

          $subject = "BYTSA S.A.C. | CV Postulacion";

          $bodyEmail .= '<html><body>';
          $bodyEmail .= "<br><br>Estimados, le adjunto el correo correspondiente al postulante!<br><br>";
          $bodyEmail .= '<table rules="all" border="1" style="border-color: #666; width: 670px;" cellpadding="15">';                    
          $bodyEmail .= "<tr><td style='background-color: #DBDBDB;'><strong> Nombres del postulante:</strong> </td><td>" . $Nombre . "</td></tr>";
          $bodyEmail .= "<tr><td style='background-color: #DBDBDB;'><strong> Apellidos del postulante:</strong> </td><td>" . $Apellidos . "</td></tr>";
          $bodyEmail .= "<tr><td style='background-color: #DBDBDB;'><strong> Correo electronico:</strong> 
              </td><td>" . $Email . "</td></tr>";
          $bodyEmail .= "</table>";
          $bodyEmail .= "<br><br>© Todos los derechos reservados - BYTSA  S.A.C. - ".date('Y').".";
          $bodyEmail .= "</body></html>";

          $fromemail = "webytsa@gmail.com";//aca es quien envia
          $fromname = "BYTSA S.A.C. | CV Postulacion";
          //$host = "smtp.live.com"; // hotmail
          //$host = "gmail.live.com"; // gmail
          //$port = "465";
          $port = "587";
          $SMTPAuth = true;
          $SMTPSecure = "tls";
          $password = "XaLe$0sTeaMBluexXx21"; //clave de quien envia para validar como correo seguros
          
             $mail = new  PHPMailer\PHPMailer\PHPMailer();
             $mail->SMTPAutoTLS = false;
             $mail->isSMTP();
             $mail->isHTML(true);
             //$mail->SMTPDebug = 1;
             //$mail->Host = $host;
             $mail->Host = 'tls://smtp.gmail.com:587';
             $mail->SMTPOptions = array(
                   'ssl' => array(
                     'verify_peer' => false,
                     'verify_peer_name' => false,
                     'allow_self_signed' => true
                    )
                );
             $mail->Port = $port;
             $mail->SMTPAuth = $SMTPAuth;
             $mail->SMTPSecure = $SMTPSecure;
             $mail->Username = $fromemail;
             $mail->Password = $password;
             $mail->From = "no-reply@bytsa.pe";
             $mail->WordWrap = 70;
             
             $mail->setFrom($fromemail, $fromname);
             $mail->addAddress($emailTo);

             // asunto
             $mail->Subject = $subject;
             // cuerpo email
             $mail->Body = $bodyEmail;

             if (!$mail->send()) { ?>
                  <script type="text/javascript">
                    alertify.set('notifier','position', 'bottom-right');
                    alertify.error('No se pudo realizar el envío del correo',5);
                  </script>
             <?php  
                  die();
             }

                ?>
                  <script type="text/javascript">
                    alertify.set('notifier','position', 'bottom-right');
                    alertify.success('Se ha enviado su postulación satisfactoriamente VERIFICAR CORREO',5);
                  </script>
             <?php  
} catch (Exception $e) {
          var_dump($e->getMessage());die();
          
         }

?>