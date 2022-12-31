<?php

namespace App\Http\Controllers;

use App\Models\BookCategory;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('manageCategory', compact('categories'));
    }

    public function deleteCategory($id) {
        $res = Category::find($id);

        if ($res) {
            BookCategory::where('category_id', $id)->delete();
            $res->delete();
            return redirect()->route('displayCategory')->with('success_message', 'Category deleted successfully');
        }

        else {
            return redirect()->route('displayCategory')->with('error_message', 'Something went wrong');
        }
    }

    protected function returnValidator(array $data)
    {
        $rules = ['catName' => 'required'];
        $messages = ['catName.required' => 'Category Name is required.'];
        return Validator::make($data, $rules, $messages);
    }

    protected function returnAddValidator(array $data)
    {
        $rules = ['addCatName' => 'required'];
        $messages = ['addCatName.required' => 'Category Name is required.'];
        return Validator::make($data, $rules, $messages);
    }

    public function update(Request $request, $id) {
        $validator = $this->returnValidator($request->all());

        if ($validator->fails()) {
            return redirect('/display/category')->withErrors($validator)->withInput()->with('error_message', "Please fill the category correctly.");
        }
        else {
            $cat = Category::find($id);
            $cat->name = $request->catName;
            $cat->save();

            return redirect()->route('displayCategory')->with('success_message', 'Category edited successfully');
        }
    }

    public function add(Request $request) {
        $validate = $this->returnAddValidator($request->all());

        if( $validate->fails()) {
            return redirect('/display/category')->withErrors($validate)->withInput()->with('error_message', "Please fill the category correctly.");
        }
        else {
            Category::create([
                'name' => $request->addCatName
            ]);

            return redirect()->route('displayCategory')->with(['success_message' => 'Category added successfully']);
        }
    }
}
