<?php

// Befunge Interpreter

function interpret(string $code): string {
/*
	$befunge = new class($code) {

		private static $DIR_STOP = 0;
		private static $DIR_MIN = 1;
		private static $DIR_UP = 1;
		private static $DIR_RIGHT = 2;
		private static $DIR_DOWN = 3;
		private static $DIR_LEFT = 4;
		private static $DIR_MAX = 4;
		private $_direction = -1;
		private $_x = 0;
		private $_y = 0;
		private $_string_mode = false;
		private $_lines = [];
		private $_stack = null;
		private $_instructions = [];

		private function str_direction($v) {
			return ($v == self::$DIR_UP ? "up" : ($v == self::$DIR_RIGHT ? "right" : ($v == self::$DIR_DOWN ? "down" : ($v == self::$DIR_LEFT ? "left" : "unknown"))));
		}

		public function __construct($code) {

			$this->_direction = self::$DIR_RIGHT;

			if (strlen($code) > 0)
				$this->_lines = explode("\n", $code);

			$this->_stack = new class {

				private $arr = array();

				public function push($val) {
					array_push($this->arr, intval($val));
				}

				public function pop() {
					$val = 0;
					if (count($this->arr) > 0)
						$val = array_pop($this->arr);
					return $val;
				}

				public function peek() {
					$val = 0;
					if (count($this->arr) > 0)
						$val = intval($this->arr[count($this->arr) - 1]);
					return $val;
				}
			};

			$this->_instructions = [
				"0" => function() {
					echo "instruction: push(0)\n";
					$this->_stack->push(0);
					$this->move();
					return false;
				},
				"1" => function() {
					echo "instruction: push(1)\n";
					$this->_stack->push(1);
					$this->move();
					return false;
				},
				"2" => function() {
					echo "instruction: push(2)\n";
					$this->_stack->push(2);
					$this->move();
					return false;
				},
				"3" => function() {
					echo "instruction: push(3)\n";
					$this->_stack->push(3);
					$this->move();
					return false;
				},
				"4" => function() {
					echo "instruction: push(4)\n";
					$this->_stack->push(4);
					$this->move();
					return false;
				},
				"5" => function() {
					echo "instruction: push(5)\n";
					$this->_stack->push(5);
					$this->move();
					return false;
				},
				"6" => function() {
					echo "instruction: push(6)\n";
					$this->_stack->push(6);
					$this->move();
					return false;
				},
				"7" => function() {
					echo "instruction: push(7)\n";
					$this->_stack->push(7);
					$this->move();
					return false;
				},
				"8" => function() {
					echo "instruction: push(8)\n";
					$this->_stack->push(8);
					$this->move();
					return false;
				},
				"9" => function() {
					echo "instruction: push(9)\n";
					$this->_stack->push(9);
					$this->move();
					return false;
				},
				"+" => function() {
					$a = $this->_stack->pop();
					$b = $this->_stack->pop();
					echo "instruction: push($a + $b = " . ($a + $b) . ")\n";
					$this->_stack->push($a + $b);
					$this->move();
					return false;
				},
				"-" => function() {
					$a = $this->_stack->pop();
					$b = $this->_stack->pop();
					echo "instruction: push($b + $a = " . ($b - $a) . ")\n";
					$this->_stack->push($b - $a);
					$this->move();
					return false;
				},
				"*" => function() {
					$a = $this->_stack->pop();
					$b = $this->_stack->pop();
					echo "instruction: push($a * $b = " . ($a * $b) . ")\n";
					$this->_stack->push($a * $b);
					$this->move();
					return false;
				},
				"/" => function() {
					$a = $this->_stack->pop();
					$b = $this->_stack->pop();
					$v = ($a === 0 ? 0 : intval($b / $a));
					echo "instruction: push($a / $b = $v)\n";
					$this->_stack->push($v);
					$this->move();
					return false;
				},
				"%" => function() {
					$a = $this->_stack->pop();
					$b = $this->_stack->pop();
					$v = ($a === 0 ? 0 : $b % $a);
					echo "instruction: push($a % $b = $v)\n";
					$this->_stack->push($v);
					$this->move();
					return false;
				},
				"!" => function() {
					$a = $this->_stack->pop();
					$v = ($a === 0 ? 1 : 0);
					echo "instruction: push(!$a = $v)\n";
					$this->_stack->push($v);
					$this->move();
					return false;
				},
				"`" => function() {
					$a = $this->_stack->pop();
					$b = $this->_stack->pop();
					$v = ($b > $a ? 1 : 0);
					echo "instruction: push($b > $a = $v)\n";
					$this->_stack->push($v);
					$this->move();
					return false;
				},
				">" => function() {
					echo "instruction: set direction: right\n";
					$this->_direction = self::$DIR_RIGHT;
					$this->move();
					return false;
				},
				"<" => function() {
					echo "instruction: set direction: left\n";
					$this->_direction = self::$DIR_LEFT;
					$this->move();
					return false;
				},
				"^" => function() {
					echo "instruction: set direction: up\n";
					$this->_direction = self::$DIR_UP;
					$this->move();
					return false;
				},
				"V" => function() {
					echo "instruction: set direction: down\n";
					$this->_direction = self::$DIR_DOWN;
					$this->move();
					return false;
				},
				"v" => function() {
					echo "instruction: set direction: down\n";
					$this->_direction = self::$DIR_DOWN;
					$this->move();
					return false;
				},
				"?" => function() {
					$v = rand(self::$DIR_MIN, self::$DIR_MAX);
					echo "instruction: set direction: random(" . $this->str_direction($v) . ")\n";
					$this->_direction = $v;
					$this->move();
					return false;
				},
				"_" => function() {
					$a = $this->_stack->pop();
					$v = (($a === 0) ? self::$DIR_RIGHT : self::$DIR_LEFT);
					echo "instruction: set direction/_/: $a == 0 (" . $this->str_direction($v) . ")\n";
					$this->_direction = $v;
					$this->move();
					return false;
				},
				"|" => function() {
					$a = $this->_stack->pop();
					$v = (($a === 0) ? self::$DIR_DOWN : self::$DIR_UP);
					echo "instruction: set direction/|/: $a == 0 (" . $this->str_direction($v) . ")\n";
					$this->_direction = $v;
					$this->move();
					return false;
				},
				'"' => function() {
					echo "instruction: set string mode\n";
					$this->_string_mode = true;
					$this->move();
					return false;
				},
				":" => function() {
					$a = $this->_stack->peek();
					echo "instruction: duplicate: $a\n";
					$this->_stack->push($a);
					$this->move();
					return false;
				},
				"\\" => function() {
					$a = $this->_stack->pop();
					$b = $this->_stack->pop();
					echo "instruction: swap: $a <=> $b\n";
					$this->_stack->push($a);
					$this->_stack->push($b);
					$this->move();
					return false;
				},
				"\$" => function() {
					$a = $this->_stack->pop();
					echo "instruction: discard: $a\n";
					$this->move();
					return false;
				},
				"." => function() {
					$res = $this->_stack->pop();
					echo "instruction: out: $res\n";
					$this->move();
					return strval($res);
				},
				"," => function() {
					$res = $this->_stack->pop();
					echo "instruction: out: '" . chr($res) . "'\n";
					$this->move();
					return chr($res);
				},
				"#" => function() {
					echo "instruction: skip: \"" . $this->str_direction($this->_direction) . "\"\n";
					$this->move();
					$this->move();
					return false;
				},
				"p" => function() {
					$x = $this->_stack->pop();
					$y = $this->_stack->pop();
					$v = $this->_stack->pop();
					echo "instruction: put($x, $y, '" . chr($v) . "')\n";
					$this->put_char($x, $y, chr($v));
					$this->move();
					return false;
				},
				"g" => function() {
					$x = $this->_stack->pop();
					$y = $this->_stack->pop();
					$v = ord($this->get_char($x, $y));
					echo "instruction: get($x, $y): '" . chr($v) . "'\n";
					$this->_stack->push($v);
					$this->move();
					return false;
				},
				" " => function() {
					echo "instruction: nop\n";
					$this->move();
					return false;
				},
			];
		}

		private function getch() {
			return $this->get_char($this->_x, $this->_y);
		}

		private function get_char($x, $y) {
			if ($x < 0 || $x >= count($this->_lines) || $y < 0 || $y >= strlen($this->_lines[$x]))
				return ' ';
			return substr($this->_lines[$x], $y, 1);
		}

		private function put_char($x, $y, $v) {
			if ($x < 0 || $x >= count($this->_lines) || $y < 0 || $y >= strlen($this->_lines[$x]))
				return;
			$this->_lines[$x][$y] = $v[0];
		}

		private function move() {
			switch ($this->_direction) {
				case self::$DIR_UP:
					$this->_x--;
					if ($this->_x < 0)
						$this->_x = count($this->_lines) - 1;
					break;
				case self::$DIR_RIGHT:
					$this->_y++;
					if ($this->_y >= strlen($this->_lines[$this->_x]))
						$this->_y = 0;
					break;
				case self::$DIR_DOWN:
					$this->_x++;
					if ($this->_x >= count($this->_lines))
						$this->_x = 0;
					break;
				case self::$DIR_LEFT:
					$this->_y--;
					if ($this->_y < 0)
						$this->_y = strlen($this->_lines[$this->_x]) - 1;
					break;
				default:
					throw new RuntimeException("Bad direction: " . $this->_direction);
					break;
			}
		}

		public function interpret(): string {
			$res = "";
			if (count($this->_lines) > 0) {
				while (($ch = $this->next()) !== null)
					$res .= $ch;
			}
			return $res;
		}

		private function next() {

			while (true) {
				$ch = $this->getch();
				if ($this->_string_mode) {
					echo "string mode: '$ch'\n";
					if (strcmp($ch, '"') === 0)
						$this->_string_mode = false;
					else
						$this->_stack->push(ord($ch));
					$this->move();
				} else {
					if (strcmp($ch, '@') === 0) {
						echo "end: '@'\n";
						return null;
					}

					if (is_callable($this->_instructions[$ch])) {
						$res = $this->_instructions[$ch]();
						if (gettype($res) === 'string')
							return $res;
					} else {
						throw new RuntimeException("Invalid instruction \"$ch\" at row=" . $this->_y . ", col=" . $this->_x);
					}
				}
			}
		}
	};
*/
	// Clean code

	$befunge = new class($code) {

		private static $DIR_STOP = 0;
		private static $DIR_MIN = 1;
		private static $DIR_UP = 1;
		private static $DIR_RIGHT = 2;
		private static $DIR_DOWN = 3;
		private static $DIR_LEFT = 4;
		private static $DIR_MAX = 4;
		private $_direction = -1;
		private $_x = 0;
		private $_y = 0;
		private $_string_mode = false;
		private $_lines = [];
		private $_stack = null;
		private $_instructions = [];

		public function __construct($code) {

			$this->_direction = self::$DIR_RIGHT;

			if (strlen($code) > 0)
				$this->_lines = explode("\n", $code);

			$this->_stack = new class {

				private $arr = array();

				public function push($val) {
					array_push($this->arr, intval($val));
				}

				public function pop() {
					$val = 0;
					if (count($this->arr) > 0)
						$val = array_pop($this->arr);
					return $val;
				}

				public function peek() {
					$val = 0;
					if (count($this->arr) > 0)
						$val = intval($this->arr[count($this->arr) - 1]);
					return $val;
				}
			};

			$this->_instructions = [
				"0" => function() {
					$this->_stack->push(0);
					$this->move();
					return false;
				},
				"1" => function() {
					$this->_stack->push(1);
					$this->move();
					return false;
				},
				"2" => function() {
					$this->_stack->push(2);
					$this->move();
					return false;
				},
				"3" => function() {
					$this->_stack->push(3);
					$this->move();
					return false;
				},
				"4" => function() {
					$this->_stack->push(4);
					$this->move();
					return false;
				},
				"5" => function() {
					$this->_stack->push(5);
					$this->move();
					return false;
				},
				"6" => function() {
					$this->_stack->push(6);
					$this->move();
					return false;
				},
				"7" => function() {
					$this->_stack->push(7);
					$this->move();
					return false;
				},
				"8" => function() {
					$this->_stack->push(8);
					$this->move();
					return false;
				},
				"9" => function() {
					$this->_stack->push(9);
					$this->move();
					return false;
				},
				"+" => function() {
					$a = $this->_stack->pop();
					$b = $this->_stack->pop();
					$this->_stack->push($a + $b);
					$this->move();
					return false;
				},
				"-" => function() {
					$a = $this->_stack->pop();
					$b = $this->_stack->pop();
					$this->_stack->push($b - $a);
					$this->move();
					return false;
				},
				"*" => function() {
					$a = $this->_stack->pop();
					$b = $this->_stack->pop();
					$this->_stack->push($a * $b);
					$this->move();
					return false;
				},
				"/" => function() {
					$a = $this->_stack->pop();
					$b = $this->_stack->pop();
					$v = ($a === 0 ? 0 : intval($b / $a));
					$this->_stack->push($v);
					$this->move();
					return false;
				},
				"%" => function() {
					$a = $this->_stack->pop();
					$b = $this->_stack->pop();
					$v = ($a === 0 ? 0 : $b % $a);
					$this->_stack->push($v);
					$this->move();
					return false;
				},
				"!" => function() {
					$a = $this->_stack->pop();
					$v = ($a === 0 ? 1 : 0);
					$this->_stack->push($v);
					$this->move();
					return false;
				},
				"`" => function() {
					$a = $this->_stack->pop();
					$b = $this->_stack->pop();
					$v = ($b > $a ? 1 : 0);
					$this->_stack->push($v);
					$this->move();
					return false;
				},
				">" => function() {
					$this->_direction = self::$DIR_RIGHT;
					$this->move();
					return false;
				},
				"<" => function() {
					$this->_direction = self::$DIR_LEFT;
					$this->move();
					return false;
				},
				"^" => function() {
					$this->_direction = self::$DIR_UP;
					$this->move();
					return false;
				},
				"V" => function() {
					$this->_direction = self::$DIR_DOWN;
					$this->move();
					return false;
				},
				"v" => function() {
					$this->_direction = self::$DIR_DOWN;
					$this->move();
					return false;
				},
				"?" => function() {
					$v = rand(self::$DIR_MIN, self::$DIR_MAX);
					$this->_direction = $v;
					$this->move();
					return false;
				},
				"_" => function() {
					$a = $this->_stack->pop();
					$v = (($a === 0) ? self::$DIR_RIGHT : self::$DIR_LEFT);
					$this->_direction = $v;
					$this->move();
					return false;
				},
				"|" => function() {
					$a = $this->_stack->pop();
					$v = (($a === 0) ? self::$DIR_DOWN : self::$DIR_UP);
					$this->_direction = $v;
					$this->move();
					return false;
				},
				'"' => function() {
					$this->_string_mode = true;
					$this->move();
					return false;
				},
				":" => function() {
					$a = $this->_stack->peek();
					$this->_stack->push($a);
					$this->move();
					return false;
				},
				"\\" => function() {
					$a = $this->_stack->pop();
					$b = $this->_stack->pop();
					$this->_stack->push($a);
					$this->_stack->push($b);
					$this->move();
					return false;
				},
				"\$" => function() {
					$a = $this->_stack->pop();
					$this->move();
					return false;
				},
				"." => function() {
					$res = $this->_stack->pop();
					$this->move();
					return strval($res);
				},
				"," => function() {
					$res = $this->_stack->pop();
					$this->move();
					return chr($res);
				},
				"#" => function() {
					$this->move();
					$this->move();
					return false;
				},
				"p" => function() {
					$x = $this->_stack->pop();
					$y = $this->_stack->pop();
					$v = $this->_stack->pop();
					$this->put_char($x, $y, chr($v));
					$this->move();
					return false;
				},
				"g" => function() {
					$x = $this->_stack->pop();
					$y = $this->_stack->pop();
					$v = ord($this->get_char($x, $y));
					$this->_stack->push($v);
					$this->move();
					return false;
				},
				" " => function() {
					$this->move();
					return false;
				},
			];
		}

		private function getch() {
			return $this->get_char($this->_x, $this->_y);
		}

		private function get_char($x, $y) {
			if ($x < 0 || $x >= count($this->_lines) || $y < 0 || $y >= strlen($this->_lines[$x]))
				return ' ';
			return substr($this->_lines[$x], $y, 1);
		}

		private function put_char($x, $y, $v) {
			if ($x < 0 || $x >= count($this->_lines) || $y < 0 || $y >= strlen($this->_lines[$x]))
				return;
			$this->_lines[$x][$y] = $v[0];
		}

		private function move() {
			switch ($this->_direction) {
				case self::$DIR_UP:
					$this->_x--;
					if ($this->_x < 0)
						$this->_x = count($this->_lines) - 1;
					break;
				case self::$DIR_RIGHT:
					$this->_y++;
					if ($this->_y >= strlen($this->_lines[$this->_x]))
						$this->_y = 0;
					break;
				case self::$DIR_DOWN:
					$this->_x++;
					if ($this->_x >= count($this->_lines))
						$this->_x = 0;
					break;
				case self::$DIR_LEFT:
					$this->_y--;
					if ($this->_y < 0)
						$this->_y = strlen($this->_lines[$this->_x]) - 1;
					break;
				default:
					throw new RuntimeException("Bad direction: " . $this->_direction);
					break;
			}
		}

		public function interpret(): string {
			$res = "";
			if (count($this->_lines) > 0) {
				while (($ch = $this->next()) !== null)
					$res .= $ch;
			}
			return $res;
		}

		private function next() {

			while (true) {
				$ch = $this->getch();
				if ($this->_string_mode) {
					if (strcmp($ch, '"') === 0)
						$this->_string_mode = false;
					else
						$this->_stack->push(ord($ch));
					$this->move();
				} else {
					if (strcmp($ch, '@') === 0) {
						return null;
					}

					if (is_callable($this->_instructions[$ch])) {
						$res = $this->_instructions[$ch]();
						if (gettype($res) === 'string')
							return $res;
					} else {
						throw new RuntimeException("Invalid instruction \"$ch\" at row=" . $this->_y . ", col=" . $this->_x);
					}
				}
			}
		}
	};

	return $befunge->interpret();
}

//echo interpret(">987v>.v\nv456<  :\n>321 ^ _@") . "\n";
echo interpret("01->1# +# :# 0# g# ,# :# 5# 8# *# 4# +# -# _@") . "\n";

?>