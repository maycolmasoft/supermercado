<?php

require_once dirname(__FILE__) . '/Data.php';
require_once dirname(__FILE__) . '/InputStream.php';
require_once dirname(__FILE__) . '/TreeBuilder.php';
require_once dirname(__FILE__) . '/Tokenizer.php';

/**
 * Outwards facing interface for HTML5.
 */
class HTML5_Parser
{
    /**

     */
    static public function parse($text, $builder = null) {
        $tokenizer = new HTML5_Tokenizer($text, $builder);
        $tokenizer->parse();
        return $tokenizer->save();
    }
    /**
     * Parses an HTML fragment.

     */
    static public function parseFragment($text, $context = null, $builder = null) {
        $tokenizer = new HTML5_Tokenizer($text, $builder);
        $tokenizer->parseFragment($context);
        return $tokenizer->save();
    }
}
