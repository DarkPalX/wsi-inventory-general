<?php

namespace App\Http\Controllers\Settings;

use App\Helpers\PanelHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Facades\App\Helpers\ListingHelper;
use App\Models\Permission;
use App\Models\{Page, Role, RolePermission};

use Auth;

class PermissionController extends Controller
{
    private $searchFields = ['module'];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('checkPermission:admin/permission', ['only' => ['index']]);
        $this->middleware('checkPermission:admin/permission/create', ['only' => ['create','store']]);
        $this->middleware('checkPermission:admin/permission/edit', ['only' => ['show','edit','update']]);
        $this->middleware('checkPermission:admin/permission/delete', ['only' => ['destroy']]);
    }


    public function index($param = null)
    {
        $page = new Page();
        $page->name = "Permissions";

        $roles = Role::all();
        //$roles = Role::where('id', '!=', 1)->get();
        $role_permissions = RolePermission::all();

        $modules = [
            [
                'id' => 1,
                'name' => 'Items',
                'permissions' => [
                    0 => [
                        'id' => 1,
                        'name' => 'Create/Edit'
                    ],

                    1 => [
                        'id' => 2,
                        'name' => 'Delete'
                    ],
                ]
            ],
            [
                'id' => 2,
                'name' => 'Receiving',
                'permissions' => [
                    0 => [
                        'id' => 1,
                        'name' => 'Create/Edit'
                    ],

                    1 => [
                        'id' => 2,
                        'name' => 'Cancel'
                    ],

                    2 => [
                        'id' => 3,
                        'name' => 'Post'
                    ],
                ]
            ],
            [
                'id' => 3,
                'name' => 'Issuance',
                'permissions' => [
                    0 => [
                        'id' => 1,
                        'name' => 'Create/Edit'
                    ],

                    1 => [
                        'id' => 2,
                        'name' => 'Cancel'
                    ],

                    2 => [
                        'id' => 3,
                        'name' => 'Post'
                    ],
                ]
            ],
            [
                'id' => 4,
                'name' => 'Requisition',
                'permissions' => [
                    0 => [
                        'id' => 1,
                        'name' => 'Create/Edit'
                    ],

                    1 => [
                        'id' => 2,
                        'name' => 'Cancel'
                    ],

                    2 => [
                        'id' => 3,
                        'name' => 'Post'
                    ],
                ]
            ],
            [
                'id' => 5,
                'name' => 'Module Access',
                'permissions' => [
                    0 => [
                        'id' => 1,
                        'name' => 'Items'
                    ],

                    1 => [
                        'id' => 2,
                        'name' => 'Receiving'
                    ],

                    2 => [
                        'id' => 3,
                        'name' => 'Issuance'
                    ],

                    3 => [
                        'id' => 4,
                        'name' => 'PAR Items'
                    ],

                    4 => [
                        'id' => 5,
                        'name' => 'Reports'
                    ],

                    5 => [
                        'id' => 6,
                        'name' => 'Maintenance'
                    ],
                ]
            ],
            [
                'id' => 6,
                'name' => 'Reports Access',
                'permissions' => [
                    0 => [
                        'id' => 1,
                        'name' => 'Issuance Report'
                    ],

                    1 => [
                        'id' => 2,
                        'name' => 'Receiving Stock Report'
                    ],

                    2 => [
                        'id' => 3,
                        'name' => 'Receivables'
                    ],

                    3 => [
                        'id' => 4,
                        'name' => 'Stock Card Report'
                    ],

                    4 => [
                        'id' => 5,
                        'name' => 'Inventory Report'
                    ],

                    5 => [
                        'id' => 6,
                        'name' => 'User Report'
                    ],

                    6 => [
                        'id' => 7,
                        'name' => 'Audit Trail'
                    ],

                    7 => [
                        'id' => 8,
                        'name' => 'Item List Report'
                    ],

                    8 => [
                        'id' => 9,
                        'name' => 'Below Minimum Stock Report'
                    ],

                    9 => [
                        'id' => 10,
                        'name' => 'Fast Moving Items'
                    ],
                ]
            ],
            [
                'id' => 7,
                'name' => 'Maintenance',
                'permissions' => [
                    0 => [
                        'id' => 1,
                        'name' => 'Item Categories'
                    ],

                    1 => [
                        'id' => 2,
                        'name' => 'Item Units'
                    ],

                    2 => [
                        'id' => 3,
                        'name' => 'Suppliers'
                    ],

                    3 => [
                        'id' => 4,
                        'name' => 'Employees'
                    ],

                    4 => [
                        'id' => 5,
                        'name' => 'Divisions'
                    ],

                    5 => [
                        'id' => 6,
                        'name' => 'Sections'
                    ],

                    6 => [
                        'id' => 7,
                        'name' => 'System Users'
                    ],

                    7 => [
                        'id' => 8,
                        'name' => 'System Roles'
                    ],

                    8 => [
                        'id' => 9,
                        'name' => 'Permissions'
                    ],
                ]
            ]
        ];
        
        return view('theme.pages.custom.accounts.permissions.index', compact('page', 'roles', 'role_permissions', 'modules'));
    }

    public function update_permissions(Request $request){

        RolePermission::truncate();

        if($request->module_role_permission){
            foreach($request->module_role_permission as $item) {
                $array = json_decode($item, true);
            
                if (is_array($array) && count($array) === 3) {
                    RolePermission::create([
                        'module_id' => $array[0],
                        'role_id' => $array[1], 
                        'permission_id' => $array[2] ,
                        'user_id' => auth()->user()->id
                    ]);
                }
            }
            return redirect()->back()->with('alert', 'success:Permissions successfully updated');
        }
        else{
            return redirect()->back();
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newData = $request->validate([
            'name' => 'required',
            'module' => 'required',
            'routes' => 'required|array',
            'methods' => 'required|array',
            'description' => 'required',
            'is_view_page' => ''
        ]);

        $newData['is_view_page'] = ($request->has('is_view_page')) ? 1 : 0;
        $newData['user_id'] = auth()->id();

        Permission::create($newData);

        return redirect()->route('permission.index')->with('success', __('standard.account_management.permissions.create_success'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $updateData = $request->validate([
            'name' => 'required',
            'module' => 'required',
            'routes' => 'required|array',
            'methods' => 'required|array',
            'description' => 'required',
            'is_view_page' => ''
        ]);

        $updateData['is_view_page'] = ($request->has('is_view_page')) ? 1 : 0;
        $updateData['user_id'] = auth()->id();

        $permission->update($updateData);

        return redirect()->route('permission.index')->with('success', __('standard.account_management.permissions.update_success'));
    }
}
