<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Contracts\AttributeContract;

class AttributeController extends BaseController
{
    public function index()
    {
        return $attributes = $this->attributeRepository->listAttributes();

        // $this->setPageTitle('Attributes', 'List of all attributes');
        // return view('admin.attributes.index', compact('attributes'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'code'          =>  'required',
            'name'          =>  'required',
            'frontend_type' =>  'required'
        ]);

        $params = $request->except('_token');

        $attribute = $this->attributeRepository->createAttribute($params);

        if (!$attribute) {
            return $this->responseRedirectBack('Error occurred while creating attribute.', 'error', true, true);
        }
        return $attribute;
        // return $this->responseRedirect('admin.attributes.index', 'Attribute added successfully', 'success', false, false);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'code'          =>  'required',
            'name'          =>  'required',
            'frontend_type' =>  'required'
        ]);

        $params = $request->except('_token');

        $attribute = $this->attributeRepository->updateAttribute($params);

        if (!$attribute) {
            return $this->responseRedirectBack('Error occurred while updating attribute.', 'error', true, true);
        }
        return $attribute;
        // return $this->responseRedirectBack('Attribute updated successfully', 'success', false, false);
    }

    public function destroy($id)
    {
        $attribute = $this->attributeRepository->deleteAttribute($id);

        if (!$attribute) {
            return $this->responseRedirectBack('Error occurred while deleting attribute.', 'error', true, true);
        }
    }
}
