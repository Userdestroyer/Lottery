<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\PayAccount;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $company = [
                'name' => 'Lotto',
                'password' => '12345678',
                'email' => 'lotto@gmail.com',
                'phone_number' => '900-555-05-05'
            ];

        $new = Company::firstOrCreate($company);
        $payAccount = PayAccount::factory()->make([
            'description' => "Lotto's balance",
            'balance' => 1000000000
        ]);
        $new->payAccount()->save($payAccount);

    }
}
