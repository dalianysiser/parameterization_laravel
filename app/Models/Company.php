<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
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

    public function typeInformation(){
        return $this->hasMany(TypeInformation::class);
    }

    public function detailTypeInformation(){
        return $this->hasMany(DetailTypeInformation::class);
    }

    public function typeComboInformation(){
        return $this->hasMany(TypeComboInformation::class);
    }

    public function personTypeInformation(){
        return $this->hasMany(PersonTypeInformation::class);
    }

    public function people(){
        return $this->hasMany(Person::class);
    }
}
