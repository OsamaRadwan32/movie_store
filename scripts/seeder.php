<?php

require_once 'connection.php';

$countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");

// foreach ($countries as $country) {

//     $c = $db->quote($country);
//     $query = "INSERT into $dbname.country (country) VALUES (" . $c . ")";

//     $result = $db->query($query);

//     if ($result)
//         echo $c . '<br>';
// }
$movies_list = array(
    [
        'name' => 'The Shawshank Redemption',
        'slug' => 'TheShawshankRedemption',
        'details' => "Two imprisoned men bond over a number of years, finding solace and eventual redemption through acts of common decency.",
        'price' => 35,
        'rating' => 9.3,
        'release_year' => 1994,
        'storyline' => "Chronicles the experiences of a formerly successful banker as a prisoner in the gloomy jailhouse of Shawshank after being found guilty of a crime he did not commit. The film portrays the man's unique way of dealing with his new, torturous life; along the way he befriends a number of fellow prisoners, most notably a wise long-term inmate named Red."
    ],
    [
        'name' => 'The Godfather',
        'slug' => 'TheGodfather',
        'details' => "The aging patriarch of an organized crime dynasty transfers control of his clandestine empire to his reluctant son.",
        'price' => 45,
        'rating' => 9.2,
        'release_year' => 1972,
        'storyline' => "When the aging head of a famous crime family decides to transfer his position to one of his subalterns, a series of unfortunate events start happening to the family, and a war begins between all the well-known families leading to insolence, deportation, murder and revenge, and ends with the favorable successor being finally chosen."
    ],
    [
        'name' => 'The Godfather: Part II',
        'slug' => 'TheGodfather-PartII',
        'details' => "The early life and career of Vito Corleone in 1920s New York City is portrayed, while his son, Michael, expands and tightens his grip on the family crime syndicate.",
        'price' => 38,
        'rating' => 9.0,
        'release_year' => 1974,
        'storyline' => "The continuing saga of the Corleone crime family tells the story of a young Vito Corleone growing up in Sicily and in 1910s New York; and follows Michael Corleone in the 1950s as he attempts to expand the family business into Las Vegas, Hollywood and Cuba."
    ],
    [
        'name' => 'The Lord of the Rings: The Return of the King',
        'slug' => 'TheLordoftheRings-TheReturnoftheKing',
        'details' => "Gandalf and Aragorn lead the World of Men against Sauron's army to draw his gaze from Frodo and Sam as they approach Mount Doom with the One Ring.",
        'price' => 15,
        'rating' => 8.9,
        'release_year' => 2003,
        'storyline' => "The final confrontation between the forces of good and evil fighting for control of the future of Middle-earth. Hobbits: Frodo and Sam reach Mordor in their quest to destroy the 'one ring', while Aragorn leads the forces of good against Sauron's evil army at the stone city of Minas Tirith."
    ],
    [
        'name' => 'The Lord of the Rings: The Fellowship of the Ring',
        'slug' => 'TheLordoftheRings-TheFellowshipoftheRing',
        'details' => "A meek Hobbit from the Shire and eight companions set out on a journey to destroy the powerful One Ring and save Middle-earth from the Dark Lord Sauron.",
        'price' => 17,
        'rating' => 8.8,
        'release_year' => 2001,
        'storyline' => "Chronicles the experiences of a formerly successful banker as a prisoner in the gloomy jailhouse of Shawshank after being found guilty of a crime he did not commit. The film portrays the man's unique way of dealing with his new, torturous life; along the way he befriends a number of fellow prisoners, most notably a wise long-term inmate named Red."
    ],
    [
        'name' => 'The Lord of the Rings: The Two Towers',
        'slug' => 'TheLordoftheRings-TheTwoTowers',
        'details' => "While Frodo and Sam edge closer to Mordor with the help of the shifty Gollum, the divided fellowship makes a stand against Sauron's new ally, Saruman, and his hordes of Isengard.",
        'price' => 20,
        'rating' => 8.7,
        'release_year' => 2002,
        'storyline' => "Chronicles the experiences of a formerly successful banker as a prisoner in the gloomy jailhouse of Shawshank after being found guilty of a crime he did not commit. The film portrays the man's unique way of dealing with his new, torturous life; along the way he befriends a number of fellow prisoners, most notably a wise long-term inmate named Red."
    ],
    [
        'name' => 'Interstellar',
        'slug' => 'Interstellar',
        'details' => "A team of explorers travel through a wormhole in space in an attempt to ensure humanity's survival.",
        'price' => 50,
        'rating' => 8.6,
        'release_year' => 2014,
        'storyline' => "Chronicles the experiences of a formerly successful banker as a prisoner in the gloomy jailhouse of Shawshank after being found guilty of a crime he did not commit. The film portrays the man's unique way of dealing with his new, torturous life; along the way he befriends a number of fellow prisoners, most notably a wise long-term inmate named Red."
    ],
    [
        'name' => 'Whiplash',
        'slug' => 'Whiplash',
        'details' => "A promising young drummer enrolls at a cut-throat music conservatory where his dreams of greatness are mentored by an instructor who will stop at nothing to realize a student's potential.",
        'price' => 28,
        'rating' => 8.5,
        'release_year' => 2014,
        'storyline' => "Chronicles the experiences of a formerly successful banker as a prisoner in the gloomy jailhouse of Shawshank after being found guilty of a crime he did not commit. The film portrays the man's unique way of dealing with his new, torturous life; along the way he befriends a number of fellow prisoners, most notably a wise long-term inmate named Red."
    ],
    [
        'name' => 'The Prestige',
        'slug' => 'ThePrestige',
        'details' => "After a tragic accident, two stage magicians engage in a battle to create the ultimate illusion while sacrificing everything they have to outwit each other.",
        'price' => 18,
        'rating' => 8.5,
        'release_year' => 2006,
        'storyline' => "Chronicles the experiences of a formerly successful banker as a prisoner in the gloomy jailhouse of Shawshank after being found guilty of a crime he did not commit. The film portrays the man's unique way of dealing with his new, torturous life; along the way he befriends a number of fellow prisoners, most notably a wise long-term inmate named Red."
    ],
    [
        'name' => 'Gladiator',
        'slug' => 'Gladiator',
        'details' => "A former Roman General sets out to exact vengeance against the corrupt emperor who murdered his family and sent him into slavery.",
        'price' => 33,
        'rating' => 8.5,
        'release_year' => 2000,
        'storyline' => "Chronicles the experiences of a formerly successful banker as a prisoner in the gloomy jailhouse of Shawshank after being found guilty of a crime he did not commit. The film portrays the man's unique way of dealing with his new, torturous life; along the way he befriends a number of fellow prisoners, most notably a wise long-term inmate named Red."
    ],
    [
        'name' => 'V for Vendetta',
        'slug' => 'VForVendetta',
        'details' => "In a future British tyranny, a shadowy freedom fighter, known only by the alias of 'V', plots to overthrow it with the help of a young woman.",
        'price' => 28,
        'rating' => 8.2,
        'release_year' => 2005,
        'storyline' => "Chronicles the experiences of a formerly successful banker as a prisoner in the gloomy jailhouse of Shawshank after being found guilty of a crime he did not commit. The film portrays the man's unique way of dealing with his new, torturous life; along the way he befriends a number of fellow prisoners, most notably a wise long-term inmate named Red."
    ],
    [
        'name' => 'A Beautiful Mind',
        'slug' => 'ABeautifulMind',
        'details' => "After John Nash, a brilliant but asocial mathematician, accepts secret work in cryptography, his life takes a turn for the nightmarish.",
        'price' => 10,
        'rating' => 8.2,
        'release_year' => 2001,
        'storyline' => "Chronicles the experiences of a formerly successful banker as a prisoner in the gloomy jailhouse of Shawshank after being found guilty of a crime he did not commit. The film portrays the man's unique way of dealing with his new, torturous life; along the way he befriends a number of fellow prisoners, most notably a wise long-term inmate named Red."
    ]
);

