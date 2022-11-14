<?php

namespace App\Http\Controllers\Backend_Api;

use App\Http\Controllers\Backend_Api\BaseController as BaseController;
use App\Models\Contacts;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Validator;

class ContactsController extends BaseController
{

    /*  start retrive all companies  */

    public function index(Request $request)
    {

        $page = $request->page;

        $contacts = $page === 'yes' ? Contacts::paginate(10) : Contacts::all();

        return $this->sendResponse($contacts, 'All Contacts listed here');
    }

    /*  end retrive all companies  */

    /*  start retrive single company  */
    public function show($id)
    {

        $contacts = Contacts::find($id);

        return $this->sendResponse($contacts, 'Contact listed here');

    }

    /*  end retrive single company  */

    /*  start create a contact  */

    public function store(Request $request)
    {
        $input = $request->all();

        //return $this->sendResponse($input, 'All fields are here');

        $validator = Validator::make($input, [
            'company_id' => 'required|exists:company,id|numeric',
            'first_name' => 'required|max:50|min:2',
            'last_name' => 'required|max:50|min:2',
            'email' => 'required|email|unique:contacts',
            'phone' => 'required|numeric|digits:10|unique:contacts',

        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $contacts = Contacts::create($input);

        return $this->sendResponse($contacts, 'Contact created successfully.');
    }

    /*  end create a contact  */

    /*  start store multiple contact  */
    public function store_multiple(Request $request, $id)
    {
        $input = $request->all();
        $ar_contact_input = array();
        $ar_company_id = array('company_id' => $id);

        foreach ($input as $input_elements) {
            $ar_contact_input[] = array_merge($input_elements, $ar_company_id);
        }

        //var_dump($ar_contact_input);

        $i = 0;

        $result_array = array();

        foreach ($ar_contact_input as $key => $val) {
            //return $this->sendResponse($input, 'All fields are here');

            $new_input = $ar_contact_input[$i];

            $validator = Validator::make($new_input, [
                'company_id' => 'required|exists:company,id|numeric',
                'first_name' => 'required|max:50|min:2',
                'last_name' => 'required|max:50|min:2',
                'email' => 'required|email|unique:contacts',
                'phone' => 'required|numeric|digits:10|unique:contacts',

            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $i++;

            $contacts = Contacts::create($new_input);

            $result_array[] = $contacts;

        }

        return $this->sendResponse($result_array, 'Contact created successfully.');

    }

    /* end store multiple contact  */

    /*  start retrive contacts per company  */
    public function get_contacts($id)
    {

        $contacts = Contacts::where('company_id', $id)->orderBy('created_at', 'DESC')->get();

        return $this->sendResponse($contacts, 'Contact listed here');

    }

    /*  end retrive retrive contacts per company  */

    /*  start update a contacts  */
    public function update(Request $request, $id)
    {

        $input = $request->all();

        //return $this->sendResponse($input, 'All fields are here');

        $validator = Validator::make($input, [
            'company_id' => 'exists:company,id|numeric',
            'first_name' => 'max:50|min:2',
            'last_name' => 'max:50|min:2',
            'email' => 'email|unique:contacts',
            'phone' => 'numeric|digits:10|unique:contacts',
            'notes' => 'max:1200|min:5',

        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $contacts = Contacts::where("id", $id)->update($input);

        return $this->sendResponse($contacts, 'Contacts updated successfully.');

    }

    /* end update a contacts  */

    /* start search by  contacts or company */

    public function search(Request $request)
    {

        $input = $request->all();

        $search = $input["search"];

        $contacts = Contacts::with('company')->whereHas('company', function ($query) use ($search) {
            $query->where('first_name', 'like', '%' . $search . '%')->orwhere('last_name', 'like', '%' . $search . '%')->orwhere('email', 'like', '%' . $search . '%')->orwhere('notes', 'like', '%' . $search . '%')->orwhere('company_name', 'like', '%' . $search . '%');
        })->get();

        return $this->sendResponse($contacts, 'Search Results');

    }

    /* end search by  contacts or company  */

    /* Contact frontend Data Inertia */

    public function contacts_filter(Request $request)
    {

        $name = $request->search;

        return Inertia::render(
            'Contact',
            [
                'contacts' => Contacts::with('company')->whereHas('company', function ($query) use ($name) {
                    $query->where('first_name', 'like', '%' . $name . '%')->orwhere('last_name', 'like', '%' . $name . '%')->orwhere('email', 'like', '%' . $name . '%')->orwhere('notes', 'like', '%' . $name . '%')->orwhere('company_name', 'like', '%' . $name . '%');
                })->paginate(10)->withQueryString(),

            ]
        );
    }

    /* Contact frontend Data Inertia */

}
