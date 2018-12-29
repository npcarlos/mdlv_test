<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SellerApiTest extends TestCase
{
    use MakeSellerTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateSeller()
    {
        $seller = $this->fakeSellerData();
        $this->json('POST', '/api/v1/sellers', $seller);

        $this->assertApiResponse($seller);
    }

    /**
     * @test
     */
    public function testReadSeller()
    {
        $seller = $this->makeSeller();
        $this->json('GET', '/api/v1/sellers/'.$seller->id);

        $this->assertApiResponse($seller->toArray());
    }

    /**
     * @test
     */
    public function testUpdateSeller()
    {
        $seller = $this->makeSeller();
        $editedSeller = $this->fakeSellerData();

        $this->json('PUT', '/api/v1/sellers/'.$seller->id, $editedSeller);

        $this->assertApiResponse($editedSeller);
    }

    /**
     * @test
     */
    public function testDeleteSeller()
    {
        $seller = $this->makeSeller();
        $this->json('DELETE', '/api/v1/sellers/'.$seller->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/sellers/'.$seller->id);

        $this->assertResponseStatus(404);
    }
}
