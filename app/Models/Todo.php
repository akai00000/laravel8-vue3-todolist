<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $table = "Todos";
    protected $guarded = ['id'];

    public static $rules = array([
        'title' => 'required',
        'rabel' => 'required',
        'rabel_id' => 'nullable',
        'priority' => 'required',
        'deadline' => 'required',
        'content' => 'required',
    ]);
}
