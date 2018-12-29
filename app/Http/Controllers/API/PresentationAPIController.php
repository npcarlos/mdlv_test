<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePresentationAPIRequest;
use App\Http\Requests\API\UpdatePresentationAPIRequest;
use App\Models\Presentation;
use App\Repositories\PresentationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class PresentationController
 * @package App\Http\Controllers\API
 */

class PresentationAPIController extends AppBaseController
{
    /** @var  PresentationRepository */
    private $presentationRepository;

    public function __construct(PresentationRepository $presentationRepo)
    {
        $this->presentationRepository = $presentationRepo;
    }

    /**
     * Display a listing of the Presentation.
     * GET|HEAD /presentations
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->presentationRepository->pushCriteria(new RequestCriteria($request));
        $this->presentationRepository->pushCriteria(new LimitOffsetCriteria($request));
        $presentations = $this->presentationRepository->all();

        return $this->sendResponse($presentations->toArray(), 'Presentations retrieved successfully');
    }

    /**
     * Store a newly created Presentation in storage.
     * POST /presentations
     *
     * @param CreatePresentationAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePresentationAPIRequest $request)
    {
        $input = $request->all();

        $presentations = $this->presentationRepository->create($input);

        return $this->sendResponse($presentations->toArray(), 'Presentation saved successfully');
    }

    /**
     * Display the specified Presentation.
     * GET|HEAD /presentations/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Presentation $presentation */
        $presentation = $this->presentationRepository->findWithoutFail($id);

        if (empty($presentation)) {
            return $this->sendError('Presentation not found');
        }

        return $this->sendResponse($presentation->toArray(), 'Presentation retrieved successfully');
    }

    /**
     * Update the specified Presentation in storage.
     * PUT/PATCH /presentations/{id}
     *
     * @param  int $id
     * @param UpdatePresentationAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePresentationAPIRequest $request)
    {
        $input = $request->all();

        /** @var Presentation $presentation */
        $presentation = $this->presentationRepository->findWithoutFail($id);

        if (empty($presentation)) {
            return $this->sendError('Presentation not found');
        }

        $presentation = $this->presentationRepository->update($input, $id);

        return $this->sendResponse($presentation->toArray(), 'Presentation updated successfully');
    }

    /**
     * Remove the specified Presentation from storage.
     * DELETE /presentations/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Presentation $presentation */
        $presentation = $this->presentationRepository->findWithoutFail($id);

        if (empty($presentation)) {
            return $this->sendError('Presentation not found');
        }

        $presentation->delete();

        return $this->sendResponse($id, 'Presentation deleted successfully');
    }
}
