<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter PHPMailer Class
 *
 * This class enables SMTP email with PHPMailer
 *
 * @category    Libraries
 * @author      CodexWorld
 * @link        https://www.codexworld.com
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class PHPMailer_Lib
{
    public function __construct(){
        log_message('Debug', 'PHPMailer class is loaded.');
    }

    public function load()
    {
        // Include PHPMailer library files
        require_once APPPATH.'third_party/PHPMailer/Exception.php';
        require_once APPPATH.'third_party/PHPMailer/PHPMailer.php';
        require_once APPPATH.'third_party/PHPMailer/SMTP.php';
        
        $mail = new PHPMailer;
                // SMTP configuration
        $mail->isSMTP();
        $mail->Host     = 'smtp-relay.sendinblue.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'eazedesk@gmail.com';
        $mail->Password = 'FtzJ5wXgU7b2Ep1q';
        $mail->SMTPSecure = 'auto';
        $mail->Port     = 587;
        $mail->setFrom('info@dilkhushyadav.com', 'CampMate');
        $mail->addReplyTo('info@dilkhushyadav.com', 'CampMate');
        
        return $mail;
    }
}