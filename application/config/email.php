<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (ENVIRONMENT === 'production') {
    // InfinityFree / Shared Hosting usually requires 'mail' or specific local SMTP
    // Using 'mail' is the safest bet for free tier, though delivery is unreliable.
    $config['protocol'] = 'mail';
    $config['mailtype'] = 'html';
    $config['charset'] = 'utf-8';
    $config['wordwrap'] = TRUE;
    $config['newline'] = "\r\n";
    $config['crlf'] = "\r\n";
} else {
    // Local Development (Gmail SMTP)
    $config['protocol'] = 'smtp';
    $config['smtp_host'] = 'smtp.gmail.com';
    $config['smtp_port'] = 587;
    $config['smtp_user'] = 'campusapp007@gmail.com';
    $config['smtp_pass'] = 'zjnz qjxn vjus odco'; // App Password
    $config['smtp_crypto'] = 'tls';
    $config['mailtype'] = 'html';
    $config['charset'] = 'utf-8';
    $config['newline'] = "\r\n";
    $config['crlf'] = "\r\n";
}
