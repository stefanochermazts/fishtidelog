<?php

namespace App\Http\Controllers;

use App\Models\Instruction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class InstructionController extends Controller
{
    /**
     * Display the public instructions page
     */
    public function index()
    {
        $instructions = Instruction::active()->ordered()->get();
        
        return view('instructions.index', compact('instructions'));
    }

    /**
     * Show the admin instructions management
     */
    public function admin()
    {
        $instructions = Instruction::ordered()->get();
        
        return view('admin.instructions.index', compact('instructions'));
    }

    /**
     * Show the form for editing an instruction
     */
    public function edit(Instruction $instruction)
    {
        return view('admin.instructions.edit', compact('instruction'));
    }

    /**
     * Update the specified instruction
     */
    public function update(Request $request, Instruction $instruction)
    {
        $request->validate([
            'title_it' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'title_de' => 'required|string|max:255',
            'title_fr' => 'required|string|max:255',
            'content_it' => 'required|string',
            'content_en' => 'required|string',
            'content_de' => 'required|string',
            'content_fr' => 'required|string',
            'is_active' => 'boolean',
            'order' => 'integer|min:0',
        ]);

        $instruction->update([
            'title' => [
                'it' => $request->title_it,
                'en' => $request->title_en,
                'de' => $request->title_de,
                'fr' => $request->title_fr,
            ],
            'content' => [
                'it' => $request->content_it,
                'en' => $request->content_en,
                'de' => $request->content_de,
                'fr' => $request->content_fr,
            ],
            'is_active' => $request->has('is_active'),
            'order' => $request->order ?? $instruction->order,
        ]);

        return redirect()
            ->route('admin.instructions.index')
            ->with('success', __('messages.instruction_updated'));
    }

    /**
     * Handle image upload for WYSIWYG editor
     */
    public function uploadImage(Request $request)
    {
        $request->validate([
            'upload' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        try {
            $file = $request->file('upload');
            $filename = time() . '_' . $file->getClientOriginalName();
            
            // Optimize and resize image
            $image = Image::make($file);
            
            // Resize if too large (max 1200px width)
            if ($image->width() > 1200) {
                $image->resize(1200, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
            }
            
            // Save optimized image
            $path = 'instructions/' . $filename;
            Storage::disk('public')->put($path, $image->encode('jpg', 85));
            
            $url = Storage::disk('public')->url($path);
            
            return response()->json([
                'uploaded' => true,
                'url' => $url
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'uploaded' => false,
                'error' => [
                    'message' => 'Upload failed: ' . $e->getMessage()
                ]
            ], 400);
        }
    }
}
