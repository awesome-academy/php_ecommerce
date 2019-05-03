<?php

namespace App\Traits;

trait Statusable
{
    public function getStatusAttribute()
    {
        if ($this->attributes['status'] == 0) {
            $arr = $this->returnStatusData('badge-info', trans('common.text.profile_page.status.pending'));

            return $arr;
        } elseif ($this->attributes['status'] == 1) {
            $arr = $this->returnStatusData('badge-success', trans('common.text.profile_page.status.accepted'));

            return $arr;
        } else {
            $arr = $this->returnStatusData('badge-danger', trans('common.text.profile_page.status.rejected'));

            return $arr;
        }
    }

    public function returnStatusData($class, $lang)
    {
        return [
            'class' => $class,
            'lang' => $lang,
        ];
    }
}
