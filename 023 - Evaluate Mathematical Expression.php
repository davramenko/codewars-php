<?php

// Evaluate mathematical expression

class calculator {
	const NAME = "n";
	const NUMBER = "#";
	const END = '$';
	const PLUS = '+';
	const MINUS = '-';
	const MUL = '*';
	const DIV = '/';
	const PRINT = ';';
	const ASSIGN = '=';
	const LP = '(';
	const RP = ')';
	const NUM0 = '0';
	const NUM1 = '1';
	const NUM2 = '2';
	const NUM3 = '3';
	const NUM4 = '4';
	const NUM5 = '5';
	const NUM6 = '6';
	const NUM7 = '7';
	const NUM8 = '8';
	const NUM9 = '9';
	const NUMP = '.';

	private $_curr_tok = self::PRINT;
	private $_number_value = 0;
	private $_string_value = "";
	private $_table = [];
	private $_no_of_errors = 0;
	private $_input = "";
	private $_ipos = 0;

	public function __construct($expression) {
		$this->_input = $expression;
		$this->_ipos = 0;
	}

	private function error($error_message) {
		$this->no_of_errors++;
		echo "$error_message\n";
		return false;
	}

	private function get_token() {
		$ch = '';
		do {
			if ($this->_ipos >= strlen($this->_input)) {
				return ($this->_curr_tok = self::END);
			}
			$ch = $this->_input[$this->_ipos];
			$this->_ipos++;
		} while ($ch != "\n" && ctype_space($ch));

		switch ($ch) {
			case '':
				return ($this->_curr_tok = self::END);
			case "\n":
			case self::PRINT:
				//echo "token: PRINT\n";
				return ($this->_curr_tok = self::PRINT);
			case self::MUL:
			case self::DIV:
			case self::PLUS:
			case self::MINUS:
			case self::LP:
			case self::RP:
			case self::ASSIGN:
				//echo "token: [$ch]\n";
				return ($this->_curr_tok = $ch);
			case self::NUM0:
			case self::NUM1:
			case self::NUM2:
			case self::NUM3:
			case self::NUM4:
			case self::NUM5:
			case self::NUM6:
			case self::NUM7:
			case self::NUM8:
			case self::NUM9:
			case self::NUMP:
				$this->_number_value = $ch;
				while (true) {
					if ($this->_ipos >= strlen($this->_input)) {
						break;
					}
					$chn = $this->_input[$this->_ipos];
					if (!ctype_digit($chn) && $chn != '.')
						break;
					$this->_ipos++;
					$this->_number_value .= $chn;
				}
				//echo "token: NUMBER[" . $this->_number_value . "]\n";
				return ($this->_curr_tok = self::NUMBER);
			default:
				if (ctype_alpha($ch)) {
					$this->_string_value = $ch;
					while (true) {
						if ($this->_ipos >= strlen($this->_input)) {
							break;
						}
						$chan = $this->_input[$this->_ipos];
						if (!ctype_alnum($chan))
							break;
						$this->_ipos++;
						$this->_string_value .= $chan;
					}
					//echo "token: NAME[" . $this->_string_value . "]\n";
					return ($this->_curr_tok = self::NAME);
				}
				return $this->error("Bad Token: \"$ch" . substr($this->_input, $this->_ipos) . "\"");
		}
	}

	private function prim($fget) {
		if ($fget) {
			if ($this->get_token() === false)
				return false;
		}

		$val = 0;
		$token = '';
		switch ($this->_curr_tok) {
			case self::NUMBER:
				$val = floatval($this->_number_value);
				if ($this->get_token() === false)
					return false;
				return $val;
			case self::NAME:
				$val = $this->_table[$this->_string_value];
				if (($token = $this->get_token()) === false)
					return false;
				if ($token == self::ASSIGN) {
					$val = $this->expr(true);
					$this->_table[$this->_string_value] = $val;
				}
				return floatval($val);
			case self::MINUS:
				if (($val = $this->prim(true)) === false)
					return $val;
				return -$val;
			case self::LP:
				if (($val = $this->expr(true)) === false)
					return false;
				if ($this->_curr_tok != self::RP) {
					return error("')' expected: \"" . $this->_curr_tok . substr($this->_input, $this->_ipos) . "\"");
				}
				if ($this->get_token() === false)
					return false;
				return floatval($val);
			default:
				return error("primary expected: \"" . $this->_curr_tok . substr($this->_input, $this->_ipos) . "\"");
		}
	}

	private function term($fget) {
		$left = $this->prim($fget);
		if ($left === false)
			return false;

		while (true) {
			$val = 0;
			switch ($this->_curr_tok) {
				case self::MUL:
					if (($val = $this->prim(true)) === false)
						return false;
					//echo "term: $left * $val\n";
					$left *= $val;
			        break;
				case self::DIV:
					if (($val = $this->prim(true)) === false)
						return false;
					if ($val != 0) {
						$left /= $val;
						//echo "term: $left / $val\n";
						break;
					}
					return error("Divide by 0: \"" . $this->_curr_tok . substr($this->_input, $this->_ipos) . "\"");
				default:
					//echo "term: res: $left\n";
					return floatval($left);
			}
		}
	}

	private function expr($fget) {
		$left = $this->term($fget);
		if ($left === false)
			return false;

		while (true) {
			$val = 0;
			switch ($this->_curr_tok) {
				case self::PLUS:
					if (($val = $this->term(true)) === false)
						return false;
					//echo "expr: $left + $val\n";
					$left += $val;
			        break;
				case self::MINUS:
					if (($val = $this->term(true)) === false)
						return false;
					//echo "expr: $left - $val\n";
					$left -= $val;
					break;
				default:
					//echo "expr: res: $left\n";
					return floatval($left);
			}
		}
	}

	public function Its_not_a_fucking_forbidden_method() {
		$this->_table["pi"] = 3.1415926535897932385;
		$this->_table["e"] = 2.7182818284590452354;

		$res = false;
		while ($this->_ipos < strlen($this->_input)) {
			if ($this->get_token() === false)
				break;
			if ($this->_curr_tok == self::END)
				break;
			if ($this->_curr_tok == self::PRINT)
				continue;

			$res = $this->expr(false);
		}
		return $res;
	}
}

function calc(string $expression): float {
	$calculator = new calculator($expression);
	return $calculator->Its_not_a_fucking_forbidden_method();
}

echo calc('1+1') . "\n";
echo calc('1 - 1') . "\n";
echo calc('1* 1') . "\n";
echo calc('1 /1') . "\n";
echo calc('-123') . "\n";
echo calc('123') . "\n";
echo calc('2 /2+3 * 4.75- -6') . "\n";
echo calc('12* 123') . "\n";
echo calc('2 / (2 + 3) * 4.33 - -6') . "\n";

?>