<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class RestaurantController extends Controller
{
    private const RULES = [
        'name'      => 'required|string|min:3|max:50',
        'note'      => 'required|string|min:3|max:50',
    ];

    public function store(Request $request): JsonResponse
    {
        $this->validate($request, self::RULES);

        $result = Restaurant::create([
            'name' => $request->input('name'),
            'note' => $request->input('note'),
            'results' => 0
        ]);

        return response()->json($result, 201);
    }

    public function all(): JsonResponse
    {
        return response()->json(Restaurant::all());
    }

    public function get($id): JsonResponse
    {
        return response()->json(Restaurant::find($id));
    }

    public function update(Request $request, $id): JsonResponse
    {
        $this->validate($request, self::RULES);

        $restaurant = Restaurant::findOrFail($id);
        $restaurant->update([
            'name' => $request->input('name'),
            'note' => $request->input('note'),
        ]);

        return response()->json($restaurant, 200);
    }


    public function delete($id): JsonResponse
    {
        Restaurant::findOrFail($id)->delete();
        return response()->json('deleted', 200);
    }

    public function random()
    {
        $restaurant = Restaurant::inRandomOrder()->first();
        $restaurant->increment('results');

        return response()->json($restaurant, 200);
    }
}
