<?php

namespace App\Components;
use App\Models\Menu;

class MenuRecursive
{
    private $htmlSelect;
    public function __construct()
    {
        $this->html = '';
    }
    public function menuRecursiveAdd($parentId = 0, $subMark ='')
    {
        $data = Menu::where('parent_id',$parentId)->get();
        foreach($data as $item)
        {
            $this->htmlSelect .= "<option value =".$item->id.">" .$subMark.$item->name. "</option>";
            $this->menuRecursiveAdd($item->id, $subMark . '--');
        }
        return $this->htmlSelect;
    }
}