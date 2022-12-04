# Advent of Code 2022
Advent of Code 2022 solutions. https://adventofcode.com/

## 🛠 Setup
- `composer install`

## 💻 Usage
To get the solution for day 2, run.
```
 ./aoc solve 2
```

## 👷 Adding a new solution
To create a new solution for day `28` do the following (replace 28 with the number of your day):
- Store the input in `puzzles/Day28/input.txt`.
- Create a new Solution for the day `solutions/Day28/Solution.php` That extends `Styxit\AbstractSolution`.
- Write the `execute()` method that writes the solution to `$this->part1` and `$this->part2`.

In the Solution class, you can use `$this->input` to get access to the parsed input that belongs to that day.

Solve the puzzle with
```
 ./aoc solve 28
```

### Example data
The example data for the puzzle can be stored in `puzzles/Day28/example.txt`. After that, use the `--example` option to use the example data as input.

Solve the puzzle using example data.
```
 ./aoc solve 28 --example
```

## 🐞 Testing
For each solution a test can be written to make sure the output is correct. by extending the `AbstractDayTest` only the Class to be tested + the solutions need to be defined. To test the solution for a new day, add a test in the `tests/Solutions` dir.

Run all tests: 
```
./vendor/bin/phpunit --testdox tests
```