<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SupplyCategoryApiTest extends TestCase
{
    use MakeSupplyCategoryTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateSupplyCategory()
    {
        $supplyCategory = $this->fakeSupplyCategoryData();
        $this->json('POST', '/api/v1/supplyCategories', $supplyCategory);

        $this->assertApiResponse($supplyCategory);
    }

    /**
     * @test
     */
    public function testReadSupplyCategory()
    {
        $supplyCategory = $this->makeSupplyCategory();
        $this->json('GET', '/api/v1/supplyCategories/'.$supplyCategory->id);

        $this->assertApiResponse($supplyCategory->toArray());
    }

    /**
     * @test
     */
    public function testUpdateSupplyCategory()
    {
        $supplyCategory = $this->makeSupplyCategory();
        $editedSupplyCategory = $this->fakeSupplyCategoryData();

        $this->json('PUT', '/api/v1/supplyCategories/'.$supplyCategory->id, $editedSupplyCategory);

        $this->assertApiResponse($editedSupplyCategory);
    }

    /**
     * @test
     */
    public function testDeleteSupplyCategory()
    {
        $supplyCategory = $this->makeSupplyCategory();
        $this->json('DELETE', '/api/v1/supplyCategories/'.$supplyCategory->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/supplyCategories/'.$supplyCategory->id);

        $this->assertResponseStatus(404);
    }
}
