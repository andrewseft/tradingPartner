<?php

namespace App\Manager;

use App\Constants\Constant;
use App\Manager\UploadManager;
use App\User;
use Carbon\Carbon;

class UserManager
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(UploadManager $upload , User $user)
    {
        $this->guard = Constant::GUARD;
        $this->upload = $upload;
        $this->user = $user;
    }

    /**
     * @return User
     */
    public function user()
    {
        return $this->user;
    }

    /**
     * @return User
     */
    public function getUserCount($roleId,$request)
    {
        if ($request->query('created_at_from') && $request->query('created_at_to')) {
            $from_date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_from'))->format('Y-m-d').' 00:00:00';
            $end_date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_to'))->format('Y-m-d').' 23:59:59';
            return $this->user->where('role_id',$roleId)->whereBetween('created_at', array($from_date, $end_date))->count();
        } else if ($request->query('created_at_from')) {
            $date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_from'))->format('Y-m-d').' 00:00:00';
            return $this->user->where('role_id',$roleId)->whereDate('created_at', '=', $date)->count();
        } else if ($request->query('created_at_to')) {
            $date = Carbon::createFromFormat('Y-m-d', $request->query('created_at_to'))->format('Y-m-d').' 00:00:00';
            return $this->user->where('role_id',$roleId)->whereDate('created_at', '=', $date)->count();
        }
        return $this->user->where('role_id',$roleId)->count();
    }


    /**
     * Update user Profile
     *
     * @param $user
     * @param $request
     */
    public function updateProfile($user, $request)
    {
        if ($request->hasFile('image')) {
            $user->image = $this->upload->image($request->file('image'), $request->old_image, Constant::USER_IMAGE, Constant::USER_IMAGE_THUMB, Constant::USER_IMAGE_HEIGHT, Constant::USER_IMAGE_WIDTH, true);
        }
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->email = $request->get('email');
        $user->address = $request->get('address');
        $user->latitude = $request->get('latitude');
        $user->longitude = $request->get('longitude');
        $user->number = $request->get('number');
         

        $user->save();
    }


}
