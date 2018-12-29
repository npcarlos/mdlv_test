<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePaymentStatusAPIRequest;
use App\Http\Requests\API\UpdatePaymentStatusAPIRequest;
use App\Models\PaymentStatus;
use App\Repositories\PaymentStatusRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class PaymentStatusController
 * @package App\Http\Controllers\API
 */

class PaymentStatusAPIController extends AppBaseController
{
    /** @var  PaymentStatusRepository */
    private $paymentStatusRepository;

    public function __construct(PaymentStatusRepository $paymentStatusRepo)
    {
        $this->paymentStatusRepository = $paymentStatusRepo;
    }

    /**
     * Display a listing of the PaymentStatus.
     * GET|HEAD /paymentStatuses
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->paymentStatusRepository->pushCriteria(new RequestCriteria($request));
        $this->paymentStatusRepository->pushCriteria(new LimitOffsetCriteria($request));
        $paymentStatuses = $this->paymentStatusRepository->all();

        return $this->sendResponse($paymentStatuses->toArray(), 'Payment Statuses retrieved successfully');
    }

    /**
     * Store a newly created PaymentStatus in storage.
     * POST /paymentStatuses
     *
     * @param CreatePaymentStatusAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePaymentStatusAPIRequest $request)
    {
        $input = $request->all();

        $paymentStatuses = $this->paymentStatusRepository->create($input);

        return $this->sendResponse($paymentStatuses->toArray(), 'Payment Status saved successfully');
    }

    /**
     * Display the specified PaymentStatus.
     * GET|HEAD /paymentStatuses/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var PaymentStatus $paymentStatus */
        $paymentStatus = $this->paymentStatusRepository->findWithoutFail($id);

        if (empty($paymentStatus)) {
            return $this->sendError('Payment Status not found');
        }

        return $this->sendResponse($paymentStatus->toArray(), 'Payment Status retrieved successfully');
    }

    /**
     * Update the specified PaymentStatus in storage.
     * PUT/PATCH /paymentStatuses/{id}
     *
     * @param  int $id
     * @param UpdatePaymentStatusAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePaymentStatusAPIRequest $request)
    {
        $input = $request->all();

        /** @var PaymentStatus $paymentStatus */
        $paymentStatus = $this->paymentStatusRepository->findWithoutFail($id);

        if (empty($paymentStatus)) {
            return $this->sendError('Payment Status not found');
        }

        $paymentStatus = $this->paymentStatusRepository->update($input, $id);

        return $this->sendResponse($paymentStatus->toArray(), 'PaymentStatus updated successfully');
    }

    /**
     * Remove the specified PaymentStatus from storage.
     * DELETE /paymentStatuses/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var PaymentStatus $paymentStatus */
        $paymentStatus = $this->paymentStatusRepository->findWithoutFail($id);

        if (empty($paymentStatus)) {
            return $this->sendError('Payment Status not found');
        }

        $paymentStatus->delete();

        return $this->sendResponse($id, 'Payment Status deleted successfully');
    }
}
