<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SimpleTestController extends Controller
{
    public function testForm()
    {
        return view('test-form');
    }

    public function testStore(Request $request)
    {
        // Test 1: Tanpa validasi sama sekali
        if ($request->hasFile('test_file')) {
            $file = $request->file('test_file');
            return response()->json([
                'success' => true,
                'message' => 'File diterima tanpa validasi',
                'file_name' => $file->getClientOriginalName(),
                'file_size' => $file->getSize(),
                'file_mime' => $file->getMimeType(),
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Tidak ada file'
        ], 422);
    }
}