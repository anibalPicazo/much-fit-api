<?php

namespace App\Service\Company;

use App\Entity\Company;
use App\Repository\CompanyRepository;
use App\Service\AbstractManager;
use Doctrine\Common\Persistence\ObjectRepository;

class CompanyManager extends AbstractManager
{
    /**
     * @return CompanyRepository|ObjectRepository
     */
    protected function getRepository()
    {
        return $this->doctrine->getRepository(Company::class);
    }


}
