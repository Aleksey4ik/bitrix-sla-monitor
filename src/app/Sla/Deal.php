<?php
declare(strict_types=1);

namespace App\Sla;

use Nette\Utils\DateTimeImmutable;

final readonly class Deal
{
    public function __construct(
        public int $id,
        public string $stageId,
        public DateTimeImmutable $stageEnteredAt
    ) {}
}
