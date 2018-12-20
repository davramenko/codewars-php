<?php

// Program a Calculator #2 - 3D Vectors

class Vector {

	public $i;
	public $j;
	public $k;

	public function __construct($i, $j, $k) {
		$this->i = $i;
		$this->j = $j;
		$this->k = $k;
	}

	public function getMagnitude() : float {
		return sqrt($this->i * $this->i + $this->j * $this->j + $this->k * $this->k);
	}

	public static function getI() : Vector {
		return new Vector(1, 0, 0);
	}

	public static function getJ() : Vector {
		return new Vector(0, 1, 0);
	}

	public static function getK() : Vector {
		return new Vector(0, 0, 1);
	}

	public function add(Vector $v) : Vector {
		return new Vector($this->i + $v->i, $this->j + $v->j, $this->k + $v->k);
	}

	public function multiplyByScalar(float $s) : Vector {
		return new Vector($this->i * $s, $this->j * $s, $this->k * $s);
	}

	public function dot(Vector $v) : float {
		return $this->i * $v->i + $this->j * $v->j + $this->k * $v->k;
	}

	public function cross(Vector $v) : Vector {
		return new Vector($this->j * $v->k - $this->k * $v->j, $this->k * $v->i - $this->i * $v->k, $this->i * $v->j - $this->j * $v->i);
	}

	public function isParallelTo(Vector $v) : bool {
		if ($this->isZero() || $v->isZero())
			return false;
		return ($this->fuzzyEquals(
			$this->getMagnitude() * $v->getMagnitude(),
			abs($this->dot($v))
		));
	}

	public function isPerpendicularTo(Vector $v) : bool {
		if ($this->isZero() || $v->isZero())
			return false;
		return $this->fuzzyEquals(0, $this->dot($v));
	}

	public function normalize() : Vector {
		$sz = $this->getMagnitude();
		return new Vector($this->i / $sz, $this->j / $sz, $this->k / $sz);
	}

	public function isNormalized() : bool {
		if ($this->isZero())
			return false();
		return ($this->fuzzyEquals(1, $this->getMagnitude()));
	}

	public function isZero() : bool {
		return ($this->fuzzyEquals(0, $this->i) && $this->fuzzyEquals(0, $this->j) && $this->fuzzyEquals(0, $this->k));
	}

	protected function fuzzyEquals(float $expected, float $actual) : bool {
		return ($expected == 0.0 ? abs($actual) <= 1e-9 : abs(($expected - $actual) / $expected) <= 1e-9);
	}

	public function __toString() {
		return "(" . $this->i . "," . $this->j . "," . $this->k . ")";
	}
}

echo Vector::getI()->getMagnitude() . "\n";
$v = new Vector(2, 1, 0);
echo "$v\n";
echo $v->multiplyByScalar(3) . "\n";
echo $v->dot(new Vector(1, 2, 3)) . "\n";
echo $v->cross(new Vector(1, 2, 3)) . "\n";

?>