<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAdministratorAPIRequest;
use App\Http\Requests\API\UpdateAdministratorAPIRequest;
use App\Models\Administrator;
use App\Repositories\AdministratorRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class AdministratorController
 * @package App\Http\Controllers\API
 */

class AdministratorAPIController extends AppBaseController
{
    /** @var  AdministratorRepository */
    private $administratorRepository;

    public function __construct(AdministratorRepository $administratorRepo)
    {
        $this->administratorRepository = $administratorRepo;
    }

    /**
     * Display a listing of the Administrator.
     * GET|HEAD /administrators
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->administratorRepository->pushCriteria(new RequestCriteria($request));
        $this->administratorRepository->pushCriteria(new LimitOffsetCriteria($request));
        $administrators = $this->administratorRepository->all();

        return $this->sendResponse($administrators->toArray(), 'Administrators retrieved successfully');
    }

    /**
     * Store a newly created Administrator in storage.
     * POST /administrators
     *
     * @param CreateAdministratorAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateAdministratorAPIRequest $request)
    {
        $input = $request->all();

        $administrators = $this->administratorRepository->create($input);

        return $this->sendResponse($administrators->toArray(), 'Administrator saved successfully');
    }

    /**
     * Display the specified Administrator.
     * GET|HEAD /administrators/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Administrator $administrator */
        $administrator = $this->administratorRepository->findWithoutFail($id);

        if (empty($administrator)) {
            return $this->sendError('Administrator not found');
        }

        return $this->sendResponse($administrator->toArray(), 'Administrator retrieved successfully');
    }

    /**
     * Update the specified Administrator in storage.
     * PUT/PATCH /administrators/{id}
     *
     * @param  int $id
     * @param UpdateAdministratorAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAdministratorAPIRequest $request)
    {
        $input = $request->all();

        /** @var Administrator $administrator */
        $administrator = $this->administratorRepository->findWithoutFail($id);

        if (empty($administrator)) {
            return $this->sendError('Administrator not found');
        }

        $administrator = $this->administratorRepository->update($input, $id);

        return $this->sendResponse($administrator->toArray(), 'Administrator updated successfully');
    }

    /**
     * Remove the specified Administrator from storage.
     * DELETE /administrators/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Administrator $administrator */
        $administrator = $this->administratorRepository->findWithoutFail($id);

        if (empty($administrator)) {
            return $this->sendError('Administrator not found');
        }

        $administrator->delete();

        return $this->sendResponse($id, 'Administrator deleted successfully');
    }
}
