<?php
namespace App\Components;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\View\Component;

class Recusive {
    private $html;
    public function __construct() {
        $this->html = '';
    }

    public function categoryRecusiveAdd($parent_id = 0, $submark = '') {
        $data = Category::where('parent_id', $parent_id)->get();
        foreach ($data as $dataItem) {
            $this->html .= '<option value="'.$dataItem->id.'">'. $submark . $dataItem->name .'</option>';
            $this->categoryRecusiveAdd($dataItem->id, $submark . '--');
        }
        return $this->html;
    }

    public function categoryRecusiveEdit($parentIdCategoryEdit ,$parent_id = 0, $submark = '') {
        $data = Category::where('parent_id', $parent_id)->get();
        foreach ($data as $dataItem) {
            if($parentIdCategoryEdit == $dataItem->id) {
                $this->html .= '<option selected value="'.$dataItem->id.'">'. $submark . $dataItem->name .'</option>';
            }
            else {
                $this->html .= '<option value="'.$dataItem->id.'">'. $submark . $dataItem->name .'</option>';
            }
            $this->categoryRecusiveEdit($parentIdCategoryEdit ,$dataItem->id, $submark . '--');
        }
        return $this->html;
    }

    public function categoryProductEdit($category_id ,$parent_id = 0, $submark = '') {
        $data = Category::where('parent_id', $parent_id)->get();
        foreach ($data as $dataItem) {
            if($category_id == $dataItem->id) {
                $this->html .= '<option selected value="'.$dataItem->id.'">'. $submark . $dataItem->name .'</option>';
            }
            else {
                $this->html .= '<option value="'.$dataItem->id.'">'. $submark . $dataItem->name .'</option>';
            }
            $this->categoryProductEdit($category_id, $dataItem->id, $submark . '--');
        }
        return $this->html;
    }
}
