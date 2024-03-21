<?php

/*
 * Generated from assembler3.g4 by ANTLR 4.13.1
 */

namespace Assembler {
	use Antlr\Antlr4\Runtime\Atn\ATN;
	use Antlr\Antlr4\Runtime\Atn\ATNDeserializer;
	use Antlr\Antlr4\Runtime\Atn\ParserATNSimulator;
	use Antlr\Antlr4\Runtime\Dfa\DFA;
	use Antlr\Antlr4\Runtime\Error\Exceptions\FailedPredicateException;
	use Antlr\Antlr4\Runtime\Error\Exceptions\NoViableAltException;
	use Antlr\Antlr4\Runtime\PredictionContexts\PredictionContextCache;
	use Antlr\Antlr4\Runtime\Error\Exceptions\RecognitionException;
	use Antlr\Antlr4\Runtime\RuleContext;
	use Antlr\Antlr4\Runtime\Token;
	use Antlr\Antlr4\Runtime\TokenStream;
	use Antlr\Antlr4\Runtime\Vocabulary;
	use Antlr\Antlr4\Runtime\VocabularyImpl;
	use Antlr\Antlr4\Runtime\RuntimeMetaData;
	use Antlr\Antlr4\Runtime\Parser;

	final class assembler3Parser extends Parser
	{
		public const START = 1, END = 2, BYTE = 3, WORD = 4, RESB = 5, RESW = 6, 
               PLUS = 7, HASH = 8, AT = 9, COMMA = 10, BASE = 11, CONS = 12, 
               CONSX = 13, ERRCONS = 14, ERRCONSX = 15, ID = 16, OPCODE = 17, 
               NUM = 18, NEWL = 19, WS = 20;

		public const RULE_prog = 0, RULE_begin = 1, RULE_lines = 2, RULE_line = 3, 
               RULE_oneOpCode = 4, RULE_instruction = 5, RULE_op1_missing = 6, 
               RULE_op2_missing = 7, RULE_both_missing = 8, RULE_comma_missing = 9, 
               RULE_no_op1 = 10, RULE_no_op2 = 11, RULE_no_comma = 12, RULE_directive = 13, 
               RULE_type = 14, RULE_end = 15;

		/**
		 * @var array<string>
		 */
		public const RULE_NAMES = [
			'prog', 'begin', 'lines', 'line', 'oneOpCode', 'instruction', 'op1_missing', 
			'op2_missing', 'both_missing', 'comma_missing', 'no_op1', 'no_op2', 'no_comma', 
			'directive', 'type', 'end'
		];

		/**
		 * @var array<string|null>
		 */
		private const LITERAL_NAMES = [
		    null, "'START'", "'END'", "'BYTE'", "'WORD'", "'RESB'", "'RESW'", 
		    "'+'", "'#'", "'@'", "','", "'BASE'"
		];

		/**
		 * @var array<string>
		 */
		private const SYMBOLIC_NAMES = [
		    null, "START", "END", "BYTE", "WORD", "RESB", "RESW", "PLUS", "HASH", 
		    "AT", "COMMA", "BASE", "CONS", "CONSX", "ERRCONS", "ERRCONSX", "ID", 
		    "OPCODE", "NUM", "NEWL", "WS"
		];

