<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PaymentStatusApiTest extends TestCase
{
    use MakePaymentStatusTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatePaymentStatus()
    {
        $paymentStatus = $this->fakePaymentStatusData();
        $this->json('POST', '/api/v1/paymentStatuses', $paymentStatus);

        $this->assertApiResponse($paymentStatus);
    }

    /**
     * @test
     */
    public function testReadPaymentStatus()
    {
        $paymentStatus = $this->makePaymentStatus();
        $this->json('GET', '/api/v1/paymentStatuses/'.$paymentStatus->id);

        $this->assertApiResponse($paymentStatus->toArray());
    }

    /**
     * @test
     */
    public function testUpdatePaymentStatus()
    {
        $paymentStatus = $this->makePaymentStatus();
        $editedPaymentStatus = $this->fakePaymentStatusData();

        $this->json('PUT', '/api/v1/paymentStatuses/'.$paymentStatus->id, $editedPaymentStatus);

        $this->assertApiResponse($editedPaymentStatus);
    }

    /**
     * @test
     */
    public function testDeletePaymentStatus()
    {
        $paymentStatus = $this->makePaymentStatus();
        $this->json('DELETE', '/api/v1/paymentStatuses/'.$paymentStatus->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/paymentStatuses/'.$paymentStatus->id);

        $this->assertResponseStatus(404);
    }
}
