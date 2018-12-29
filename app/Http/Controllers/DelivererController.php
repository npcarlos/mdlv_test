<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDelivererRequest;
use App\Http\Requests\UpdateDelivererRequest;
use App\Repositories\DelivererRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class DelivererController extends AppBaseController
{
    /** @var  DelivererRepository */
    private $delivererRepository;

    public function __construct(DelivererRepository $delivererRepo)
    {
        $this->delivererRepository = $delivererRepo;
    }

    /**
     * Display a listing of the Deliverer.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->delivererRepository->pushCriteria(new RequestCriteria($request));
        $deliverers = $this->delivererRepository->all();

        return view('deliverers.index')
            ->with('deliverers', $deliverers);
    }

    /**
     * Show the form for creating a new Deliverer.
     *
     * @return Response
     */
    public function create()
    {
        return view('deliverers.create');
    }

    /**
     * Store a newly created Deliverer in storage.
     *
     * @param CreateDelivererRequest $request
     *
     * @return Response
     */
    public function store(CreateDelivererRequest $request)
    {
        $input = $request->all();

        $deliverer = $this->delivererRepository->create($input);

        Flash::success('Deliverer saved successfully.');

        return redirect(route('deliverers.index'));
    }

    /**
     * Display the specified Deliverer.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $deliverer = $this->delivererRepository->findWithoutFail($id);

        if (empty($deliverer)) {
            Flash::error('Deliverer not found');

            return redirect(route('deliverers.index'));
        }

        return view('deliverers.show')->with('deliverer', $deliverer);
    }

    /**
     * Show the form for editing the specified Deliverer.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $deliverer = $this->delivererRepository->findWithoutFail($id);

        if (empty($deliverer)) {
            Flash::error('Deliverer not found');

            return redirect(route('deliverers.index'));
        }

        return view('deliverers.edit')->with('deliverer', $deliverer);
    }

    /**
     * Update the specified Deliverer in storage.
     *
     * @param  int              $id
     * @param UpdateDelivererRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDelivererRequest $request)
    {
        $deliverer = $this->delivererRepository->findWithoutFail($id);

        if (empty($deliverer)) {
            Flash::error('Deliverer not found');

            return redirect(route('deliverers.index'));
        }

        $deliverer = $this->delivererRepository->update($request->all(), $id);

        Flash::success('Deliverer updated successfully.');

        return redirect(route('deliverers.index'));
    }

    /**
     * Remove the specified Deliverer from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $deliverer = $this->delivererRepository->findWithoutFail($id);

        if (empty($deliverer)) {
            Flash::error('Deliverer not found');

            return redirect(route('deliverers.index'));
        }

        $this->delivererRepository->delete($id);

        Flash::success('Deliverer deleted successfully.');

        return redirect(route('deliverers.index'));
    }
}
