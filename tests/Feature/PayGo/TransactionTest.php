<?php

namespace Tests\Feature\PayGo;

use App\Apis\PayGo\Gate2AllClient;
use App\Enums\Apis\PayGoStatusEnum;
use App\Enums\Billing\PaymentMethodEnum;
use App\Exceptions\PayGo\PayGoException;
use App\Services\PayGo\Transaction;
use App\Traits\Providers\Billing\CollectionProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    use RefreshDatabase, WithFaker, CollectionProvider;

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
     * Test if a transaction can be created with a tradable method of a collection.
     * 
     * @dataProvider getCollectionsWithTradableMethods
     *
     * @param callable $provider
     * @return void
     */
    public function test_transaction_with_tradable_method_can_be_created(callable $provider)
    {
        [$collection] = $provider();

        $response = $this->transactionService->create($collection);

        $this->assertIsObject($response);
        $this->assertNotEmpty($response->transactionId);
        $this->assertNotEmpty($response->referenceId);
        $this->assertEquals($collection->id, $response->referenceId);
    }
    
    /**
     * Test if a error is throwed with a untradable method of a collection.
     * 
     * @dataProvider getCollectionsWithUntradableMethods
     *
     * @param callable $provider
     * @return void
     */
    public function test_transaction_with_untradable_method_can_not_be_created(callable $provider)
    {
        [$collection] = $provider();

        $this->expectException(PayGoException::class);
        $this->expectErrorMessage(__('paygo.fail.invalid_payment'));

        $this->transactionService->create($collection);
    }

    /**
     * Test if a transaction can be created with a tradable method of a collection.
     * 
     * @param callable $provider
     * @return void
     */
    public function test_transaction_can_be_canceled()
    {
        $collection = $this->makeWithCustomPaymentMethod(PaymentMethodEnum::CREDIT_CARD());

        $response = $this->transactionService->create($collection);
        $this->assertNotEmpty($response->transactionId);
        $this->assertNotEmpty($response->status);

        if (!PayGoStatusEnum::fromValue($response->status)->in(config('api.paygo.cancelableStatus'))) {
            return;
        }

        $transaction_id = $response->transactionId;
        $response = $this->transactionService->cancel($transaction_id);

        $this->assertNotEmpty($response->transactionId);
        $this->assertNotEmpty($response->status);
        $this->assertEquals($transaction_id, $response->transactionId);
        $this->assertEquals(PayGoStatusEnum::CANCELED, $response->status);
    }

    /**
     * Test if a transaction can be created with a tradable method of a collection.
     * 
     * @dataProvider getCollectionsWithTradableMethods
     *
     * @param callable $provider
     * @return void
     */
    public function test_transaction_can_be_consulted(callable $provider)
    {
        [$collection] = $provider();

        $response = $this->transactionService->create($collection);
        $this->assertNotEmpty($response->transactionId);

        $transaction_id = $response->transactionId;
        $response = $this->transactionService->check($transaction_id);

        $this->assertNotEmpty($response->transactionId);
        $this->assertEquals($transaction_id, $response->transactionId);
    }

}
