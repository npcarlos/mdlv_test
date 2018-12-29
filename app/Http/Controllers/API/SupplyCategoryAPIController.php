<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSupplyCategoryAPIRequest;
use App\Http\Requests\API\UpdateSupplyCategoryAPIRequest;
use App\Models\SupplyCategory;
use App\Repositories\SupplyCategoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class SupplyCategoryController
 * @package App\Http\Controllers\API
 */

class SupplyCategoryAPIController extends AppBaseController
{
    /** @var  SupplyCategoryRepository */
    private $supplyCategoryRepository;

    public function __construct(SupplyCategoryRepository $supplyCategoryRepo)
    {
        $this->supplyCategoryRepository = $supplyCategoryRepo;
    }

    /**
     * Display a listing of the SupplyCategory.
     * GET|HEAD /supplyCategories
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->supplyCategoryRepository->pushCriteria(new RequestCriteria($request));
        $this->supplyCategoryRepository->pushCriteria(new LimitOffsetCriteria($request));
        $supplyCategories = $this->supplyCategoryRepository->all();

        return $this->sendResponse($supplyCategories->toArray(), 'Supply Categories retrieved successfully');
    }

    /**
     * Store a newly created SupplyCategory in storage.
     * POST /supplyCategories
     *
     * @param CreateSupplyCategoryAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateSupplyCategoryAPIRequest $request)
    {
        $input = $request->all();

        $supplyCategories = $this->supplyCategoryRepository->create($input);

        return $this->sendResponse($supplyCategories->toArray(), 'Supply Category saved successfully');
    }

    /**
     * Display the specified SupplyCategory.
     * GET|HEAD /supplyCategories/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var SupplyCategory $supplyCategory */
        $supplyCategory = $this->supplyCategoryRepository->findWithoutFail($id);

        if (empty($supplyCategory)) {
            return $this->sendError('Supply Category not found');
        }

        return $this->sendResponse($supplyCategory->toArray(), 'Supply Category retrieved successfully');
    }

    /**
     * Update the specified SupplyCategory in storage.
     * PUT/PATCH /supplyCategories/{id}
     *
     * @param  int $id
     * @param UpdateSupplyCategoryAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSupplyCategoryAPIRequest $request)
    {
        $input = $request->all();

        /** @var SupplyCategory $supplyCategory */
        $supplyCategory = $this->supplyCategoryRepository->findWithoutFail($id);

        if (empty($supplyCategory)) {
            return $this->sendError('Supply Category not found');
        }

        $supplyCategory = $this->supplyCategoryRepository->update($input, $id);

        return $this->sendResponse($supplyCategory->toArray(), 'SupplyCategory updated successfully');
    }

    /**
     * Remove the specified SupplyCategory from storage.
     * DELETE /supplyCategories/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var SupplyCategory $supplyCategory */
        $supplyCategory = $this->supplyCategoryRepository->findWithoutFail($id);

        if (empty($supplyCategory)) {
            return $this->sendError('Supply Category not found');
        }

        $supplyCategory->delete();

        return $this->sendResponse($id, 'Supply Category deleted successfully');
    }
}