		private const SERIALIZED_ATN =
			[4, 1, 20, 174, 2, 0, 7, 0, 2, 1, 7, 1, 2, 2, 7, 2, 2, 3, 7, 3, 2, 4, 
		    7, 4, 2, 5, 7, 5, 2, 6, 7, 6, 2, 7, 7, 7, 2, 8, 7, 8, 2, 9, 7, 9, 
		    2, 10, 7, 10, 2, 11, 7, 11, 2, 12, 7, 12, 2, 13, 7, 13, 2, 14, 7, 
		    14, 2, 15, 7, 15, 1, 0, 1, 0, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 
		    1, 2, 1, 2, 1, 2, 5, 2, 44, 8, 2, 10, 2, 12, 2, 47, 9, 2, 1, 3, 1, 
		    3, 1, 3, 1, 3, 1, 3, 3, 3, 54, 8, 3, 1, 3, 3, 3, 57, 8, 3, 1, 3, 1, 
		    3, 3, 3, 61, 8, 3, 1, 3, 1, 3, 1, 3, 1, 3, 1, 3, 1, 3, 1, 3, 1, 3, 
		    1, 3, 1, 3, 1, 3, 3, 3, 74, 8, 3, 1, 4, 1, 4, 1, 5, 3, 5, 79, 8, 5, 
		    1, 5, 1, 5, 3, 5, 83, 8, 5, 1, 5, 1, 5, 1, 5, 3, 5, 88, 8, 5, 3, 5, 
		    90, 8, 5, 1, 6, 3, 6, 93, 8, 6, 1, 6, 3, 6, 96, 8, 6, 1, 6, 1, 6, 
		    3, 6, 100, 8, 6, 1, 6, 1, 6, 1, 6, 1, 6, 1, 7, 3, 7, 107, 8, 7, 1, 
		    7, 3, 7, 110, 8, 7, 1, 7, 1, 7, 3, 7, 114, 8, 7, 1, 7, 1, 7, 1, 7, 
		    1, 7, 1, 8, 3, 8, 121, 8, 8, 1, 8, 3, 8, 124, 8, 8, 1, 8, 1, 8, 3, 
		    8, 128, 8, 8, 1, 8, 1, 8, 1, 8, 1, 8, 1, 9, 3, 9, 135, 8, 9, 1, 9, 
		    1, 9, 3, 9, 139, 8, 9, 1, 9, 1, 9, 1, 9, 1, 10, 1, 10, 1, 11, 1, 11, 
		    1, 12, 1, 12, 1, 13, 1, 13, 1, 14, 1, 14, 1, 14, 1, 14, 1, 14, 1, 
		    14, 1, 14, 1, 14, 1, 14, 1, 14, 1, 14, 1, 14, 1, 14, 3, 14, 165, 8, 
		    14, 1, 15, 1, 15, 3, 15, 169, 8, 15, 1, 15, 3, 15, 172, 8, 15, 1, 
		    15, 0, 0, 16, 0, 2, 4, 6, 8, 10, 12, 14, 16, 18, 20, 22, 24, 26, 28, 
		    30, 0, 4, 1, 0, 8, 9, 2, 0, 16, 16, 18, 18, 1, 0, 14, 15, 1, 0, 12, 
		    13, 189, 0, 32, 1, 0, 0, 0, 2, 35, 1, 0, 0, 0, 4, 40, 1, 0, 0, 0, 
		    6, 73, 1, 0, 0, 0, 8, 75, 1, 0, 0, 0, 10, 78, 1, 0, 0, 0, 12, 92, 
		    1, 0, 0, 0, 14, 106, 1, 0, 0, 0, 16, 120, 1, 0, 0, 0, 18, 134, 1, 
		    0, 0, 0, 20, 143, 1, 0, 0, 0, 22, 145, 1, 0, 0, 0, 24, 147, 1, 0, 
		    0, 0, 26, 149, 1, 0, 0, 0, 28, 164, 1, 0, 0, 0, 30, 166, 1, 0, 0, 
		    0, 32, 33, 3, 2, 1, 0, 33, 34, 3, 4, 2, 0, 34, 1, 1, 0, 0, 0, 35, 
		    36, 5, 16, 0, 0, 36, 37, 5, 1, 0, 0, 37, 38, 5, 18, 0, 0, 38, 39, 
		    5, 19, 0, 0, 39, 3, 1, 0, 0, 0, 40, 45, 3, 6, 3, 0, 41, 42, 5, 19, 
		    0, 0, 42, 44, 3, 6, 3, 0, 43, 41, 1, 0, 0, 0, 44, 47, 1, 0, 0, 0, 
		    45, 43, 1, 0, 0, 0, 45, 46, 1, 0, 0, 0, 46, 5, 1, 0, 0, 0, 47, 45, 
		    1, 0, 0, 0, 48, 49, 5, 16, 0, 0, 49, 50, 3, 18, 9, 0, 50, 51, 6, 3, 
		    -1, 0, 51, 74, 1, 0, 0, 0, 52, 54, 5, 16, 0, 0, 53, 52, 1, 0, 0, 0, 
		    53, 54, 1, 0, 0, 0, 54, 57, 1, 0, 0, 0, 55, 57, 6, 3, -1, 0, 56, 53, 
		    1, 0, 0, 0, 56, 55, 1, 0, 0, 0, 57, 58, 1, 0, 0, 0, 58, 74, 3, 10, 
		    5, 0, 59, 61, 5, 16, 0, 0, 60, 59, 1, 0, 0, 0, 60, 61, 1, 0, 0, 0, 
		    61, 62, 1, 0, 0, 0, 62, 74, 3, 26, 13, 0, 63, 64, 3, 12, 6, 0, 64, 
		    65, 6, 3, -1, 0, 65, 74, 1, 0, 0, 0, 66, 67, 3, 14, 7, 0, 67, 68, 
		    6, 3, -1, 0, 68, 74, 1, 0, 0, 0, 69, 70, 3, 16, 8, 0, 70, 71, 6, 3, 
		    -1, 0, 71, 74, 1, 0, 0, 0, 72, 74, 3, 30, 15, 0, 73, 48, 1, 0, 0, 
		    0, 73, 56, 1, 0, 0, 0, 73, 60, 1, 0, 0, 0, 73, 63, 1, 0, 0, 0, 73, 
		    66, 1, 0, 0, 0, 73, 69, 1, 0, 0, 0, 73, 72, 1, 0, 0, 0, 74, 7, 1, 
		    0, 0, 0, 75, 76, 5, 16, 0, 0, 76, 9, 1, 0, 0, 0, 77, 79, 5, 7, 0, 
		    0, 78, 77, 1, 0, 0, 0, 78, 79, 1, 0, 0, 0, 79, 80, 1, 0, 0, 0, 80, 
		    89, 5, 16, 0, 0, 81, 83, 7, 0, 0, 0, 82, 81, 1, 0, 0, 0, 82, 83, 1, 
		    0, 0, 0, 83, 84, 1, 0, 0, 0, 84, 87, 7, 1, 0, 0, 85, 86, 5, 10, 0, 
		    0, 86, 88, 7, 1, 0, 0, 87, 85, 1, 0, 0, 0, 87, 88, 1, 0, 0, 0, 88, 
		    90, 1, 0, 0, 0, 89, 82, 1, 0, 0, 0, 89, 90, 1, 0, 0, 0, 90, 11, 1, 
		    0, 0, 0, 91, 93, 5, 16, 0, 0, 92, 91, 1, 0, 0, 0, 92, 93, 1, 0, 0, 
		    0, 93, 95, 1, 0, 0, 0, 94, 96, 5, 7, 0, 0, 95, 94, 1, 0, 0, 0, 95, 
		    96, 1, 0, 0, 0, 96, 97, 1, 0, 0, 0, 97, 99, 5, 16, 0, 0, 98, 100, 
		    7, 0, 0, 0, 99, 98, 1, 0, 0, 0, 99, 100, 1, 0, 0, 0, 100, 101, 1, 
		    0, 0, 0, 101, 102, 3, 20, 10, 0, 102, 103, 5, 10, 0, 0, 103, 104, 
		    7, 1, 0, 0, 104, 13, 1, 0, 0, 0, 105, 107, 5, 16, 0, 0, 106, 105, 
		    1, 0, 0, 0, 106, 107, 1, 0, 0, 0, 107, 109, 1, 0, 0, 0, 108, 110, 
		    5, 7, 0, 0, 109, 108, 1, 0, 0, 0, 109, 110, 1, 0, 0, 0, 110, 111, 
		    1, 0, 0, 0, 111, 113, 5, 16, 0, 0, 112, 114, 7, 0, 0, 0, 113, 112, 
		    1, 0, 0, 0, 113, 114, 1, 0, 0, 0, 114, 115, 1, 0, 0, 0, 115, 116, 
		    7, 1, 0, 0, 116, 117, 5, 10, 0, 0, 117, 118, 3, 22, 11, 0, 118, 15, 
		    1, 0, 0, 0, 119, 121, 5, 16, 0, 0, 120, 119, 1, 0, 0, 0, 120, 121, 
		    1, 0, 0, 0, 121, 123, 1, 0, 0, 0, 122, 124, 5, 7, 0, 0, 123, 122, 
		    1, 0, 0, 0, 123, 124, 1, 0, 0, 0, 124, 125, 1, 0, 0, 0, 125, 127, 
		    5, 16, 0, 0, 126, 128, 7, 0, 0, 0, 127, 126, 1, 0, 0, 0, 127, 128, 
		    1, 0, 0, 0, 128, 129, 1, 0, 0, 0, 129, 130, 3, 22, 11, 0, 130, 131, 
		    5, 10, 0, 0, 131, 132, 3, 22, 11, 0, 132, 17, 1, 0, 0, 0, 133, 135, 
		    5, 7, 0, 0, 134, 133, 1, 0, 0, 0, 134, 135, 1, 0, 0, 0, 135, 136, 
		    1, 0, 0, 0, 136, 138, 5, 16, 0, 0, 137, 139, 7, 0, 0, 0, 138, 137, 
		    1, 0, 0, 0, 138, 139, 1, 0, 0, 0, 139, 140, 1, 0, 0, 0, 140, 141, 
		    7, 1, 0, 0, 141, 142, 7, 1, 0, 0, 142, 19, 1, 0, 0, 0, 143, 144, 6, 
		    10, -1, 0, 144, 21, 1, 0, 0, 0, 145, 146, 6, 11, -1, 0, 146, 23, 1, 
		    0, 0, 0, 147, 148, 6, 12, -1, 0, 148, 25, 1, 0, 0, 0, 149, 150, 3, 
		    28, 14, 0, 150, 27, 1, 0, 0, 0, 151, 152, 5, 3, 0, 0, 152, 153, 7, 
		    2, 0, 0, 153, 165, 6, 14, -1, 0, 154, 155, 5, 3, 0, 0, 155, 165, 7, 
		    3, 0, 0, 156, 157, 5, 4, 0, 0, 157, 165, 5, 18, 0, 0, 158, 159, 5, 
		    5, 0, 0, 159, 165, 5, 18, 0, 0, 160, 161, 5, 6, 0, 0, 161, 165, 5, 
		    18, 0, 0, 162, 163, 5, 11, 0, 0, 163, 165, 5, 16, 0, 0, 164, 151, 
		    1, 0, 0, 0, 164, 154, 1, 0, 0, 0, 164, 156, 1, 0, 0, 0, 164, 158, 
		    1, 0, 0, 0, 164, 160, 1, 0, 0, 0, 164, 162, 1, 0, 0, 0, 165, 29, 1, 
		    0, 0, 0, 166, 168, 5, 2, 0, 0, 167, 169, 7, 1, 0, 0, 168, 167, 1, 
		    0, 0, 0, 168, 169, 1, 0, 0, 0, 169, 171, 1, 0, 0, 0, 170, 172, 5, 
		    19, 0, 0, 171, 170, 1, 0, 0, 0, 171, 172, 1, 0, 0, 0, 172, 31, 1, 
		    0, 0, 0, 23, 45, 53, 56, 60, 73, 78, 82, 87, 89, 92, 95, 99, 106, 
		    109, 113, 120, 123, 127, 134, 138, 164, 168, 171];
		protected static $atn;
		protected static $decisionToDFA;
		protected static $sharedContextCache;

