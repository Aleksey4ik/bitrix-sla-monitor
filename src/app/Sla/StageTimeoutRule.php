<?php
declare(strict_types=1);

namespace App\Sla;

use DateTimeImmutable;

final readonly class StageTimeoutRule
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

        if ($now->getTimestamp() - $deal->stageEnteredAt->getTimestamp() > $this->limitMinutes * 60) {
            return true;
        }

        return false;
    }
}
