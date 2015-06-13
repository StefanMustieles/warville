<?php

require_once '../config/emailconfig.php'; 

function mail_user($email, $newPassword) {

    $message = '<html><body>';
    $message .= '<div style="background-color: #091c5a; width: 80%; padding:10px;"><a href="http://gravesendrnli.org" style="text-decoration: none; color: White;"><img src="http://gravesendrnli.org/assets/img/rnliflag.png" alt="Gravesend RNLI" />&nbsp;&nbsp;Gravesend RNLI</a></div>';
    $message .= '<br /><br />Your password has been reset:<br /><br />';
    $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
    $message .= '<tr style="background: #eee;"><td><strong>New Password:</strong></td><td>' . $newPassword . '</td></tr>';
    $message .= '</table>';
    $message .= '<br />';
    $message .= 'Regards,<br /><br />gravsendrnli.org<br /><br />';
    $message .= '</body></html>';

    $headers = SEND_EMAIL;

    return mail($email, SUBJECT, $message, $headers); 
}
