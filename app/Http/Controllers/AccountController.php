<?php
 
namespace App\Http\Controllers;
 
use App\Models\User;
use Illuminate\View\View;
 
class AccountController extends Controller
{
    /**
     * Show the profile for a given user.
     */
    public function getBalance(string $id): View
    {
        return "test";
    }
}