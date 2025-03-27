<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class FieldType extends Model
{
    protected $table = 'field_types';
    protected $fillable=[
        'name'
    ];
    protected function name() : Attribute {
        return Attribute::make(
            set: function($value) {
                return ucfirst($value);
            },
            get: function($value) {
                return ucfirst($value);
            }
        );
    }

    protected function casts():array{
        return [
            'created_at'=>'datetime'
        ];
    }

    public function detailTypeInformation(){
        return $this->hasMany(DetailTypeInformation::class);
    }
}
