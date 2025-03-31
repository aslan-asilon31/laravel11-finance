<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Accounting\Account;
use App\Models\Accounting\AccountSubtype;

class AccountSeeder extends Seeder
{
    public function run(): void
    {
        // Mendapatkan subtype_id untuk 'Cash and Cash Equivalents'
        $accountSubtypeCash = AccountSubtype::where('name', 'Cash and Cash Equivalents')->first();
        $accountSubtypeSalesTax = AccountSubtype::where('name', 'Sales Taxes')->first();
        $accountSubtypePurchaseTax = AccountSubtype::where('name', 'Input Tax Recoverable')->first();
        $accountSubtypeSalesDiscount = AccountSubtype::where('name', 'Sales Discounts')->first();
        $accountSubtypePurchaseDiscount = AccountSubtype::where('name', 'Purchase Discounts')->first();

        // Membuat beberapa akun dengan data dummy
        Account::create([
            'company_id' => 1,
            'subtype_id' => $accountSubtypeCash->id,
            'name' => 'Kas Utama',
            'currency_code' => 'IDR',
            'description' => 'Akun kas utama perusahaan',
            'archived' => false,
            'default' => true,
        ]);

        Account::create([
            'company_id' => 1,
            'subtype_id' => $accountSubtypeSalesTax->id,
            'name' => 'Pajak Penjualan',
            'currency_code' => 'IDR',
            'description' => 'Akun untuk pajak penjualan',
            'archived' => false,
            'default' => false,
        ]);

        Account::create([
            'company_id' => 1,
            'subtype_id' => $accountSubtypePurchaseTax->id,
            'name' => 'Pajak Pembelian',
            'currency_code' => 'IDR',
            'description' => 'Akun untuk pajak pembelian',
            'archived' => false,
            'default' => false,
        ]);

        Account::create([
            'company_id' => 1,
            'subtype_id' => $accountSubtypeSalesDiscount->id,
            'name' => 'Diskon Penjualan',
            'currency_code' => 'IDR',
            'description' => 'Akun untuk diskon penjualan',
            'archived' => false,
            'default' => false,
        ]);

        Account::create([
            'company_id' => 1,
            'subtype_id' => $accountSubtypePurchaseDiscount->id,
            'name' => 'Diskon Pembelian',
            'currency_code' => 'IDR',
            'description' => 'Akun untuk diskon pembelian',
            'archived' => false,
            'default' => false,
        ]);
    }
}
