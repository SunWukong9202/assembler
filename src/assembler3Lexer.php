<?php

/*
 * Generated from assembler3.g4 by ANTLR 4.13.1
 */

namespace Assembler {
	use Antlr\Antlr4\Runtime\Atn\ATNDeserializer;
	use Antlr\Antlr4\Runtime\Atn\LexerATNSimulator;
	use Antlr\Antlr4\Runtime\Lexer;
	use Antlr\Antlr4\Runtime\CharStream;
	use Antlr\Antlr4\Runtime\PredictionContexts\PredictionContextCache;
	use Antlr\Antlr4\Runtime\RuleContext;
	use Antlr\Antlr4\Runtime\Atn\ATN;
	use Antlr\Antlr4\Runtime\Dfa\DFA;
	use Antlr\Antlr4\Runtime\Vocabulary;
	use Antlr\Antlr4\Runtime\RuntimeMetaData;
	use Antlr\Antlr4\Runtime\VocabularyImpl;

	final class assembler3Lexer extends Lexer
	{
		public const START = 1, END = 2, BYTE = 3, WORD = 4, RESB = 5, RESW = 6, 
               PLUS = 7, HASH = 8, AT = 9, COMMA = 10, BASE = 11, CONS = 12, 
               CONSX = 13, ERRCONS = 14, ERRCONSX = 15, ID = 16, OPCODE = 17, 
               NUM = 18, NEWL = 19, WS = 20;

		/**
		 * @var array<string>
		 */
		public const CHANNEL_NAMES = [
			'DEFAULT_TOKEN_CHANNEL', 'HIDDEN'
		];

		/**
		 * @var array<string>
		 */
		public const MODE_NAMES = [
			'DEFAULT_MODE'
		];

