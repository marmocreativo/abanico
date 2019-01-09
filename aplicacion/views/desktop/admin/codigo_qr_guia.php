
<?php
$CI =& get_instance();

$CI->load->library('ciqrcode');
$params['data'] = 'This is a text to encode become QR Code';
$params['level'] = 'H';
$params['size'] = 10;
$CI->ciqrcode->generate($params);

echo '<img src="'.base_url().'tes.png" />';
?>
