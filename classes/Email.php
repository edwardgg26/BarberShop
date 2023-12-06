<?php 
    namespace Classes;
    use PHPMailer\PHPMailer\PHPMailer;

    class Email{

        public $email;
        public $nombre;
        public $token;
        public function __construct($email,$nombre,$token){
            $this->email = $email;
            $this->nombre = $nombre;
            $this->token = $token;
        }

        public function enviarConfirmacion(){
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = $_ENV["EMAIL_HOST"];
            $mail->SMTPAuth = true;
            $mail->Port = $_ENV["EMAIL_PORT"];
            $mail->SMTPSecure = $_ENV["EMAIL_SMTPSECURE"];
            $mail->Username = $_ENV["EMAIL_USERNAME"];
            $mail->Password = $_ENV["EMAIL_PASSWORD"]; 
            
            $mail->setFrom('admin@elcortecito.com');
            $mail->addAddress($this->email);
            $mail->Subject = 'Confirmación de la Cuenta: El Cortecito';

            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $contenido = "<html>";
            $contenido .= "<p>Hola ".$this->nombre.", para confirmar la creación de tu cuenta haz click en el siguiente enlace.</p>";
            $contenido .= "<p>Click para confirmar: <a href='".$_ENV["APP_URL"]."/confirmar-cuenta?token=".$this->token."'>Confirmar Cuenta</a></p>";
            $contenido .= "<p>Si no deseas continuar con la creacion de la cuenta puedes ignorar este mensaje</p>";
            $contenido .= "</html>";
            
            $mail->Body = $contenido;
            
            if ($mail->send()) {
                return true;
            }else{
                return false;
            }
        }

        public function enviarRetornoDePassword(){
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = $_ENV["EMAIL_HOST"];
            $mail->SMTPAuth = true;
            $mail->Port = $_ENV["EMAIL_PORT"];
            $mail->SMTPSecure = $_ENV["EMAIL_SMTPSECURE"];
            $mail->Username = $_ENV["EMAIL_USERNAME"];
            $mail->Password = $_ENV["EMAIL_PASSWORD"]; 
            
            $mail->setFrom('admin@elcortecito.com');
            $mail->addAddress($this->email);
            $mail->Subject = 'Reestablecer Password: El Cortecito';

            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $contenido = "<html>";
            $contenido .= "<p>Hola ".$this->nombre.", haz solicitado reestablecer tu contraseña, sigue el enlace para reestablecerlo.</p>";
            $contenido .= "<p>Reestablecer password: <a href='".$_ENV["APP_URL"]."/recuperar?token=".$this->token."'>Reestablecer</a></p>";
            $contenido .= "<p>Si no deseas continuar con el reestablecimiento de la contraseña puedes ignorar este mensaje</p>";
            $contenido .= "</html>";
            
            $mail->Body = $contenido;
            
            if ($mail->send()) {
                return true;
            }else{
                return false;
            }
        }
    }
?>