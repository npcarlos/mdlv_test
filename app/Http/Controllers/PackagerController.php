<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePackagerRequest;
use App\Http\Requests\UpdatePackagerRequest;
use App\Repositories\PackagerRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

use App\Models\Person;


class PackagerController extends AppBaseController
{
    /** @var  PackagerRepository */
    private $packagerRepository;

    public function __construct(PackagerRepository $packagerRepo)
    {
        $this->packagerRepository = $packagerRepo;
    }

    /**
     * Display a listing of the Packager.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->packagerRepository->pushCriteria(new RequestCriteria($request));
        $packagers = $this->packagerRepository->all();

        return view('packagers.index')
            ->with('packagers', $packagers);
    }

    /**
     * Show the form for creating a new Packager.
     *
     * @return Response
     */
    public function create()
    {
		$people = Person::all()->pluck('labelSelect', 'id');

		return view('packagers.create', compact('people'));
    }

    /**
     * Store a newly created Packager in storage.
     *
     * @param CreatePackagerRequest $request
     *
     * @return Response
     */
    public function store(CreatePackagerRequest $request)
    {
        $input = $request->all();

        $packager = $this->packagerRepository->create($input);

        Flash::success('Packager saved successfully.');

        return redirect(route('packagers.index'));
    }

    /**
     * Display the specified Packager.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $packager = $this->packagerRepository->findWithoutFail($id);

        if (empty($packager)) {
            Flash::error('Packager not found');

            return redirect(route('packagers.index'));
        }

        return view('packagers.show')->with('packager', $packager);
    }

    /**
     * Show the form for editing the specified Packager.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
		$people = Person::all()->pluck('labelSelect', 'id');

        $packager = $this->packagerRepository->findWithoutFail($id);

        if (empty($packager)) {
            Flash::error('Packager not found');

            return redirect(route('packagers.index'));
        }

		return view('packagers.edit', compact('packager', 'people'));
    }

    /**
     * Update the specified Packager in storage.
     *
     * @param  int              $id
     * @param UpdatePackagerRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePackagerRequest $request)
    {
        $packager = $this->packagerRepository->findWithoutFail($id);

        if (empty($packager)) {
            Flash::error('Packager not found');

            return redirect(route('packagers.index'));
        }

        $packager = $this->packagerRepository->update($request->all(), $id);

        Flash::success('Packager updated successfully.');

        return redirect(route('packagers.index'));
    }

    /**
     * Remove the specified Packager from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $packager = $this->packagerRepository->findWithoutFail($id);

        if (empty($packager)) {
            Flash::error('Packager not found');

            return redirect(route('packagers.index'));
        }

        $this->packagerRepository->delete($id);

        Flash::success('Packager deleted successfully.');

        return redirect(route('packagers.index'));
    }
}
