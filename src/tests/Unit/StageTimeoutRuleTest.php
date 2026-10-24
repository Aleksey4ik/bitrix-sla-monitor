<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Sla\Deal;
use App\Sla\StageTimeoutRule;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class StageTimeoutRuleTest extends TestCase
{
    private DateTimeImmutable $dateTime;

    protected function setUp(): void
    {
        $this->dateTime = new DateTimeImmutable('2026-10-23 12:00:00');
    }

    public function test_expired_timeout_rule(): void
    {
        $rule = new StageTimeoutRule('NEW', 60);
        $deal = new Deal(1, 'NEW', $this->dateTime->modify('-120 minutes'));

        $this->assertTrue($rule->isViolated($deal, $this->dateTime));
    }

    public function test_not_expired_timeout_rule(): void
    {
        $rule = new StageTimeoutRule('NEW', 60);
        $deal = new Deal(1, 'NEW', $this->dateTime->modify('-30 minutes'));

        $this->assertFalse($rule->isViolated($deal, $this->dateTime));
    }

    public function test_stage_not_match_rule(): void
    {
        $rule = new StageTimeoutRule('NEW', 60);
        $deal = new Deal(1, 'OLD', $this->dateTime->modify('-30 minutes'));

        $this->assertFalse($rule->isViolated($deal, $this->dateTime));
    }

    public function test_stage_match_rule(): void
    {
        $rule = new StageTimeoutRule('NEW', 60);
        $deal = new Deal(1, 'NEW', $this->dateTime->modify('-60 minutes'));

        $this->assertFalse($rule->isViolated($deal, $this->dateTime));
    }
}
