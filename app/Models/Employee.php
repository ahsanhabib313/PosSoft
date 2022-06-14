<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [

        'name',
        'designation_id',
        'photo',
        'phone',
        'nid',
        'salary',
        'gender',
        'address',
        'joining_date',
        'leaving_date',
        'is_leave'

    ];

  
        /* Get the designation name that owns the Employee
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        public function designation()
        {
            return $this->belongsTo(Designation::class);
        }
    

 

}