		public function __construct(TokenStream $input)
		{
			parent::__construct($input);

			self::initialize();

			$this->interp = new ParserATNSimulator($this, self::$atn, self::$decisionToDFA, self::$sharedContextCache);
		}

		private static function initialize(): void
		{
			if (self::$atn !== null) {
				return;
			}

			RuntimeMetaData::checkVersion('4.13.1', RuntimeMetaData::VERSION);

			$atn = (new ATNDeserializer())->deserialize(self::SERIALIZED_ATN);

			$decisionToDFA = [];
			for ($i = 0, $count = $atn->getNumberOfDecisions(); $i < $count; $i++) {
				$decisionToDFA[] = new DFA($atn->getDecisionState($i), $i);
			}

			self::$atn = $atn;
			self::$decisionToDFA = $decisionToDFA;
			self::$sharedContextCache = new PredictionContextCache();
		}

		public function getGrammarFileName(): string
		{
			return "assembler3.g4";
		}

		public function getRuleNames(): array
		{
			return self::RULE_NAMES;
		}

		public function getSerializedATN(): array
		{
			return self::SERIALIZED_ATN;
		}

		public function getATN(): ATN
		{
			return self::$atn;
		}

		public function getVocabulary(): Vocabulary
        {
            static $vocabulary;

			return $vocabulary = $vocabulary ?? new VocabularyImpl(self::LITERAL_NAMES, self::SYMBOLIC_NAMES);
        }

		/**
		 * @throws RecognitionException
		 */
		public function prog(): Context\ProgContext
		{
		    $localContext = new Context\ProgContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 0, self::RULE_prog);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(32);
		        $this->begin();
		        $this->setState(33);
		        $this->lines();
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function begin(): Context\BeginContext
		{
		    $localContext = new Context\BeginContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 2, self::RULE_begin);

