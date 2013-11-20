## Toy Robot Simulator - PHP version

Code test in PHP this time.

Problem description can be found in CodeTest-Robot.pdf

#### Environment Details

PHP 5.3.16

#### Instructions

To see the code run:

1. cd to robot-php folder.
2. php runRobotApp.php testdata/file-1 {testdata/file-2 .. testdata/file-n} Minimum of 1 file, up to n number of files.

To run the tests:
1. cd to the robot-php folder.
2. php codecept.phar run tests/unit/ 

Please see the below list for details about the various test data files

1. test-1 Starts the robot at 0,0 then runs it fully around the perimeter including various turns and attempts to run off the edges.
1. test-2 Starts the robot at 0,0 then runs many places. At the end, a move off an edge is attempted followed by another place.
1. test-3 Demonstrates the robot ignoring instructions and a bad place until a valid place is processed. After that, a bad place results in no changes to the robot.

Other data files are there to support the tests.

#### Notes and Assumptions

1. I have assumed that if there is an invalid command in the commands file, the whole lot will be rejected.
1. Specifically with regards to PLACE, PLACE -1, 0, NORTH would cause a rejection as negative numbers are deemed invalid. PLACE 100, 100, SOUTH would be accepted as valid syntax, but will be skipped by the robot as a bad place().