// foreach ($movies_list as $movie) {
//
//     // $t=time();
//     $m_name = $db->quote($movie['name']);
//     $m_slug = $db->quote($movie['slug']);
//     $m_description = $db->quote($movie['details']);
//     $m_story_line = $db->quote($movie['storyline']);
//     $m_release_year = $movie['release_year'];
//     $m_price = $movie['price'];
//     // $m_reg_date = date("Y-m-d H:i:s");
//
//     $query = "INSERT INTO $dbname.movies (name, slug, description, story_line, release_year, price) VALUES ($m_name, $m_slug, $m_description, $m_story_line, $m_release_year, $m_price)";
//     $result = $db->query($query);
//
//     if ($result)
//         echo $movie['name'] . '<br>';
// }

$sql = "SELECT * FROM $dbname.genre_movie";
$qry = $db->prepare($sql);
$qry->execute();
$results = $qry->fetchAll(PDO::FETCH_ASSOC);

if (($db->prepare("DELETE FROM $dbname.genre_movie"))->execute()) {
    foreach ($results as $result) {
        $genre_id = $result['genre_id'];
        $movie_id = $result['movie_id'];
        $query = "INSERT into $dbname.genre_movie (genre_id, movie_id) VALUES ($movie_id, $genre_id)";
        $result = $db->query($query);
    }
}
