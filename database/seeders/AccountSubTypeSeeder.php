<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Accounting\AccountSubtype;


class AccountSubtypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat beberapa subtype akun
        AccountSubtype::create([
            'company_id' => 1,
            'name' => 'Cash and Cash Equivalents',
            'category' => 'Asset',
            'type' => 'Current',
        ]);

        AccountSubtype::create([
            'company_id' => 1,
            'name' => 'Sales Taxes',
            'category' => 'Liability',
            'type' => 'Current',
        ]);

        AccountSubtype::create([
            'company_id' => 1,
            'name' => 'Input Tax Recoverable',
            'category' => 'Asset',
            'type' => 'Current',
        ]);

        AccountSubtype::create([
            'company_id' => 1,
            'name' => 'Sales Discounts',
            'category' => 'Revenue',
            'type' => 'Contra',
        ]);

        AccountSubtype::create([
            'company_id' => 1,
            'name' => 'Purchase Discounts',
            'category' => 'Expense',
            'type' => 'Contra',
        ]);
    }
}
