<?php

namespace App\Http\Controllers;

use App\DataTables\PenggunaDataTable;
use App\Models\Fakultas;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class PenggunaController extends Controller
{
    private $permissions = "users.web";
    /**
     * Display a listing of the resource.
     */
    public function index(PenggunaDataTable $penggunaDataTable)
    {
        confirmAuthorization($this->permissions, "index");
        return $penggunaDataTable->render('pages.master-data.pengguna.index', [
            "title" => "Pengguna"
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        confirmAuthorization($this->permissions, "create");
        return view('pages.master-data.pengguna.create', [
            "title" => "Tambah Pengguna",
            "roles" => Role::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        confirmAuthorization($this->permissions, "store");
        $request->validate([
            "name" => "required|unique:users,name",
            "email" => "required|email|unique:users,email",
            "password" => "required|min:8",
            "role" => "required|exists:roles,name",
            "nama_fakultas" => "nullable|unique:fakultas,nama"
        ]);
        DB::beginTransaction();
        try {
            if ($request->role === "Fakultas" && !$request->filled("nama_fakultas")) {
                DB::rollBack();
                return redirect()->back()->with("error", "Nama fakultas wajib diisi");
            }
            $user = User::create([
                "name" => $request->name,
                "email" => $request->email,
                "password" => bcrypt($request->password)
            ]);
            $user->assignRole($request->role);
            Fakultas::create([
                "nama" => $request->nama_fakultas,
                "user_id" => $user->id,
                "visi" => json_encode([]),
                "misi" => json_encode([]),
                "kelompok_diferensiasi" => json_encode([])
            ]);
            DB::commit();
            return redirect()->route("master-data.pengguna.index")->with("success", "Pengguna berhasil ditambahkan");
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with("error", $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        confirmAuthorization($this->permissions, "edit");
        return view("pages.master-data.pengguna.edit", [
            "title" => "Edit Pengguna",
            "user" => $user->load("Fakultas"),
            "roles" => Role::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        confirmAuthorization($this->permissions, "update");
        $request->validate([
            "name" => "required|unique:users,name," . $user->id,
            "email" => "required|email|unique:users,email," . $user->id,
            "password" => "nullable|min:8",
            "role" => "required|exists:roles,name",
            "nama_fakultas" => "nullable|unique:fakultas,nama," . $user->Fakultas->id ?? ""
        ]);
        DB::beginTransaction();
        try {
            if ($request->password) {
                $user->update([
                    "password" => bcrypt($request->password)
                ]);
            }

            if ($request->role === "Fakultas" && !$request->filled("nama_fakultas")) {
                return redirect()->back()->with("error", "Nama fakultas wajib diisi");
            }

            if ($request->role !== "Fakultas" && $user->Fakultas) {
                $user->Fakultas->delete();
            }

            if ($request->role === "Fakultas" && $user->Fakultas) {
                $user->Fakultas->update([
                    "nama" => $request->nama_fakultas
                ]);
            } else if ($request->role === "Fakultas" && !$user->Fakultas) {
                Fakultas::create([
                    "nama" => $request->nama_fakultas,
                    "user_id" => $user->id,
                    "visi" => json_encode([]),
                    "misi" => json_encode([]),
                    "kelompok_diferensiasi" => json_encode([])
                ]);
            }

            $user->update([
                "name" => $request->name,
                "email" => $request->email
            ]);

            $user->syncRoles([$request->role]);
            DB::commit();
            return redirect()->route("master-data.pengguna.index")->with("success", "Pengguna berhasil diperbarui");
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with("error", $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        confirmAuthorization($this->permissions, "destroy");
        DB::beginTransaction();
        try {
            $user->delete();
            DB::commit();
            return redirect()->back()->with("success", "Pengguna berhasil dihapus");
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with("error", $e->getMessage());
        }
    }
}
