<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSupplyCategoryRequest;
use App\Http\Requests\UpdateSupplyCategoryRequest;
use App\Repositories\SupplyCategoryRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class SupplyCategoryController extends AppBaseController
{
    /** @var  SupplyCategoryRepository */
    private $supplyCategoryRepository;

    public function __construct(SupplyCategoryRepository $supplyCategoryRepo)
    {
        $this->supplyCategoryRepository = $supplyCategoryRepo;
    }

    /**
     * Display a listing of the SupplyCategory.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->supplyCategoryRepository->pushCriteria(new RequestCriteria($request));
        $supplyCategories = $this->supplyCategoryRepository->all();

        return view('supply_categories.index')
            ->with('supplyCategories', $supplyCategories);
    }

    /**
     * Show the form for creating a new SupplyCategory.
     *
     * @return Response
     */
    public function create()
    {
        return view('supply_categories.create');
    }

    /**
     * Store a newly created SupplyCategory in storage.
     *
     * @param CreateSupplyCategoryRequest $request
     *
     * @return Response
     */
    public function store(CreateSupplyCategoryRequest $request)
    {
        $input = $request->all();

        $supplyCategory = $this->supplyCategoryRepository->create($input);

        Flash::success('Supply Category saved successfully.');

        return redirect(route('supplyCategories.index'));
    }

    /**
     * Display the specified SupplyCategory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $supplyCategory = $this->supplyCategoryRepository->findWithoutFail($id);

        if (empty($supplyCategory)) {
            Flash::error('Supply Category not found');

            return redirect(route('supplyCategories.index'));
        }

        return view('supply_categories.show')->with('supplyCategory', $supplyCategory);
    }

    /**
     * Show the form for editing the specified SupplyCategory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $supplyCategory = $this->supplyCategoryRepository->findWithoutFail($id);

        if (empty($supplyCategory)) {
            Flash::error('Supply Category not found');

            return redirect(route('supplyCategories.index'));
        }

        return view('supply_categories.edit')->with('supplyCategory', $supplyCategory);
    }

    /**
     * Update the specified SupplyCategory in storage.
     *
     * @param  int              $id
     * @param UpdateSupplyCategoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSupplyCategoryRequest $request)
    {
        $supplyCategory = $this->supplyCategoryRepository->findWithoutFail($id);

        if (empty($supplyCategory)) {
            Flash::error('Supply Category not found');

            return redirect(route('supplyCategories.index'));
        }

        $supplyCategory = $this->supplyCategoryRepository->update($request->all(), $id);

        Flash::success('Supply Category updated successfully.');

        return redirect(route('supplyCategories.index'));
    }

    /**
     * Remove the specified SupplyCategory from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $supplyCategory = $this->supplyCategoryRepository->findWithoutFail($id);

        if (empty($supplyCategory)) {
            Flash::error('Supply Category not found');

            return redirect(route('supplyCategories.index'));
        }

        $this->supplyCategoryRepository->delete($id);

        Flash::success('Supply Category deleted successfully.');

        return redirect(route('supplyCategories.index'));
    }
}
