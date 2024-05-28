<?php

namespace App\Http\Controllers;

use App\DataTables\PeranHakAksesDataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PeranHakAksesController extends Controller
{
    private $permissions = "roles.web";

    /**
     * Display a listing of the resource.
     */
    public function index(PeranHakAksesDataTable $dataTable)
    {
        confirmAuthorization($this->permissions, 'index');
        $permissionModule = Permission::all();
        // split string by dot
        $permissionModule = $permissionModule->map(function ($item) {
            $item = explode('.', $item->name)[0];
            return $item;
        });
        return $dataTable->render('pages.setelan.peran-hak-akses.index', [
            'title' => 'Peran dan Hak Akses',
            "permission" => Permission::all(),
            "modules" => $permissionModule->unique(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        confirmAuthorization($this->permissions, 'store');
        $request->validate([
            "addName" => "required|string",
            "addPermissions" => "array"
        ]);

        DB::beginTransaction();
        try {
            $role = Role::create([
                "name" => $request->addName
            ]);
            $role->syncPermissions($request->addPermissions);
            DB::commit();
            return redirect()->route('setelan.peran-hak-akses.index')->with('success', 'Peran berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('setelan.peran-hak-akses.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        confirmAuthorization($this->permissions, 'show');
        $role = Role::findById($id);
        $role = $role->load('permissions');
        return response()->json($role);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $role = Role::findById($id);
        confirmAuthorization($this->permissions, 'update');
        $request->validate([
            "editName" => "required|string|unique:roles,name," . $role->id,
            "editPermissions" => "array"
        ]);

        DB::beginTransaction();
        try {
            $role->update([
                "name" => $request->editName
            ]);
            $role->syncPermissions($request->editPermissions);
            DB::commit();
            return redirect()->route('setelan.peran-hak-akses.index')->with('success', 'Peran berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('setelan.peran-hak-akses.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        confirmAuthorization($this->permissions, 'destroy');
        DB::beginTransaction();
        try {
            $role->delete();
            DB::commit();
            return redirect()->route('setelan.peran-hak-akses.index')->with('success', 'Peran berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('setelan.peran-hak-akses.index')->with('error', $e->getMessage());
        }
    }
}
