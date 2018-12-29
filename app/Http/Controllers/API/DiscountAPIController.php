<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateDiscountAPIRequest;
use App\Http\Requests\API\UpdateDiscountAPIRequest;
use App\Models\Discount;
use App\Repositories\DiscountRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class DiscountController
 * @package App\Http\Controllers\API
 */

class DiscountAPIController extends AppBaseController
{
    /** @var  DiscountRepository */
    private $discountRepository;

    public function __construct(DiscountRepository $discountRepo)
    {
        $this->discountRepository = $discountRepo;
    }

    /**
     * Display a listing of the Discount.
     * GET|HEAD /discounts
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->discountRepository->pushCriteria(new RequestCriteria($request));
        $this->discountRepository->pushCriteria(new LimitOffsetCriteria($request));
        $discounts = $this->discountRepository->all();

        return $this->sendResponse($discounts->toArray(), 'Discounts retrieved successfully');
    }

    /**
     * Store a newly created Discount in storage.
     * POST /discounts
     *
     * @param CreateDiscountAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateDiscountAPIRequest $request)
    {
        $input = $request->all();

        $discounts = $this->discountRepository->create($input);

        return $this->sendResponse($discounts->toArray(), 'Discount saved successfully');
    }

    /**
     * Display the specified Discount.
     * GET|HEAD /discounts/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Discount $discount */
        $discount = $this->discountRepository->findWithoutFail($id);

        if (empty($discount)) {
            return $this->sendError('Discount not found');
        }

        return $this->sendResponse($discount->toArray(), 'Discount retrieved successfully');
    }

    /**
     * Update the specified Discount in storage.
     * PUT/PATCH /discounts/{id}
     *
     * @param  int $id
     * @param UpdateDiscountAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDiscountAPIRequest $request)
    {
        $input = $request->all();

        /** @var Discount $discount */
        $discount = $this->discountRepository->findWithoutFail($id);

        if (empty($discount)) {
            return $this->sendError('Discount not found');
        }

        $discount = $this->discountRepository->update($input, $id);

        return $this->sendResponse($discount->toArray(), 'Discount updated successfully');
    }

    /**
     * Remove the specified Discount from storage.
     * DELETE /discounts/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Discount $discount */
        $discount = $this->discountRepository->findWithoutFail($id);

        if (empty($discount)) {
            return $this->sendError('Discount not found');
        }

        $discount->delete();

        return $this->sendResponse($id, 'Discount deleted successfully');
    }
}
