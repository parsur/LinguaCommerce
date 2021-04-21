<?php

namespace App\Providers;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Media;
use File;

class Action {

    /**
     * All reusable actions (GET,POST).
     * @return Json
     */

    /**
     * Edit
     */
    public function edit($model,$id) {
        try{
            $values = $model::find($id);
            return response()->json($values);

        } catch(Throwable $e) {
            return response()->json($e);
        }
    }

    /**
     * Edit with status.
     */
    public function editWithStatus($model,$id) {

        $values = $model::where('id', $id)->with('statuses:status_id,status')->first();
        return response()->json($values);
    }
    
    /**
     * Delete
     */
    public function delete($model, $id) {
        // Why did not try catch work?
        $values = $model::find($id);
        if ($values) {
            $values->delete();
        } else {
            return $this->responseWithError();
        }
        return $this->responseWithSuccess();

    }

    /**
     * Delete With Image.
     */
    public function deleteWithImage($model, $id ,$column) {

        $modelImage = $model::find($id);
        if($modelImage) {
            File::delete(public_path("images/" . $modelImage->$column)); 
            $modelImage->delete();
        } else {
            return $this->responseWithError();
        }
        return $this->responseWithSuccess();
    }
    
    // Add Image
    public function image($imageUploader, $request, $media_id, $type) {
        // Update
        if(!$imageUploader) {
            // Insert
            $imageUploader = new Media();
        }
        $imageUploader->media_id = $media_id;
        $imageUploader->media_type = $type;
        // 0 = image
        $imageUploader->type = Media::IMAGE;

        if($request->hasFile('images')) {
            foreach($request->file('images') as $image) {
                // File
                $file = $image->getClientOriginalName();

                if(isset($file)) {
                    File::delete(public_path("images/$imageUploader->url")); 
                    $image->move(public_path('images'), $file);
                    $imageUploader->url = $file;
                }
            }
        }

        $imageUploader->save();
    }

    // Response with error
    public function responseWithError() {
        return response()->json(['error' => 'ٔداده ای یافت نشد'], Response::HTTP_NOT_FOUND);
    }

    // Response with success
    public function responseWithSuccess() {
        return response()->json(['success' => 'با موفقیت حذف شد'], Response::HTTP_OK);
    }
}