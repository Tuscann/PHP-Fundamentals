<?php
//<?php var_export($_GET);
$_GET=array (
    'list' => 'The Hobbit: The Battle of the Five Armies (adventure)- Ian McKellen, Martin Freeman, Richard Armitage, Cate Blanchett / 300
Night at the Museum: Secret of the Tomb (comedy)- Ben Stiller, Robin Williams, Owen Wilson, Dick Van Dyke / 200
Annie (comedy)- Quvenzhane Wallis, Cameron Diaz, Jamie Foxx, Rose Byrne / 160
Night at the Museum: Secret of the Tomb (comedy)- Ben Stiller, Robin Williams, Owen Wilson, Dick Van Dyke / 180
Exodus: Gods and Kings (action)- Christian Bale, Joel Edgerton, Ben Kingsley, Sigourney Weaver / 250',
    'minSeats' => '160',
    'maxSeats' => '300',
    'filter' => 'comedy',
    'order' => 'ascending',
);

$list = $_GET['list'];
$minSeats = $_GET['minSeats'];
$maxSeats = $_GET['maxSeats'];
$genreFilter = $_GET['filter'];
$order = $_GET['order'];

$inputList = preg_split('/[\r\n\t]+/', $list);
$screenings = array();

//validate each entry as per the filters and fill a single array
foreach($inputList as $line) {
    $movie = preg_split('/[\)\(\-\/]/', $line, -1, PREG_SPLIT_NO_EMPTY);

    if($genreFilter != 'all' && $movie[1] != $genreFilter) {
        continue;
    }

    if($movie[3] >= $minSeats && $movie[3] <= $maxSeats) {
        $screenings[] = $movie;
    }
}

//sort the array
if($order == 'ascending') {
    usort($screenings, 'sortAscending');
} else {
    usort($screenings, 'sortDescending');
}

//print the array
foreach($screenings as $screening) {
    $result = '<div class="screening">';
    $result .= '<h2>' . trim(htmlspecialchars($screening[0])) . '</h2>';

    $cast = preg_split('/,/', $screening[2], -1, PREG_SPLIT_NO_EMPTY);
    $result .= '<ul>';
    foreach($cast as $star) {
        $result .= '<li class="star">' . trim(htmlspecialchars($star)) . '</li>';
    }
    $result .= '</ul>';

    $result .= '<span class="seatsFilled">' . trim(htmlspecialchars($screening[3])) . ' seats filled</span>';

    $result .= '</div>';
    echo $result;
}

function sortAscending($first, $second) {
    $compare = strcmp($first[0], $second[0]);
    if($compare == 0) {
        if($first[3] > $second[3]) {
            return 1;
        } else {
            return -1;
        }
    }
    return $compare;
}

function sortDescending($first, $second) {
    $compare = strcmp($first[0], $second[0]);
    if($compare == 0) {
        if($first[3] > $second[3]) {
            return 1;
        } else {
            return -1;
        }
    }
    $compare *= -1;
    return $compare;
}
