<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DiscountApiTest extends TestCase
{
    use MakeDiscountTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateDiscount()
    {
        $discount = $this->fakeDiscountData();
        $this->json('POST', '/api/v1/discounts', $discount);

        $this->assertApiResponse($discount);
    }

    /**
     * @test
     */
    public function testReadDiscount()
    {
        $discount = $this->makeDiscount();
        $this->json('GET', '/api/v1/discounts/'.$discount->id);

        $this->assertApiResponse($discount->toArray());
    }

    /**
     * @test
     */
    public function testUpdateDiscount()
    {
        $discount = $this->makeDiscount();
        $editedDiscount = $this->fakeDiscountData();

        $this->json('PUT', '/api/v1/discounts/'.$discount->id, $editedDiscount);

        $this->assertApiResponse($editedDiscount);
    }

    /**
     * @test
     */
    public function testDeleteDiscount()
    {
        $discount = $this->makeDiscount();
        $this->json('DELETE', '/api/v1/discounts/'.$discount->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/discounts/'.$discount->id);

        $this->assertResponseStatus(404);
    }
}
