<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NoticeCategory extends Model
{
    protected $table = 'notice_categories';

    protected $fillable = [
        'category_name','category_name_bn','status','details',
    ];
}
