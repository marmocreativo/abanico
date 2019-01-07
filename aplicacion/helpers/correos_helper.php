<?php
defined('BASEPATH') OR exit('No direct script access allowed');

  /*
  Función general para enviar correos
  */
  function enviar_correo_abanico($remitente,$destinatarios,$plantilla,$asunto)
  {
    $CI =& get_instance();

    $config['protocol']    = 'smtp';
    $config['smtp_host']    = $CI->data['op']['mailer_host'];
    $config['smtp_port']    = $CI->data['op']['mailer_port'];
    $config['smtp_timeout'] = '7';
    $config['smtp_user']    = $CI->data['op']['mailer_user'];
    $config['smtp_pass']    = $CI->data['op']['mailer_pass'];
    $config['charset']    = 'utf-8';
    $config['mailtype'] = 'html'; // or html
    $config['validation'] = TRUE; // bool whether to validate email or not

    $mensaje = $CI->load->view($plantilla,$CI->data,true);
    $CI->email->initialize($config);

    $CI->email->from($remitente, 'Abanico Siempre lo Mejor');
    $CI->email->to($destinatarios);
    $CI->email->cc($destinatarios);

    $CI->email->subject($asunto);
    $CI->email->message($mensaje);
    // envio el correo
    $CI->email->send();
  }
