<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Components\Recursive;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    private $category;
    function __construct(Category $category)
    {
        $this -> category = $category;
    }
    public function create()
    {
        $htmlOption = $this->getCategory($parentId='');
        return view('admin.category.add',compact('htmlOption'));
    }
    public function index()
    {
        $categories = $this -> category -> paginate(5);
        return view('admin.category.index',compact('categories'));
    }
    public function store(Request $request)
    {
        $this->category->create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name),
        ]);
        return redirect() -> route ('categories.index');
    }
    public function getCategory($parentId)
    {
        $data = $this -> category -> all();
        $recursive = new Recursive($data);
        $htmlOption =  $recursive -> Recursive($parentId);
        return $htmlOption;
    }
    public function edit($id)
    {
        $category = $this->category->find($id);
        $htmlOption = $this->getCategory($category->parent_id);
        return view('admin.category.edit',compact('category','htmlOption'));

    }
    public function update(Request $request, $id)
    {
        $this->category ->find($id) ->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name),
        ]);
        return redirect() -> route ('categories.index');
    }
    public function delete($id)
    {
        $this->category->find($id)->delete();
        $allCate = $this->category ->all();
        foreach($allCate as $categories)
        {
            if($categories['parent_id']==$id)
            {
                $this -> category -> find($categories['id'])->delete();
            }
        }
        return redirect() -> route ('categories.index');
    }
}
