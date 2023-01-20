<?php 

$cells = 15;
$generations = 5;
$state = array();

function print_state($t){
  foreach ($t as $idx => $value) {
    echo "\n";
    echo $value ? "o" : "x";
  }
}
for ($i = 0; $i < $cells; $i++) {
  $state[$i] = rand(0, 1);
}

print_state($state);

for ($g = 0; $g < $generations; $g++) {
  $new_state = $state;
  for ($i = 0; $i < $cells; $i++) {
    $left = $state[($i - 1 + $cells) % $cells];
    $center = $state[$i];
    $right = $state[($i + 1) % $cells];
    $new_state[$i] = ($left + $center + $right) % 2;
  }
  $state = $new_state;
  print_state($state);
}