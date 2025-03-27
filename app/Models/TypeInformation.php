<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class TypeInformation extends Model
{
    protected $table = 'type_information';
    protected $fillable=[
        'name', 'company_id', 'codTypeInformation', 'typeInformation', 'is_singleRegistry','is_active'
    ];
    protected function typeInformation() : Attribute {
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

    public function company(){
        return $this->belongsTo(Company::class);
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
}
