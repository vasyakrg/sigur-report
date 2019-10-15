<?php

namespace App\Models;


use App\Core\Model;

class Model_main extends Model
{

    public function get_data($srt)
    {
        return parent::get_data($srt);
    }

    public function generateposts($qposts, $qwords, $qusers)
    {
        return parent::generateposts($qposts, $qwords, $qusers);
    }
}
