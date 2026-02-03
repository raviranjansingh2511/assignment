<?php

use Illuminate\Support\Facades\Crypt;
use App\Models\ShortUrl;



function p($p, $exit = 1)
{
  echo '<pre>';
  print_r($p);
  echo '</pre>';
  if ($exit == 1) {
    exit;
  }
}



function get_encrypted_value($key, $encrypt = false)
{
  $encrypted_key = null;
  if (!empty($key)) {
    if ($encrypt == true) {
      $key = Crypt::encrypt($key);
    }
    $encrypted_key = $key;
  }
  return $encrypted_key;
}

function get_decrypted_value($key, $decrypt = false)
{
  $decrypted_key = null;
  if (!empty($key)) {
    if ($decrypt == true) {
      $key = Crypt::decrypt($key);
    }
    $decrypted_key = $key;
  }
  return $decrypted_key;
}

function generate_short_url_code($length = 6)
{
    do {
        $code = substr(base_convert(uniqid(), 16, 36), 0, $length);
    } while (ShortUrl::where('short_code', $code)->exists());

    return $code;
}
