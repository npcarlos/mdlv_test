<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePresentationSuppliesAPIRequest;
use App\Http\Requests\API\UpdatePresentationSuppliesAPIRequest;
use App\Models\PresentationSupplies;
use App\Repositories\PresentationSuppliesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class PresentationSuppliesController
 * @package App\Http\Controllers\API
 */

class PresentationSuppliesAPIController extends AppBaseController
{
    /** @var  PresentationSuppliesRepository */
    private $presentationSuppliesRepository;

    public function __construct(PresentationSuppliesRepository $presentationSuppliesRepo)
    {
        $this->presentationSuppliesRepository = $presentationSuppliesRepo;
    }

    /**
     * Display a listing of the PresentationSupplies.
     * GET|HEAD /presentationSupplies
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->presentationSuppliesRepository->pushCriteria(new RequestCriteria($request));
        $this->presentationSuppliesRepository->pushCriteria(new LimitOffsetCriteria($request));
        $presentationSupplies = $this->presentationSuppliesRepository->all();

        return $this->sendResponse($presentationSupplies->toArray(), 'Presentation Supplies retrieved successfully');
    }

    /**
     * Store a newly created PresentationSupplies in storage.
     * POST /presentationSupplies
     *
     * @param CreatePresentationSuppliesAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePresentationSuppliesAPIRequest $request)
    {
        $input = $request->all();

        $presentationSupplies = $this->presentationSuppliesRepository->create($input);

        return $this->sendResponse($presentationSupplies->toArray(), 'Presentation Supplies saved successfully');
    }

    /**
     * Display the specified PresentationSupplies.
     * GET|HEAD /presentationSupplies/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var PresentationSupplies $presentationSupplies */
        $presentationSupplies = $this->presentationSuppliesRepository->findWithoutFail($id);

        if (empty($presentationSupplies)) {
            return $this->sendError('Presentation Supplies not found');
        }

        return $this->sendResponse($presentationSupplies->toArray(), 'Presentation Supplies retrieved successfully');
    }

    /**
     * Update the specified PresentationSupplies in storage.
     * PUT/PATCH /presentationSupplies/{id}
     *
     * @param  int $id
     * @param UpdatePresentationSuppliesAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePresentationSuppliesAPIRequest $request)
    {
        $input = $request->all();

        /** @var PresentationSupplies $presentationSupplies */
        $presentationSupplies = $this->presentationSuppliesRepository->findWithoutFail($id);

        if (empty($presentationSupplies)) {
            return $this->sendError('Presentation Supplies not found');
        }

        $presentationSupplies = $this->presentationSuppliesRepository->update($input, $id);

        return $this->sendResponse($presentationSupplies->toArray(), 'PresentationSupplies updated successfully');
    }

    /**
     * Remove the specified PresentationSupplies from storage.
     * DELETE /presentationSupplies/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var PresentationSupplies $presentationSupplies */
        $presentationSupplies = $this->presentationSuppliesRepository->findWithoutFail($id);

        if (empty($presentationSupplies)) {
            return $this->sendError('Presentation Supplies not found');
        }

        $presentationSupplies->delete();

        return $this->sendResponse($id, 'Presentation Supplies deleted successfully');
    }
}
