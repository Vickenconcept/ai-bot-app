<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductTransactions;
use App\Models\User;
use App\Notifications\NewUserNotification;
use App\Notifications\RefundUserNotification;
use App\Notifications\UpdateUserRoleNotification;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;


class WarriorPlusWebhookController extends Controller
{
    public function WPlus(Request $request)
    {
        $data = $request->all();
        Log::debug(json_encode($data));

        if (isset($data['WP_SECURITYKEY']) && $data['WP_SECURITYKEY'] === 'a8b1bdde78eda7d3b1c9011a9208c70') {
            if(!$data['WP_ITEM_NUMBER'] || !$data['WP_BUYER_EMAIL'] || !$data['WP_BUYER_NAME'] || !$data['WP_TXNID'] || !$data['WP_ACTION']) 
            {
                return response(['message' => 'Incorrect fields!'], 422);
            }

            $d = [
                'PRODUCT_ID'     => $data['WP_ITEM_NUMBER'],
                'EMAIL' => $data['WP_BUYER_EMAIL'],
                'customerName'  => $data['WP_BUYER_NAME'],
                'TRANSACTION_ID' => $data['WP_TXNID'],
                'transactionType' => $data['WP_ACTION']
            ];

            switch ($d['transactionType']) {
                case 'sale':
                    $response = $this->createUser($d);
                    break;
                case 'refund':
                    $response = $this->detachUser($d);
                    break;
            }
            return response(['message' => $response]);
        }
        return response(['message' => 'Verification Failed!'], 422);
    }

    private function createUser($data)
    {
        $role = Product::where('product_id', $data['PRODUCT_ID'])->first();

        // confirm product_id exist
        if (!$role) {

            throw new Exception("Product Validation Failed!", 1);
        }

        $email = $data['EMAIL'];
        $password = false;
        $user = User::where('email', $email)->first();
        // $userId;

        // if user do not exist create user
        if (!$user) {
            // check deleted user
            $deletedUser = User::select('email')
                ->where('email', $email)
                ->onlyTrashed()
                ->first();
            $password = Str::random(10);
            // $userModel;
            // $username;

            if ($deletedUser) {
                User::where('email', $email)
                    ->onlyTrashed()
                    ->update([
                        'deleted_at' => null,
                        'created_at' => Carbon::now(),
                        'active_status' => 1,
                        'password' => Hash::make($password),
                    ]);
                $oldUser = User::where('email', $email)->first();
                $oldUser->assignRole($role->funnel);
                $userModel =  $oldUser;
                $username = $oldUser->name;
                $userId = $oldUser->id;
            } else {
                $newUser = User::create([
                    'name'      => substr($email, 0, strpos($email, '@')),
                    'email'     => $email,
                    'password'  => Hash::make($password),
                    'username' => substr($email, 0, strpos($email, '@')) . Str::random(3),
                    'role' => 'user',
                    'referrer_id' => null,
                ]);

                $newUser->assignRole($role->funnel);
                $userModel = $newUser;
                $username = $newUser->name;
                $userId = $newUser->id;
            }

            $userInfo = [
                'username' => $username,
                'email' => $email,
                'password' => $password,
                'product' => $role->name
            ];

            ProductTransactions::create([
                'user_id'           => $userId,
                'product_id'        => $data['PRODUCT_ID'],
                'transaction_id'    => $data['TRANSACTION_ID'],
                'transaction_type'  => 'SALE'
            ]);

            $user = User::find($newUser->id);

            $user->notify(new NewUserNotification($userInfo));

            return 'User Created Successfully!';
        } else {
            $currentRole = Role::select('roles.name as name', 'mr.model_id')
            ->join('model_has_roles as mr', 'roles.id', '=', 'mr.role_id')
            ->where('mr.model_id', $user->id)
            ->first();
            
            if ($role->funnel != $currentRole->name) {
                
                $user->removeRole($currentRole->name);
                $user->assignRole($role->funnel);
                
                $userInfo = [
                    'username' => $user->name,
                    'product' => $role->funnel
                ];
                $userId = $user->id;
                
                ProductTransactions::create([
                    'user_id'           => $userId,
                    'product_id'        => $data['PRODUCT_ID'],
                    'transaction_id'    => $data['TRANSACTION_ID'],
                    'transaction_type'  => 'SALE'
                ]);
                
                $user->notify(new UpdateUserRoleNotification($userInfo));

                return 'User Bundle Upgraded!';
            }
        }
    }

    private function detachUser($d)
    {
        // detach user role
        $user = User::where('email', $d['EMAIL'])->first();
        $role = Product::where('product_id', $d['PRODUCT_ID'])->first();
        if ($user) {
            $id = $user->id;

            $currentRole = Role::select('roles.name as name', 'mr.model_id')
                ->join('model_has_roles as mr', 'roles.id', '=', 'mr.role_id')
                ->where('mr.model_id', $id)
                ->first();

            if ($currentRole) {
                $user->removeRole($currentRole->name);
                $user->update(['active_status' => 2]);
                $user->delete();
                
                $userInfo = [
                    'username' => $user->name,
                    'product' => $role->name
                ];
                ProductTransactions::create([
                    'user_id'           => $id,
                    'product_id'        => $d['PRODUCT_ID'],
                    'transaction_id'    => $d['TRANSACTION_ID'],
                    'transaction_type'  => 'RFND'
                ]);

                $user->notify(new RefundUserNotification($userInfo));

                return 'User Detached';
            }
        }

        throw new Exception("User does not exist", 1);
    }
}
