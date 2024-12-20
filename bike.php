<?php

class Bicycle {

  var $brand;
  var $model;
  var $year;
  var $description = 'Used bicycle';
  var $weight_kg = 0.0;

  function name() {// Name generated from Brand, Mode & Year. Simple.
    return $this->brand . " " . $this->model . " (" . $this->year . ")";
  }

  function weight_lbs() {// No argument taken, so converts KG weight to pounds. Simple.
    return floatval($this->weight_kg) * 2.2046226218;
  }

  // A bit tricky/loopy!
  function set_weight_lbs($value) {// Provide weight(pounds) to change the original (kg) weight
    $this->weight_kg = floatval($value) / 2.2046226218;
  }

}

$trek = new Bicycle;
$trek->brand = 'Trek';
$trek->model = 'Emonda';
$trek->year = '2017';
$trek->weight_kg = 1.0;

$cd = new Bicycle;
$cd->brand = 'Cannondale';
$cd->model = 'Synapse';
$cd->year = '2016';
$cd->weight_kg = 8.0;

echo "<b>Trek Name</b>:" . $trek->name() . "<br />";
echo "<b>CD Name</b>:" .$cd->name() . "<br />";

echo "<br><b><u>Trek weights Calculated</b></u><br>";
echo "<b>Trek weight kgs</b>:" .$trek->weight_kg . "<br />";
echo "<b>Trek weight lbs</b>:" .$trek->weight_lbs() . "<br />";
// notice that one is property, one is a method


// A bit tricky as loopy but follow the trail and it makes sense!!!
echo "<br><u><b>Trek weight changed manually</b></u><br>";
$trek->set_weight_lbs(150);// CHANGING weight for TREK to 2 pounds.
echo "<b>Trek weight kgs</b>:" .$trek->weight_kg . "<br />";
echo "<b>Trek weight lbs</b>:" .$trek->weight_lbs() . "<br />";


// You can play with CD bike weights here :)

// Thought :: How about a function that intermangles with both the objects?
// -- Possible? How? $this will always take current object! how to retain OR
// Pass value of one as argument to another. ?? Have a try :)

?>