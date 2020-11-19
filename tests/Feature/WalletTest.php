<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Wallet;
use App\Models\Transfer;

class WalletTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetWallet()
    {
        $wallet = wallet::factory()->create();
        //posible error transfer::factory(3)
        $transfers = transfer::factory(3)->create([
            'wallet_id' => $wallet->id
        ]);

        $response = $this->json('GET','/api/wallet');

        $response->assertStatus(200)
                ->assertJsonStructure([
                    'id','money','transfers' =>[
                        '*'=>[
                            'id','amount','description','wallet_id'
                        ]
                    ]
                ]);

        $this->assertCount(3, $response->json()['transfers']);        
    }
}
