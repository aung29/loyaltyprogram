<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DetailExport implements FromCollection,WithHeadings,WithColumnWidths,WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */

    
        protected $id;

        function __construct($id) {
                $this->id = $id;
        }


    
    public function collection()
    {
        
        $specificData = DB::table('m_transaction')
        ->join('m-card', 'm_transaction.card_id', '=', 'm-card.id')
        ->join('m_membership_program','m-card.membership_id','=','m_membership_program.id')
        ->join('m_ad_shop','m_ad_shop.id','=','m-card.shop_id')
        ->select('m_transaction.transaction_date','m-card.customer_name','m-card.card_id','m_membership_program.program_name','m_membership_program.note','m_transaction.amount','m_ad_shop.shop_name')
        ->where('m_transaction.card_id',$this->id)
        ->where('m-card.active',1)
        ->where('m_membership_program.active',1)
        ->get();

        return $specificData;
    }


    public function headings() : array
    {

        return [
            "Transaction Date","Customer Name","Card Id","Reference","Note",'Amount','Branch'
        ];
    
    }  

    public function columnWidths(): array
    {
        return [
            'A' => 30,
            'B' => 20,   
            'C' => 15,
            'D' => 20,
            'E' => 20,
            'F' => 16,
            'G' => 17,
                  
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
            'G1'   => ['font' => ['bold' => true]],
          
          

         
        ];
    }
}
