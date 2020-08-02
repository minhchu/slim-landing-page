<?php

$app->get('/', function ($request, $response) {
    return $this->view->render($response, 'index.phtml', [
        'csrf_name'  => $request->getAttribute('csrf_name'),
        'csrf_value' => $request->getAttribute('csrf_value'),
    ]);
});

$app->post('/submit', function ($request, $response) {
    $data = $request->getParsedBody();

    $name = isset($data['name']) ? escape($data['name']) : 'Anonymous';
    $phone = isset($data['phone']) ? escape($data['phone']) : '+123456789';
    $address = isset($data['address']) ? escape($data['address']) : 'No address';
    $description = isset($data['description']) ? escape($data['description']) : '';

    $mail = new \PHPMailer();

    $mail->isSMTP();
    $mail->SMTPDebug = 2;
    $mail->Host = env('MAIL_HOST', 'smtp.gmail.com');
    $mail->Port = env('MAIL_PORT', 587);
    $mail->SMTPSecure = 'tls';

    $mail->SMTPAuth = true;
    $mail->Username = env('MAIL_USERNAME');
    $mail->Password = env('MAIL_PASSWORD');

    $mail->setFrom(env('MAIL_USERNAME'), 'example@gmail.com');
    $mail->addAddress('another@gmail.com', 'Minh Chu');
    $mail->Subject = 'New Order';
    $mail->Body = "{$name} \n {$phone} \n {$address} \n {$description}";

    if (!$mail->send()) {
        $this->flash->error('Email cannot be sent');
        $this->logger->addError('Message could not be sent. Mailer Error: '.$mail->ErrorInfo);
    } else {
        $this->flash->success('Order successfully');
    }

    return $response->withRedirect('/');
});
