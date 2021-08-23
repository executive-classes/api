<?php

namespace Tests\Integration\PayGo;

use App\Support\Api\PayGo\Gate2AllClient;
use App\Exceptions\PayGo\PayGoException;
use App\Models\Eloquent\Billing\Biller\Biller;
use App\Services\PayGo\Transaction;
use Tests\Providers\Billing\CollectionProvider;
use Tests\Providers\PayGo\CreditCartProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreditCardTest extends TestCase
{
    use RefreshDatabase, WithFaker, CollectionProvider, CreditCartProvider;

    /**
     * Indicates that the database should seed.
     *
     * @var bool
     */
    protected $seed = true;

    /**
     * The PayGo transaction service.
     * 
     * @var Transaction
     */
    protected $transactionService;

    /**
     * Test Set Up.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        
        $this->transactionService = new Transaction(new Gate2AllClient);
    }

    /**
     * Test if a credit card can be tokenized.
     *
     * @return void
     */
    public function test_credit_card_can_be_tokenized()
    {
        $biller = Biller::factory()->create();
        $card = $this->makeCreditCard();

        $response = $this->transactionService->saveCreditCard($biller, $card);

        $this->assertIsObject($response);
        $this->assertNotEmpty($response->tokenizationId);
        $this->assertNotEmpty($response->referenceId);
        $this->assertNotEmpty($response->cardInfo->token ?? null);
        $this->assertEquals($biller->id, $response->referenceId);
    }

    /**
     * Test if a invalid credit card will not be tokenided.
     *
     * @return void
     */
    public function test_invalid_credit_card_will_not_be_tokenized()
    {
        $biller = Biller::factory()->create();
        $card = $this->makeCreditCard(false);

        $this->expectException(PayGoException::class);

        $this->transactionService->saveCreditCard($biller, $card);
    }

    /**
     * Test if a credit card can be consulted by its token.
     *
     * @return void
     */
    public function test_credit_card_can_be_consulted_by_token()
    {
        $biller = Biller::factory()->create();
        $card = $this->makeCreditCard();

        $response = $this->transactionService->saveCreditCard($biller, $card);
        $this->assertNotEmpty($response->cardInfo->token);

        $token = $response->cardInfo->token;
        $response = $this->transactionService->getCreditCard($token);

        $this->assertEquals($biller->id, $response->referenceId);
        $this->assertEquals($token, $response->cardInfo->token);
    }

}
