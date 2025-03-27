<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Person extends Model
{
    protected $fillable=[
        'name', 'company_id'
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

    public function personTypeInformation(){
        return $this->hasMany(PersonTypeInformation::class);
    }
    
    public function company(){
        return $this->belongsTo(Company::class);
    }
}
