<?php

namespace App\Exports;

use App\Admin_model\Enquiry;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EnquiryExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Enquiry::all();
    }

        public function headings(): array

    {

        return [

            'ID',

            'Enquiry Name',

            'Enquiry Email',

            'Emquiry Mobile',

            'Enquiry Source',

            'Enquiry Msg',

            'Created At',

            'Updated At'

        ];

    }
}
