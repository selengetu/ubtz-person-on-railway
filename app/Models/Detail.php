<?php

namespace  App\Models;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    public $timestamps = false;
    protected $table = 'RIBBON_DETAIL';
    protected $primaryKey = 'detail_id';
}
