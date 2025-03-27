<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailTypeInformation extends Model
{
    protected $table = 'detail_type_information';
    protected $fillable=[
        'type_information_id', 'company_id', 'detail', 'field_type_id', 'comesCombo','order','is_active'
    ];

    protected function casts():array{
        return [
            'created_at'=>'datetime'
        ];
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function typeInformation(){
        return $this->belongsTo(TypeInformation::class);
    }

    public function fieldType(){
        return $this->belongsTo(FieldType::class);
    }

    public function typeComboInformation() { 
        return $this->hasMany(TypeComboInformation::class); 
    }

    public function personTypeInformation(){
        return $this->hasMany(PersonTypeInformation::class);
    }
}
