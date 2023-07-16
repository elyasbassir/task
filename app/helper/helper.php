<?php

namespace App\helper;

class helper
{
static public function hash($text){
    return md5(sha1(md5($text)));
}



}
