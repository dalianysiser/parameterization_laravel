<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonTypeInformation extends Model
{
    protected $fillable=[
        'person_id',
        'company_id',
        'type_information_id',
        'detail_type_information_id',
        'consecutive',
        'field_1',
        'field_2',
        'field_3',
        'field_4',
        'field_5'
    ];

    protected function casts():array{
        return [
            'created_at'=>'datetime'
        ];
    }

    public function person(){
        return $this->belongsTo(Person::class);
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function typeInformation(){
        return $this->belongsTo(TypeInformation::class);
    }

    public function detailTypeInformation() { 
        return $this->belongsTo(DetailTypeInformation::class); 
    }
}
