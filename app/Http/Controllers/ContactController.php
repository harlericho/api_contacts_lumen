<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //GET
    public function index()
    {
        return Contact::all();
    }
    //SHOW
    public function show($id)
    {
        return Contact::findOrFail($id);
    }
    //POST
    public function store(Request $request)
    {
        $this->validations($request);
        $data = $request->all();
        Contact::create($data);
        return response()->json(
            [
                'res' => true,
                'message' => 'Data save'
            ]
        );
    }
    //PUT
    public function update(Request $request, $id)
    {
        $this->validations($request, $id);
        $data = $request->all();
        $contacts = Contact::find($id);
        $contacts->update($data);
        return response()->json(
            [
                'res' => true,
                'message' => 'Data update'
            ]
        );
    }
    //DELETE
    public function destroy($id)
    {
        Contact::destroy($id);
        return response()->json(
            [
                'res' => true,
                'message' => 'Data deleting'
            ]
        );
    }
    //VALIDATION 
    private function validations($request, $id = null)
    {
        $rulesUpdate = is_null($id) ? '' : ',' . $id;
        $this->validate($request, [
            'dni' => 'required|min:10|max:10|unique:contacts,dni' . $rulesUpdate,
            'names' => 'required',
            'phone' => 'required|min:10|max:10|unique:contacts,phone' . $rulesUpdate
        ]);
    }
}
