<?php


namespace App\Manager;


use App\Entity\Account;
use App\Entity\Withdraw;

interface DepositCalculatorInterface
{
    public function withdraw(Account $account,Withdraw $withdraw);
}