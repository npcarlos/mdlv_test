<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateDocumentTypeAPIRequest;
use App\Http\Requests\API\UpdateDocumentTypeAPIRequest;
use App\Models\DocumentType;
use App\Repositories\DocumentTypeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class DocumentTypeController
 * @package App\Http\Controllers\API
 */

class DocumentTypeAPIController extends AppBaseController
{
    /** @var  DocumentTypeRepository */
    private $documentTypeRepository;

    public function __construct(DocumentTypeRepository $documentTypeRepo)
    {
        $this->documentTypeRepository = $documentTypeRepo;
    }

    /**
     * Display a listing of the DocumentType.
     * GET|HEAD /documentTypes
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->documentTypeRepository->pushCriteria(new RequestCriteria($request));
        $this->documentTypeRepository->pushCriteria(new LimitOffsetCriteria($request));
        $documentTypes = $this->documentTypeRepository->all();

        return $this->sendResponse($documentTypes->toArray(), 'Document Types retrieved successfully');
    }

    /**
     * Store a newly created DocumentType in storage.
     * POST /documentTypes
     *
     * @param CreateDocumentTypeAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateDocumentTypeAPIRequest $request)
    {
        $input = $request->all();

        $documentTypes = $this->documentTypeRepository->create($input);

        return $this->sendResponse($documentTypes->toArray(), 'Document Type saved successfully');
    }

    /**
     * Display the specified DocumentType.
     * GET|HEAD /documentTypes/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var DocumentType $documentType */
        $documentType = $this->documentTypeRepository->findWithoutFail($id);

        if (empty($documentType)) {
            return $this->sendError('Document Type not found');
        }

        return $this->sendResponse($documentType->toArray(), 'Document Type retrieved successfully');
    }

    /**
     * Update the specified DocumentType in storage.
     * PUT/PATCH /documentTypes/{id}
     *
     * @param  int $id
     * @param UpdateDocumentTypeAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDocumentTypeAPIRequest $request)
    {
        $input = $request->all();

        /** @var DocumentType $documentType */
        $documentType = $this->documentTypeRepository->findWithoutFail($id);

        if (empty($documentType)) {
            return $this->sendError('Document Type not found');
        }

        $documentType = $this->documentTypeRepository->update($input, $id);

        return $this->sendResponse($documentType->toArray(), 'DocumentType updated successfully');
    }

    /**
     * Remove the specified DocumentType from storage.
     * DELETE /documentTypes/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var DocumentType $documentType */
        $documentType = $this->documentTypeRepository->findWithoutFail($id);

        if (empty($documentType)) {
            return $this->sendError('Document Type not found');
        }

        $documentType->delete();

        return $this->sendResponse($id, 'Document Type deleted successfully');
    }
}
