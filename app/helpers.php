<?php

use App\Models\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
/**
 * Return sizes readable by humans
 */
function human_filesize($bytes, $decimals = 2)
{
  $size = ['B', 'kB', 'MB', 'GB', 'TB', 'PB'];
  $factor = floor((strlen($bytes) - 1) / 3);

  return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) .
      @$size[$factor];
}




function menuSubmenu($menu, $submenu)
{
  $request = request();
  $request->session()->forget(['lsbm','lsbsm']);
  $request->session()->put(['lsbm'=>$menu,'lsbsm'=>$submenu]);
  return true;
}




function bdMobile($mobile)
{
    $number = trim($mobile);
    $c_code = '880';
    $cc_count = strlen($c_code);

    if(substr($number, 0, 2) == '00')
    {
        $number = ltrim($number, '0');
    }
    if(substr($number, 0, 1) == '0')
    {
        $number = ltrim($number, '0');
    }
    if(substr($number, 0, 1) == '+')
    {
        $number = ltrim($number, '+');
    }
    if(substr($number, 0, $cc_count) == $c_code)
    {
        $number = substr($number, $cc_count);
    }
    if(substr($c_code, -1) == 0)
    {
        $number = ltrim($number, '0');
    }
    $finalNumber = $c_code.$number;

    return $finalNumber;
}



function smsUrl($to, $msg)
{
    $userid = 'bisesoggo.test';
    $password = '11112222';
    $sender = '01970009329';

    return "http://apismpp.ajuratech.com/sendtext?apikey=62319aab9168d33a&secretkey=a95fe3da&callerID={$sender}&toUser={$to}&messageContent={$msg}";
}


function intMobile($cc,$mobile)
{
    $number = trim($mobile);
    $c_code = $cc;
    $cc_count = strlen($c_code);

    if(substr($number, 0, 2) == '00')
    {
        $number = ltrim($number, '0');
    }
    if(substr($number, 0, 1) == '0')
    {
        $number = ltrim($number, '0');
    }
    if(substr($number, 0, 1) == '+')
    {
        $number = ltrim($number, '+');
    }
    if(substr($number, 0, $cc_count) == $c_code)
    {
        $number = substr($number, $cc_count);
    }
    if(substr($c_code, -1) == 0)
    {
        $number = ltrim($number, '0');
    }
    $finalNumber = $c_code.$number;

    return $finalNumber;



}




function getSlug($title = Null, $model = Null, $edit = false)
{
  if (!is_null($title)) {
    $slug = "";
    if (!preg_match('/[^\x20-\x7e]/', $title)) {
      $slug = Str::slug($title);
    }
    $slug = empty($slug) ? generateSlug($title) : $slug;
    if (!$model == Null) {
      $exixts = $model->where('slug', $slug)->get();
      if (count($exixts) > 0 && !$edit) {
        $slug = $slug . '-' . time();
      }
    }
    return $slug;
  } else {
    return time();
  }
}
/**
 * Generate Slug NUmber For All Language
 */
function generateSlug($title, $seperator = '-')
{
  $title = str_replace(['- ', ' -', ' '], $seperator, $title);
  $title = str_replace('@', 'AT', $title);
  $title = strip_tags($title);
  return trim($title);
}


