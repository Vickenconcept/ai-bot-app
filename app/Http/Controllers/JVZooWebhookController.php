<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Notifications\RefundUserNotification;
use App\Notifications\UpdateUserRoleNotification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use \Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class JVZooWebhookController extends Controller
{
    //

    public function JVZoo(Request $request)
    {

        //Verify the JVZoo IPN request
        // if (!$this->jvzipnVerification($request)) {
        //     return response()->json(['message' => 'Verification Failed!']);
        // }

        $data = $request->all();

        // if (!isset($_POST["cverify"])) {
        //     return response()->json(['message' => 'Verification Failed!']);
        // }

        $TYPE = isset($data['ctransaction']) ? $data['ctransaction'] : 'SALE';

        // Collect necessary data from the request
        $d = array(
            "TYPE"            => $TYPE,
            "EMAIL"           => isset($data['ccustemail']) ? $data['ccustemail'] : null,
            "TRANSACTION_ID"  => isset($data["ctransreceipt"]) ? $data["ctransreceipt"] : null,
            "PRODUCT_ID"      => isset($data['cproditem']) ? $data['cproditem'] : null
        );

        // Check if required data exists
        if (!$d['PRODUCT_ID'] || !$d['EMAIL']) {
            // if (!$d['PRODUCT_ID'] || !$d['EMAIL'] || !$d['TRANSACTION_ID']) {
            return response()->json(['message' => 'Item does not exist.']);
        }

        // Get user email, product ID, and transaction ID
        $email = $d['EMAIL'];
        $productID = $d['PRODUCT_ID'];
        $transactionID = $d['TRANSACTION_ID'];

        // Find the role (related to the product) by product ID
        $role = Product::where('product_id', $productID)->first();

        // If the role doesn't exist, return an error
        if (!$role) {
            return response()->json(['message' => 'Product not found!']);
        }

        // Process based on transaction type (SALE or RFND)
        // switch ($TYPE) {
        //     case 'SALE':
        //         $user = User::where('email', $email)->first();

        //         if (!$user) {
        //             $password = Str::random(10);
        //             $newUser = User::create([
        //                 'name'      => substr($email, 0, strpos($email, '@')),
        //                 'email'     => $email,
        //                 'password'  => Hash::make($password),
        //                 'username' => substr($email, 0, strpos($email, '@')) . Str::random(3),
        //                 'role' => 'user',
        //                 'referrer_id' => null,
        //             ]);

        //             $newUser->assignRole($role->funnel);
        //             $userModel = $newUser;
        //             $username = $newUser->name;
        //             $userId = $newUser->id;
        //             $userInfo = [
        //                 'username' => $user->name,
        //                 'product' => $role->funnel,
        //                 'password' => $password
        //             ];


        //             Auth::login($newUser);

        //             $user = auth()->user();


        //             $message = $user->bots()->create([
        //                 'name' => 'bot',
        //                 'personality' => '',
        //                 'description' => 'an intelligent bot , for all times',
        //                 'knowledge' => '',
        //                 'model' => 'gpt-4',
        //             ]);

        //             auth()->logout();
        //             $user->notify(new UpdateUserRoleNotification($userInfo));

        //             return response()->json(['message' => 'User created successfully!']);
        //         } else {
        //             $password = Str::random(10);
        //             $user->syncRoles([$role->funnel]);
        //             // $user->assignRole($role->funnel);
        //             $userInfo = [
        //                 'username' => $user->name,
        //                 'product' => $role->funnel,
        //                 'password' => $password
        //             ];

        //             $user->notify(new UpdateUserRoleNotification($userInfo));

        //             return response()->json(['message' => 'User role updated successfully!']);
        //         }

        //         break;

        //     case 'RFND':
        //         // Handle refund transaction
        //         $user = User::where('email', $email)->first();

        //         if ($user) {
        //             $user->roles()->detach();
        //             // $user->update(['active_status' => 2]);
        //             // $user->delete();
        //             $user->forceDelete();

        //             $userInfo = [
        //                 'username' => $user->name,
        //                 'product' => $role->name
        //             ];
        //             $user->notify(new RefundUserNotification($userInfo));


        //             return response()->json(['message' => 'User refunded and deleted successfully!']);
        //         } else {
        //             return response()->json(['message' => 'User not found!']);
        //         }

        //         break;

        //     default:
        //         return response()->json(['message' => 'Invalid transaction type!']);
        // }

        switch ($TYPE) {
            case 'SALE':
                $user = User::where('email', $email)->first();

                if (!$user) {
                    // Generate random password
                    $password = Str::random(10);

                    // Create a new user
                    $newUser = User::create([
                        'name'       => substr($email, 0, strpos($email, '@')),
                        'email'      => $email,
                        'password'   => Hash::make($password),
                        'username'   => substr($email, 0, strpos($email, '@')) . Str::random(3),
                        'role'       => 'user',
                        'referrer_id' => null,
                    ]);

                    // Assign the role to the new user
                    $newUser->assignRole($role->funnel);

                    // Create a bot for the new user
                    $newUser->bots()->create([
                        'name'         => 'bot',
                        'personality'  => '',
                        'description'  => 'An intelligent bot, for all times',
                        'knowledge'    => '',
                        'model'        => 'gpt-4',
                    ]);

                    // Prepare user info for notifications
                    $userInfo = [
                        'username' => $newUser->name,
                        'product'  => $role->funnel,
                        'password' => $password
                    ];

                    // Notify the user about their account details
                    $newUser->notify(new UpdateUserRoleNotification($userInfo));

                    return response()->json(['message' => 'User and bot created successfully!']);
                } else {
                    // If the user already exists, just update their role
                    $password = Str::random(10);
                    $user->syncRoles([$role->funnel]);

                    $userInfo = [
                        'username' => $user->name,
                        'product'  => $role->funnel,
                        'password' => $password
                    ];

                    // Notify the user about the role update
                    $user->notify(new UpdateUserRoleNotification($userInfo));

                    return response()->json(['message' => 'User role updated successfully!']);
                }

                break;

            case 'RFND':
                // Handle refund transaction
                $user = User::where('email', $email)->first();

                if ($user) {
                    // Detach roles and delete the user
                    $user->roles()->detach();
                    $user->forceDelete();

                    $userInfo = [
                        'username' => $user->name,
                        'product'  => $role->name
                    ];

                    // Notify the user about the refund
                    $user->notify(new RefundUserNotification($userInfo));

                    return response()->json(['message' => 'User refunded and deleted successfully!']);
                } else {
                    return response()->json(['message' => 'User not found!']);
                }

                break;

            default:
                return response()->json(['message' => 'Invalid transaction type!']);
        }
    }


    // This method verifies the JVZoo IPN request
    public function jvzipnVerification(Request $request)
    {
        $secretKey = "yP5LoM3o0NZVxHSU0QmC"; // Replace with your actual JVZoo secret key
        $pop = "";
        $ipnFields = array();

        foreach ($_POST as $key => $value) {
            if ($key == "cverify") {
                continue;
            }
            $ipnFields[] = $key;
        }

        sort($ipnFields);
        foreach ($ipnFields as $field) {
            $pop = $pop . $_POST[$field] . "|";
        }

        $pop = $pop . $secretKey;
        if ('UTF-8' != mb_detect_encoding($pop)) {
            $pop = mb_convert_encoding($pop, "UTF-8");
        }

        $calcedVerify = sha1($pop);
        $calcedVerify = strtoupper(substr($calcedVerify, 0, 8));

        return $calcedVerify == $_POST["cverify"];
    }
}
