<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class FormTemplates extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    protected $fillable = [
        'id',
        'template_name',
        'size_file',
        'url_file',
        'type_id',
        'status',
        'sort_order',
        'created_by',
        'updated_by',
    ];

    public function pathUrl()
    {
        return isset($this->url_file) ? asset($this->url_file) : null;
    }
    public function formType()
    {
        return FormType::find($this->type_id);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }
}
