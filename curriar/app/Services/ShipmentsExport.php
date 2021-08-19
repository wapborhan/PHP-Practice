<?php

namespace App\Services;

use App\Shipment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ShipmentsExport implements FromCollection,WithHeadings {
  public $branch_id;
  public $client_id;
  public $type;
  public $status;
 
  public function headings(): array {
     // "رقم العمليه","الملاحظه","نوع الحركه","اسم العميل"
    return [
       // "الكود","الحاله","نوع المرتجع","المبلغ المراد تحصيله","المبلغ المحصل","العميل"

       //"رقم العمليه","الملاحظه","نوع الحركه","اسم العميل","قيمه الورقه","المبلغ المورد الفعلي","تاريخ العمليه"

     "Branch","Client","Type","Status"
    ];
  }

  /**
  * @return \Illuminate\Support\Collection
  */
  public function collection() {
     return collect(Shipment::getShipmentsReport($this->branch_id,$this->client_id,$this->type,$this->status));
  }
}