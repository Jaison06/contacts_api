<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    use HasFactory;

    protected $table = 'contacts';
    protected $fillable = ['company_id', 'first_name', 'last_name', 'email', 'phone'];

    public function Company()
    {
        return $this->belongsTo(Company::class);
    }
}
