<?php
$config['smtp_host'] = $_SERVER['SMTP_HOST'];
$config['smtp_port'] = $_SERVER['SMTP_PORT'];
$config['smtp_user'] = $_SERVER['SMTP_USER'];
$config['_smtp_auth'] = TRUE;
$config['smtp_pass'] = $_SERVER['SMTP_PASS'];
$config['smtp_crypto'] = 'tls';
$config['protocol'] = 'smtp';
$config['mailtype'] = 'html';
$config['send_multipart'] = FALSE;
$config['charset'] = 'utf-8';
$config['wordwrap'] = TRUE;
$config['crlf'] = "\r\n";
$config['newline'] = "\r\n"
  ?>