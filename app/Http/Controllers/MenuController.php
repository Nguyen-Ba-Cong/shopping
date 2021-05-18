<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Components\Recursive;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    private $menu;
    function __construct( Menu $menu)
    {
        $this->menu = $menu;
    }
    public function getMenu($parentId)
    {
        $data = $this->menu ->all();
        $recursive = new Recursive($data);
        $htmlOption = $recursive->Recursive($parentId);
        return $htmlOption;
    }
    public function index()
    {
        $menus = $this->menu ->paginate(5);
        return view('admin.menus.index',compact('menus'));
    }
    public function create()
    {
        $htmlOption = $this->getMenu($parentId='');
        return view('admin.menus.add',compact('htmlOption'));
    }
    public function store(Request $request)
    {
        $this->menu->create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name),
        ]);
        return redirect() -> route ('menus.index');
    }
    public function edit($id)
    {
        $menu = $this ->menu ->find($id);
        $htmlOption = $this->getMenu($menu->parent_id);
        return view('admin.menus.edit', compact('menu','htmlOption'));
    }
    public function update(Request $request, $id)
    {
        $this->menu->find($id)->update([
            'name' => $request->name,
            'parent_id' => $request-> parent_id,
            'slug' => Str::slug($request->name),
        ]);
        return redirect() -> route ('menus.index');
    }
    public function delete($id)
    {
        $this->menu->find($id)->delete();
        $allMenu = $this->menu->all();
        foreach($allMenu as $item)
        {
            if($item['parent_id']==$id)
            {
                $this->menu->find($item['id'])->delete();
            }
        }
        return redirect() -> route('menus.index');
    }
}
