<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAdministratorRequest;
use App\Http\Requests\UpdateAdministratorRequest;
use App\Repositories\AdministratorRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

use App\Models\Person;


class AdministratorController extends AppBaseController
{
    /** @var  AdministratorRepository */
    private $administratorRepository;

    public function __construct(AdministratorRepository $administratorRepo)
    {
        $this->administratorRepository = $administratorRepo;
    }

    /**
     * Display a listing of the Administrator.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->administratorRepository->pushCriteria(new RequestCriteria($request));
        $administrators = $this->administratorRepository->all();

        return view('administrators.index')
            ->with('administrators', $administrators);
    }

    /**
     * Show the form for creating a new Administrator.
     *
     * @return Response
     */
    public function create()
    {
		$people = Person::all()->pluck('labelSelect', 'id');

		return view('administrators.create', compact('people'));
    }

    /**
     * Store a newly created Administrator in storage.
     *
     * @param CreateAdministratorRequest $request
     *
     * @return Response
     */
    public function store(CreateAdministratorRequest $request)
    {
        $input = $request->all();

        $administrator = $this->administratorRepository->create($input);

        Flash::success('Administrator saved successfully.');

        return redirect(route('administrators.index'));
    }

    /**
     * Display the specified Administrator.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $administrator = $this->administratorRepository->findWithoutFail($id);

        if (empty($administrator)) {
            Flash::error('Administrator not found');

            return redirect(route('administrators.index'));
        }

        return view('administrators.show')->with('administrator', $administrator);
    }

    /**
     * Show the form for editing the specified Administrator.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
		$people = Person::all()->pluck('labelSelect', 'id');

        $administrator = $this->administratorRepository->findWithoutFail($id);

        if (empty($administrator)) {
            Flash::error('Administrator not found');

            return redirect(route('administrators.index'));
        }

		return view('administrators.edit', compact('administrator', 'people'));
    }

    /**
     * Update the specified Administrator in storage.
     *
     * @param  int              $id
     * @param UpdateAdministratorRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAdministratorRequest $request)
    {
        $administrator = $this->administratorRepository->findWithoutFail($id);

        if (empty($administrator)) {
            Flash::error('Administrator not found');

            return redirect(route('administrators.index'));
        }

        $administrator = $this->administratorRepository->update($request->all(), $id);

        Flash::success('Administrator updated successfully.');

        return redirect(route('administrators.index'));
    }

    /**
     * Remove the specified Administrator from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $administrator = $this->administratorRepository->findWithoutFail($id);

        if (empty($administrator)) {
            Flash::error('Administrator not found');

            return redirect(route('administrators.index'));
        }

        $this->administratorRepository->delete($id);

        Flash::success('Administrator deleted successfully.');

        return redirect(route('administrators.index'));
    }
}
