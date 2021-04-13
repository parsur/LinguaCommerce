<?php

namespace App\Providers;

class SuccessMessages {
    /**
     * Success Messages
     * 
     * @return void
    */

    // Insert Message
    public function getInsert() {
        return '<div class="alert alert-success">اطلاعات با موفقیت ثبت شد</div>';
    }

    // Update Message
    public function getUpdate() {
        return '<div class="alert alert-success">اطلاعات با موفقیت ویرایش شد</div>';
    }
    
}

?>