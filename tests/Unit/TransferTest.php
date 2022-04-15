<?php

namespace Tests\Unit;

use App\Actions\NumberGenerator;
use Database\Seeders\CompanySeeder;
use Database\Seeders\DatabaseSeeder;
use Database\Seeders\UserSeeder;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Actions\Transfer;
use App\Models\PayAccount;


class TransferTest extends TestCase
{

    use RefreshDatabase;
    /**
     * @test
     */
    public function run_success()
    {
        $seeder = new DatabaseSeeder();
        $seeder->call(UserSeeder::class);
        $seeder->call(CompanySeeder::class);
        for ($i = 1; $i <= 2; $i++){
            $sender = PayAccount::find($i);
            $receiver = PayAccount::where('id','!=', $sender->id)->inRandomOrder()->limit(1)->first();
            $amount = 500;
            $sender_before = $sender->balance;
            $receiver_before = $receiver->balance;
            $transfer = new Transfer();
            $transfer->run($sender->id, $receiver->id, $amount, 'TEST');
            // maybe fetch again
            $sender_after = PayAccount::where('id', $sender->id)->value('balance');
            $receiver_after = PayAccount::where('id', $receiver->id)->value('balance');
            $this->assertEquals($sender_before, $sender_after + $amount);
            $this->assertEquals($receiver_before, $receiver_after - $amount);
        }

    }

    public function run_negative_amount()
    {
        /*$seeder = new DatabaseSeeder();
        $seeder->call(UserSeeder::class);
        $seeder->call(CompanySeeder::class);
        $transfer = new Transfer();
        $transfer->run($sender->id, $receiver->id, $amount, 'TEST');*/

    }

    public function run_same_ids()
    {
        $seeder = new DatabaseSeeder();
        $seeder->call(DatabaseSeeder::class);

    }

    public function run_not_enough_money()
    {
        $seeder = new DatabaseSeeder();
        $seeder->call(DatabaseSeeder::class);

    }
}
