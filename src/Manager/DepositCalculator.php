<?php


namespace App\Manager;


use App\Entity\Account;
use App\Entity\Withdraw;
use App\Repository\AccountRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class DepositCalculator implements DepositCalculatorInterface
{
    private $accountRepository;

    private $em;

    public function __construct(EntityManagerInterface $entityManager,AccountRepository $accountRepository)
    {
        $this->accountRepository = $accountRepository;
        $this->em = $entityManager;
    }


    /**
     * @throws Exception
     */
    public function withdraw(Account $account, Withdraw $withdraw)
    {
        $debitedAccount =  $this->accountRepository->find($account);
        //todo check if null throw exception
        if ($debitedAccount == null){
            throw new Exception('Account not found');
        }

        $accountBalance = $debitedAccount->getBlance();


    }
}