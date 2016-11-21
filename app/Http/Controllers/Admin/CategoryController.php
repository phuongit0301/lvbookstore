<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CategoryRequest;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\CategoryInterface;
use App\Http\Models\User;

class CategoryController extends Controller
{
    protected $category;
    
    public function __construct(CategoryInterface $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        $listCategories = $this->category->sort('sort');
        return view('backend.category.index', compact('listCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = $this->category;
        $listCategories = $this->category->lists('name', 'id')->prepend('Please Select Category');
        /*$listCategories =  $this->category->get();
        $listCategories = $listCategories->pluck('name', 'id');
        $listCategories = $listCategories->prepend('Please Select Category');
        $listCategories = $listCategories->all();*/
        return view('backend.categories.create', compact('category', 'listCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        try {
            //User::find(Auth::user()->id)->category()->create($request->all());
            $this->category->create($request->all());
        } catch (Exception $e) {
            echo 'Error Add Category: '. $e->getMessage();
        }
        return redirect('admin/management/category')->with('message','Category successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = $this->category->findOrFail($id);
        return view('admin.management.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->category->findOrFail($id);
        $listCategories = $this->category->where('id', '<>', $category->id)->lists('name', 'id')->prepend('Please Select Category');
        return view('admin.management.category.edit', compact('category', 'listCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        try {
            $input = $request->except(['_method', '_token']);
            $this->category->findOrFail($id)->update($input);
        } catch (Exception $e) {
            echo 'Error Update Category: '. $e->getMessage();
        }
        return redirect('admin/category')->with('message', 'Category successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = $this->category->findOrFail($id);
        $category->delete();
        return redirect('admin/management/category')->with('message', 'Category successfully delete!');
    }
}
