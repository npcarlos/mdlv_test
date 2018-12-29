<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSellerAPIRequest;
use App\Http\Requests\API\UpdateSellerAPIRequest;
use App\Models\Seller;
use App\Repositories\SellerRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class SellerController
 * @package App\Http\Controllers\API
 */

class SellerAPIController extends AppBaseController
{
    /** @var  SellerRepository */
    private $sellerRepository;

    public function __construct(SellerRepository $sellerRepo)
    {
        $this->sellerRepository = $sellerRepo;
    }

    /**
     * Display a listing of the Seller.
     * GET|HEAD /sellers
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->sellerRepository->pushCriteria(new RequestCriteria($request));
        $this->sellerRepository->pushCriteria(new LimitOffsetCriteria($request));
        $sellers = $this->sellerRepository->all();

        return $this->sendResponse($sellers->toArray(), 'Sellers retrieved successfully');
    }

    /**
     * Store a newly created Seller in storage.
     * POST /sellers
     *
     * @param CreateSellerAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateSellerAPIRequest $request)
    {
        $input = $request->all();

        $sellers = $this->sellerRepository->create($input);

        return $this->sendResponse($sellers->toArray(), 'Seller saved successfully');
    }

    /**
     * Display the specified Seller.
     * GET|HEAD /sellers/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Seller $seller */
        $seller = $this->sellerRepository->findWithoutFail($id);

        if (empty($seller)) {
            return $this->sendError('Seller not found');
        }

        return $this->sendResponse($seller->toArray(), 'Seller retrieved successfully');
    }

    /**
     * Update the specified Seller in storage.
     * PUT/PATCH /sellers/{id}
     *
     * @param  int $id
     * @param UpdateSellerAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSellerAPIRequest $request)
    {
        $input = $request->all();

        /** @var Seller $seller */
        $seller = $this->sellerRepository->findWithoutFail($id);

        if (empty($seller)) {
            return $this->sendError('Seller not found');
        }

        $seller = $this->sellerRepository->update($input, $id);

        return $this->sendResponse($seller->toArray(), 'Seller updated successfully');
    }

    /**
     * Remove the specified Seller from storage.
     * DELETE /sellers/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Seller $seller */
        $seller = $this->sellerRepository->findWithoutFail($id);

        if (empty($seller)) {
            return $this->sendError('Seller not found');
        }

        $seller->delete();

        return $this->sendResponse($id, 'Seller deleted successfully');
    }
}
