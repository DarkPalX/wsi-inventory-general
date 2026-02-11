<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->users();
        $this->role_permission();
        $this->item_categories();
        $this->item_types();
        $this->item_units();
        $this->items();
        $this->suppliers();
        $this->receivers();
        $this->vehicles();
        $this->employees();
        $this->divisions();
        $this->sections();
        
        $this->call([
            SettingSeeder::class,
            MenuSeeder::class,
            MenusHasPagesSeeder::class,
            PageSeeder::class,
            AlbumSeeder::class,
            RoleSeeder::class,
            OptionSeeder::class,
            BannerSeeder::class,
            ReceivingTransactionSeeder::class,
            RequisitionTransactionSeeder::class,
            IssuanceTransactionSeeder::class,
        ]);
    }

    private function users()
    {
        $users = [
            [
                'name' => 'Admin Istrator',
                'firstname' => 'admin',
                'middlename' => 'user',
                'lastname' => 'istrator',
                'email' => 'wsiprod.demo@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'section_id' => 1,
                'role_id' => 1,
                'is_active' => 1,
                'user_id' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'mobile' => '09456714321',
                'phone' => '022646545',
                'address_street' => 'Maharlika St',
                'address_city' => 'Pasay',
                'address_zip' => '1234'
            ],
            [
                'name' => 'Secretary',
                'firstname' => 'Sec',
                'middlename' => 'Re',
                'lastname' => 'Tary',
                'email' => 'secretary',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'section_id' => 1,
                'role_id' => 2,
                'is_active' => 1,
                'user_id' => 3,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'mobile' => '09456714321',
                'phone' => '022646545',
                'address_street' => 'Maharlika St',
                'address_city' => 'Pasay',
                'address_zip' => '1234'
            ],
            [
                'name' => 'Approver',
                'firstname' => 'App',
                'middlename' => 'Ro',
                'lastname' => 'Rover',
                'email' => 'approver',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'section_id' => 1,
                'role_id' => 3,
                'is_active' => 1,
                'user_id' => 2,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'mobile' => '09456714321',
                'phone' => '022646545',
                'address_street' => 'Maharlika St',
                'address_city' => 'Pasay',
                'address_zip' => '1234'
            ],
            [
                'name' => 'Warehouse Incharge',
                'firstname' => 'Warehouse',
                'middlename' => 'In',
                'lastname' => 'Incharge',
                'email' => 'warehouse',
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'section_id' => 1,
                'role_id' => 4,
                'is_active' => 1,
                'user_id' => 4,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'mobile' => '09456714321',
                'phone' => '022646545',
                'address_street' => 'Maharlika St',
                'address_city' => 'Pasay',
                'address_zip' => '1234'
            ]
        ];

        DB::table('users')->insert($users);
    }
    
    private function assign_role_permission($module_id, $role_id, $permission_ids)
    {
        $entries = [];

        foreach ((array) $permission_ids as $permission_id) {
            $entries[] = [
                'module_id' => $module_id,
                'role_id' => $role_id,
                'permission_id' => $permission_id,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        return $entries;
    }
    
    private function role_permission()
    {
        $all_role_permissions = [];

        $all_role_permissions = array_merge(
            $all_role_permissions,

            //ADMIN
            $this->assign_role_permission(1, 1, [1, 2]),
            $this->assign_role_permission(2, 1, [1, 2, 3]),
            $this->assign_role_permission(3, 1, [1, 2, 3]),
            $this->assign_role_permission(4, 1, [1, 2, 3]),
            $this->assign_role_permission(5, 1, [1, 2, 3, 4, 5, 6]),
            $this->assign_role_permission(6, 1, [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]),
            $this->assign_role_permission(7, 1, [1, 2, 3, 4, 5, 6, 7, 8, 9]),

            //SECRETARY
            $this->assign_role_permission(3, 2, [1]),
            $this->assign_role_permission(4, 2, [1]),
            $this->assign_role_permission(5, 2, [3, 4, 5]),
            $this->assign_role_permission(6, 2, [1]),

            //APPROVER
            $this->assign_role_permission(2, 3, [2, 3]),
            $this->assign_role_permission(3, 3, [2, 3]),
            $this->assign_role_permission(4, 3, [2, 3]),
            $this->assign_role_permission(5, 3, [3, 4, 5]),
            $this->assign_role_permission(6, 3, [1]),

            //WAREHOUSE IN CHARGE
            $this->assign_role_permission(1, 4, [1, 2]),
            $this->assign_role_permission(2, 4, [1, 2, 3]),
            $this->assign_role_permission(3, 4, [1, 2, 3]),
            $this->assign_role_permission(4, 4, [1, 2, 3]),
            $this->assign_role_permission(5, 4, [1, 2, 3, 4, 5, 6]),
            $this->assign_role_permission(6, 4, [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]),
            $this->assign_role_permission(7, 4, [1, 2, 3, 4, 5, 6]),

            //USERS
            $this->assign_role_permission(5, 5, [1, 2, 3, 4]),

            //GUEST
            $this->assign_role_permission(1, 6, [1, 2]),
            $this->assign_role_permission(2, 6, [1, 2, 3]),
            $this->assign_role_permission(3, 6, [1, 2, 3]),
            $this->assign_role_permission(4, 6, [1, 2, 3]),
            $this->assign_role_permission(5, 6, [1, 2, 3, 4, 5]),
            $this->assign_role_permission(6, 6, [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]),

        );

        // Finally insert into the DB
        DB::table('role_permission')->insert($all_role_permissions);
    }
    
    private function item_categories()
    {
        $item_categories = [
            [
                'name' => 'Home Appliances',
                'slug' => 'home-appliances',
                'description' => 'home',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ], 

            [
                'name' => 'School Supplies',
                'slug' => 'school-supplies',
                'description' => 'school',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ], 

            [
                'name' => 'Kitchen Wares',
                'slug' => 'kitchen-wares',
                'description' => 'Sanaol',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ], 

            [
                'name' => 'Gadgets',
                'slug' => 'gadgets',
                'description' => 'edi wow',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]
        ];

        DB::table('item_categories')->insert($item_categories);
    }
    
    private function item_types()
    {
        $item_types = [
            [
                'name' => 'Office Supplies',
                'slug' => 'office-supplies',
                'description' => 'Office Supplies',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ], 

            [
                'name' => 'Equipment',
                'slug' => 'equipment',
                'description' => 'Equipment',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]
        ];

        DB::table('item_types')->insert($item_types);
    }
    
    private function item_units()
    {
        $item_units = [
            [
                'name' => 'Piece',
                'slug' => 'piece',
                'description' => 'Piece',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ], 

            [
                'name' => 'Box',
                'slug' => 'box',
                'description' => 'Box',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ], 

            [
                'name' => 'Jumbo Box',
                'slug' => 'jumbo-box',
                'description' => 'Jumbo Box',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ], 

            [
                'name' => 'Cellophane',
                'slug' => 'cellophane',
                'description' => 'Cellophane',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]
        ];

        DB::table('item_units')->insert($item_units);
    }
    
    private function items()
    {
        $names = [
            'Flower Vase', 'Wooden Chair', 'Glass Bottle', 'Ceramic Plate', 'Metal Spoon',
            'Cotton Towel', 'Leather Wallet', 'Plastic Container', 'Steel Knife', 'Paper Notebook',
            'Silk Scarf', 'Linen Blanket', 'Stone Mortar', 'Copper Pan', 'Aluminum Can',
            'Rubber Mat', 'Bamboo Stick', 'Clay Pot', 'Gold Ring', 'Silver Bracelet'
        ];

        $locations = ['Kitchen Wares Section', 'Hardware Section', 'Food Section'];

        $items = [];

        foreach ($names as $index => $name) {
            $items[] = [
                'sku' => '20250' . str_pad($index + 100, 4, '0', STR_PAD_LEFT),
                'barcode' => str_pad($index + 100, 7, '0', STR_PAD_LEFT),
                'name' => $name,
                'slug' => Str::slug($name),
                'category_id' => rand(1, 4),
                'unit_id' => rand(1, 4),
                'type_id' => rand(1, 2),
                // 'supplier_id' => '['. rand(1, 3) . ']',
                // 'location' => $locations[array_rand($locations)],
                // 'price' => rand(100, 1000),
                'minimum_stock' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('items')->insert($items);
    }

    private function suppliers()
    {
        $suppliers = [
            [
                'name' => 'Maligaya Printers',
                'address' => 'Davao City',
                'cellphone_no' => '09987654321',
                'telephone_no' => '2287000',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ], 

            [
                'name' => 'Epson Printer',
                'address' => 'Davao City',
                'cellphone_no' => '09987654321',
                'telephone_no' => '2287000',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ], 

            [
                'name' => 'Asus',
                'address' => 'Davao City',
                'cellphone_no' => '09987654321',
                'telephone_no' => '2287000',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]
        ];

        DB::table('suppliers')->insert($suppliers);
    }

    private function receivers()
    {
        $receivers = [
            [
                'name' => 'Bureau of Immigrations',
                'address' => 'Davao City',
                'contact' => '09987654321',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ], 
            [
                'name' => 'Commmission on Audit',
                'address' => 'Buhangin, Davao City',
                'contact' => '09987654321',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ], 
            [
                'name' => 'San Miguel',
                'address' => 'Panabo City',
                'contact' => '09987654321',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]
        ];

        DB::table('receivers')->insert($receivers);
    }
    
    private function divisions()
    {
        $divisions = [
            [
                'name' => 'ICT',
                'head_emp_id' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ], 
            [
                'name' => 'MCD',
                'head_emp_id' => 2,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ], 
            [
                'name' => 'Accounting',
                'head_emp_id' => 3,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],

        ];

        DB::table('divisions')->insert($divisions);
    }
    
    private function sections()
    {
        $sections = [
            [
                'name' => 'Guest',
                'division_id' => 1,
                'head_emp_id' => 1,
                'secretary_emp_id' => 4,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ], 
            [
                'name' => 'Developer',
                'division_id' => 1,
                'head_emp_id' => 1,
                'secretary_emp_id' => 4,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ], 
            [
                'name' => 'DMS',
                'division_id' => 1,
                'head_emp_id' => 2,
                'secretary_emp_id' => 4,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ], 
            [
                'name' => 'Admin',
                'division_id' => 2,
                'head_emp_id' => 2,
                'secretary_emp_id' => 3,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ], 
            [
                'name' => 'Kitchen',
                'division_id' => 2,
                'head_emp_id' => 1,
                'secretary_emp_id' => 3,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ], 
            [
                'name' => 'Tax',
                'division_id' => 3,
                'head_emp_id' => 3,
                'secretary_emp_id' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ], 
            [
                'name' => 'Payroll',
                'division_id' => 3,
                'head_emp_id' => 3,
                'secretary_emp_id' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ], 
        ];

        DB::table('sections')->insert($sections);
    }

    private function employees()
    {
        $employees = [
            [
                'name' => 'Myoui Mina',
                'section_id' => 1,
                'department' => 'Accounting',
                'position' => 'Calculator',
                'emp_id' => 'E001',
                'hired_date' => '2025-01-01',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ], 
            [
                'name' => 'Hirai Momo',
                'section_id' => 3,
                'department' => 'Accounting',
                'position' => 'Calculator',
                'emp_id' => 'E002',
                'hired_date' => '2025-01-01',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ], 
            [
                'name' => 'Minatozaki Sana',
                'section_id' => 4,
                'department' => 'ICT',
                'position' => 'Developer',
                'emp_id' => 'E003',
                'hired_date' => '2025-01-01',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ], 
            [
                'name' => 'Chou Tzuyu',
                'section_id' => 2,
                'department' => 'ICT',
                'position' => 'Developer',
                'emp_id' => 'E004',
                'hired_date' => '2025-01-01',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ], 
        ];

        DB::table('employees')->insert($employees);
    }
    
    private function vehicles()
    {
        $vehicles = [
            [
                'name' => null,
                'slug' => null,
                'plate_no' => 'LXY 576',
                'driver' => null,
                'description' => 'Truck',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ], 

            [
                'name' => null,
                'slug' => null,
                'plate_no' => 'LXZ 810',
                'driver' => null,
                'description' => 'Truck',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ], 

            [
                'name' => null,
                'slug' => null,
                'plate_no' => 'LZS 245',
                'driver' => null,
                'description' => 'Truck',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ], 

            [
                'name' => null,
                'slug' => null,
                'plate_no' => 'LYR 143',
                'driver' => null,
                'description' => 'Truck',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]
        ];

        DB::table('vehicles')->insert($vehicles);
    }

}
