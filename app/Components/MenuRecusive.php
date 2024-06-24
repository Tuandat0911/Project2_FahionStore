<?php

namespace App\Components;

use App\Models\Menu;
use Illuminate\Support\Facades\DB;

class MenuRecusive
{
    private $html;
    public function __construct() {
        $this->html = '';
    }

    public function menuRecusiveAdd($parent_id = 0, $submark = '') {
        $data = Menu::where('parent_id', $parent_id)->get();
        foreach ($data as $dataItem) {
            $this->html .= '<option value="'.$dataItem->id.'">'. $submark . $dataItem->name .'</option>';
            $this->menuRecusiveAdd($dataItem->id, $submark . '--');
        }
        return $this->html;
    }

    public function menuRecusiveEdit($parentIdMenuEdit ,$parent_id = 0, $submark = '') {
        $data = Menu::where('parent_id', $parent_id)->get();
        foreach ($data as $dataItem) {
            if($parentIdMenuEdit == $dataItem->id) {
                $this->html .= '<option selected value="'.$dataItem->id.'">'. $submark . $dataItem->name .'</option>';
            }
            else {
                $this->html .= '<option value="'.$dataItem->id.'">'. $submark . $dataItem->name .'</option>';
            }
            $this->menuRecusiveEdit($parentIdMenuEdit ,$dataItem->id, $submark . '--');
        }
        return $this->html;
    }
}

