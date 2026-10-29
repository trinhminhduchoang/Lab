<?php
$escape = static function ($value): string {
	return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
};

$firstname = isset($_POST['firstname']) ? trim((string) $_POST['firstname']) : '';
$lastname = isset($_POST['lastname']) ? trim((string) $_POST['lastname']) : '';
$age = isset($_POST['age']) ? trim((string) $_POST['age']) : '';
$speciesOptions = [
	'M' => 'Human',
	'D' => 'Dwarf',
	'E' => 'Elf',
	'H' => 'Hobbit',
];
$speciesCode = isset($_POST['species']) ? (string) $_POST['species'] : '';
$species = $speciesOptions[$speciesCode] ?? '';

$bookingOptions = [
	'accom' => 'Accommodation',
	'4day' => 'Four-day tour',
	'10day' => 'Ten-day tour',
];
$bookings = [];
foreach ($bookingOptions as $field => $label) {
	if (isset($_POST[$field])) {
		$bookings[] = $label;
	}
}

$foodOptions = [
	'none' => 'None',
	'lembas' => 'Lembas',
	'mushrooms' => 'Mushrooms',
	'ent' => 'Ent Draft',
	'cram' => 'Cram',
];
$foodCode = isset($_POST['food']) ? (string) $_POST['food'] : '';
$food = $foodOptions[$foodCode] ?? '';
$bookday = isset($_POST['bookday']) ? trim((string) $_POST['bookday']) : '';
$partysize = isset($_POST['partysize']) ? trim((string) $_POST['partysize']) : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Booking Confirmation</title>
</head>
<body>
	<h1>Rohirrim Tour Booking Confirmation</h1>
	<?php if ($_SERVER['REQUEST_METHOD'] !== 'POST'): ?>
		<p>Please submit your booking using the <a href="register.html">booking form</a>.</p>
	<?php else: ?>
		<p>Welcome <?= $escape($firstname) ?> <?= $escape($lastname) ?>!</p>
		<p>You are now booked on the <?= $escape($bookings ? implode(' and ', $bookings) : 'no tours or accommodation') ?>.</p>
		<p>Species: <?= $escape($species !== '' ? $species : 'Not specified') ?></p>
		<p>Age: <?= $escape($age !== '' ? $age : 'Not specified') ?></p>
		<p>Meal Preference: <?= $escape($food !== '' ? $food : 'Not specified') ?></p>
		<p>Date: <?= $escape($bookday !== '' ? $bookday : 'Not specified') ?></p>
		<p>Number of travellers: <?= $escape($partysize !== '' ? $partysize : 'Not specified') ?></p>
	<?php endif; ?>
</body>
</html>
