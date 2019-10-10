<?php

/*

DECODED & CRACKED BY KontolKuda17
Lampung, Indonesia

*/

require_once("setting/phpmailer/PHPMailerAutoload.php");
include('setting/Gx.settings.php');
include('setting/Gx.function.php');

echo "Sender phpmyadmin\r\n";
echo "\n\n              IIIIIIIIIIDDDDDDDDDDDDD        NNNNNNNN        NNNNNNN\r\n";
echo "              I::::::::ID:::::::::::::::DD   N::::::::N      N::::::N\r\n";
echo "              II::::::IIDDD:::::DDDDD:::::D  N:::::::::N     N::::::N\r\n";
echo "                I::::I    D:::::D    D:::::D N::::::::::N    N::::::N\r\n";
echo "                I::::I    D:::::D     D:::::DN:::::::::::N   N::::::N\r\n";
echo "                I::::I    D:::::D     D:::::DN:::::::N::::N  N::::::N\r\n";
echo "                ======    =======     ====================== ========\e[0m\r\n";
echo "                \e[101m                                                     \r\n";
echo "\e[0m                         GX40 SENDER V.1.5 - INDONESIADARKNET\r\n";
echo "                \e[107m                                                     \r\n";
echo "\e[0m                ======    =======     ===============  ==============\r\n";
echo "                I::::I    D:::::D     D:::::DN::::::N   N:::::::::::N\r\n";
echo "                I::::I    D:::::D     D:::::DN::::::N    N::::::::::N\r\n";
echo "                I::::I    D:::::D    D:::::D N::::::N     N:::::::::N\r\n";
echo "              II::::::IIDDD:::::DDDDD:::::D  N::::::N      N::::::::N\r\n";
echo "              I::::::::ID:::::::::::::::DD   N::::::N       N:::::::N\r\n";
echo "              I::::::::ID::::::::::::DDD     N::::::N        N::::::N\r\n";
echo "              IIIIIIIIIIDDDDDDDDDDDDD        NNNNNNNN         NNNNNNN\r\n";
echo "\r\n";


function Kirim($email, $smtp_acc, $gx_setup)
{
    $smtp           = new SMTP;
    $smtp->do_debug = 0;

    $smtpserver     = $smtp_acc['host'];
    $smtpport       = $smtp_acc['port'];
    $smtpuser       = $smtp_acc['username'];
    $smtppass       = $smtp_acc['password'];
    $priority       = $gx_setup['priority'];
    $userandom      = $gx_setup['userandom'];
    $sleeptime      = $gx_setup['sleeptime'];
    $replacement    = $gx_setup['replacement'];
    $userremoveline = $gx_setup['userremoveline'];
    $fromname       = $gx_setup['fromname'];
    $frommail       = $gx_setup['frommail'];
    $subject        = $gx_setup['subject'];
    $msgfile        = $gx_setup['msgfile'];
    $filepdf        = $gx_setup['filesend'];
    $randurl        = $gx_setup['scampage'];

    if (!$smtp->connect($smtpserver, $smtpport)) {
        throw new Exception('Connect failed');
    }

    //Say hello
    if (!$smtp->hello(gethostname())) {
        throw new Exception('EHLO failed: ' . $smtp->getError()['error']);
    }

    $e = $smtp->getServerExtList();

    if (array_key_exists('STARTTLS', $e)) {
        $tlsok = $smtp->startTLS();
        if (!$tlsok) {
            throw new Exception('Failed to start encryption: ' . $smtp->getError()['error']);
        }
        if (!$smtp->hello(gethostname())) {
            throw new Exception('EHLO (2) failed: ' . $smtp->getError()['error']);
        }
        $e = $smtp->getServerExtList();
    }

    if (array_key_exists('AUTH', $e)) {

        if ($smtp->authenticate($smtpuser, $smtppass)) {
            $mail           = new PHPMailer;
            $mail->Encoding = 'base64'; // 8bit base64 multipart/alternative quoted-printable
            $mail->CharSet  = 'UTF-8';
            $mail->headerLine("format", "flowed");
            /*  Smtp connect    */
            //$mail->addCustomHeader('X-Ebay-Mailtracker', '11400.000.0.0.df812eaca5dd4ebb8aa71380465a8e74');
            $mail->IsSMTP();
            $mail->SMTPAuth = true;
            $mail->Host     = $smtpserver;
            $mail->Port     = $smtpport;
            $mail->Priority = $priority;
            $mail->Username = $smtpuser;
            $mail->Password = $smtppass;

            if ($userandom == 1) {
                $rand     = rand(1, 50);
                $fromname = randName($rand);
                $frommail = randMail($rand);
                $subject  = randSubject($rand);
            }

            if ($gx_setup['filesend'] == 0) {
                $filepdf = file_get_contents($AddAttachment);
                $mail->AddAttachment($filepdf);
            }

            $asu       = RandString1(8);
            $asu1      = RandString(5);
            $asu2      = RandString1(5);
            $nmbr      = RandNumber(5);
            $fromnames = str_replace('##randstring##', $asu1, $fromname);
            $frommails = str_replace('##randstring##', $asu, $frommail);
            $subjects  = str_replace('##randstring##', $asu2, $subject);

            $mail->setFrom($frommails, $fromnames);

            $mail->AddAddress($email);

            $mail->Subject = $subjects;
            if ($replacement == 1) {
                $msg = lettering($msgfile, $email, $frommail, $fromname, $randurl, $subject);
            } else {
                $msg = file_get_contents($msgfile);
            }

            $mail->msgHTML($msg);

            if (!$mail->send()) {
                echo "SMTP Error : " . $mail->ErrorInfo;
                exit();
            } else {
                echo "\e[91m[+] \e[4m";
                echo date('h:i:s A');
                echo "\e[0m \e[91m[+] \e[0m Send To : $email \e[91m|\e[0m Send From : $smtpuser\n";
            }
            $mail->clearAddresses();

        } else {
            throw new Exception('Authentication failed: ' . $smtp->getError()['error']);
        }

        $smtp->quit(true);

    }

}



    $file = file_get_contents($gx_setup['mail_list']);
    if ($file) {
        $ext = preg_split('/\n|\r\n?/', $file);
        echo "                               \e[1;4m_________________\e[0m \r\n";
        echo "\e[91m=============================[\e[0m \e[1;4mGX40 SENDER READY\e[0m \e[91m]==============================\e[0m";
        echo "\r\n";
        echo "\n";
        $smtp_key = 0;
        foreach ($ext as $num => $email) {

            if ($smtp_key == count($smtp_acc)) {
                $smtp_key = 0;
            }
            //kirim
            Kirim($email, $smtp_acc[$smtp_key], $gx_setup);

            $smtp_key++;

            ///
            sleep($gx_setup['sleeptime']);
        }
        if ($gx_setup['userremoveline'] == 1) {
            $remove = Removeline($mailist, $email);
        }
    }
