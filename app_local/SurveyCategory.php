<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SurveyCategory extends Model
{
    protected $table = 'survey_categories';

    protected $fillable = [
        'category_name','category_name_bn','status','details',
    ];
}
