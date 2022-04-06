<?php

namespace App\Exports;

use App\Admin_model\Lens;
use App\Admin_model\LensBrand;
use App\Admin_model\Vision;
use App\Admin_model\LensColorType;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LensExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Lens::all()->map(function($lens) {
         $brand = LensBrand::find($lens->brand);
         $lens_index = DB::table('lens_index')->where('id',$lens->lens_index)->first();
        $vision = Vision::find($lens->vision_id);
        $lens_color_type = LensColorType::find($lens->color_type_id);
        $toggle_names=array();
         $toggle_names_list="";
        if(!empty($lens->lens_toggles)){ 
         $toggle_ids = explode(',',$lens->lens_toggles);
         $toggle_data = DB::table('lens_toggles')->whereIn('id',$toggle_ids)->get(); 
         foreach($toggle_data as $data){
            $toggle_names[] = $data->toggle_name; 
         }
          $toggle_names_list = implode(',',$toggle_names); 
        }
        
         
            return [
               'name' => $lens->name,
               'brand' => $brand->category_name,
               'lens_index' => $lens_index->lens_index,
               'diameter' => $lens->diameter,
               'vision' => $vision->vision_name,
               'color_type' => $lens_color_type->category_name,
               'bifocal_type' => $lens->bifocal_type,
               'cost' => $lens->cost,
               'price' => $lens->price,
               'min_sph' => $lens->min_sph,
               'max_sph' => $lens->max_sph,
               'min_cyl' => $lens->min_cyl,
               'max_cyl' => $lens->max_cyl,
               'min_add' => $lens->min_add,
               'max_add' => $lens->max_add,
               'limit_minus' => $lens->limit_minus,
               'limit_plus' => $lens->limit_plus,
               'group_id' => $lens->category_group_ids,
               'toggle' => $toggle_names_list
            ];
         });
    }
    
    public function headings(): array
    {
        return [
            'Name',
            'Brand',
            'Lens Index',
            'Diameter',
            'Vision',
            'Color Type',
            'Bifocal Type',
            'Cost',
            'Price',
            'Min SPH',
            'Max SPH',
            'Min CYL',
            'Max CYL',
            'Min ADD',
            'Max ADD',
            'Limit MINUS',
            'Limit PLUS',
            'Group IDs',
            'Toggles'
        ];

    }

       
}
