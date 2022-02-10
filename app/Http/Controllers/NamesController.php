<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Name;
use Illuminate\Support\Facades\Validator;

class NamesController extends Controller
{
    /**
     *
     * @return \Illuminate\Database\Eloquent\Collection|Name[]
     */
    public function index()
    {
        return Name::all();
    }

    /**
     *
     * @param Request $request
     * @param Name $name
     * @return \Illuminate\Http\JsonResponse | Name
     */
    public function store(Request $request, Name $name)
    {
        $request->validate([
           'firstname' => 'required|string|max:255|unique:App\Models\Name',
           'lastname' => 'required|string|max:255|unique:App\Models\Name'
        ]);

        $name->firstname = $request->get('firstname');
        $name->lastname = $request->get('lastname');

        if($name->save()) {
            return $name;
        }

        return response()->json(['error ' => 'record not saved']);

    }

    /**
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse | Name
     */
    public function show($id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'id must be a numeric']);
        }

        $record = Name::find($id);

        if (!$record) {
            return response()->json(['error' => 'record not found']);
        }

        return $record;
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse | Name
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|numeric'
        ]);

        $request->validate([
            'firstname' => 'required|string|max:255|unique:App\Models\Name',
            'lastname' => 'required|string|max:255|unique:App\Models\Name'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'id must be a numeric']);
        }

        $record = Name::find($id);

        if ($record) {
            $record->firstname = $request->get('firstname');
            $record->lastname = $request->get('lastname');

            if ($record->update()) {
                return $record;
            }
        } else {
            return response()->json(['error' => 'record not found']);
        }

        return response()->json(['error' => 'record not updated']);

    }

    /**
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'id must be a numeric']);
        }

        $record = Name::find($id);

        if ($record) {
            if ($record->delete()) {
                return response()->json(['error' => 'record deleted']);
            }
        } else {
            return response()->json(['error' => 'record not found']);
        }
    }
}
