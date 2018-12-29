<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PackagerApiTest extends TestCase
{
    use MakePackagerTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatePackager()
    {
        $packager = $this->fakePackagerData();
        $this->json('POST', '/api/v1/packagers', $packager);

        $this->assertApiResponse($packager);
    }

    /**
     * @test
     */
    public function testReadPackager()
    {
        $packager = $this->makePackager();
        $this->json('GET', '/api/v1/packagers/'.$packager->id);

        $this->assertApiResponse($packager->toArray());
    }

    /**
     * @test
     */
    public function testUpdatePackager()
    {
        $packager = $this->makePackager();
        $editedPackager = $this->fakePackagerData();

        $this->json('PUT', '/api/v1/packagers/'.$packager->id, $editedPackager);

        $this->assertApiResponse($editedPackager);
    }

    /**
     * @test
     */
    public function testDeletePackager()
    {
        $packager = $this->makePackager();
        $this->json('DELETE', '/api/v1/packagers/'.$packager->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/packagers/'.$packager->id);

        $this->assertResponseStatus(404);
    }
}
