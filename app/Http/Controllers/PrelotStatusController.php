<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePrelotStatusRequest;
use App\Http\Requests\UpdatePrelotStatusRequest;
use App\Repositories\PrelotStatusRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class PrelotStatusController extends AppBaseController
{
    /** @var  PrelotStatusRepository */
    private $prelotStatusRepository;

    public function __construct(PrelotStatusRepository $prelotStatusRepo)
    {
        $this->prelotStatusRepository = $prelotStatusRepo;
    }

    /**
     * Display a listing of the PrelotStatus.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->prelotStatusRepository->pushCriteria(new RequestCriteria($request));
        $prelotStatuses = $this->prelotStatusRepository->all();

        return view('prelot_statuses.index')
            ->with('prelotStatuses', $prelotStatuses);
    }

    /**
     * Show the form for creating a new PrelotStatus.
     *
     * @return Response
     */
    public function create()
    {
        return view('prelot_statuses.create');
    }

    /**
     * Store a newly created PrelotStatus in storage.
     *
     * @param CreatePrelotStatusRequest $request
     *
     * @return Response
     */
    public function store(CreatePrelotStatusRequest $request)
    {
        $input = $request->all();

        $prelotStatus = $this->prelotStatusRepository->create($input);

        Flash::success('Prelot Status saved successfully.');

        return redirect(route('prelotStatuses.index'));
    }

    /**
     * Display the specified PrelotStatus.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $prelotStatus = $this->prelotStatusRepository->findWithoutFail($id);

        if (empty($prelotStatus)) {
            Flash::error('Prelot Status not found');

            return redirect(route('prelotStatuses.index'));
        }

        return view('prelot_statuses.show')->with('prelotStatus', $prelotStatus);
    }

    /**
     * Show the form for editing the specified PrelotStatus.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $prelotStatus = $this->prelotStatusRepository->findWithoutFail($id);

        if (empty($prelotStatus)) {
            Flash::error('Prelot Status not found');

            return redirect(route('prelotStatuses.index'));
        }

        return view('prelot_statuses.edit')->with('prelotStatus', $prelotStatus);
    }

    /**
     * Update the specified PrelotStatus in storage.
     *
     * @param  int              $id
     * @param UpdatePrelotStatusRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePrelotStatusRequest $request)
    {
        $prelotStatus = $this->prelotStatusRepository->findWithoutFail($id);

        if (empty($prelotStatus)) {
            Flash::error('Prelot Status not found');

            return redirect(route('prelotStatuses.index'));
        }

        $prelotStatus = $this->prelotStatusRepository->update($request->all(), $id);

        Flash::success('Prelot Status updated successfully.');

        return redirect(route('prelotStatuses.index'));
    }

    /**
     * Remove the specified PrelotStatus from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $prelotStatus = $this->prelotStatusRepository->findWithoutFail($id);

        if (empty($prelotStatus)) {
            Flash::error('Prelot Status not found');

            return redirect(route('prelotStatuses.index'));
        }

        $this->prelotStatusRepository->delete($id);

        Flash::success('Prelot Status deleted successfully.');

        return redirect(route('prelotStatuses.index'));
    }
}
