<?php
// Includi il file di connessione al database
require_once "db_connection.php";

// Creazione della tabella "users" con prepared statement
$sql_users = "CREATE TABLE IF NOT EXISTS users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL
)";

if ($conn->query($sql_users) === TRUE) {
    echo "Tabella 'users' creata con successo o già esistente.\n";

    // Inserimento dei dati di esempio nella tabella "users" con prepared statement
    $users_data = [
        ['Nicola Milella','nicola.milella@aulab.es','7c222fb2927d828af22f592134e8932480637c0d'], // 12345678
        ['John Doe', 'john@example.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8'], // password
        ['Ciro Esposito', 'ciresp@example.com', '9d0d544ec710b5e84b8b7a7326830f3433a6c0cb'],
        ['Michael Johnson', 'michael@example.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8'],// password
        ['Mario Rossi', 'mariorossi88@example.com', '51289b4650b22b1e68bfa73c0ff7422437dbc70a1cabebd04b5d985c4153692c'],
        ['David Wilson', 'david@example.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8'],// password
        ['Jessica Anderson', 'jessica@example.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8'],// password
        ['Daniel Thomas', 'daniel@example.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8'],// password
        ['Sarah Martinez', 'sarah@example.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8'],// password
        ['Christopher Brown', 'christopher@example.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8'],// password
        ['Olivia Taylor', 'olivia@example.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8']// password
    ];

    // Preparazione dello statement di inserimento per la tabella "users"
    $stmt_insert_user = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");

    // Bind dei parametri per l'inserimento dei dati nella tabella "users"
    $stmt_insert_user->bind_param("sss", $name, $email, $password);

    // Esecuzione dello statement per l'inserimento dei dati nella tabella "users"
    foreach ($users_data as $user) {
        $name = $user[0];
        $email = $user[1];
        $password = $user[2];

        if ($stmt_insert_user->execute() === FALSE) {
            echo "Errore durante l'inserimento dell'utente: " . $stmt_insert_user->error;
        }
    }

    // Chiudi lo statement di inserimento per la tabella "users"
    $stmt_insert_user->close();
} else {
    echo "Errore durante la creazione della tabella 'users': " . $conn->error;
}

// Creazione della tabella "movies" con prepared statement
$sql_movies = "CREATE TABLE IF NOT EXISTS movies (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    year INT(4) NOT NULL
)";

if ($conn->query($sql_movies) === TRUE) {
    echo "Tabella 'movies' creata con successo o già esistente.\n";

    // Inserimento dei dati di esempio nella tabella "movies" con prepared statement
    $movies_data = [
        ['Il padrino', 1972],
        ['Forrest Gump', 1994],
        ['Pulp Fiction', 1994],
        ['Il signore degli anelli - La compagnia dell\'anello', 2001],
        ['Schindler\'s List', 1993],
        ['Fight Club', 1999],
        ['Il buono, il brutto, il cattivo', 1966],
        ['The Shawshank Redemption', 1994],
        ['Inception', 2010],
        ['Interstellar', 2014],
        ['The Godfather: Part II', 1974],
        ['The Dark Knight', 2008],
        ['The Matrix', 1999],
        ['La vita è bella', 1997],
        ['Seven', 1995],
        ['Forrest Gump 2', 1998],
        ['La lista di Schindler', 1993],
        ['Guerre stellari', 1977],
        ['E.T. - L\'extraterrestre', 1982],
        ['Il cavaliere oscuro', 2008]
    ];

    // Preparazione dello statement di inserimento per la tabella "movies"
    $stmt_insert_movie = $conn->prepare("INSERT INTO movies (title, year) VALUES (?, ?)");

    // Bind dei parametri per l'inserimento dei dati nella tabella "movies"
    $stmt_insert_movie->bind_param("si", $title, $year);

    // Esecuzione dello statement per l'inserimento dei dati nella tabella "movies"
    foreach ($movies_data as $movie) {
        $title = $movie[0];
        $year = $movie[1];

        if ($stmt_insert_movie->execute() === FALSE) {
            echo "Errore durante l'inserimento del film: " . $stmt_insert_movie->error;
        }
    }

    // Chiudi lo statement di inserimento per la tabella "movies"
    $stmt_insert_movie->close();
} else {
    echo "Errore durante la creazione della tabella 'movies': " . $conn->error;
}

// Chiudi la connessione al database
$conn->close();
?>
