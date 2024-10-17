<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AccountType extends Model
{
    use HasFactory;

	protected $table = 'account_types';

	protected $fillable = [
		'account_type',
		'account_category',
		'balance_type',
		'notation',	
    ];

	public $timestamps = false;

	public function accounts(): HasMany
    {
        return $this->hasMany(Account::class);
    }
}
