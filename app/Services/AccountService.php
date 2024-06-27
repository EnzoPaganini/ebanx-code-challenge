<?php

namespace App\Services;

use App\Models\Account;
use App\Services\Service;
use Illuminate\Support\Facades\DB;
use App\Traits\ApiResponse;


class AccountService extends Service {

    public function __construct() {
        //
    }

    /**
     * Create account
     *
     * @param mixed $account_id
     * @return AccountCustomer
     */
    public function createAccount ($data) {
        $account = Account::insert($data);

        return $account;
    }

     /**
     * Update account
     *
     * @param mixed $account_id
     * @return AccountCustomer
     */
    public function updateAccount ($account_id, $data) {
        $account = DB::table('accounts')
            ->where(['id' => $account_id])
            ->update(["balance" => $data["balance"]]);

        return $account;
    }

    /**
     * Return the account's balance
     *
     * @param mixed $account_id
     * @return AccountCustomer
     */
    public function getBalance ($account_id) {
        $account = Account::select('*')
            ->where(['id' => $account_id])
            ->first();

        return $account;
    }

    /**
     * Create account
     *
     * @param mixed $account_id
     * @return AccountCustomer
     */
    public function createEvent ($data) {
        switch($data["type"]){
            case("deposit"):
                # check if account exists
                $account = Account::find($data["destination"]);
                # if account not found, create account with id and amount as balance
                if(empty($account)){
                    $account_data = [
                        "id" => $data["destination"],
                        "balance" => $data["amount"]
                    ];
                    return $this->createAccount($account_data);
                }else{
                    # if account found, update account with new balance
                    $new_balance = $account["balance"] + $data["amount"];
                    return $this->updateAccount($data["destination"], ["balance" => $new_balance]);
                }
            case("withdraw"):
                # check if account exists
                $account = Account::find($data["origin"]);
                if(empty($account)){
                    # if account not found, return error
                    return false;
                }else{
                    # if account found, update account with new balance
                    $new_balance = $account["balance"] - $data["amount"];
                    return $this->updateAccount($data["origin"], ["balance" => $new_balance]);
                }
            
        }




        $account = Account::insert($account_data);

        return $account;
    }
}
