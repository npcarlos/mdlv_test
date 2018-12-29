<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePackagerAPIRequest;
use App\Http\Requests\API\UpdatePackagerAPIRequest;
use App\Models\Packager;
use App\Repositories\PackagerRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class PackagerController
 * @package App\Http\Controllers\API
 */

class PackagerAPIController extends AppBaseController
{
    /** @var  PackagerRepository */
    private $packagerRepository;

    public function __construct(PackagerRepository $packagerRepo)
    {
        $this->packagerRepository = $packagerRepo;
    }

    /**
     * Display a listing of the Packager.
     * GET|HEAD /packagers
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->packagerRepository->pushCriteria(new RequestCriteria($request));
        $this->packagerRepository->pushCriteria(new LimitOffsetCriteria($request));
        $packagers = $this->packagerRepository->all();

        return $this->sendResponse($packagers->toArray(), 'Packagers retrieved successfully');
    }

    /**
     * Store a newly created Packager in storage.
     * POST /packagers
     *
     * @param CreatePackagerAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePackagerAPIRequest $request)
    {
        $input = $request->all();

        $packagers = $this->packagerRepository->create($input);

        return $this->sendResponse($packagers->toArray(), 'Packager saved successfully');
    }

    /**
     * Display the specified Packager.
     * GET|HEAD /packagers/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Packager $packager */
        $packager = $this->packagerRepository->findWithoutFail($id);

        if (empty($packager)) {
            return $this->sendError('Packager not found');
        }

        return $this->sendResponse($packager->toArray(), 'Packager retrieved successfully');
    }

    /**
     * Update the specified Packager in storage.
     * PUT/PATCH /packagers/{id}
     *
     * @param  int $id
     * @param UpdatePackagerAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePackagerAPIRequest $request)
    {
        $input = $request->all();

        /** @var Packager $packager */
        $packager = $this->packagerRepository->findWithoutFail($id);

        if (empty($packager)) {
            return $this->sendError('Packager not found');
        }

        $packager = $this->packagerRepository->update($input, $id);

        return $this->sendResponse($packager->toArray(), 'Packager updated successfully');
    }

    /**
     * Remove the specified Packager from storage.
     * DELETE /packagers/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Packager $packager */
        $packager = $this->packagerRepository->findWithoutFail($id);

        if (empty($packager)) {
            return $this->sendError('Packager not found');
        }

        $packager->delete();

        return $this->sendResponse($id, 'Packager deleted successfully');
    }
}
