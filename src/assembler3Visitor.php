<?php

/*
 * Generated from assembler3.g4 by ANTLR 4.13.1
 */

namespace Assembler;

use Antlr\Antlr4\Runtime\Tree\ParseTreeVisitor;

/**
 * This interface defines a complete generic visitor for a parse tree produced by {@see assembler3Parser}.
 */
interface assembler3Visitor extends ParseTreeVisitor
{
	/**
	 * Visit a parse tree produced by {@see assembler3Parser::prog()}.
	 *
	 * @param Context\ProgContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitProg(Context\ProgContext $context);

	/**
	 * Visit a parse tree produced by the `beginProg` labeled alternative
	 * in {@see assembler3Parser::begin()}.
	 *
	 * @param Context\BeginProgContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitBeginProg(Context\BeginProgContext $context);

	/**
	 * Visit a parse tree produced by {@see assembler3Parser::lines()}.
	 *
	 * @param Context\LinesContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitLines(Context\LinesContext $context);

	/**
	 * Visit a parse tree produced by the `commaMissing` labeled alternative
	 * in {@see assembler3Parser::line()}.
	 *
	 * @param Context\CommaMissingContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitCommaMissing(Context\CommaMissingContext $context);

	/**
	 * Visit a parse tree produced by the `instructionOpt` labeled alternative
	 * in {@see assembler3Parser::line()}.
	 *
	 * @param Context\InstructionOptContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitInstructionOpt(Context\InstructionOptContext $context);

	/**
	 * Visit a parse tree produced by the `directiveOpt` labeled alternative
	 * in {@see assembler3Parser::line()}.
	 *
	 * @param Context\DirectiveOptContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitDirectiveOpt(Context\DirectiveOptContext $context);

	/**
	 * Visit a parse tree produced by the `op1Missing` labeled alternative
	 * in {@see assembler3Parser::line()}.
	 *
	 * @param Context\Op1MissingContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitOp1Missing(Context\Op1MissingContext $context);

	/**
	 * Visit a parse tree produced by the `op2Missing` labeled alternative
	 * in {@see assembler3Parser::line()}.
	 *
	 * @param Context\Op2MissingContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitOp2Missing(Context\Op2MissingContext $context);

	/**
	 * Visit a parse tree produced by the `bothMissing` labeled alternative
	 * in {@see assembler3Parser::line()}.
	 *
	 * @param Context\BothMissingContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitBothMissing(Context\BothMissingContext $context);

	/**
	 * Visit a parse tree produced by the `endOpt` labeled alternative
	 * in {@see assembler3Parser::line()}.
	 *
	 * @param Context\EndOptContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitEndOpt(Context\EndOptContext $context);

	/**
	 * Visit a parse tree produced by {@see assembler3Parser::oneOpCode()}.
	 *
	 * @param Context\OneOpCodeContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitOneOpCode(Context\OneOpCodeContext $context);

	/**
	 * Visit a parse tree produced by the `instruction_` labeled alternative
	 * in {@see assembler3Parser::instruction()}.
	 *
	 * @param Context\Instruction_Context $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitInstruction_(Context\Instruction_Context $context);

	/**
	 * Visit a parse tree produced by {@see assembler3Parser::op1_missing()}.
	 *
	 * @param Context\Op1_missingContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitOp1_missing(Context\Op1_missingContext $context);

	/**
	 * Visit a parse tree produced by {@see assembler3Parser::op2_missing()}.
	 *
	 * @param Context\Op2_missingContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitOp2_missing(Context\Op2_missingContext $context);

	/**
	 * Visit a parse tree produced by {@see assembler3Parser::both_missing()}.
	 *
	 * @param Context\Both_missingContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitBoth_missing(Context\Both_missingContext $context);

	/**
	 * Visit a parse tree produced by {@see assembler3Parser::comma_missing()}.
	 *
	 * @param Context\Comma_missingContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitComma_missing(Context\Comma_missingContext $context);

	/**
	 * Visit a parse tree produced by {@see assembler3Parser::no_op1()}.
	 *
	 * @param Context\No_op1Context $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitNo_op1(Context\No_op1Context $context);

	/**
	 * Visit a parse tree produced by {@see assembler3Parser::no_op2()}.
	 *
	 * @param Context\No_op2Context $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitNo_op2(Context\No_op2Context $context);

	/**
	 * Visit a parse tree produced by {@see assembler3Parser::no_comma()}.
	 *
	 * @param Context\No_commaContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitNo_comma(Context\No_commaContext $context);

	/**
	 * Visit a parse tree produced by the `directive_` labeled alternative
	 * in {@see assembler3Parser::directive()}.
	 *
	 * @param Context\Directive_Context $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitDirective_(Context\Directive_Context $context);

	/**
	 * Visit a parse tree produced by the `byteError` labeled alternative
	 * in {@see assembler3Parser::type()}.
	 *
	 * @param Context\ByteErrorContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitByteError(Context\ByteErrorContext $context);

	/**
	 * Visit a parse tree produced by the `byte` labeled alternative
	 * in {@see assembler3Parser::type()}.
	 *
	 * @param Context\ByteContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitByte(Context\ByteContext $context);

	/**
	 * Visit a parse tree produced by the `word` labeled alternative
	 * in {@see assembler3Parser::type()}.
	 *
	 * @param Context\WordContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitWord(Context\WordContext $context);

	/**
	 * Visit a parse tree produced by the `resb` labeled alternative
	 * in {@see assembler3Parser::type()}.
	 *
	 * @param Context\ResbContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitResb(Context\ResbContext $context);

	/**
	 * Visit a parse tree produced by the `resw` labeled alternative
	 * in {@see assembler3Parser::type()}.
	 *
	 * @param Context\ReswContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitResw(Context\ReswContext $context);

	/**
	 * Visit a parse tree produced by the `base` labeled alternative
	 * in {@see assembler3Parser::type()}.
	 *
	 * @param Context\BaseContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitBase(Context\BaseContext $context);

	/**
	 * Visit a parse tree produced by the `endProg` labeled alternative
	 * in {@see assembler3Parser::end()}.
	 *
	 * @param Context\EndProgContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitEndProg(Context\EndProgContext $context);
}