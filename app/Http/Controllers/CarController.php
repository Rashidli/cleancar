<?php

namespace App\Http\Controllers;

use App\Http\Resources\CarResource;
use App\Http\Resources\UserResource;
use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;

class CarController extends Controller
{

    public function index()
    {
        try {
            $cars = Car::with('ban')->where('user_id', auth()->user()->id)->get();
            return response()->json([
                'success' => true,
                'data' => ['cars' => CarResource::collection($cars)],
                'message' => 'Cars fetched successfully.',
                'errors' => null,
            ]);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'ban_id' => 'required',
                'car_model' => 'required',
                'car_number' => 'required',
            ]);

            $car = new Car();
            $car->user_id = auth()->user()->id;
            $car->ban_id = $request->ban_id;
            $car->car_model = $request->car_model;
            $car->car_number = $request->car_number;
            $car->save();

            $new_car = new CarResource($car);

            return response()->json([
                'success' => true,
                'data' => ['car' => $new_car],
                'message' => 'Car created successfully.',
                'errors' => null,
            ], 201);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function show(Car $car)
    {
        try {
            return response()->json([
                'success' => true,
                'data' => ['car' => new CarResource($car)],
                'message' => 'Car fetched successfully.',
                'errors' => null,
            ]);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function edit(Car $car)
    {
        try {
            return response()->json([
                'success' => true,
                'data' => ['car' => new CarResource($car)],
                'message' => 'Car fetched for editing successfully.',
                'errors' => null,
            ]);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function update(Request $request, Car $car)
    {
        try {
            $car->ban_id = $request->ban_id;
            $car->car_model = $request->car_model;
            $car->car_number = $request->car_number;
            $car->save();

            $new_car = new CarResource($car);

            return response()->json([
                'success' => true,
                'data' => ['car' => $new_car],
                'message' => 'Car updated successfully.',
                'errors' => null,
            ]);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function destroy(Car $car)
    {
        try {
            $car->delete();
            return response()->json([
                'success' => true,
                'data' => null,
                'message' => 'Car deleted successfully.',
                'errors' => null,
            ]);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    private function errorResponse(\Exception $e)
    {
        $statusCode = $this->getStatusCodeFromException($e);

        return response()->json([
            'success' => false,
            'data' => null,
            'message' => $e->getMessage(),
            'errors' => ['code' => $statusCode, 'message' => $e->getMessage()],
        ], $statusCode);
    }

    private function getStatusCodeFromException(\Exception $e)
    {
        return method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500;
    }


}
