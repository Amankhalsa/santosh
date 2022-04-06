<?php

namespace App\Exports;

use App\Admin_model\Category;
use App\Admin_model\Vision;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Category::where('category_parent_id','!=',0)->get()->map(function($cat) {
         $brand = Category::find($cat->category_parent_id);
         
         $vision_names=array();
         $vision_names_list="";
        if(!empty($cat->visions)){ 
         $vision_ids = explode(',',$cat->visions);
         for($i=0;$i<COUNT($vision_ids);$i++){
            $vision = Vision::find($vision_ids[$i]); 
            $vision_names[] = $vision->vision_name; 
         }
          $vision_names_list = implode(',',$vision_names); 
        }
         
            return [
               'name' => $cat->category_name,
               'brand' => $brand->category_name,
               'uan_code' => $cat->category_uan_code,
               'sku_code' => $cat->category_sku_code,
               'price' => $cat->category_price,
               'discount_price' => $cat->category_discount_price,
               'shape' => $cat->shape,
               'type' => $cat->type,
               'material' => $cat->material,
               'category_frame' => $cat->category_frame,
               'category_for' => $cat->category_for,
               'category_lens_width' => $cat->category_lens_width,
               'category_lens_height' => $cat->category_lens_height,
               'bridge' => $cat->category_bridge,
               'category_arm_length' => $cat->category_arm_length,
               'category_total_width' => $cat->category_total_width,
               'available_with_lens' => $cat->available_with_lens,
               'category_qty' => $cat->category_qty,
               'min_sph' => $cat->min_sph,
               'max_sph' => $cat->max_sph,
               'min_cyl' => $cat->min_cyl,
               'max_cyl' => $cat->max_cyl,
               'group_id' => $cat->category_group_ids,
               'vision_id' => $vision_names_list
            ];
         });
    }
    
    public function headings(): array
    {
        return [
            'Name',
            'Brand',
            'UAN Code',
            'SKU Code',
            'Price',
            'Discount Price',
            'Shape',
            'Type',
            'Material',
            'Frame Type',
            'Frame For',
            'Lens Width',
            'Lens Height',
            'Bridge',
            'Arm Length',
            'Total Width',
            'Available with lens',
            'Qty',
            'Min SPH',
            'Max SPH',
            'Min CYL',
            'Max CYL',
            'Group IDs',
            'Visions'
        ];

    }

       
}
