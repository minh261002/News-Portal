<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSectionSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'language',
        'category_section_1',
        'category_section_2',
        'category_section_3',
        'category_section_4',
    ];

}