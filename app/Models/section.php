<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class section extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['Name_Section'];

    public function My_classs()
    {
        return $this->belongsTo('App\Models\Classroom', 'Class_id');
    }

    public function teachers()
    {
        return $this->belongsToMany('App\Models\Teacher','teacher_section');
    }


}
