<?php
require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;

$header = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/app/helpers/email_templates/header.html');
$footer = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/app/helpers/email_templates/footer.html');
$footer = str_replace('{{ thisYear }}', date("Y"), $footer);

$requested_params = [
    "application_accepted" => ["surname", "name", "phone", "email", "applicationId"],
    "email_confirmation"   => ["confirmation_code"],
];

$replacements = [
    '{{ surname }}' => 'Иванов',
    '{{ name }}' => 'Иван',
    '{{ phone }}' => '80258909430',
    '{{ email }}' => 'test@ex.com',
    '{{ applicationId }}' => '4425',
];

function sendMail(string $address, string $subject, string $template, array $params)
{
    global $header;
    global $footer;
    global $requested_params;
    $mail = new PHPMailer;
    $mail->CharSet = 'utf-8';
    $mail->isSMTP();
    $mail->Host = 'mailbe07.hoster.by';
    $mail->SMTPAuth = true;
    $mail->Username = 'noreply@belmice.by';
    $mail->Password = '5bm1TM_w$t';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->setFrom('noreply@belmice.by', 'NOREPLY | Витаю в облаках');
    $mail->isHTML(true);
    $mail->addAddress($address);
    $mail->Subject = $subject;
    $body = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/app/helpers/email_templates/'.$template.'.html');

    $missingKeys = array_diff($requested_params[$template], array_keys($params));
    $extraKeys = array_diff(array_keys($params), $requested_params[$template]);

    if (empty($missingKeys) && empty($extraKeys)) {
        foreach ($params as $key => $value) {
            $body = str_replace('{{ '.$key.' }}', $value, $body);
        }
        $mail->Body = $header . $body . $footer;
        try {
            $mail->send();
            if($mail->isError()){
                return json_encode(["errs" => 1, "res" => "Message could not be sent. Mailer Error: ", $mail->ErrorInfo]);
            }
            return json_encode(["errs" => 0, "res" => "Message sent successfully"]);
        } catch (Exception $e) {
            return json_encode(["errs" => 1, "res" => "Message could not be sent. Mailer Error: " . $e->getMessage() . " Mailer Error Info: ".$mail->ErrorInfo]);
        }

    } else {
        if (!empty($missingKeys)) {
            return json_encode(["errs" => 2, "res" => "Missing keys: " . implode(", ", $missingKeys) . ". "]);
        }
        if (!empty($extraKeys)) {
            return json_encode(["errs" => 2, "res" => "Extra keys: " . implode(", ", $extraKeys) . ". "]);
        }
    }
    return json_encode(["errs" => 3, "res" => "Unexpected error occurred"]);
}
