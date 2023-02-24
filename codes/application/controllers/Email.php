<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
        
        class Email extends CI_Controller{
        
            function  __construct(){
                parent::__construct();
            }

            public function send(){
                $this->load->library('phpmailer_lib');
        
                // PHPMailer object
                $mail = $this->phpmailer_lib->load();
                try {
                    //Server settings
                    $mail->SMTPDebug = 0;                      //Enable verbose debug output
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->Username   = 'movie.tastic69@gmail.com';                     //SMTP username
                    $mail->Password   = 'mvtuhmbdywpiivjt';                               //SMTP password
                    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
                    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
                    //Recipients
                    $mail->setFrom('movie.tastic69@gmail.com', 'Movie Tastic');
                    $mail->addAddress('arlanticojerick09@gmail.com');               //Name is optional
                    $mail->addReplyTo('movie.tastic69@gmail.com');
                    // $mail->addCC('cc@example.com');
                    // $mail->addBCC('bcc@example.com');
    
                    //Attachments
                    // $mail->AddEmbeddedImage('img/'.$banner1.'', 'movie_banner');
                    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
    
                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = 'Ticket Receipt';
                    $mail->Body    = 'THANK YOU FOR BUYING <strong>Jeeriick</strong>!<br>';
    
                    $mail->send();
                    echo 'Message has been sent';
                    header("Location: index.php");
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            }
        }