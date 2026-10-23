<?php

namespace Tests\Unit;

use App\Sla\Deal;
use App\Sla\StageTimeoutRule;
use Nette\Utils\DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class StageTimeoutRuleTest extends TestCase
{
    public function testStageTimeoutRule()
    {
        $rule = new StageTimeoutRule('NEW', 60);
        $deal = new Deal('7', 'NEW', new DateTimeImmutable()->modify('-40 minutes'));

        $this->assertTrue($rule->isViolated($deal, new DateTimeImmutable()));
    }
}
