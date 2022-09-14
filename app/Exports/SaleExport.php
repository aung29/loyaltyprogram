<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SaleExport implements FromCollection,WithHeadings,WithColumnWidths,WithStyles

{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        
        if(session()->has('adminId')){
            $createid =  session('adminId');
        }

        $count = DB::table('m_transaction')
        ->join('m-card', 'm_transaction.card_id', '=', 'm-card.id')
        ->join('m_membership_program','m-card.membership_id','=','m_membership_program.id' )
        ->select('m-card.customer_name','m-card.card_id','m_transaction.invoice','m_transaction.amount','m_membership_program.program_name','m_transaction.transaction_date')
        ->where('m-card.active',1)
        ->where('m_membership_program.active',1)
        // ->where('m_transaction.created_by_id',$createid)
        ->orderBy('m_transaction.id','DESC')
        ->get();

        return $count;


    }


    public function headings() : array
    {

        return [
            "Customer Name","Card ID","Invoice No","Price","Reference",'Date Create'
        ];
    
    }  

    public function columnWidths(): array
    {
        return [
            'A' => 30,
            'B' => 15,   
            'C' => 30,
            'D' => 17,
            'E' => 30,
            'F' => 35         
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
