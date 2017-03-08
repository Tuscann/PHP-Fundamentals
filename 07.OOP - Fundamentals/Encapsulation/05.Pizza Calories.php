<?php
declare(strict_types = 1);
namespace Pizza;


try {
    while (true) {
        $input = trim(fgets(STDIN));
        if ($input == "END") {
            break;
        }
        $input = explode(" ", $input);

        $typeFloursAllowed = ['White', 'Wholegrain', 'Crispy ', 'Chewy', 'Homemade'];

        if (!array_key_exists($input[1], $typeFloursAllowed)) {
            throw new \Exception("Invalid type of dough.");
        }
        if ($input[3] < 1 || $input[3] > 200) {
            throw new \Exception("Dough weight should be in the range [1..200].");
        }

    }


} catch (\Exception $e) {
    echo ($e->getMessage()) . PHP_EOL;
}