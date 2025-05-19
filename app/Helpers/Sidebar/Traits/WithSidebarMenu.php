<?php


namespace App\Helpers\Sidebar\Traits;

trait WithSidebarMenu
{
    public function getSidebarMenu(): array
    {
        return [
            '/accounting' => [
                [
                    'title' => 'Jurnal Umum',
                    'link' => '/accounting/general-ledger',
                    'accounting.journal.index',
                    'icon' => 'fa-book',
                    'route-name' => request()->is('general-ledger') ? 'active' : ''
                ],
                [
                    'title' => 'Laporan Keuangan',
                    'link' => '/accounting/financial-report',
                    'route' => 'accounting.reports.index',
                    'icon' => 'fa-file',
                    'route-name' => request()->is('financial-report') ? 'active' : ''
                ],
            ],
            '/sales' => [
                [
                    'title' => 'Sales',
                    'link' => 'sales//general-ledger',
                    'route' => 'accounting.reports.index',
                    'icon' => 'fa-book',
                    'route-name' => request()->is('general-ledger') ? 'active' : ''
                ],
            ],
            '/warehouse' => [
                [
                    'title' => 'Product',
                    'link' => '/warehouse/products',
                    'route' => 'accounting.reports.index',
                    'icon' => 'fa-book',
                    'route-name' => request()->is('general-ledger') ? 'active' : ''
                ],
            ],
            '/human-resource' => [
                [
                    'title' => 'Human Resource',
                    'link' => '/human-resource/companies',
                    'route' => 'accounting.reports.index',
                    'icon' => 'fa-book',
                    'route-name' => request()->is('general-ledger') ? 'active' : ''
                ],
            ],
        ];
    }
}