		/**
		 * @var array<string>
		 */
		public const RULE_NAMES = [
			'START', 'END', 'BYTE', 'WORD', 'RESB', 'RESW', 'PLUS', 'HASH', 'AT', 
			'COMMA', 'BASE', 'CONS', 'CONSX', 'ERRCONS', 'ERRCONSX', 'ID', 'OPCODE', 
			'NUM', 'NEWL', 'WS'
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
			[4, 0, 20, 193, 6, -1, 2, 0, 7, 0, 2, 1, 7, 1, 2, 2, 7, 2, 2, 3, 7, 3, 
		    2, 4, 7, 4, 2, 5, 7, 5, 2, 6, 7, 6, 2, 7, 7, 7, 2, 8, 7, 8, 2, 9, 
		    7, 9, 2, 10, 7, 10, 2, 11, 7, 11, 2, 12, 7, 12, 2, 13, 7, 13, 2, 14, 
		    7, 14, 2, 15, 7, 15, 2, 16, 7, 16, 2, 17, 7, 17, 2, 18, 7, 18, 2, 
		    19, 7, 19, 1, 0, 1, 0, 1, 0, 1, 0, 1, 0, 1, 0, 1, 1, 1, 1, 1, 1, 1, 
		    1, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 3, 1, 3, 1, 3, 1, 3, 1, 3, 1, 
		    4, 1, 4, 1, 4, 1, 4, 1, 4, 1, 5, 1, 5, 1, 5, 1, 5, 1, 5, 1, 6, 1, 
		    6, 1, 7, 1, 7, 1, 8, 1, 8, 1, 9, 1, 9, 1, 10, 1, 10, 1, 10, 1, 10, 
		    1, 10, 1, 11, 1, 11, 1, 11, 1, 11, 4, 11, 89, 8, 11, 11, 11, 12, 11, 
		    90, 1, 11, 1, 11, 1, 12, 1, 12, 1, 12, 1, 12, 4, 12, 99, 8, 12, 11, 
		    12, 12, 12, 100, 1, 12, 1, 12, 1, 13, 1, 13, 1, 13, 4, 13, 108, 8, 
		    13, 11, 13, 12, 13, 109, 1, 13, 1, 13, 1, 13, 1, 13, 4, 13, 116, 8, 
		    13, 11, 13, 12, 13, 117, 1, 13, 4, 13, 121, 8, 13, 11, 13, 12, 13, 
		    122, 1, 13, 3, 13, 126, 8, 13, 3, 13, 128, 8, 13, 1, 14, 1, 14, 1, 
		    14, 4, 14, 133, 8, 14, 11, 14, 12, 14, 134, 1, 14, 1, 14, 1, 14, 1, 
		    14, 4, 14, 141, 8, 14, 11, 14, 12, 14, 142, 1, 14, 4, 14, 146, 8, 
		    14, 11, 14, 12, 14, 147, 1, 14, 3, 14, 151, 8, 14, 3, 14, 153, 8, 
		    14, 1, 15, 4, 15, 156, 8, 15, 11, 15, 12, 15, 157, 1, 15, 5, 15, 161, 
		    8, 15, 10, 15, 12, 15, 164, 9, 15, 1, 16, 4, 16, 167, 8, 16, 11, 16, 
		    12, 16, 168, 1, 17, 4, 17, 172, 8, 17, 11, 17, 12, 17, 173, 1, 17, 
		    3, 17, 177, 8, 17, 1, 18, 3, 18, 180, 8, 18, 1, 18, 4, 18, 183, 8, 
		    18, 11, 18, 12, 18, 184, 1, 19, 4, 19, 188, 8, 19, 11, 19, 12, 19, 
		    189, 1, 19, 1, 19, 0, 0, 20, 1, 1, 3, 2, 5, 3, 7, 4, 9, 5, 11, 6, 
		    13, 7, 15, 8, 17, 9, 19, 10, 21, 11, 23, 12, 25, 13, 27, 14, 29, 15, 
		    31, 16, 33, 17, 35, 18, 37, 19, 39, 20, 1, 0, 8, 3, 0, 48, 57, 65, 
		    90, 97, 122, 2, 0, 48, 57, 65, 70, 3, 0, 65, 66, 68, 90, 97, 122, 
		    2, 0, 65, 90, 97, 122, 3, 0, 65, 87, 89, 90, 97, 122, 1, 0, 65, 90, 
		    1, 0, 48, 57, 2, 0, 9, 9, 32, 32, 212, 0, 1, 1, 0, 0, 0, 0, 3, 1, 
		    0, 0, 0, 0, 5, 1, 0, 0, 0, 0, 7, 1, 0, 0, 0, 0, 9, 1, 0, 0, 0, 0, 
		    11, 1, 0, 0, 0, 0, 13, 1, 0, 0, 0, 0, 15, 1, 0, 0, 0, 0, 17, 1, 0, 
		    0, 0, 0, 19, 1, 0, 0, 0, 0, 21, 1, 0, 0, 0, 0, 23, 1, 0, 0, 0, 0, 
		    25, 1, 0, 0, 0, 0, 27, 1, 0, 0, 0, 0, 29, 1, 0, 0, 0, 0, 31, 1, 0, 
		    0, 0, 0, 33, 1, 0, 0, 0, 0, 35, 1, 0, 0, 0, 0, 37, 1, 0, 0, 0, 0, 
		    39, 1, 0, 0, 0, 1, 41, 1, 0, 0, 0, 3, 47, 1, 0, 0, 0, 5, 51, 1, 0, 
		    0, 0, 7, 56, 1, 0, 0, 0, 9, 61, 1, 0, 0, 0, 11, 66, 1, 0, 0, 0, 13, 
		    71, 1, 0, 0, 0, 15, 73, 1, 0, 0, 0, 17, 75, 1, 0, 0, 0, 19, 77, 1, 
		    0, 0, 0, 21, 79, 1, 0, 0, 0, 23, 84, 1, 0, 0, 0, 25, 94, 1, 0, 0, 
		    0, 27, 127, 1, 0, 0, 0, 29, 152, 1, 0, 0, 0, 31, 155, 1, 0, 0, 0, 
		    33, 166, 1, 0, 0, 0, 35, 171, 1, 0, 0, 0, 37, 182, 1, 0, 0, 0, 39, 
		    187, 1, 0, 0, 0, 41, 42, 5, 83, 0, 0, 42, 43, 5, 84, 0, 0, 43, 44, 
		    5, 65, 0, 0, 44, 45, 5, 82, 0, 0, 45, 46, 5, 84, 0, 0, 46, 2, 1, 0, 
		    0, 0, 47, 48, 5, 69, 0, 0, 48, 49, 5, 78, 0, 0, 49, 50, 5, 68, 0, 
		    0, 50, 4, 1, 0, 0, 0, 51, 52, 5, 66, 0, 0, 52, 53, 5, 89, 0, 0, 53, 
		    54, 5, 84, 0, 0, 54, 55, 5, 69, 0, 0, 55, 6, 1, 0, 0, 0, 56, 57, 5, 
		    87, 0, 0, 57, 58, 5, 79, 0, 0, 58, 59, 5, 82, 0, 0, 59, 60, 5, 68, 
		    0, 0, 60, 8, 1, 0, 0, 0, 61, 62, 5, 82, 0, 0, 62, 63, 5, 69, 0, 0, 
		    63, 64, 5, 83, 0, 0, 64, 65, 5, 66, 0, 0, 65, 10, 1, 0, 0, 0, 66, 
		    67, 5, 82, 0, 0, 67, 68, 5, 69, 0, 0, 68, 69, 5, 83, 0, 0, 69, 70, 
		    5, 87, 0, 0, 70, 12, 1, 0, 0, 0, 71, 72, 5, 43, 0, 0, 72, 14, 1, 0, 
		    0, 0, 73, 74, 5, 35, 0, 0, 74, 16, 1, 0, 0, 0, 75, 76, 5, 64, 0, 0, 
		    76, 18, 1, 0, 0, 0, 77, 78, 5, 44, 0, 0, 78, 20, 1, 0, 0, 0, 79, 80, 
		    5, 66, 0, 0, 80, 81, 5, 65, 0, 0, 81, 82, 5, 83, 0, 0, 82, 83, 5, 
		    69, 0, 0, 83, 22, 1, 0, 0, 0, 84, 85, 5, 67, 0, 0, 85, 86, 5, 39, 
		    0, 0, 86, 88, 1, 0, 0, 0, 87, 89, 7, 0, 0, 0, 88, 87, 1, 0, 0, 0, 
		    89, 90, 1, 0, 0, 0, 90, 88, 1, 0, 0, 0, 90, 91, 1, 0, 0, 0, 91, 92, 
		    1, 0, 0, 0, 92, 93, 5, 39, 0, 0, 93, 24, 1, 0, 0, 0, 94, 95, 5, 88, 
		    0, 0, 95, 96, 5, 39, 0, 0, 96, 98, 1, 0, 0, 0, 97, 99, 7, 1, 0, 0, 
		    98, 97, 1, 0, 0, 0, 99, 100, 1, 0, 0, 0, 100, 98, 1, 0, 0, 0, 100, 
		    101, 1, 0, 0, 0, 101, 102, 1, 0, 0, 0, 102, 103, 5, 39, 0, 0, 103, 
		    26, 1, 0, 0, 0, 104, 105, 7, 2, 0, 0, 105, 107, 5, 39, 0, 0, 106, 
		    108, 7, 0, 0, 0, 107, 106, 1, 0, 0, 0, 108, 109, 1, 0, 0, 0, 109, 
		    107, 1, 0, 0, 0, 109, 110, 1, 0, 0, 0, 110, 111, 1, 0, 0, 0, 111, 
		    128, 5, 39, 0, 0, 112, 125, 7, 3, 0, 0, 113, 115, 5, 39, 0, 0, 114, 
		    116, 7, 0, 0, 0, 115, 114, 1, 0, 0, 0, 116, 117, 1, 0, 0, 0, 117, 
		    115, 1, 0, 0, 0, 117, 118, 1, 0, 0, 0, 118, 126, 1, 0, 0, 0, 119, 
		    121, 7, 0, 0, 0, 120, 119, 1, 0, 0, 0, 121, 122, 1, 0, 0, 0, 122, 
		    120, 1, 0, 0, 0, 122, 123, 1, 0, 0, 0, 123, 124, 1, 0, 0, 0, 124, 
		    126, 5, 39, 0, 0, 125, 113, 1, 0, 0, 0, 125, 120, 1, 0, 0, 0, 126, 
		    128, 1, 0, 0, 0, 127, 104, 1, 0, 0, 0, 127, 112, 1, 0, 0, 0, 128, 
		    28, 1, 0, 0, 0, 129, 130, 7, 4, 0, 0, 130, 132, 5, 39, 0, 0, 131, 
		    133, 7, 0, 0, 0, 132, 131, 1, 0, 0, 0, 133, 134, 1, 0, 0, 0, 134, 
		    132, 1, 0, 0, 0, 134, 135, 1, 0, 0, 0, 135, 136, 1, 0, 0, 0, 136, 
		    153, 5, 39, 0, 0, 137, 150, 7, 3, 0, 0, 138, 140, 5, 39, 0, 0, 139, 
		    141, 7, 0, 0, 0, 140, 139, 1, 0, 0, 0, 141, 142, 1, 0, 0, 0, 142, 
		    140, 1, 0, 0, 0, 142, 143, 1, 0, 0, 0, 143, 151, 1, 0, 0, 0, 144, 
		    146, 7, 0, 0, 0, 145, 144, 1, 0, 0, 0, 146, 147, 1, 0, 0, 0, 147, 
		    145, 1, 0, 0, 0, 147, 148, 1, 0, 0, 0, 148, 149, 1, 0, 0, 0, 149, 
		    151, 5, 39, 0, 0, 150, 138, 1, 0, 0, 0, 150, 145, 1, 0, 0, 0, 151, 
		    153, 1, 0, 0, 0, 152, 129, 1, 0, 0, 0, 152, 137, 1, 0, 0, 0, 153, 
		    30, 1, 0, 0, 0, 154, 156, 7, 5, 0, 0, 155, 154, 1, 0, 0, 0, 156, 157, 
		    1, 0, 0, 0, 157, 155, 1, 0, 0, 0, 157, 158, 1, 0, 0, 0, 158, 162, 
		    1, 0, 0, 0, 159, 161, 7, 6, 0, 0, 160, 159, 1, 0, 0, 0, 161, 164, 
		    1, 0, 0, 0, 162, 160, 1, 0, 0, 0, 162, 163, 1, 0, 0, 0, 163, 32, 1, 
		    0, 0, 0, 164, 162, 1, 0, 0, 0, 165, 167, 7, 5, 0, 0, 166, 165, 1, 
		    0, 0, 0, 167, 168, 1, 0, 0, 0, 168, 166, 1, 0, 0, 0, 168, 169, 1, 
		    0, 0, 0, 169, 34, 1, 0, 0, 0, 170, 172, 7, 6, 0, 0, 171, 170, 1, 0, 
		    0, 0, 172, 173, 1, 0, 0, 0, 173, 171, 1, 0, 0, 0, 173, 174, 1, 0, 
		    0, 0, 174, 176, 1, 0, 0, 0, 175, 177, 5, 72, 0, 0, 176, 175, 1, 0, 
		    0, 0, 176, 177, 1, 0, 0, 0, 177, 36, 1, 0, 0, 0, 178, 180, 5, 13, 
		    0, 0, 179, 178, 1, 0, 0, 0, 179, 180, 1, 0, 0, 0, 180, 181, 1, 0, 
		    0, 0, 181, 183, 5, 10, 0, 0, 182, 179, 1, 0, 0, 0, 183, 184, 1, 0, 
		    0, 0, 184, 182, 1, 0, 0, 0, 184, 185, 1, 0, 0, 0, 185, 38, 1, 0, 0, 
		    0, 186, 188, 7, 7, 0, 0, 187, 186, 1, 0, 0, 0, 188, 189, 1, 0, 0, 
		    0, 189, 187, 1, 0, 0, 0, 189, 190, 1, 0, 0, 0, 190, 191, 1, 0, 0, 
		    0, 191, 192, 6, 19, 0, 0, 192, 40, 1, 0, 0, 0, 21, 0, 90, 100, 109, 
		    117, 122, 125, 127, 134, 142, 147, 150, 152, 157, 162, 168, 173, 176, 
		    179, 184, 189, 1, 6, 0, 0];
		protected static $atn;
		protected static $decisionToDFA;
		protected static $sharedContextCache;
		public function __construct(CharStream $input)
		{
			parent::__construct($input);

			self::initialize();

			$this->interp = new LexerATNSimulator($this, self::$atn, self::$decisionToDFA, self::$sharedContextCache);
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

		public static function vocabulary(): Vocabulary
		{
			static $vocabulary;

			return $vocabulary = $vocabulary ?? new VocabularyImpl(self::LITERAL_NAMES, self::SYMBOLIC_NAMES);
		}

		public function getGrammarFileName(): string
		{
			return 'assembler3.g4';
		}

		public function getRuleNames(): array
		{
			return self::RULE_NAMES;
		}

		public function getSerializedATN(): array
		{
			return self::SERIALIZED_ATN;
		}

		/**
		 * @return array<string>
		 */
		public function getChannelNames(): array
		{
			return self::CHANNEL_NAMES;
		}

		/**
		 * @return array<string>
		 */
		public function getModeNames(): array
		{
			return self::MODE_NAMES;
		}

		public function getATN(): ATN
		{
			return self::$atn;
		}

		public function getVocabulary(): Vocabulary
		{
			return self::vocabulary();
		}
	}
}