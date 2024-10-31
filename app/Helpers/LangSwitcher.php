<?php
namespace App\Helpers;

function languageSwitcher($string)
{
  $lang = strtolower($_COOKIE["lang"]) ?? null;
  return $string . "In" .$lang;
}