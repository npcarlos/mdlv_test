<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PresentationSuppliesApiTest extends TestCase
{
    use MakePresentationSuppliesTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatePresentationSupplies()
    {
        $presentationSupplies = $this->fakePresentationSuppliesData();
        $this->json('POST', '/api/v1/presentationSupplies', $presentationSupplies);

        $this->assertApiResponse($presentationSupplies);
    }

    /**
     * @test
     */
    public function testReadPresentationSupplies()
    {
        $presentationSupplies = $this->makePresentationSupplies();
        $this->json('GET', '/api/v1/presentationSupplies/'.$presentationSupplies->id);

        $this->assertApiResponse($presentationSupplies->toArray());
    }

    /**
     * @test
     */
    public function testUpdatePresentationSupplies()
    {
        $presentationSupplies = $this->makePresentationSupplies();
        $editedPresentationSupplies = $this->fakePresentationSuppliesData();

        $this->json('PUT', '/api/v1/presentationSupplies/'.$presentationSupplies->id, $editedPresentationSupplies);

        $this->assertApiResponse($editedPresentationSupplies);
    }

    /**
     * @test
     */
    public function testDeletePresentationSupplies()
    {
        $presentationSupplies = $this->makePresentationSupplies();
        $this->json('DELETE', '/api/v1/presentationSupplies/'.$presentationSupplies->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/presentationSupplies/'.$presentationSupplies->id);

        $this->assertResponseStatus(404);
    }
}
