<?php

namespace Tests\Unit;

use App\Actions\NumberGenerator;
use App\Exceptions\NegativeOrZeroAmountException;
use App\Exceptions\NotEnoughMoneyException;
use App\Exceptions\TransferSameIdException;
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
        for ($i = 1; $i <= 3; $i++){
            $sender = PayAccount::inRandomOrder()->limit(1)->first();
            $receiver = PayAccount::where('id','!=', $sender->id)->inRandomOrder()->limit(1)->first();
            $amount = 500;
            $sender_before = $sender->balance;
            $receiver_before = $receiver->balance;
            $transfer = new Transfer();
            $transfer->run($sender, $receiver, $amount, 'TEST');
            // maybe fetch again
            $sender_after = PayAccount::where('id', $sender->id)->value('balance');
            $receiver_after = PayAccount::where('id', $receiver->id)->value('balance');
            $this->assertEquals($sender_before, $sender_after + $amount);
            $this->assertEquals($receiver_before, $receiver_after - $amount);
        }

    }

    /**
     * test
     */
    public function run_negative_amount()
    {
        // SEED THE DATABASE
        $seeder = new DatabaseSeeder();
        $seeder->call(UserSeeder::class);
        $seeder->call(CompanySeeder::class);
        //GET RANDOM UNIQUE ID's OF TWO ACCOUNTS
        $sender = PayAccount::inRandomOrder()->limit(1)->first();
        $receiver = PayAccount::where('id','!=', $sender->id)->inRandomOrder()->limit(1)->first();

        $transfer = new Transfer();
        $this->expectException(NegativeOrZeroAmountException::class);
        $transfer->run($sender, $receiver, -500, 'TEST');
    }

    /**
     * test
     */
    public function run_same_ids()
    {
        // SEED THE DATABASE
        $seeder = new DatabaseSeeder();
        $seeder->call(UserSeeder::class);
        $seeder->call(CompanySeeder::class);
        $sender = PayAccount::inRandomOrder()->limit(1)->first();

        $transfer = new Transfer();
        $this->expectException(TransferSameIdException::class);
        $transfer->run($sender, $sender, 100, 'TEST');
    }

    /**
     * test
     */
    public function run_not_enough_money()
    {
        // SEED THE DATABASE
        $seeder = new DatabaseSeeder();
        $seeder->call(UserSeeder::class);
        $seeder->call(CompanySeeder::class);
        //GET RANDOM UNIQUE ID's OF TWO ACCOUNTS
        $sender = PayAccount::inRandomOrder()->limit(1)->first();
        $receiver = PayAccount::where('id','!=', $sender->id)->inRandomOrder()->limit(1)->first();

        $transfer = new Transfer();
        $this->expectException(NotEnoughMoneyException::class);
        $transfer->run($sender, $receiver, 5000, 'TEST');
    }
}
