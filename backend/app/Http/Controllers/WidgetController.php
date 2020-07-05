<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Widget;
use Exception;

class WidgetController extends Controller
{
    public function index()
    {
        return response()->json([
            'widgets' => Widget::all()
        ], 200);
    }

    public function show(Widget $widget)
    {
        return response()->json([
            'widget' => $widget
        ], 200);
    }

    public function create()
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required|max:20',
            'description' => 'max:100'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => trans('widgets.failed.validation'),
                'errors' => $validator->errors()
            ], 400);
        }

        Widget::create(request()->all());

        return response()->json([
            'message' => trans('widgets.success.create')
        ], 201);
    }

    public function update(Widget $widget)
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required|max:20',
            'description' => 'max:100'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => trans('widgets.failed.validation'),
                'errors' => $validator->errors()
            ], 400);
        }

        $widget->update(request()->all());

        return response()->json([
            'message' => trans('widgets.success.update')
        ], 200);
    }

    public function delete(Widget $widget)
    {
        try {
            $widget->delete();
        } catch (Exception $exception) {
            return response()->json([
                'message' => trans('widgets.failed.delete')
            ], 200);
        }
        return response()->json([
            'message' => trans('widgets.success.delete')
        ], 200);
    }
}
