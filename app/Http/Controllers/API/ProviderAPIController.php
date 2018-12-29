<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateProviderAPIRequest;
use App\Http\Requests\API\UpdateProviderAPIRequest;
use App\Models\Provider;
use App\Repositories\ProviderRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ProviderController
 * @package App\Http\Controllers\API
 */

class ProviderAPIController extends AppBaseController
{
    /** @var  ProviderRepository */
    private $providerRepository;

    public function __construct(ProviderRepository $providerRepo)
    {
        $this->providerRepository = $providerRepo;
    }

    /**
     * Display a listing of the Provider.
     * GET|HEAD /providers
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->providerRepository->pushCriteria(new RequestCriteria($request));
        $this->providerRepository->pushCriteria(new LimitOffsetCriteria($request));
        $providers = $this->providerRepository->all();

        return $this->sendResponse($providers->toArray(), 'Providers retrieved successfully');
    }

    /**
     * Store a newly created Provider in storage.
     * POST /providers
     *
     * @param CreateProviderAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateProviderAPIRequest $request)
    {
        $input = $request->all();

        $providers = $this->providerRepository->create($input);

        return $this->sendResponse($providers->toArray(), 'Provider saved successfully');
    }

    /**
     * Display the specified Provider.
     * GET|HEAD /providers/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Provider $provider */
        $provider = $this->providerRepository->findWithoutFail($id);

        if (empty($provider)) {
            return $this->sendError('Provider not found');
        }

        return $this->sendResponse($provider->toArray(), 'Provider retrieved successfully');
    }

    /**
     * Update the specified Provider in storage.
     * PUT/PATCH /providers/{id}
     *
     * @param  int $id
     * @param UpdateProviderAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProviderAPIRequest $request)
    {
        $input = $request->all();

        /** @var Provider $provider */
        $provider = $this->providerRepository->findWithoutFail($id);

        if (empty($provider)) {
            return $this->sendError('Provider not found');
        }

        $provider = $this->providerRepository->update($input, $id);

        return $this->sendResponse($provider->toArray(), 'Provider updated successfully');
    }

    /**
     * Remove the specified Provider from storage.
     * DELETE /providers/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Provider $provider */
        $provider = $this->providerRepository->findWithoutFail($id);

        if (empty($provider)) {
            return $this->sendError('Provider not found');
        }

        $provider->delete();

        return $this->sendResponse($id, 'Provider deleted successfully');
    }
}
