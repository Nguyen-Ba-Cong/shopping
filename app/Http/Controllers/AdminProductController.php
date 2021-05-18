<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Components\Recursive;
class AdminProductController extends Controller
{
    private $product;
    private $category;
    function __construct(Category $category)
    {
        $this->category = $category;
    }
    public function index()
    {
        return view('admin.products.index');
    }
    public function create()
    {
        $htmlOption = $this ->getCategory($parentId='');
        return view('admin.products.add',compact('htmlOption'));
    }
    public function getCategory($parentId)
    {
        $data = $this -> category -> all();
        $recursive = new Recursive($data);
        $htmlOption =  $recursive -> Recursive($parentId);
        return $htmlOption;
    }
}
