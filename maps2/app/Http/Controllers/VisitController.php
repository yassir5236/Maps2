<?php

// app/Http/Controllers/VisitController.php

namespace App\Http\Controllers;

use App\Models\Visit;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    public function index()
    {
        return Visit::all();
    }

    public function store(Request $request)
    {
        return Visit::create($request->all());
    }

    public function show($id)
    {
        return Visit::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $visit = Visit::findOrFail($id);
        $visit->update($request->all());
        return $visit;
    }

    public function destroy($id)
    {
        $visit = Visit::findOrFail($id);
        $visit->delete();
        return response()->json(['message' => 'Visit deleted successfully']);
    }
}
