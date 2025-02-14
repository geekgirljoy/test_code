<?php

$layers = [2, 3, 1];

$num_input = 2;
$num_output = 1;
$num_layers = 3;
$num_neurons_hidden = 3;

// test data
$input = [-1, -1];
$output = [-1];

echo "Creating network.\n";
$fann = fann_create_standard($num_layers, $num_input, $num_neurons_hidden, $num_output);

echo "Configuring network.\n";
fann_set_activation_steepness_hidden($fann, 1);
fann_set_activation_steepness_output($fann, 1);
fann_set_activation_function_hidden($fann, FANN_SIGMOID_SYMMETRIC);
fann_set_activation_function_output($fann, FANN_SIGMOID_SYMMETRIC);
fann_set_train_stop_function($fann, FANN_STOPFUNC_BIT);
fann_set_bit_fail_limit($fann, 0.01);
fann_set_training_algorithm($fann, FANN_TRAIN_RPROP);

for ($i = 0; $i < 10; ++$i){
	echo "Training network.\n";
	fann_train ($fann, $input, $output);
	
	echo "Testing network.\n";
	$answer = fann_run ($fann, $input);
	printf("XOR test (%f,%f) -> %f, should be %f, difference=%f\n", $input[0], $input[1],
             $answer[0], $output[0], abs($answer[0] - $output[0]));
}


echo("Final test after training network.\n");
$answer = fann_run ($fann, $input);
printf("XOR test (%f,%f) -> %f, should be %f, difference=%f\n", $input[0], $input[1],
        $answer[0], $output[0], abs($answer[0] - $output[0]));

echo "Saving network.\n";
fann_save ($fann, "xor.net");

echo "Destroying network.\n";
fann_destroy ($fann);

echo "Reloading network.\n";
$fann = fann_create_from_file("xor.net");

echo "Test after reloading network.\n";
$answer = fann_run ($fann, $input);
printf("XOR test (%f,%f) -> %f, should be %f, difference=%f\n", $input[0], $input[1],
        $answer[0], $output[0], abs($answer[0] - $output[0]));

echo "Destroying network.\n";
fann_destroy ($fann);

// Results:
/*

Creating network.
Configuring network.
Training network.
Testing network.
XOR test (-1.000000,-1.000000) -> -0.674595, should be -1.000000, difference=0.325405
Training network.
Testing network.
XOR test (-1.000000,-1.000000) -> -0.749394, should be -1.000000, difference=0.250606
Training network.
Testing network.
XOR test (-1.000000,-1.000000) -> -0.789931, should be -1.000000, difference=0.210069
Training network.
Testing network.
XOR test (-1.000000,-1.000000) -> -0.816424, should be -1.000000, difference=0.183576
Training network.
Testing network.
XOR test (-1.000000,-1.000000) -> -0.835459, should be -1.000000, difference=0.164541
Training network.
Testing network.
XOR test (-1.000000,-1.000000) -> -0.849962, should be -1.000000, difference=0.150038
Training network.
Testing network.
XOR test (-1.000000,-1.000000) -> -0.861467, should be -1.000000, difference=0.138533
Training network.
Testing network.
XOR test (-1.000000,-1.000000) -> -0.870869, should be -1.000000, difference=0.129131
Training network.
Testing network.
XOR test (-1.000000,-1.000000) -> -0.878730, should be -1.000000, difference=0.121270
Training network.
Testing network.
XOR test (-1.000000,-1.000000) -> -0.885421, should be -1.000000, difference=0.114579
Final test after training network.
XOR test (-1.000000,-1.000000) -> -0.885421, should be -1.000000, difference=0.114579
Saving network.
Destroying network.
Reloading network.
Test after reloading network.
XOR test (-1.000000,-1.000000) -> -0.885421, should be -1.000000, difference=0.114579
Destroying network.

*/