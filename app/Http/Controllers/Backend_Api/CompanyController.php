<?php

namespace App\Http\Controllers\Backend_Api;

use App\Http\Controllers\Backend_Api\BaseController as BaseController;
use App\Models\Company;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Validator;

class CompanyController extends BaseController
{
    /*  start retrive all companies  */
    public function index(Request $request)
    {

        $page = $request->page;

        $company = $page === 'yes' ? Company::paginate(10) : Company::orderBy('created_at', 'DESC')->get();

        return $this->sendResponse($company, 'All Companies listed here');

    }

    /*  end retrive all companies  */

    /*  start retrive single company  */
    public function show($id)
    {

        $company = Company::find($id);

        return $this->sendResponse($company, 'Company listed here');

    }

    /*  end retrive single company  */

    /*  start create a company  */
    public function store(Request $request)
    {
        $input = $request->all();

        //return $this->sendResponse($input, 'All fields are here');

        $validator = Validator::make($input, [
            'company_name' => 'required|unique:company|max:50|min:2',

        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $company = Company::create($input);

        return $this->sendResponse($company, 'Create company successfully.');
    }

    /* end create a company  */

    /*  start update a company  */
    public function update(Request $request, $id)
    {

        $input = $request->all();

        //return $this->sendResponse($input, 'All fields are here');

        $validator = Validator::make($input, [
            'company_name' => 'required|unique:company|max:50|min:2',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $company = Company::where("id", $id)->update($input);

        return $this->sendResponse($company, 'Company updated successfully.');

    } /* end update a company  */

    /* Company frontend Data Inertia */

    public function company_filter(Request $request)
    {

        $name = $request->search;

        return Inertia::render(
            'Company',
            [
                'companies' => Company::where('company_name', 'like', '%' . $name . '%')->paginate(10)->withQueryString(),

            ]
        );
    }

    /* Company frontend Data Inertia */
}
