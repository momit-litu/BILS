<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SurveyParticipatentAnswer extends Model
{
    protected $table = 'survey_participant_answers';

    protected $fillable = [
        'survey_participan_id','survey_question_id',
    ];

    public function options()
    {
        return $this->hasMany('App\SurveyParticipatentAnswerOption','survey_participant_answer_id','id');
    }
}
