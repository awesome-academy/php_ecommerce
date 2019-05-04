<?php

namespace App\Traits;

trait Statusable
{
    public function getStatusAttribute()
    {
        if ($this->attributes['status'] == 0) {
            $arr = $this->returnStatusData('badge-info', trans('common.text.profile_page.status.pending'), 0);

            return $arr;
        } elseif ($this->attributes['status'] == 1) {
            $arr = $this->returnStatusData('badge-success', trans('common.text.profile_page.status.accepted'), 1);

            return $arr;
        } else {
            $arr = $this->returnStatusData('badge-danger', trans('common.text.profile_page.status.rejected'), -1);

            return $arr;
        }
    }

    public function returnStatusData($class, $lang, $status)
    {
        return [
            'class' => $class,
            'lang' => $lang,
            'status' => $status,
        ];
    }
}
