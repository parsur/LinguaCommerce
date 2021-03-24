<?php

namespace App\Providers;
use App\Models\Cart;
use App\Models\Order;

class CourseArticleAction {

    /**
     * Action of course and article. (GET,POST)
     * 
     * @return json 
     */
    
    // Details
    public function details($id, $model, $name, $role) {

        $vars["$name"] =$model::where('id', $id)->with('statuses:status_id,status',
            'description:description_id,description','category:id,name','subCategory:id,name', 'media:media_id,url');

        if($role != 'admin')
            return response()->json($vars);

        return view("$name.details", $vars);
    }


    // Edit
    public function edit($model, $id) {
        $values = $model::where('id', $id)->with('statuses:status_id,status',
            'description:description_id,description','category:id,name','subCategory:id,name')->first();

        return response()->json($values);
    }

}