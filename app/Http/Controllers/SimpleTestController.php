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
        // Test dengan validasi 'file' saja
        try {
            $validated = $request->validate([
                'test_file' => 'required|file|max:51200'
            ]);

            $file = $request->file('test_file');
            return response()->json([
                'success' => true,
                'message' => 'File berhasil di-validasi (file rule)',
                'file_name' => $file->getClientOriginalName(),
                'file_size' => $file->getSize(),
                'file_mime' => $file->getMimeType(),
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        }
    }
}