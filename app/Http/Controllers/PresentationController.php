<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePresentationRequest;
use App\Http\Requests\UpdatePresentationRequest;
use App\Repositories\PresentationRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

use App\Models\Product;
use App\Models\MeasurementUnit;


class PresentationController extends AppBaseController
{
    /** @var  PresentationRepository */
    private $presentationRepository;

    public function __construct(PresentationRepository $presentationRepo)
    {
        $this->presentationRepository = $presentationRepo;
    }

    /**
     * Display a listing of the Presentation.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->presentationRepository->pushCriteria(new RequestCriteria($request));
        $presentations = $this->presentationRepository->all();

        return view('presentations.index')
            ->with('presentations', $presentations);
    }

    /**
     * Show the form for creating a new Presentation.
     *
     * @return Response
     */
    public function create()
    {
		$products = Product::all()->pluck('labelSelect', 'id');
		$measurementUnits = MeasurementUnit::all()->pluck('labelSelect', 'id');

		return view('presentations.create', compact('products', 'measurementUnits'));
    }

    /**
     * Store a newly created Presentation in storage.
     *
     * @param CreatePresentationRequest $request
     *
     * @return Response
     */
    public function store(CreatePresentationRequest $request)
    {
        $input = $request->all();

        $presentation = $this->presentationRepository->create($input);

        Flash::success('Presentation saved successfully.');

        return redirect(route('presentations.index'));
    }

    /**
     * Display the specified Presentation.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $presentation = $this->presentationRepository->findWithoutFail($id);

        if (empty($presentation)) {
            Flash::error('Presentation not found');

            return redirect(route('presentations.index'));
        }

        return view('presentations.show')->with('presentation', $presentation);
    }

    /**
     * Show the form for editing the specified Presentation.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
		$products = Product::all()->pluck('labelSelect', 'id');
		$measurementUnits = MeasurementUnit::all()->pluck('labelSelect', 'id');

        $presentation = $this->presentationRepository->findWithoutFail($id);

        if (empty($presentation)) {
            Flash::error('Presentation not found');

            return redirect(route('presentations.index'));
        }

		return view('presentations.edit', compact('presentation', 'products', 'measurementUnits'));
    }

    /**
     * Update the specified Presentation in storage.
     *
     * @param  int              $id
     * @param UpdatePresentationRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePresentationRequest $request)
    {
        $presentation = $this->presentationRepository->findWithoutFail($id);

        if (empty($presentation)) {
            Flash::error('Presentation not found');

            return redirect(route('presentations.index'));
        }

        $presentation = $this->presentationRepository->update($request->all(), $id);

        Flash::success('Presentation updated successfully.');

        return redirect(route('presentations.index'));
    }

    /**
     * Remove the specified Presentation from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $presentation = $this->presentationRepository->findWithoutFail($id);

        if (empty($presentation)) {
            Flash::error('Presentation not found');

            return redirect(route('presentations.index'));
        }

        $this->presentationRepository->delete($id);

        Flash::success('Presentation deleted successfully.');

        return redirect(route('presentations.index'));
    }
}
