<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeComboInformation extends Model
{
    protected $table = 'type_combo_information';

    protected $fillable=[
        'company_id','type_information_id', 'type', 'code', 'detail_type_information_id','is_active'
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

    public function detailTypeInformation() { 
        return $this->belongsTo(DetailTypeInformation::class); 
    }
}
