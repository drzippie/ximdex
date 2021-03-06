<?php
/**
 * Copyright 2011 Bas de Nooijer. All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 * 1. Redistributions of source code must retain the above copyright notice,
 *    this list of conditions and the following disclaimer.
 *
 * 2. Redistributions in binary form must reproduce the above copyright notice,
 *    this listof conditions and the following disclaimer in the documentation
 *    and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDER AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * The views and conclusions contained in the software and documentation are
 * those of the authors and should not be interpreted as representing official
 * policies, either expressed or implied, of the copyright holder.
 */

class Solarium_Result_Select_Debug_TimingTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var Solarium_Result_Select_Debug_Timing
     */
    protected $_result;

    protected $_time, $_phases;

    public function setUp()
    {
        $this->_time = 14;
        $this->_phases = array('key1' => 'dummy1', 'key2' => 'dummy2');
        $this->_result = new Solarium_Result_Select_Debug_Timing($this->_time, $this->_phases);
    }

    public function testGetTime()
    {
        $this->assertEquals(
            $this->_time,
            $this->_result->getTime()
        );
    }

    public function testGetPhase()
    {
        $this->assertEquals(
            $this->_phases['key1'],
            $this->_result->getPhase('key1')
        );
    }

    public function testGetPhaseWithInvalidKey()
    {
        $this->assertEquals(
            null,
            $this->_result->getPhase('invalidkey')
        );
    }

    public function testGetPhases()
    {
        $this->assertEquals(
            $this->_phases,
            $this->_result->getPhases()
        );
    }

    public function testIterator()
    {
        $items = array();
        foreach($this->_result AS $key => $item)
        {
            $items[$key] = $item;
        }

        $this->assertEquals($this->_phases, $items);
    }

    public function testCount()
    {
        $this->assertEquals(count($this->_phases), count($this->_result));
    }

}