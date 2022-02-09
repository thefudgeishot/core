<?php
/*
Gibbon, Flexible & Open School System
Copyright (C) 2010, Ross Parker

For the full copyright and license information, please view the LICENSE
file that was distributed with this source code.
*/

namespace Gibbon\Forms;

use PHPUnit\Framework\TestCase;
use Gibbon\Forms\FormFactoryInterface;

/**
 * @covers FormFactory
 */
class FormFactoryTest extends TestCase
{
    public function testCanBeCreatedStatically()
    {
        $this->assertInstanceOf(
            FormFactory::class,
            FormFactory::create()
        );
    }
}
