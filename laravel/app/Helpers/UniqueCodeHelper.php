<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

use App\Models\MCustomer;
use App\Models\MMaterial;
use App\Models\TrxHSalesOrder;
use App\Models\MCustomerReceipt;

class UniqueCodeHelper
{
    public static function generateCustomerCode()
    {
        $lastCustomer = MCustomer::selectRaw('MAX(SUBSTRING(code, 3, 8)) as customer_code')->first();

        if($lastCustomer->customer_code) $increment = (int)$lastCustomer->customer_code + 1;
        else $increment = 1;

        return 'CM' . str_pad($increment, 8, 0, STR_PAD_LEFT);
    }

    public static function generateReceiptCode()
    {
        $lastReceipt = MCustomerReceipt::selectRaw('MAX(SUBSTRING(code, 3, 8)) as receipt_code')->first();

        if($lastReceipt->receipt_code) $increment = (int)$lastReceipt->receipt_code + 1;
        else $increment = 1;

        return 'CR' . str_pad($increment, 8, 0, STR_PAD_LEFT);
    }

    public static function generateMaterialCode()
    {
        $lastReceipt = MMaterial::selectRaw('MAX(SUBSTRING(code, 2, 8)) as material_code')->first();

        if($lastReceipt->material_code) $increment = (int)$lastReceipt->material_code + 1;
        else $increment = 1;

        return 'M' . str_pad($increment, 8, 0, STR_PAD_LEFT);
    }

    public static function generateSalesOrderCode()
    {
        $month = date('m');
        $year  = date('y');
      
        $lastReceipt = TrxHSalesOrder::selectRaw('MAX(SUBSTRING(invoice, 4, 7)) as invoice_code')
            ->whereRaw("SUBSTRING(invoice, 12, 2) = '{$month}'")
            ->whereRaw("SUBSTRING(invoice, 15, 2) = '{$year}'")
        ->first();

        if($lastReceipt->invoice_code) $increment = (int)$lastReceipt->invoice_code + 1;
        else $increment = 1;

        $increment = str_pad($increment, 7, 0, STR_PAD_LEFT);

        return "CSO{$increment}/{$month}/{$year}";
    }
}