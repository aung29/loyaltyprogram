<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MembershipExport implements FromCollection,WithHeadings,WithColumnWidths,WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $pglist = DB::table('m_membership_program AS member')
        ->select('member.program_name','member.discount','member.kyat_from','member.kyat_to','member.start_date','member.end_date')
        ->where('member.active', 1)
        ->paginate(10);
        


        
     return $pglist;
    }


    
    public function headings() : array
    {

        return [
            "Program name","Discount","Kyat From","Kyat To","Start Date",'End Date'
        ];
    
    }  

    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 11,   
            'C' => 15,
            'D' => 15,
            'E' => 17,
            'F' => 17,
           
                  
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            'A1'   => ['font' => ['bold' => true]],
            'B1'   => ['font' => ['bold' => true]],
            'C1'   => ['font' => ['bold' => true]],
            'D1'   => ['font' => ['bold' => true]],
            'E1'   => ['font' => ['bold' => true]],
            'F1'   => ['font' => ['bold' => true]],
           
          
          

         
        ];
    }
}
