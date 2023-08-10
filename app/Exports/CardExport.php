<?php

namespace App\Exports;

use App\Models\M_card;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CardExport implements FromCollection,WithHeadings,WithColumnWidths,WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        

        if (session()->has('role')) {
            $shopid =  session('shop');
            if (session('role') == 'SA') {
                $count = DB::table('m_card')
                ->select('m_card.customer_name','m_card.card_id','m_card.phone','m_card.dob','m_card.address')
                ->where('m_card.active',1)
                // ->where('m_card.shop_id',$shopid)
                ->get();
            }else{
                $count = DB::table('m_card')
                ->select('m_card.customer_name','m_card.card_id','m_card.phone','m_card.dob','m_card.address')
                ->where('m_card.active',1)
                ->where('m_card.shop_id',$shopid)
                ->get();
            }
        }
       

        return $count;
    }


    public function headings() : array
    {

        return [
            "Customer Name","Card ID","Phone Number","Date of Birth","Address"
        ];
    
    }  

    public function columnWidths(): array
    {
        return [
            'A' => 30,
            'B' => 20,   
            'C' => 30,
            'D' => 30,
            'E' => 35         
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
          

         
        ];
    }

}
