<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserDeviceRequest;
use App\Http\Requests\UpdateUserDeviceRequest;
use App\Repositories\UserDeviceRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class UserDeviceController extends AppBaseController
{
    /** @var  UserDeviceRepository */
    private $userDeviceRepository;

    public function __construct(UserDeviceRepository $userDeviceRepo)
    {
        $this->userDeviceRepository = $userDeviceRepo;
    }

    /**
     * Display a listing of the UserDevice.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->userDeviceRepository->pushCriteria(new RequestCriteria($request));
        $userDevices = $this->userDeviceRepository->all();

        return view('user_devices.index')
            ->with('userDevices', $userDevices);
    }

    /**
     * Show the form for creating a new UserDevice.
     *
     * @return Response
     */
    public function create()
    {
        return view('user_devices.create');
    }

    /**
     * Store a newly created UserDevice in storage.
     *
     * @param CreateUserDeviceRequest $request
     *
     * @return Response
     */
    public function store(CreateUserDeviceRequest $request)
    {
        $input = $request->all();

        $userDevice = $this->userDeviceRepository->create($input);

        Flash::success('User Device saved successfully.');

        return redirect(route('userDevices.index'));
    }

    /**
     * Display the specified UserDevice.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $userDevice = $this->userDeviceRepository->findWithoutFail($id);

        if (empty($userDevice)) {
            Flash::error('User Device not found');

            return redirect(route('userDevices.index'));
        }

        return view('user_devices.show')->with('userDevice', $userDevice);
    }

    /**
     * Show the form for editing the specified UserDevice.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $userDevice = $this->userDeviceRepository->findWithoutFail($id);

        if (empty($userDevice)) {
            Flash::error('User Device not found');

            return redirect(route('userDevices.index'));
        }

        return view('user_devices.edit')->with('userDevice', $userDevice);
    }

    /**
     * Update the specified UserDevice in storage.
     *
     * @param  int              $id
     * @param UpdateUserDeviceRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserDeviceRequest $request)
    {
        $userDevice = $this->userDeviceRepository->findWithoutFail($id);

        if (empty($userDevice)) {
            Flash::error('User Device not found');

            return redirect(route('userDevices.index'));
        }

        $userDevice = $this->userDeviceRepository->update($request->all(), $id);

        Flash::success('User Device updated successfully.');

        return redirect(route('userDevices.index'));
    }

    /**
     * Remove the specified UserDevice from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $userDevice = $this->userDeviceRepository->findWithoutFail($id);

        if (empty($userDevice)) {
            Flash::error('User Device not found');

            return redirect(route('userDevices.index'));
        }

        $this->userDeviceRepository->delete($id);

        Flash::success('User Device deleted successfully.');

        return redirect(route('userDevices.index'));
    }
}
