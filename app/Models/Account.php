<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Account extends Model
{
    use HasFactory;

	protected $table = 'accounts';

	protected $fillable = [
		'account_type_id',
		'account_number',
		'account_name',
		'account_description',
		'bank_reconciliation',
		'is_active',
		'statement',
    ];

	public function accountType(): BelongsTo
    {
        return $this->belongsTo(AccountType::class);
    }
}