		    try {
		        $localContext = new Context\BeginProgContext($localContext);
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(35);
		        $this->match(self::ID);
		        $this->setState(36);
		        $this->match(self::START);
		        $this->setState(37);
		        $this->match(self::NUM);
		        $this->setState(38);
		        $this->match(self::NEWL);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function lines(): Context\LinesContext
		{
		    $localContext = new Context\LinesContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 4, self::RULE_lines);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(40);
		        $this->line();
		        $this->setState(45);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::NEWL) {
		        	$this->setState(41);
		        	$this->match(self::NEWL);
		        	$this->setState(42);
		        	$this->line();
		        	$this->setState(47);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function line(): Context\LineContext
		{
		    $localContext = new Context\LineContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 6, self::RULE_line);

		    try {
		        $this->setState(73);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 4, $this->ctx)) {
		        	case 1:
		        	    $localContext = new Context\CommaMissingContext($localContext);
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(48);
		        	    $this->match(self::ID);
		        	    $this->setState(49);
		        	    $this->comma_missing();
		        	    $this->notifyErrorListeners("Operadores mal formateados");
		        	break;

		        	case 2:
		        	    $localContext = new Context\InstructionOptContext($localContext);
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(56);
		        	    $this->errorHandler->sync($this);

		        	    switch ($this->getInterpreter()->adaptivePredict($this->input, 2, $this->ctx)) {
		        	    	case 1:
		        	    	    $this->setState(53);
		        	    	    $this->errorHandler->sync($this);

		        	    	    switch ($this->getInterpreter()->adaptivePredict($this->input, 1, $this->ctx)) {
		        	    	        case 1:
		        	    	    	    $this->setState(52);
		        	    	    	    $this->match(self::ID);
		        	    	    	break;
		        	    	    }
		        	    	break;

		        	    	case 2:
		        	    	    false;
		        	    	break;
		        	    }
		        	    $this->setState(58);
		        	    $this->instruction();
		        	break;

		        	case 3:
		        	    $localContext = new Context\DirectiveOptContext($localContext);
		        	    $this->enterOuterAlt($localContext, 3);
		        	    $this->setState(60);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if ($_la === self::ID) {
		        	    	$this->setState(59);
		        	    	$this->match(self::ID);
		        	    }
		        	    $this->setState(62);
		        	    $this->directive();
		        	break;

		        	case 4:
		        	    $localContext = new Context\Op1MissingContext($localContext);
		        	    $this->enterOuterAlt($localContext, 4);
		        	    $this->setState(63);
		        	    $this->op1_missing();
		        	    $this->notifyErrorListeners("Operadores mal formateados");
		        	break;

		        	case 5:
		        	    $localContext = new Context\Op2MissingContext($localContext);
		        	    $this->enterOuterAlt($localContext, 5);
		        	    $this->setState(66);
		        	    $this->op2_missing();
		        	    $this->notifyErrorListeners("Operadores mal formateados");
		        	break;

		        	case 6:
		        	    $localContext = new Context\BothMissingContext($localContext);
		        	    $this->enterOuterAlt($localContext, 6);
		        	    $this->setState(69);
		        	    $this->both_missing();
		        	    $this->notifyErrorListeners("Operadores mal formateados");
		        	break;

		        	case 7:
		        	    $localContext = new Context\EndOptContext($localContext);
		        	    $this->enterOuterAlt($localContext, 7);
		        	    $this->setState(72);
		        	    $this->end();
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function oneOpCode(): Context\OneOpCodeContext
		{
		    $localContext = new Context\OneOpCodeContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 8, self::RULE_oneOpCode);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(75);
		        $this->match(self::ID);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function instruction(): Context\InstructionContext
		{
		    $localContext = new Context\InstructionContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 10, self::RULE_instruction);

		    try {
		        $localContext = new Context\Instruction_Context($localContext);
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(78);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::PLUS) {
		        	$this->setState(77);
		        	$this->match(self::PLUS);
		        }
		        $this->setState(80);
		        $this->match(self::ID);
		        $this->setState(89);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 328448) !== 0)) {
		        	$this->setState(82);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);

		        	if ($_la === self::HASH || $_la === self::AT) {
		        		$this->setState(81);

		        		$_la = $this->input->LA(1);

		        		if (!($_la === self::HASH || $_la === self::AT)) {
		        		$this->errorHandler->recoverInline($this);
		        		} else {
		        			if ($this->input->LA(1) === Token::EOF) {
		        			    $this->matchedEOF = true;
		        		    }

		        			$this->errorHandler->reportMatch($this);
		        			$this->consume();
		        		}
		        	}
		        	$this->setState(84);

		        	$localContext->op1 = $this->input->LT(1);
		        	$_la = $this->input->LA(1);

		        	if (!($_la === self::ID || $_la === self::NUM)) {
		        		    $localContext->op1 = $this->errorHandler->recoverInline($this);
		        	} else {
		        		if ($this->input->LA(1) === Token::EOF) {
		        		    $this->matchedEOF = true;
		        	    }

		        		$this->errorHandler->reportMatch($this);
		        		$this->consume();
		        	}
		        	$this->setState(87);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);

		        	if ($_la === self::COMMA) {
		        		$this->setState(85);
		        		$this->match(self::COMMA);
		        		$this->setState(86);

		        		$localContext->op2 = $this->input->LT(1);
		        		$_la = $this->input->LA(1);

		        		if (!($_la === self::ID || $_la === self::NUM)) {
		        			    $localContext->op2 = $this->errorHandler->recoverInline($this);
		        		} else {
		        			if ($this->input->LA(1) === Token::EOF) {
		        			    $this->matchedEOF = true;
		        		    }

		        			$this->errorHandler->reportMatch($this);
		        			$this->consume();
		        		}
		        	}
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function op1_missing(): Context\Op1_missingContext
		{
		    $localContext = new Context\Op1_missingContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 12, self::RULE_op1_missing);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(92);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 9, $this->ctx)) {
		            case 1:
		        	    $this->setState(91);
		        	    $this->match(self::ID);
		        	break;
		        }
		        $this->setState(95);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::PLUS) {
		        	$this->setState(94);
		        	$this->match(self::PLUS);
		        }
		        $this->setState(97);
		        $this->match(self::ID);
		        $this->setState(99);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::HASH || $_la === self::AT) {
		        	$this->setState(98);

		        	$_la = $this->input->LA(1);

		        	if (!($_la === self::HASH || $_la === self::AT)) {
		        	$this->errorHandler->recoverInline($this);
		        	} else {
		        		if ($this->input->LA(1) === Token::EOF) {
		        		    $this->matchedEOF = true;
		        	    }

		        		$this->errorHandler->reportMatch($this);
		        		$this->consume();
		        	}
		        }
		        $this->setState(101);
		        $this->no_op1();
		        $this->setState(102);
		        $this->match(self::COMMA);
		        $this->setState(103);

		        $_la = $this->input->LA(1);

		        if (!($_la === self::ID || $_la === self::NUM)) {
		        $this->errorHandler->recoverInline($this);
		        } else {
		        	if ($this->input->LA(1) === Token::EOF) {
		        	    $this->matchedEOF = true;
		            }

		        	$this->errorHandler->reportMatch($this);
		        	$this->consume();
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function op2_missing(): Context\Op2_missingContext
		{
		    $localContext = new Context\Op2_missingContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 14, self::RULE_op2_missing);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(106);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 12, $this->ctx)) {
		            case 1:
		        	    $this->setState(105);
		        	    $this->match(self::ID);
		        	break;
		        }
		        $this->setState(109);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::PLUS) {
		        	$this->setState(108);
		        	$this->match(self::PLUS);
		        }
		        $this->setState(111);
		        $this->match(self::ID);
		        $this->setState(113);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::HASH || $_la === self::AT) {
		        	$this->setState(112);

		        	$_la = $this->input->LA(1);

		        	if (!($_la === self::HASH || $_la === self::AT)) {
		        	$this->errorHandler->recoverInline($this);
		        	} else {
		        		if ($this->input->LA(1) === Token::EOF) {
		        		    $this->matchedEOF = true;
		        	    }

		        		$this->errorHandler->reportMatch($this);
		        		$this->consume();
		        	}
		        }
		        $this->setState(115);

		        $_la = $this->input->LA(1);

		        if (!($_la === self::ID || $_la === self::NUM)) {
		        $this->errorHandler->recoverInline($this);
		        } else {
		        	if ($this->input->LA(1) === Token::EOF) {
		        	    $this->matchedEOF = true;
		            }

		        	$this->errorHandler->reportMatch($this);
		        	$this->consume();
		        }
		        $this->setState(116);
		        $this->match(self::COMMA);
		        $this->setState(117);
		        $this->no_op2();
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function both_missing(): Context\Both_missingContext
		{
		    $localContext = new Context\Both_missingContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 16, self::RULE_both_missing);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(120);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 15, $this->ctx)) {
		            case 1:
		        	    $this->setState(119);
		        	    $this->match(self::ID);
		        	break;
		        }
		        $this->setState(123);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::PLUS) {
		        	$this->setState(122);
		        	$this->match(self::PLUS);
		        }
		        $this->setState(125);
		        $this->match(self::ID);
		        $this->setState(127);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::HASH || $_la === self::AT) {
		        	$this->setState(126);

		        	$_la = $this->input->LA(1);

		        	if (!($_la === self::HASH || $_la === self::AT)) {
		        	$this->errorHandler->recoverInline($this);
		        	} else {
		        		if ($this->input->LA(1) === Token::EOF) {
		        		    $this->matchedEOF = true;
		        	    }

		        		$this->errorHandler->reportMatch($this);
		        		$this->consume();
		        	}
		        }
		        $this->setState(129);
		        $this->no_op2();
		        $this->setState(130);
		        $this->match(self::COMMA);
		        $this->setState(131);
		        $this->no_op2();
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function comma_missing(): Context\Comma_missingContext
		{
		    $localContext = new Context\Comma_missingContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 18, self::RULE_comma_missing);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(134);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::PLUS) {
		        	$this->setState(133);
		        	$this->match(self::PLUS);
		        }
		        $this->setState(136);
		        $this->match(self::ID);
		        $this->setState(138);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::HASH || $_la === self::AT) {
		        	$this->setState(137);

		        	$_la = $this->input->LA(1);

		        	if (!($_la === self::HASH || $_la === self::AT)) {
		        	$this->errorHandler->recoverInline($this);
		        	} else {
		        		if ($this->input->LA(1) === Token::EOF) {
		        		    $this->matchedEOF = true;
		        	    }

		        		$this->errorHandler->reportMatch($this);
		        		$this->consume();
		        	}
		        }
		        $this->setState(140);

		        $_la = $this->input->LA(1);

		        if (!($_la === self::ID || $_la === self::NUM)) {
		        $this->errorHandler->recoverInline($this);
		        } else {
		        	if ($this->input->LA(1) === Token::EOF) {
		        	    $this->matchedEOF = true;
		            }

		        	$this->errorHandler->reportMatch($this);
		        	$this->consume();
		        }
		        $this->setState(141);

		        $_la = $this->input->LA(1);

		        if (!($_la === self::ID || $_la === self::NUM)) {
		        $this->errorHandler->recoverInline($this);
		        } else {
		        	if ($this->input->LA(1) === Token::EOF) {
		        	    $this->matchedEOF = true;
		            }

		        	$this->errorHandler->reportMatch($this);
		        	$this->consume();
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function no_op1(): Context\No_op1Context
		{
		    $localContext = new Context\No_op1Context($this->ctx, $this->getState());

		    $this->enterRule($localContext, 20, self::RULE_no_op1);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        false;
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function no_op2(): Context\No_op2Context
		{
		    $localContext = new Context\No_op2Context($this->ctx, $this->getState());

		    $this->enterRule($localContext, 22, self::RULE_no_op2);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        false;
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function no_comma(): Context\No_commaContext
		{
		    $localContext = new Context\No_commaContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 24, self::RULE_no_comma);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        false;
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function directive(): Context\DirectiveContext
		{
		    $localContext = new Context\DirectiveContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 26, self::RULE_directive);

		    try {
		        $localContext = new Context\Directive_Context($localContext);
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(149);
		        $this->type();
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function type(): Context\TypeContext
		{
		    $localContext = new Context\TypeContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 28, self::RULE_type);

		    try {
		        $this->setState(164);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 20, $this->ctx)) {
		        	case 1:
		        	    $localContext = new Context\ByteErrorContext($localContext);
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(151);
		        	    $this->match(self::BYTE);
		        	    $this->setState(152);

		        	    $_la = $this->input->LA(1);

		        	    if (!($_la === self::ERRCONS || $_la === self::ERRCONSX)) {
		        	    $this->errorHandler->recoverInline($this);
		        	    } else {
		        	    	if ($this->input->LA(1) === Token::EOF) {
		        	    	    $this->matchedEOF = true;
		        	        }

		        	    	$this->errorHandler->reportMatch($this);
		        	    	$this->consume();
		        	    }
		        	    $this->notifyErrorListeners("en directiva BYTE");
		        	break;

		        	case 2:
		        	    $localContext = new Context\ByteContext($localContext);
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(154);
		        	    $this->match(self::BYTE);
		        	    $this->setState(155);

		        	    $_la = $this->input->LA(1);

		        	    if (!($_la === self::CONS || $_la === self::CONSX)) {
		        	    $this->errorHandler->recoverInline($this);
		        	    } else {
		        	    	if ($this->input->LA(1) === Token::EOF) {
		        	    	    $this->matchedEOF = true;
		        	        }

		        	    	$this->errorHandler->reportMatch($this);
		        	    	$this->consume();
		        	    }
		        	break;

		        	case 3:
		        	    $localContext = new Context\WordContext($localContext);
		        	    $this->enterOuterAlt($localContext, 3);
		        	    $this->setState(156);
		        	    $this->match(self::WORD);
		        	    $this->setState(157);
		        	    $this->match(self::NUM);
		        	break;

		        	case 4:
		        	    $localContext = new Context\ResbContext($localContext);
		        	    $this->enterOuterAlt($localContext, 4);
		        	    $this->setState(158);
		        	    $this->match(self::RESB);
		        	    $this->setState(159);
		        	    $this->match(self::NUM);
		        	break;

		        	case 5:
		        	    $localContext = new Context\ReswContext($localContext);
		        	    $this->enterOuterAlt($localContext, 5);
		        	    $this->setState(160);
		        	    $this->match(self::RESW);
		        	    $this->setState(161);
		        	    $this->match(self::NUM);
		        	break;

		        	case 6:
		        	    $localContext = new Context\BaseContext($localContext);
		        	    $this->enterOuterAlt($localContext, 6);
		        	    $this->setState(162);
		        	    $this->match(self::BASE);
		        	    $this->setState(163);
		        	    $this->match(self::ID);
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function end(): Context\EndContext
		{
		    $localContext = new Context\EndContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 30, self::RULE_end);

		    try {
		        $localContext = new Context\EndProgContext($localContext);
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(166);
		        $this->match(self::END);
		        $this->setState(168);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::ID || $_la === self::NUM) {
		        	$this->setState(167);

		        	$_la = $this->input->LA(1);

		        	if (!($_la === self::ID || $_la === self::NUM)) {
		        	$this->errorHandler->recoverInline($this);
		        	} else {
		        		if ($this->input->LA(1) === Token::EOF) {
		        		    $this->matchedEOF = true;
		        	    }

		        		$this->errorHandler->reportMatch($this);
		        		$this->consume();
		        	}
		        }
		        $this->setState(171);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 22, $this->ctx)) {
		            case 1:
		        	    $this->setState(170);
		        	    $this->match(self::NEWL);
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}
	}
}

