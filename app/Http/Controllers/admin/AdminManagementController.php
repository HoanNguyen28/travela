<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\AdminModel;
use Illuminate\Http\Request;

class AdminManagementController extends Controller
{
    private $admin;

    public function __construct()
    {
        $this->admin = new AdminModel();
    }
    public function index()
    {
        $title = 'Quản lý Admin';

        $admin = $this->admin->getAdmin();

        return view('admin.profile-admin', compact('title', 'admin'));
    }

    public function updateAdmin(Request $request)
    {
        $fullName = $request->fullName;
        $password = $request->password;
        $email = $request->email;
        $address = $request->address;

        $admin = $this->admin->getAdmin();
        $oldPass = $admin->password;

        if ($password != $oldPass) {
            $password = md5($password);
        }
        

        $dataUpdate = [
            'fullName' => $fullName,
            'password' => $password,
            'email' => $email,
            'address' => $address
        ];
        $update = $this->admin->updateAdmin($dataUpdate);
        $newinfo = $this->admin->getAdmin();
        if ($update) {
            return response()->json(
                [
                    'success' => true,
                    'data' => $newinfo
                ]
            );
        } else {
            return response()->json(['success' => false, 'message' => 'Không có thông tin nào thay đổi!']);
        }
    }

    public function updateAvatar(Request $req)
{
    if (!$req->hasFile('avatarAdmin')) {
        return response()->json(['error' => true, 'message' => 'Không có file được gửi lên!']);
    }

    $avatar = $req->file('avatarAdmin');
    if (!$avatar->isValid()) {
        return response()->json(['error' => true, 'message' => 'File không hợp lệ!']);
    }

    $filePath = public_path('admin/assets/images/user-profile/avt_admin.jpg');
    if (file_exists($filePath)) {
        unlink($filePath);
    }

    $avatar->move(public_path('admin/assets/images/user-profile'), 'avt_admin.jpg');

    return response()->json(['success' => true, 'message' => 'Cập nhật ảnh thành công!']);
}

}
