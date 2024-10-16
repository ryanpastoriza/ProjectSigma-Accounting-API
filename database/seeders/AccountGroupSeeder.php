<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AccountGroup;
use App\Models\Account;

class AccountGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
		$disbursementAccounts = Account::whereHas('accountType', function($query) {
			$query->where('account_category', 'expenses');
		})->get();

		// $cashAccounts = Account::whereHas('accountType', function($query) {
		// 	$query->where('account_category', 'asset');
		// })->get();

		// $journal = Accounts::all();

        $disbursement = AccountGroup::create(['name' => 'disbursement']);
		// $cash = AccountGroup::create(['name' => 'cash']);
		// $journal = AccountGroup::create(['name' => 'journal']);

		
		foreach($disbursementAccounts as $da) {
			$disbursement->accounts()->sync($da->id, false);
		}
    }
}
