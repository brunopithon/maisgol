<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    // Lista todos os grupos
    public function index()
    {
        $groups = Group::all();
        return response()->json($groups, 200);
    }

    // Mostra um grupo específico
    public function show($id)
    {
        $group = Group::find($id);

        if (!$group) {
            return response()->json(['message' => 'Group not found'], 404);
        }

        return response()->json($group, 200);
    }

    // Cria um novo grupo
    public function store(StoreGroupRequest $request)
    {
        $data = $request->validated();

        $group = Group::create($data);

        return response()->json($group, 201);
    }

    // Atualiza um grupo existente
    public function update(UpdateGroupRequest $request, $id)
    {
        $data = $request->validated();

        $group = Group::find($id);

        if (!$group) {
            return response()->json(['message' => 'Group not found'], 404);
        }

        $group->update($data);

        return response()->json($group, 200);
    }

    // Remove um grupo
    public function destroy($id)
    {
        $group = Group::find($id);

        if (!$group) {
            return response()->json(['message' => 'Group not found'], 404);
        }

        $group->delete();

        return response()->json(['message' => 'Group deleted successfully'], 200);
    }
}
