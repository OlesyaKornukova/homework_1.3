<?php
error_reporting(E_ALL);
$fauna = array(
    "Africa" => [
        "Mammuthus columbi", // Columbian mammoth
        "Hydrochoerus hydrochaeris", // Capybara
        "Ursus arctos horribilis" //Grizli Bear
    ],
    "Eurasia" => [
        "Ailuropoda melanoleuca", // Giant panda
        "Rupicapra", // Chamois
        "Bos grunniens" // Domestic yak
    ],
    "South America" => [
        "Pygocentrus Nattereri", // Piranha
        "Lama glama", // Llama
        "Tapirus" // Tapir
    ],
    "North America" => [
        "Alopex lagopus", // Arctic Fox
        "Sylvilagus bachmani", // Brush Rabbit
        "Coyote" // Canis latrans
    ],
    "Australia" => [
        "Cervus timorensis", // Rusa
        "Axis axis" // Chital
    ],
    "Antarctica" => [
        "Aptenodytes patagonica" // King Penguins Facts
    ]
);

$twoWordsAnimals = [];

foreach ($fauna as $animals) {
    foreach ($animals as $key => $animal) {
        $count = substr_count($animal, ' ');
        if ($count === 1) {
            array_push($twoWordsAnimals, $animal);
        }
    }
}

$fantasyAnimals = [];
while (count($twoWordsAnimals) !== 0) {

    if (count($twoWordsAnimals) === 1) {
        array_push($fantasyAnimals, $twoWordsAnimals[0]);
        break;
    } else {

        $first = 0;
        $rand = rand(1, count($twoWordsAnimals) - 1);
        $firstElem = $twoWordsAnimals[$first];
        $randElem = $twoWordsAnimals[$rand];

        $fantasyFirst = substr($firstElem, 0, strpos($firstElem, ' ')) . ' '
            . substr($randElem, strpos($randElem, ' '));
        $fantasySecond = substr($randElem, 0, strpos($randElem, ' ')) . ' '
            . substr($firstElem, strpos($firstElem, ' '));

        array_push($fantasyAnimals, $fantasyFirst, $fantasySecond);
        unset($twoWordsAnimals[$first], $twoWordsAnimals[$rand]);

        $twoWordsAnimals = array_values($twoWordsAnimals);
    }
}

$fantasyAnimalsWithHome = [];
foreach ($fantasyAnimals as $elem) {
    $words1 = explode(' ', $elem);
    foreach ($fauna as $key => $animal) {
        foreach ($animal as $value) {
            $words2 = explode(' ', $value);
            if ($words1[0] === $words2[0]) {
                $fantasyAnimalsWithHome[$key][] = $elem;
            }
        }
    }
}

foreach ($fauna as $key => $item) $continents[] = $key;
foreach ($fantasyAnimalsWithHome as $key => $animals) $arraysOfAnimals[$key] = $animals;
$continents = array_flip($continents);
$fantasyAnimalsWithHome = array_merge($continents, $arraysOfAnimals);

function printAnimals($array) {
    foreach ($array as $key => $animals) {
        echo "<div class=\"container\">";
        echo "<h2>{$key}</h2>";
        $animalsWithCommas = implode(",<br>", $animals);
        echo "<p>{$animalsWithCommas}</p>";
        echo "</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>1.3-homework</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="wrapper">
        <h1>Животные до перемешивания</h1>
		<div class="block">
			<?php printAnimals($fauna); ?>
		</div>
        <h1 class="margin">Животные после перемешивания</h1>
		<div class="block">
            <?php printAnimals($fantasyAnimalsWithHome); ?>
		</div>
	</div>
</body>
</html>
