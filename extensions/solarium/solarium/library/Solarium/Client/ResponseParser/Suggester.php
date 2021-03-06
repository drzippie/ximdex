<?php
/**
 * Copyright 2011 Gasol Wu. PIXNET Digital Media Corporation.
 * All rights reserved.
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
 *
 * @copyright Copyright 2011 Gasol Wu <gasol.wu@gmail.com>
 * @license http://github.com/basdenooijer/solarium/raw/master/COPYING
 * @link http://www.solarium-project.org/
 *
 * @package Solarium
 * @subpackage Client
 */

/**
 * Parse Suggester response data
 *
 * @package Solarium
 * @subpackage Client
 */
class Solarium_Client_ResponseParser_Suggester extends Solarium_Client_ResponseParser
{

    /**
     * Get result data for the response
     *
     * @param Solarium_Result_Terms $result
     * @return array
     */
    public function parse($result)
    {
        $data = $result->getData();
        $query = $result->getQuery();

        $status = null;
        $queryTime = null;
        if (isset($data['responseHeader'])) {
            $status = $data['responseHeader']['status'];
            $queryTime = $data['responseHeader']['QTime'];
        }

        $suggestions = array();
        $collation = null;

        if (isset($data['spellcheck']['suggestions']) && is_array($data['spellcheck']['suggestions'])) {
            $suggestResults = $data['spellcheck']['suggestions'];
            $termClass = $query->getOption('termclass');
            for ($i = 0; $i < count($suggestResults); $i += 2) {
                $term = $suggestResults[$i];
                $termData = $suggestResults[$i+1];

                if ($term == 'collation'&& $i == count($suggestResults)-2) {
                    $collation = $termData;
                } else {
                    $suggestions[$term] = new $termClass(
                        $termData['numFound'],
                        $termData['startOffset'],
                        $termData['endOffset'],
                        $termData['suggestion']
                    );
                }
            }
        }

        return array(
            'status' => $status,
            'queryTime' => $queryTime,
            'results' => $suggestions,
            'collation' => $collation,
        );
    }

}