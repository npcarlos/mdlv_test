<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLotRequest;
use App\Http\Requests\UpdateLotRequest;
use App\Repositories\LotRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class LotController extends AppBaseController
{
    /** @var  LotRepository */
    private $lotRepository;

    public function __construct(LotRepository $lotRepo)
    {
        $this->lotRepository = $lotRepo;
    }

    /**
     * Display a listing of the Lot.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->lotRepository->pushCriteria(new RequestCriteria($request));
        $lots = $this->lotRepository->all();

        return view('lots.index')
            ->with('lots', $lots);
    }

    /**
     * Show the form for creating a new Lot.
     *
     * @return Response
     */
    public function create()
    {
        return view('lots.create');
    }

    /**
     * Store a newly created Lot in storage.
     *
     * @param CreateLotRequest $request
     *
     * @return Response
     */
    public function store(CreateLotRequest $request)
    {
        $input = $request->all();

        $lot = $this->lotRepository->create($input);

        Flash::success('Lot saved successfully.');

        return redirect(route('lots.index'));
    }

    /**
     * Display the specified Lot.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $lot = $this->lotRepository->findWithoutFail($id);

        if (empty($lot)) {
            Flash::error('Lot not found');

            return redirect(route('lots.index'));
        }

        return view('lots.show')->with('lot', $lot);
    }

    /**
     * Show the form for editing the specified Lot.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $lot = $this->lotRepository->findWithoutFail($id);

        if (empty($lot)) {
            Flash::error('Lot not found');

            return redirect(route('lots.index'));
        }

        return view('lots.edit')->with('lot', $lot);
    }

    /**
     * Update the specified Lot in storage.
     *
     * @param  int              $id
     * @param UpdateLotRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLotRequest $request)
    {
        $lot = $this->lotRepository->findWithoutFail($id);

        if (empty($lot)) {
            Flash::error('Lot not found');

            return redirect(route('lots.index'));
        }

        $lot = $this->lotRepository->update($request->all(), $id);

        Flash::success('Lot updated successfully.');

        return redirect(route('lots.index'));
    }

    /**
     * Remove the specified Lot from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $lot = $this->lotRepository->findWithoutFail($id);

        if (empty($lot)) {
            Flash::error('Lot not found');

            return redirect(route('lots.index'));
        }

        $this->lotRepository->delete($id);

        Flash::success('Lot deleted successfully.');

        return redirect(route('lots.index'));
    }
}
