<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/var/www/html/vendor/autoload.php';

class MessageController {
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);
            $name = $data['name'] ?? '';
            $email = $data['email'] ?? '';
            $message = $data['message'] ?? '';

            if (empty($name) || empty($email) || empty($message)) {
                http_response_code(400);
                echo json_encode(['error' => 'All fields are required.']);
                return;
            }

            // Send email
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->isSMTP();                                            
                $mail->Host       = 'smtp.gmail.com';                     
                $mail->SMTPAuth   = true;                                   
                $mail->Username   = getenv('EMAIL_USER');               
                $mail->Password   = getenv('PASSWORD_EMAIL');                  
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
                $mail->Port       = 587;                                    

                //Recipients
                $mail->setFrom('gufrondev@gmail.com', 'Mailer');
                $mail->addAddress('gufrondev@gmail.com', 'Your Name');

                // Content
                $mail->isHTML(true);                                  
                $mail->Subject = 'New Message from ' . $name;
                $mail->Body    = 'Email: ' . $email . '<br>Message: ' . nl2br($message);

                $mail->send();
                echo json_encode(['success' => 'Message has been sent']);
            } catch (Exception $e) {
                http_response_code(500);
                echo json_encode(['error' => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"]);
            }
        } else {
            http_response_code(405);
            echo json_encode(['error' => 'Method not allowed']);
        }
    }
}
