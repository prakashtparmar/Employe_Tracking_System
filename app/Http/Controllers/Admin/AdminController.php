<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AdminsRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Admin\LoginRequest;
use App\Http\Requests\Admin\PasswordRequest;
use App\Http\Requests\Admin\DetailRequest;
use App\Http\Requests\Admin\SubadminRequest;
use App\Services\Admin\AdminService;


class AdminController extends Controller
{
    protected $adminService;

    // Inject AdminService using Constructor
    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        Session::put('page', 'dashboard');
        return view('admin.dashboard');
    }

    /**
     * Show the login form.
     */
    public function create()
    {
        return view('admin.login');
    }

    /**
     * Handle admin login.
     * @param \Illuminate\Http\Request $request
     */

    public function store(LoginRequest $request) {
    $data = $request->all();
    $loginStatus = $this->adminService->login($data);

    if ($loginStatus == "success") {
        return redirect()->route('dashboard.index');
    } elseif ($loginStatus == "inactive") {
        return redirect()->back()->with('error_message', 'Your account is inactive. Please contact the administrator.');
    } else {
        return redirect()->back()->with('error_message', 'Invalid Email or Password!');
    }
    }

    /**
     * Show the update password form.
     */
    public function edit(Admin $admin)
    {
        Session::put('page', 'update-password');
        return view('admin.update_password');
    }

    /**
     * Logout the admin.
     */
    public function destroy(Admin $admin)
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    /**
     * AJAX: Verify the current password.
     */
    public function verifyPassword(Request $request)
    {
        $data = $request->all();
        return $this->adminService->verifyPassword($data);
    }

    /**
     * Handle password update request.
     * @param \Illuminate\Http\Request $request
     */
    public function updatePasswordRequest(PasswordRequest $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->input();
            $pwdStatus = $this->adminService->updatePassword($data);

            if ($pwdStatus['status'] == "success") {
                return redirect()->back()->with('success_message', $pwdStatus['message']);
            } else {
                return redirect()->back()->with('error_message', $pwdStatus['message']);
            }
        }
    }

    public function editDetails(){
        Session::put('page','update-details');
        return view('admin.update_details');
    }
    /**
     * @param \Illuminate\Http\Request $request
    */ 
    public function updateDetails(DetailRequest $request){
        Session::put('page', 'update-details');
        if($request->isMethod('post')){
            $this->adminService->updateDetails($request);
            return redirect()->back()->with('success_message', 'Admin Details have been updated successfully!');
        }
    }

    public function deleteProfileImage(Request $request)
    {
        $status = $this->adminService->deleteProfileImage($request->admin_id);
        return response()->json($status);
    }

    public function subadmins()
    {
        Session::put('page', 'subadmins');
        $subadmins = $this->adminService->subadmins();
        return view('admin.subadmins.subadmins')->with(compact('subadmins'));
    }

    public function updateSubadminStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();

            // Call the service method to update status
            $status = $this->adminService->updateSubadminStatus($data);

            // Return JSON response
            return response()->json([
                'status'      => $status,
                'subadmin_id' => $data['subadmin_id']
            ]);
        }
    }

    public function deleteSubadmin($id)
    {
        $result = $this->adminService->deleteSubadmin($id);
        return redirect()->back()->with('success_message', $result['message']);
    }


    public function addEditSubadmin($id = null) {
    if ($id == "") {
        $title = "Add Subadmin";
        $subadmindata = array();
    } else {
        $title = "Edit Subadmin";
        $subadmindata = Admin::find($id);
    }
    return view('admin.subadmins.add_edit_subadmin')->with(compact('title', 'subadmindata'));
    }





    public function addEditSubadminRequest(SubadminRequest $request)
    {
        if ($request->isMethod('post')) {
            $result = $this->adminService->addEditSubadmin($request);
            return redirect('admin/subadmins')->with('success_message', $result['message']);
        }
    }

    public function updateRole($id) {
        $subadminRoles = AdminsRole::where('subadmin_id', $id)->get()->toArray();
        $subadminDetails = Admin::where('id', $id)->first()->toArray();
        $modules = ['categories', 'products', 'order', 'users'];
        $title = "Update " . $subadminDetails['name'] . " Subadmin Roles/Permissions";
        return view('admin.subadmins.update_roles')->with(compact('title', 'id', 'subadminRoles', 'modules'));
    }

    public function updateRoleRequest(Request $request) {
    if ($request->isMethod('post')) {
        $data = $request->all();
        $service = new AdminService();
        $result = $service->updateRole($request);
        return redirect()->back()->with('success_message', $result['message']);
    }
}




    
    // The following methods are unused or incomplete:
    public function show(Admin $admin) { /* Not used */ }

    public function update(Request $request, Admin $admin) { /* Not used */ }
}
