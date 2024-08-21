<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\FormSubmission;
use App\Models\RoleMembership;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;
use Illuminate\Support\Facades\File;
use Exception;
use Yajra\DataTables\DataTables;

class MasterUsersController extends Controller
{
    public function index()
    {
        $departments = Department::where('status', 'Active')->orderBy('department_name')->get();
        return view('admin.sipa.users.index')
            ->with(compact('departments'));
    }

    public function getByDepartmentId(Request $request, $departmentId)
    {
        if ($request->ajax()) {
            $data = DB::table('users as u')
                ->leftJoin('role_memberships as rm', 'rm.id', '=', 'u.role_id')
                ->leftJoin(DB::raw('(SELECT SUBSTRING_INDEX(GROUP_CONCAT(id ORDER BY created_at DESC), \',\', 1) AS id, user_id FROM form_submissions GROUP BY user_id) fss'), 'u.id', '=', 'fss.user_id')
                ->leftJoin('form_submissions as fs', 'fss.id', '=', 'fs.id')
                ->leftJoin('departments as d', 'u.department_id', '=', 'd.id')
                ->leftJoin('study_programs as sp', 'u.study_program_id', '=', 'sp.id')
                ->select(
                    'u.id',
                    'u.img_url',
                    DB::raw('CONCAT(u.first_name, " ", u.last_name) AS full_name'),
                    'u.npm as npm',
                    'u.email',
                    'u.gender',
                    'd.department_name',
                    'sp.study_program_name',
                    'rm.name as role_name',
                    'u.role_id'
                )->orderBy('full_name', 'asc');

            if ($departmentId != 0) {
                $data->where('d.id', $departmentId);
            }

            $data = $data->get();

            return FacadesDataTables::of($data)->addIndexColumn()
                ->addColumn('role_name', function ($row) {
                    return $row->role_name;
                })
                ->addColumn('status', function ($row) {
                    $badgeClass = $row->role_name === 'Admin' ? 'primary' : 'info';
                    $badge = '<span class="badge bg-label-' . $badgeClass . '">'
                        . $row->role_name . '</span>';
                    return $badge;
                })
                ->addColumn('avatar', function ($row) {
                    $image =  isset($row->img_url) ? asset($row->img_url) : asset("file/avatars/blank-profile.png");
                    return '<ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                    <li
                      data-bs-toggle="tooltip"
                      data-popup="tooltip-custom"
                      data-bs-placement="top"
                      class="avatar avatar-xs pull-up"
                      title="' . $row->full_name . '">
                      <img src="' . $image . '" alt="Avatar" onerror="handleImageError(this)" class="rounded-circle" />
                    </li>
                    <li>' . $row->full_name . '</li>
                  </ul>';
                })
                ->addColumn('action', function ($row) {
                    if ($row->id == auth()->user()->id) {
                        return null;
                    }
                    if (auth()->user()->role_id == 1 && auth()->user()->id == 'administrator') {
                        $url = route('masteruser.changeRole', ['id' => $row->id, 'roleId' => ($row->role_id == 1 ? 2 : 1)]);
                        $urlDelete = route('masteruser.destroy', $row->id);
                        $changeRole = $row->role_id == 1 ? 'User' : 'Admin';

                        $dropdown = '<div class="dropdown">
                                    <button class="btn btn-link text-danger p-0 dropdown-toggle hide-arrow" type="button" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <form method="POST" action="' . $url . '" class="dropdown-item">
                                            ' . csrf_field() . '
                                            ' . method_field('PUT') . '
                                            <button type="submit" class="btn btn-link">
                                                <i class="bx bxs-show me-1"></i> Change Role to ' . $changeRole . '
                                            </button>
                                        </form>
                                        <form method="POST" action="' . $urlDelete . '" class="dropdown-item">
                                            ' . csrf_field() . '
                                            ' . method_field('DELETE') . '
                                            <button type="submit" class="btn btn-link text-danger swalSuccesDeleteUser">
                                                <i class="tf-icons bx bx-trash me-1"></i> Delete User
                                            </button>
                                        </form>
                                    </div>
                                </div>';

                        return $dropdown;
                    };
                })

                ->rawColumns(['status', 'avatar', 'action'])
                // ->filter(function ($query) use ($request) {
                //     // Lakukan filter hanya jika ada input pencarian
                //     if ($request->has('search') && !empty($request->input('search')['value'])) {
                //         $searchValue = $request->input('search')['value'];
                //         // Lakukan filter pada kolom yang ingin Anda filter
                //         $query->where(function ($query) use ($searchValue) {
                //             $query->where('role_name', 'like', "%{$searchValue}%")
                //                 ->orWhere('email', 'like', "%{$searchValue}%");
                //             // Tambahkan filter untuk kolom lain jika diperlukan
                //         });
                //     }
                // })
                // ->orderColumn('status', 'confirmed_date $1')
                ->make(true);
        }

        return view('admin.sipa.users.index');
    }


    public function changeRole(Request $request, $id, $role_id)
    {
        RoleMembership::find($role_id);
        $user = User::find($id);
        $user->update([
            'role_id' => $role_id,
            'updated_by' => auth()->user()->id,
        ]);
        return redirect()->route('masteruser.index')->with('success', 'Change role successfully.');
    }

    public function destroy($id)
    {
        try {
            $periodes = DB::table('form_submissions as fs')
                ->select(DB::raw("DATE_FORMAT(fs.created_at, '%Y-%m') AS periode"))
                ->where('fs.user_id', '=', $id)
                ->groupBy(DB::raw("DATE_FORMAT(fs.created_at, '%Y-%m')"))
                ->get();

            foreach ($periodes as $p) {
                $folderName = str_replace('-', '', $p->periode);
                $publicPath = 'file/pengajuan-surat/' . $folderName . '/' . $id;
                if (File::exists($publicPath)) {
                    File::deleteDirectory($publicPath);
                }
            }

            DB::table('form_submissions')
                ->whereRaw("user_id = ?", $id)
                ->delete();

            $user = User::find($id);
            if ($user->img_url) {
                File::delete($user->img_url);
            }
            $user->delete();

            return redirect()->route('masteruser.index')->with('success', 'Delete all data ' . $user->first_name . ' successfully.');
        } catch (Exception $e) {
            return redirect()->route('masteruser.index')->with('error', $e->getMessage());
        }
    }
}
