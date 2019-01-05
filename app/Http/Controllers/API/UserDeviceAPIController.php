<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateUserDeviceAPIRequest;
use App\Http\Requests\API\UpdateUserDeviceAPIRequest;
use App\Models\UserDevice;
use App\Repositories\UserDeviceRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class UserDeviceController
 * @package App\Http\Controllers\API
 */

class UserDeviceAPIController extends AppBaseController
{
    /** @var  UserDeviceRepository */
    private $userDeviceRepository;

    public function __construct(UserDeviceRepository $userDeviceRepo)
    {
        $this->userDeviceRepository = $userDeviceRepo;
    }

    /**
     * Display a listing of the UserDevice.
     * GET|HEAD /userDevices
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->userDeviceRepository->pushCriteria(new RequestCriteria($request));
        $this->userDeviceRepository->pushCriteria(new LimitOffsetCriteria($request));
        $userDevices = $this->userDeviceRepository->all();

        return $this->sendResponse($userDevices->toArray(), 'User Devices retrieved successfully');
    }

    /**
     * Store a newly created UserDevice in storage.
     * POST /userDevices
     *
     * @param CreateUserDeviceAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateUserDeviceAPIRequest $request)
    {
        $input = $request->all();

        $userDevices = $this->userDeviceRepository->create($input);

        return $this->sendResponse($userDevices->toArray(), 'User Device saved successfully');
    }

    /**
     * Display the specified UserDevice.
     * GET|HEAD /userDevices/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var UserDevice $userDevice */
        $userDevice = $this->userDeviceRepository->findWithoutFail($id);

        if (empty($userDevice)) {
            return $this->sendError('User Device not found');
        }

        return $this->sendResponse($userDevice->toArray(), 'User Device retrieved successfully');
    }

    /**
     * Update the specified UserDevice in storage.
     * PUT/PATCH /userDevices/{id}
     *
     * @param  int $id
     * @param UpdateUserDeviceAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserDeviceAPIRequest $request)
    {
        $input = $request->all();

        /** @var UserDevice $userDevice */
        $userDevice = $this->userDeviceRepository->findWithoutFail($id);

        if (empty($userDevice)) {
            return $this->sendError('User Device not found');
        }

        $userDevice = $this->userDeviceRepository->update($input, $id);

        return $this->sendResponse($userDevice->toArray(), 'UserDevice updated successfully');
    }

    /**
     * Remove the specified UserDevice from storage.
     * DELETE /userDevices/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var UserDevice $userDevice */
        $userDevice = $this->userDeviceRepository->findWithoutFail($id);

        if (empty($userDevice)) {
            return $this->sendError('User Device not found');
        }

        $userDevice->delete();

        return $this->sendResponse($id, 'User Device deleted successfully');
    }
}
