<?php
function getStringByLang($titleInHu, $titleInEn)
{
  $lang = strtolower($_COOKIE["lang"]) ?? null;

  if ($lang === "hu") {
    return $titleInHu;
  } else {
    return $titleInEn;
  }
}
