<?php

namespace App\Providers;
use File;

class Action {

    /**
     * All reusable actions (GET,POST).
     * 
     * @return json
     * 
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
            return response()->json('Deleted Unsuccessfuly', 404);
        }
        return response()->json('Deleted Successfuly', 200);

    }

    /**
     * Delete With Image.
     */
    public function deleteWithImage($model,$id,$column) {

        $modelImage = $model::find($id);
        if($modelImage) {
            File::delete(public_path("images/" . $modelImage->$column)); 
            $modelImage->delete();
        } else {
            return response()->json('Deleted Unsuccessfuly', 404);
        }
        return response()->json('Deleted Successfuly', 200);
    }
}