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

class Solarium_Query_Update_Command_DeleteTest extends PHPUnit_Framework_TestCase
{
    protected $_command;

    public function setUp()
    {
        $this->_command = new Solarium_Query_Update_Command_Delete;
    }

    public function testGetType()
    {
        $this->assertEquals(
            Solarium_Query_Update::COMMAND_DELETE,
            $this->_command->getType()
        );
    }

    public function testConfigMode()
    {
        $options = array(
            'id' => 1,
            'query' => '*:*',
        );

        $command = new Solarium_Query_Update_Command_Delete($options);

        $this->assertEquals(
            array(1),
            $command->getIds()
        );

        $this->assertEquals(
            array('*:*'),
            $command->getQueries()
        );
    }

    public function testConfigModeMultiValue()
    {
        $options = array(
            'id' => array(1,2),
            'query' => array('id:1','id:2'),
        );

        $command = new Solarium_Query_Update_Command_Delete($options);

        $this->assertEquals(
            array(1,2),
            $command->getIds()
        );

        $this->assertEquals(
            array('id:1','id:2'),
            $command->getQueries()
        );
    }

    public function testAddId()
    {
        $this->_command->addId(1);
        $this->assertEquals(
            array(1),
            $this->_command->getIds()
        );
    }

    public function testAddIds()
    {
        $this->_command->addId(1);
        $this->_command->addIds(array(2,3));
        $this->assertEquals(
            array(1,2,3),
            $this->_command->getIds()
        );
    }

    public function testAddQuery()
    {
        $this->_command->addQuery('*:*');
        $this->assertEquals(
            array('*:*'),
            $this->_command->getQueries()
        );
    }

    public function testAddQueries()
    {
        $this->_command->addQuery('*:*');
        $this->_command->addQueries(array('id:1','id:2'));
        $this->assertEquals(
            array('*:*','id:1','id:2'),
            $this->_command->getQueries()
        );
    }

}