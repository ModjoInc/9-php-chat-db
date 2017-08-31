<?
include 'pdo.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

	$req = $conn->query("SELECT * FROM (SELECT message.id AS id, message.content AS content, HOUR(message.date) AS hour, MINUTE(message.date) AS minutes, user.pseudo AS user FROM message INNER JOIN user ON message.user_id = user.id ORDER BY message.id DESC LIMIT 10) AS new ORDER BY id ASC");

?>


		<ul>
		<?

		while ($row = $req -> fetch()) : ?>

			<li>
				<strong><? $row['user']; ?></strong>
				[<? $row['hour']; ?>:<? $row['minutes']; ?>]
				<? $row['content']; ?>
			</li>

		<? endwhile; ?>

		</ul>
