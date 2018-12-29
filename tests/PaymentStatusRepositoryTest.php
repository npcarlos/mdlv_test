<?php

use App\Models\PaymentStatus;
use App\Repositories\PaymentStatusRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PaymentStatusRepositoryTest extends TestCase
{
    use MakePaymentStatusTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var PaymentStatusRepository
     */
    protected $paymentStatusRepo;

    public function setUp()
    {
        parent::setUp();
        $this->paymentStatusRepo = App::make(PaymentStatusRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatePaymentStatus()
    {
        $paymentStatus = $this->fakePaymentStatusData();
        $createdPaymentStatus = $this->paymentStatusRepo->create($paymentStatus);
        $createdPaymentStatus = $createdPaymentStatus->toArray();
        $this->assertArrayHasKey('id', $createdPaymentStatus);
        $this->assertNotNull($createdPaymentStatus['id'], 'Created PaymentStatus must have id specified');
        $this->assertNotNull(PaymentStatus::find($createdPaymentStatus['id']), 'PaymentStatus with given id must be in DB');
        $this->assertModelData($paymentStatus, $createdPaymentStatus);
    }

    /**
     * @test read
     */
    public function testReadPaymentStatus()
    {
        $paymentStatus = $this->makePaymentStatus();
        $dbPaymentStatus = $this->paymentStatusRepo->find($paymentStatus->id);
        $dbPaymentStatus = $dbPaymentStatus->toArray();
        $this->assertModelData($paymentStatus->toArray(), $dbPaymentStatus);
    }

    /**
     * @test update
     */
    public function testUpdatePaymentStatus()
    {
        $paymentStatus = $this->makePaymentStatus();
        $fakePaymentStatus = $this->fakePaymentStatusData();
        $updatedPaymentStatus = $this->paymentStatusRepo->update($fakePaymentStatus, $paymentStatus->id);
        $this->assertModelData($fakePaymentStatus, $updatedPaymentStatus->toArray());
        $dbPaymentStatus = $this->paymentStatusRepo->find($paymentStatus->id);
        $this->assertModelData($fakePaymentStatus, $dbPaymentStatus->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletePaymentStatus()
    {
        $paymentStatus = $this->makePaymentStatus();
        $resp = $this->paymentStatusRepo->delete($paymentStatus->id);
        $this->assertTrue($resp);
        $this->assertNull(PaymentStatus::find($paymentStatus->id), 'PaymentStatus should not exist in DB');
    }
}
