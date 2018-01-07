<?php

class EmailGenerator {

    private $smtp_server;
    private $smtp_port;
    private $smtp_user;
    private $smtp_pass;
    private $email_sender_name;

    function __construct() {
        
    }

    public static function SendEmail($msg, $to, $subject, $attach = '') {
        if ($to != '') {
            set_time_limit(900);
            $emailconfig = AdmEmailConfig::model()->findByPk(1);

            $SM = Yii::app()->swiftMailer;
            if ($emailconfig->email_method == 1) {
                $transport = Swift_SmtpTransport::newInstance($emailconfig->smtp_server, $emailconfig->smtp_port)
                        ->setUsername($emailconfig->smtp_user)
                        ->setPassword($emailconfig->smtp_pass);
            } else if ($emailconfig->email_method == 2) {
                $transport = Swift_SmtpTransport::newInstance($emailconfig->smtp_server, $emailconfig->smtp_port);
            }

            // Mailer
            $message = Swift_Message::newInstance();

            $message->setTo($to);
            $message->setSubject($subject);
            $message->setFrom(array($emailconfig->smtp_user => $emailconfig->email_sender_name));
            $message->setBody($msg, 'text/html');

            if ($attach != "") {
                $message->attach(Swift_Attachment::fromPath($attach));
            }
            // Send the email
            $mailer = Swift_Mailer::newInstance($transport);

            if ($mailer->send($message)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function getEmailSubject($recognize) {
        $content = EmailContent::model()->find("recognize_text='" . $recognize . "'");
        return $content->email_subject;
    }

    static function setEmailMessageBodyUser($recognize, $type, $empId, $userName, $pwd) {
        $empData = EmpBasic::model()->findByPk($empId);
        $content = AdmEmailContent::model()->find("recognize_text='" . $recognize . "'");
        $format = AdmEmailFormat::model()->find('email_type="' . $type . '"');

        $msg = $content->email_content;
        $subject = $content->email_subject;
        $top = $format->email_format;

        $replacearrBody = array(
            '[empName]' => $empData->emp_display_name,
            '[username]' => $userName,
            '[password]' => $pwd,
        );
        $new_msg = self::str_replace_assoc($replacearrBody, $msg);

        $replacearrFull = array(
//            '[header_logo]' => Yii::app()->getBaseUrl(true) . "/images/system/email/logo/logo-160.png",
            '[email_subject]' => $subject,
            '[email_message_body]' => $new_msg);
        $mailbody = self::str_replace_assoc($replacearrFull, $top);

        return $mailbody;
    }

    private static function str_replace_assoc(array $replace, $msg) {
        return str_replace(array_keys($replace), array_values($replace), $msg);
    }

//    public static function jobSeekerVerificationUrl($encryptedId) {
//        return Yii::app()->getBaseUrl(true) . "/JobSeeker/ViewRegistration/id/" . $encryptedId;
//    }
//
//    public static function employerVerificationUrl($encryptedId) {
//        return Yii::app()->getBaseUrl(true) . "/Employer/EmployerRegister/id/" . $encryptedId;
//    }
}

?>
