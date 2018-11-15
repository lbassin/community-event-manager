<?php

declare(strict_types=1);

namespace App\Repository\SpecialBenefit;

use App\Entity\SpecialBenefit;
use App\Dto\SpecialBenefitRequest;
use Ramsey\Uuid\UuidInterface;

final class SpecialBenefitManager implements SpecialBenefitManagerInterface
{
    private $repository;

    public function __construct(SpecialBenefitRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function find(string $id): ?SpecialBenefit
    {
        return $this->repository->find($id);
    }

    public function findAll(): array
    {
        return $this->repository->findAll();
    }

    /**
     * @param SpecialBenefitRequest $specialBenefitRequest
     * @return SpecialBenefit
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    public function createFrom(SpecialBenefitRequest $specialBenefitRequest): SpecialBenefit
    {
        return new SpecialBenefit(
            $this->nextIdentity(),
            $specialBenefitRequest->label,
            $specialBenefitRequest->price,
            $specialBenefitRequest->description
        );
    }

    /**
     * @param string $label
     * @param float $price
     * @param string $description
     * @return SpecialBenefit
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    public function createWith(string $label, float $price, string $description): SpecialBenefit
    {
        return new SpecialBenefit(
            $this->nextIdentity(),
            $label,
            $price,
            $description
        );
    }

    /**
     * @param SpecialBenefit $specialBenefit
     */
    public function save(SpecialBenefit $specialBenefit): void
    {
        $this->repository->save($specialBenefit);
    }

    /**
     * @param SpecialBenefit $specialBenefit
     */
    public function remove(SpecialBenefit $specialBenefit): void
    {
        $this->repository->remove($specialBenefit);
    }

    /**
     * @return UuidInterface
     * @throws \Exception
     */
    private function nextIdentity(): UuidInterface
    {
        return $this->repository->nextIdentity();
    }
}
