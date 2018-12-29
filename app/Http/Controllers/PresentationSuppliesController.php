<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePresentationSuppliesRequest;
use App\Http\Requests\UpdatePresentationSuppliesRequest;
use App\Repositories\PresentationSuppliesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class PresentationSuppliesController extends AppBaseController
{
    /** @var  PresentationSuppliesRepository */
    private $presentationSuppliesRepository;

    public function __construct(PresentationSuppliesRepository $presentationSuppliesRepo)
    {
        $this->presentationSuppliesRepository = $presentationSuppliesRepo;
    }

    /**
     * Display a listing of the PresentationSupplies.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->presentationSuppliesRepository->pushCriteria(new RequestCriteria($request));
        $presentationSupplies = $this->presentationSuppliesRepository->all();

        return view('presentation_supplies.index')
            ->with('presentationSupplies', $presentationSupplies);
    }

    /**
     * Show the form for creating a new PresentationSupplies.
     *
     * @return Response
     */
    public function create()
    {
        return view('presentation_supplies.create');
    }

    /**
     * Store a newly created PresentationSupplies in storage.
     *
     * @param CreatePresentationSuppliesRequest $request
     *
     * @return Response
     */
    public function store(CreatePresentationSuppliesRequest $request)
    {
        $input = $request->all();

        $presentationSupplies = $this->presentationSuppliesRepository->create($input);

        Flash::success('Presentation Supplies saved successfully.');

        return redirect(route('presentationSupplies.index'));
    }

    /**
     * Display the specified PresentationSupplies.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $presentationSupplies = $this->presentationSuppliesRepository->findWithoutFail($id);

        if (empty($presentationSupplies)) {
            Flash::error('Presentation Supplies not found');

            return redirect(route('presentationSupplies.index'));
        }

        return view('presentation_supplies.show')->with('presentationSupplies', $presentationSupplies);
    }

    /**
     * Show the form for editing the specified PresentationSupplies.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $presentationSupplies = $this->presentationSuppliesRepository->findWithoutFail($id);

        if (empty($presentationSupplies)) {
            Flash::error('Presentation Supplies not found');

            return redirect(route('presentationSupplies.index'));
        }

        return view('presentation_supplies.edit')->with('presentationSupplies', $presentationSupplies);
    }

    /**
     * Update the specified PresentationSupplies in storage.
     *
     * @param  int              $id
     * @param UpdatePresentationSuppliesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePresentationSuppliesRequest $request)
    {
        $presentationSupplies = $this->presentationSuppliesRepository->findWithoutFail($id);

        if (empty($presentationSupplies)) {
            Flash::error('Presentation Supplies not found');

            return redirect(route('presentationSupplies.index'));
        }

        $presentationSupplies = $this->presentationSuppliesRepository->update($request->all(), $id);

        Flash::success('Presentation Supplies updated successfully.');

        return redirect(route('presentationSupplies.index'));
    }

    /**
     * Remove the specified PresentationSupplies from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $presentationSupplies = $this->presentationSuppliesRepository->findWithoutFail($id);

        if (empty($presentationSupplies)) {
            Flash::error('Presentation Supplies not found');

            return redirect(route('presentationSupplies.index'));
        }

        $this->presentationSuppliesRepository->delete($id);

        Flash::success('Presentation Supplies deleted successfully.');

        return redirect(route('presentationSupplies.index'));
    }
}
