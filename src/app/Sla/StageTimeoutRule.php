<?php

namespace App\Sla;

use Nette\Utils\DateTimeImmutable;

readonly class StageTimeoutRule
{
    public function __construct(
        private string $stageId,
        private int $limitMinutes
    ) {}

    public function isViolated(Deal $deal, DateTimeImmutable $now): bool
    {
        if ($this->stageId !== $deal->stageId) {
            return false;
        }

        if ($deal->stageEnteredAt->getTimestamp() + $this->limitMinutes * 60 < time()) {
            return false;
        }

        return true;
    }
}
