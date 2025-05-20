<?php


namespace App\Helpers\Sidebar\Traits;

trait WithSidebarMenu
{
    public function getSidebarMenu(): array
    {
        return [
            '/accounting' => [
                [
                    'title' => 'Cash Book',
                    'link' => '/accounting/general-ledger',
                    'accounting.journal.index',
                    'icon' => 'o-adjustments-horizontal',
                    'route-name' => request()->is('general-ledger') ? 'active' : ''
                ],
                [
                    'title' => 'Expenses',
                    'link' => '/accounting/general-ledger',
                    'accounting.journal.index',
                    'icon' => 'o-adjustments-horizontal',
                    'route-name' => request()->is('general-ledger') ? 'active' : ''
                ],
                [
                    'title' => 'Sales Expense Reconciliation',
                    'link' => '/accounting/general-ledger',
                    'accounting.journal.index',
                    'icon' => 'o-adjustments-horizontal',
                    'route-name' => request()->is('general-ledger') ? 'active' : ''
                ],
                [
                    'title' => 'Jurnal Umum',
                    'link' => '/accounting/general-ledger',
                    'accounting.journal.index',
                    'icon' => 'o-adjustments-horizontal',
                    'route-name' => request()->is('general-ledger') ? 'active' : ''
                ],
                [
                    'title' => 'Laporan Keuangan',
                    'link' => '/accounting/financial-report',
                    'route' => 'accounting.reports.index',
                    'icon' => 'o-adjustments-horizontal',
                    'route-name' => request()->is('financial-report') ? 'active' : ''
                ],
            ],
            '/sales' => [
                [
                    'title' => 'Sales',
                    'link' => 'sales//general-ledger',
                    'route' => 'accounting.reports.index',
                    'icon' => 'o-adjustments-horizontal',
                    'route-name' => request()->is('general-ledger') ? 'active' : ''
                ],
            ],
            '/warehouse' => [

                [
                    'title' => 'Warehouse Dashboard',
                    'icon' => 'o-archive-box',
                    'link' => '#',
                    'children' => [
                        [
                            'title' => 'Overview of incoming, outgoing, and transfer stock',
                            'link' => '/warehouse/dashboard',
                            'route' => 'warehouse.dashboard',
                            'icon' => 'o-presentation-chart-line',
                            'route-name' => request()->is('warehouse/dashboard') ? 'active' : ''
                        ],
                        [
                            'title' => 'Restock alerts and notifications',
                            'link' => '/warehouse/products',
                            'route' => 'warehouse.products.index',
                            'icon' => 'o-cube',
                            'route-name' => request()->is('warehouse/products') ? 'active' : ''
                        ],
                        [
                            'title' => 'Warehouse capacity and storage locations',
                            'link' => '/warehouse/incoming',
                            'route' => 'warehouse.incoming.index',
                            'icon' => 'o-arrow-down-circle',
                            'route-name' => request()->is('warehouse/incoming') ? 'active' : ''
                        ],

                    ]
                ],
                [
                    'title' => 'Products',
                    'icon' => 'o-archive-box',
                    'link' => '#',
                    'children' => [
                        [
                            'title' => 'Product List',
                            'link' => '/warehouse/dashboard',
                            'route' => 'warehouse.dashboard',
                            'icon' => 'o-presentation-chart-line',
                            'route-name' => request()->is('warehouse/dashboard') ? 'active' : ''
                        ],
                        [
                            'title' => 'Product Categories',
                            'link' => '/warehouse/products',
                            'route' => 'warehouse.products.index',
                            'icon' => 'o-cube',
                            'route-name' => request()->is('warehouse/products') ? 'active' : ''
                        ],
                        [
                            'title' => 'Units of Measure (UOM)',
                            'link' => '/warehouse/incoming',
                            'route' => 'warehouse.incoming.index',
                            'icon' => 'o-arrow-down-circle',
                            'route-name' => request()->is('warehouse/incoming') ? 'active' : ''
                        ],
                        [
                            'title' => 'Product Variants',
                            'link' => '/warehouse/outgoing',
                            'route' => 'warehouse.outgoing.index',
                            'icon' => 'o-arrow-up-circle',
                            'route-name' => request()->is('warehouse/outgoing') ? 'active' : ''
                        ],
                        [
                            'title' => 'Batch / Serial Number Tracking',
                            'link' => '/warehouse/adjustment',
                            'route' => 'warehouse.adjustment.index',
                            'icon' => 'o-scale',
                            'route-name' => request()->is('warehouse/adjustment') ? 'active' : ''
                        ],
                        [
                            'title' => 'Minimum & Maximum Stock Levels',
                            'link' => '/warehouse/adjustment',
                            'route' => 'warehouse.adjustment.index',
                            'icon' => 'o-scale',
                            'route-name' => request()->is('warehouse/adjustment') ? 'active' : ''
                        ],
                        [
                            'title' => 'Storage Location per Product',
                            'link' => '/warehouse/adjustment',
                            'route' => 'warehouse.adjustment.index',
                            'icon' => 'o-scale',
                            'route-name' => request()->is('warehouse/adjustment') ? 'active' : ''
                        ],
                    ]
                ],
                [
                    'title' => 'Warehouse Management',
                    'icon' => 'o-archive-box',
                    'link' => '#',
                    'children' => [
                        [
                            'title' => 'List of Warehouses',
                            'link' => '/warehouse/dashboard',
                            'route' => 'warehouse.dashboard',
                            'icon' => 'o-presentation-chart-line',
                            'route-name' => request()->is('warehouse/dashboard') ? 'active' : ''
                        ],
                        [
                            'title' => 'Storage Locations (Bins / Shelves)',
                            'link' => '/warehouse/products',
                            'route' => 'warehouse.products.index',
                            'icon' => 'o-cube',
                            'route-name' => request()->is('warehouse/products') ? 'active' : ''
                        ],
                        [
                            'title' => 'Zone Configuration (Inbound, Picking, Packing, Outbound)',
                            'link' => '/warehouse/incoming',
                            'route' => 'warehouse.incoming.index',
                            'icon' => 'o-arrow-down-circle',
                            'route-name' => request()->is('warehouse/incoming') ? 'active' : ''
                        ],
                        [
                            'title' => 'Warehouse Types (Main, Distribution, Outlet, etc.)',
                            'link' => '/warehouse/incoming',
                            'route' => 'warehouse.incoming.index',
                            'icon' => 'o-arrow-down-circle',
                            'route-name' => request()->is('warehouse/incoming') ? 'active' : ''
                        ],

                    ]
                ],
                [
                    'title' => 'Inventory Transactions',
                    'icon' => 'o-archive-box',
                    'link' => '#',
                    'children' => [
                        [
                            'title' => 'Goods Receipt',
                            'link' => '/warehouse/dashboard',
                            'route' => 'warehouse.dashboard',
                            'icon' => 'o-presentation-chart-line',
                            'children' => [
                                [
                                    'title' => 'From Purchase Orders',
                                    'link' => '/warehouse/dashboard',
                                    'route' => 'warehouse.dashboard',
                                    'icon' => 'o-presentation-chart-line',
                                    'route-name' => request()->is('warehouse/dashboard') ? 'active' : ''
                                ],
                                [
                                    'title' => 'From Internal Transfers',
                                    'link' => '/warehouse/products',
                                    'route' => 'warehouse.products.index',
                                    'icon' => 'o-cube',
                                    'route-name' => request()->is('warehouse/products') ? 'active' : ''
                                ],


                            ]
                        ],


                    ]
                ],
            ],
            '/human-resource' => [
                [
                    'title' => 'Dashboard',
                    'link' => '/human-resource/companies',
                    'route' => 'accounting.reports.index',
                    'icon' => 'o-adjustments-horizontal',
                    'route-name' => request()->is('general-ledger') ? 'active' : ''
                ],
                [
                    'title' => 'User',
                    'link' => '/human-resource/users',
                    'route' => 'accounting.reports.index',
                    'icon' => 'o-adjustments-horizontal',
                    'route-name' => request()->is('general-ledger') ? 'active' : ''
                ],
                [
                    'title' => 'Company',
                    'link' => '/human-resource/companies',
                    'route' => 'accounting.reports.index',
                    'icon' => 'o-adjustments-horizontal',
                    'route-name' => request()->is('general-ledger') ? 'active' : ''
                ],
            ],
            '/finance' => [
                [
                    'title' => 'Dashboard',
                    'link' => '/finance/dashboard',
                    'route' => 'accounting.reports.index',
                    'icon' => 'o-adjustments-horizontal',
                    'route-name' => request()->is('general-ledger') ? 'active' : ''
                ],
            ],
            '/marketing' => [
                [
                    'title' => 'Dashboard',
                    'link' => '/marketing/dashboard',
                    'route' => 'accounting.reports.index',
                    'icon' => 'o-adjustments-horizontal',
                    'route-name' => request()->is('general-ledger') ? 'active' : ''
                ],

            ],
        ];
    }
}