namespace Assembler\Context {
	use Antlr\Antlr4\Runtime\ParserRuleContext;
	use Antlr\Antlr4\Runtime\Token;
	use Antlr\Antlr4\Runtime\Tree\ParseTreeVisitor;
	use Antlr\Antlr4\Runtime\Tree\TerminalNode;
	use Antlr\Antlr4\Runtime\Tree\ParseTreeListener;
	use Assembler\assembler3Parser;
	use Assembler\assembler3Visitor;

	class ProgContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return assembler3Parser::RULE_prog;
	    }

	    public function begin(): ?BeginContext
	    {
	    	return $this->getTypedRuleContext(BeginContext::class, 0);
	    }

	    public function lines(): ?LinesContext
	    {
	    	return $this->getTypedRuleContext(LinesContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof assembler3Visitor) {
			    return $visitor->visitProg($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class BeginContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return assembler3Parser::RULE_begin;
	    }
	 
		public function copyFrom(ParserRuleContext $context): void
		{
			parent::copyFrom($context);

		}
	}

	class BeginProgContext extends BeginContext
	{
		public function __construct(BeginContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function ID(): ?TerminalNode
	    {
	        return $this->getToken(assembler3Parser::ID, 0);
	    }

	    public function START(): ?TerminalNode
	    {
	        return $this->getToken(assembler3Parser::START, 0);
	    }

	    public function NUM(): ?TerminalNode
	    {
	        return $this->getToken(assembler3Parser::NUM, 0);
	    }

	    public function NEWL(): ?TerminalNode
	    {
	        return $this->getToken(assembler3Parser::NEWL, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof assembler3Visitor) {
			    return $visitor->visitBeginProg($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class LinesContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return assembler3Parser::RULE_lines;
	    }

	    /**
	     * @return array<LineContext>|LineContext|null
	     */
	    public function line(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(LineContext::class);
	    	}

	        return $this->getTypedRuleContext(LineContext::class, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function NEWL(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(assembler3Parser::NEWL);
	    	}

	        return $this->getToken(assembler3Parser::NEWL, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof assembler3Visitor) {
			    return $visitor->visitLines($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class LineContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return assembler3Parser::RULE_line;
	    }
	 
		public function copyFrom(ParserRuleContext $context): void
		{
			parent::copyFrom($context);

		}
	}

	class InstructionOptContext extends LineContext
	{
		public function __construct(LineContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function instruction(): ?InstructionContext
	    {
	    	return $this->getTypedRuleContext(InstructionContext::class, 0);
	    }

	    public function ID(): ?TerminalNode
	    {
	        return $this->getToken(assembler3Parser::ID, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof assembler3Visitor) {
			    return $visitor->visitInstructionOpt($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class CommaMissingContext extends LineContext
	{
		public function __construct(LineContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function ID(): ?TerminalNode
	    {
	        return $this->getToken(assembler3Parser::ID, 0);
	    }

	    public function comma_missing(): ?Comma_missingContext
	    {
	    	return $this->getTypedRuleContext(Comma_missingContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof assembler3Visitor) {
			    return $visitor->visitCommaMissing($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class DirectiveOptContext extends LineContext
	{
		public function __construct(LineContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function directive(): ?DirectiveContext
	    {
	    	return $this->getTypedRuleContext(DirectiveContext::class, 0);
	    }

	    public function ID(): ?TerminalNode
	    {
	        return $this->getToken(assembler3Parser::ID, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof assembler3Visitor) {
			    return $visitor->visitDirectiveOpt($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class BothMissingContext extends LineContext
	{
		public function __construct(LineContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function both_missing(): ?Both_missingContext
	    {
	    	return $this->getTypedRuleContext(Both_missingContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof assembler3Visitor) {
			    return $visitor->visitBothMissing($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class EndOptContext extends LineContext
	{
		public function __construct(LineContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function end(): ?EndContext
	    {
	    	return $this->getTypedRuleContext(EndContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof assembler3Visitor) {
			    return $visitor->visitEndOpt($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class Op1MissingContext extends LineContext
	{
		public function __construct(LineContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function op1_missing(): ?Op1_missingContext
	    {
	    	return $this->getTypedRuleContext(Op1_missingContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof assembler3Visitor) {
			    return $visitor->visitOp1Missing($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class Op2MissingContext extends LineContext
	{
		public function __construct(LineContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function op2_missing(): ?Op2_missingContext
	    {
	    	return $this->getTypedRuleContext(Op2_missingContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof assembler3Visitor) {
			    return $visitor->visitOp2Missing($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class OneOpCodeContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return assembler3Parser::RULE_oneOpCode;
	    }

	    public function ID(): ?TerminalNode
	    {
	        return $this->getToken(assembler3Parser::ID, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof assembler3Visitor) {
			    return $visitor->visitOneOpCode($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class InstructionContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return assembler3Parser::RULE_instruction;
	    }
	 
		public function copyFrom(ParserRuleContext $context): void
		{
			parent::copyFrom($context);

		}
	}

	class Instruction_Context extends InstructionContext
	{
		/**
		 * @var Token|null $op1
		 */
		public $op1;

		/**
		 * @var Token|null $op2
		 */
		public $op2;

		public function __construct(InstructionContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function ID(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(assembler3Parser::ID);
	    	}

	        return $this->getToken(assembler3Parser::ID, $index);
	    }

	    public function PLUS(): ?TerminalNode
	    {
	        return $this->getToken(assembler3Parser::PLUS, 0);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function NUM(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(assembler3Parser::NUM);
	    	}

	        return $this->getToken(assembler3Parser::NUM, $index);
	    }

	    public function COMMA(): ?TerminalNode
	    {
	        return $this->getToken(assembler3Parser::COMMA, 0);
	    }

	    public function AT(): ?TerminalNode
	    {
	        return $this->getToken(assembler3Parser::AT, 0);
	    }

	    public function HASH(): ?TerminalNode
	    {
	        return $this->getToken(assembler3Parser::HASH, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof assembler3Visitor) {
			    return $visitor->visitInstruction_($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class Op1_missingContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return assembler3Parser::RULE_op1_missing;
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function ID(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(assembler3Parser::ID);
	    	}

	        return $this->getToken(assembler3Parser::ID, $index);
	    }

	    public function no_op1(): ?No_op1Context
	    {
	    	return $this->getTypedRuleContext(No_op1Context::class, 0);
	    }

	    public function COMMA(): ?TerminalNode
	    {
	        return $this->getToken(assembler3Parser::COMMA, 0);
	    }

	    public function NUM(): ?TerminalNode
	    {
	        return $this->getToken(assembler3Parser::NUM, 0);
	    }

	    public function PLUS(): ?TerminalNode
	    {
	        return $this->getToken(assembler3Parser::PLUS, 0);
	    }

	    public function AT(): ?TerminalNode
	    {
	        return $this->getToken(assembler3Parser::AT, 0);
	    }

	    public function HASH(): ?TerminalNode
	    {
	        return $this->getToken(assembler3Parser::HASH, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof assembler3Visitor) {
			    return $visitor->visitOp1_missing($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class Op2_missingContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return assembler3Parser::RULE_op2_missing;
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function ID(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(assembler3Parser::ID);
	    	}

	        return $this->getToken(assembler3Parser::ID, $index);
	    }

	    public function COMMA(): ?TerminalNode
	    {
	        return $this->getToken(assembler3Parser::COMMA, 0);
	    }

	    public function no_op2(): ?No_op2Context
	    {
	    	return $this->getTypedRuleContext(No_op2Context::class, 0);
	    }

	    public function NUM(): ?TerminalNode
	    {
	        return $this->getToken(assembler3Parser::NUM, 0);
	    }

	    public function PLUS(): ?TerminalNode
	    {
	        return $this->getToken(assembler3Parser::PLUS, 0);
	    }

	    public function AT(): ?TerminalNode
	    {
	        return $this->getToken(assembler3Parser::AT, 0);
	    }

	    public function HASH(): ?TerminalNode
	    {
	        return $this->getToken(assembler3Parser::HASH, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof assembler3Visitor) {
			    return $visitor->visitOp2_missing($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class Both_missingContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return assembler3Parser::RULE_both_missing;
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function ID(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(assembler3Parser::ID);
	    	}

	        return $this->getToken(assembler3Parser::ID, $index);
	    }

	    /**
	     * @return array<No_op2Context>|No_op2Context|null
	     */
	    public function no_op2(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(No_op2Context::class);
	    	}

	        return $this->getTypedRuleContext(No_op2Context::class, $index);
	    }

	    public function COMMA(): ?TerminalNode
	    {
	        return $this->getToken(assembler3Parser::COMMA, 0);
	    }

	    public function PLUS(): ?TerminalNode
	    {
	        return $this->getToken(assembler3Parser::PLUS, 0);
	    }

	    public function AT(): ?TerminalNode
	    {
	        return $this->getToken(assembler3Parser::AT, 0);
	    }

	    public function HASH(): ?TerminalNode
	    {
	        return $this->getToken(assembler3Parser::HASH, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof assembler3Visitor) {
			    return $visitor->visitBoth_missing($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class Comma_missingContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return assembler3Parser::RULE_comma_missing;
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function ID(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(assembler3Parser::ID);
	    	}

	        return $this->getToken(assembler3Parser::ID, $index);
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function NUM(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(assembler3Parser::NUM);
	    	}

	        return $this->getToken(assembler3Parser::NUM, $index);
	    }

	    public function PLUS(): ?TerminalNode
	    {
	        return $this->getToken(assembler3Parser::PLUS, 0);
	    }

	    public function AT(): ?TerminalNode
	    {
	        return $this->getToken(assembler3Parser::AT, 0);
	    }

	    public function HASH(): ?TerminalNode
	    {
	        return $this->getToken(assembler3Parser::HASH, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof assembler3Visitor) {
			    return $visitor->visitComma_missing($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class No_op1Context extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return assembler3Parser::RULE_no_op1;
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof assembler3Visitor) {
			    return $visitor->visitNo_op1($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class No_op2Context extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return assembler3Parser::RULE_no_op2;
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof assembler3Visitor) {
			    return $visitor->visitNo_op2($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class No_commaContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return assembler3Parser::RULE_no_comma;
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof assembler3Visitor) {
			    return $visitor->visitNo_comma($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class DirectiveContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return assembler3Parser::RULE_directive;
	    }
	 
		public function copyFrom(ParserRuleContext $context): void
		{
			parent::copyFrom($context);

		}
	}

	class Directive_Context extends DirectiveContext
	{
		public function __construct(DirectiveContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function type(): ?TypeContext
	    {
	    	return $this->getTypedRuleContext(TypeContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof assembler3Visitor) {
			    return $visitor->visitDirective_($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class TypeContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return assembler3Parser::RULE_type;
	    }
	 
		public function copyFrom(ParserRuleContext $context): void
		{
			parent::copyFrom($context);

		}
	}

	class ReswContext extends TypeContext
	{
		public function __construct(TypeContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function RESW(): ?TerminalNode
	    {
	        return $this->getToken(assembler3Parser::RESW, 0);
	    }

	    public function NUM(): ?TerminalNode
	    {
	        return $this->getToken(assembler3Parser::NUM, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof assembler3Visitor) {
			    return $visitor->visitResw($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class ByteContext extends TypeContext
	{
		public function __construct(TypeContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function BYTE(): ?TerminalNode
	    {
	        return $this->getToken(assembler3Parser::BYTE, 0);
	    }

	    public function CONS(): ?TerminalNode
	    {
	        return $this->getToken(assembler3Parser::CONS, 0);
	    }

	    public function CONSX(): ?TerminalNode
	    {
	        return $this->getToken(assembler3Parser::CONSX, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof assembler3Visitor) {
			    return $visitor->visitByte($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class ResbContext extends TypeContext
	{
		public function __construct(TypeContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function RESB(): ?TerminalNode
	    {
	        return $this->getToken(assembler3Parser::RESB, 0);
	    }

	    public function NUM(): ?TerminalNode
	    {
	        return $this->getToken(assembler3Parser::NUM, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof assembler3Visitor) {
			    return $visitor->visitResb($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class WordContext extends TypeContext
	{
		public function __construct(TypeContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function WORD(): ?TerminalNode
	    {
	        return $this->getToken(assembler3Parser::WORD, 0);
	    }

	    public function NUM(): ?TerminalNode
	    {
	        return $this->getToken(assembler3Parser::NUM, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof assembler3Visitor) {
			    return $visitor->visitWord($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class ByteErrorContext extends TypeContext
	{
		public function __construct(TypeContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function BYTE(): ?TerminalNode
	    {
	        return $this->getToken(assembler3Parser::BYTE, 0);
	    }

	    public function ERRCONS(): ?TerminalNode
	    {
	        return $this->getToken(assembler3Parser::ERRCONS, 0);
	    }

	    public function ERRCONSX(): ?TerminalNode
	    {
	        return $this->getToken(assembler3Parser::ERRCONSX, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof assembler3Visitor) {
			    return $visitor->visitByteError($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class BaseContext extends TypeContext
	{
		public function __construct(TypeContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function BASE(): ?TerminalNode
	    {
	        return $this->getToken(assembler3Parser::BASE, 0);
	    }

	    public function ID(): ?TerminalNode
	    {
	        return $this->getToken(assembler3Parser::ID, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof assembler3Visitor) {
			    return $visitor->visitBase($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class EndContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return assembler3Parser::RULE_end;
	    }
	 
		public function copyFrom(ParserRuleContext $context): void
		{
			parent::copyFrom($context);

		}
	}

	class EndProgContext extends EndContext
	{
		public function __construct(EndContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function END(): ?TerminalNode
	    {
	        return $this->getToken(assembler3Parser::END, 0);
	    }

	    public function NEWL(): ?TerminalNode
	    {
	        return $this->getToken(assembler3Parser::NEWL, 0);
	    }

	    public function ID(): ?TerminalNode
	    {
	        return $this->getToken(assembler3Parser::ID, 0);
	    }

	    public function NUM(): ?TerminalNode
	    {
	        return $this->getToken(assembler3Parser::NUM, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof assembler3Visitor) {
			    return $visitor->visitEndProg($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 
}