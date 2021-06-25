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

        //PHOTO
        //if ($request->has('photo')) {
        if (empty($request->has('photo'))) {
            $data['photo'] = 'sin-photo.png';
        } else {
            $data['photo'] = $this->uploadPhoto($request->photo);
        }
        //  $data['photo'] = $this->uploadPhoto($request->photo);
        //}
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
        //PHOTO
        if ($request->has('photo')) {
            if ($data['photo'] != "sin-photo.png") {
                $file = base_path('/public/uploads/') . $contacts['photo'];
                unlink($file);
                $data['photo'] = $this->uploadPhoto($request->photo);
            }
        }

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
        $contact = Contact::find($id);
        if ($contact['photo'] != 'sin-photo.png') {
            $file = base_path('/public/uploads/') . $contact['photo'];
            unlink($file);
        }
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
    //UPLOAD PHOTO
    public function uploadPhoto($files)
    {
        $nameFiles = time() . '.' . $files->getClientOriginalExtension();
        $files->move(base_path('/public/uploads'), $nameFiles);
        return $nameFiles;
    }
}
