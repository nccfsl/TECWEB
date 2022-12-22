<?php 
namespace DB;
class DBAccess {
    private const HOST_DB = "127.0.0.1";
    private const DATABASE_NAME = "nfasolo";
    private const USERNAME = "nfasolo";
    private const PASSWORD = "iaW4lexa9neereeg";

    private $connection;

    public function openDBConnection() {
        mysqli_report(MYSQLI_REPORT_ERROR);
        $this->connection = mysqli_connect(DBAccess::HOST_DB, DBAccess::DATABASE_NAME, DBAccess::USERNAME, DBAccess::PASSWORD);

        if (mysqli_connect_errno()) {
            return false;
        }
        else {
            return true;
        }
    }

    public function getList() {
        $query = "SELECT * FROM giocatori ORDER BY ID ASC";
        $queryResult = mysqli_query($this->connection, $query) or die("Errore in openDBConnection: " . mysqli_error($this->connection));

        if (mysqli_num_rows($queryResult) == 0) {
            return null;
        }
        else {
            $result = array();
            while ($riga = mysqli_fetch_assoc($queryResult)) {
                array_push($result, $riga);
            }
            $queryResult->free();
            return $result;
        }
    }

    public function insertNewPlayer($nome, $capitano, $dataNascita, $luogo, $squadra, $ruolo, $altezza, $maglia, $magliaNazionale, $punti, $riconoscimenti, $note) {
        $query = "INSERT INTO giocatori (nome, capitano, dataNascita, luogo, squadra, ruolo, altezza, maglia, magliaNazionale, punti, riconoscimenti, note) VALUES (\"$nome\", $capitano, \"$dataNascita\", \"$luogo\", \"$squadra\", \"$ruolo\", $altezza, $maglia, $magliaNazionale, $punti, \"$riconoscimenti\", \"$note\")";

        $queryOK = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
        if (mysqli_affected_rows($this->connection) > 0) {
            return true;
        }
        else {
            return false;
        }
    }

    public function deletePayer($id) {
        $query = "DELETE FROM giocatori WHERE ID = $id";

        $queryOK = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
        if (mysqli_affected_rows($this->connection) > 0) {
            return true;
        }
        else {
            return false;
        }
    }

    public function closeConnection() {
        mysqli_close($this->connection);
    }
}
?>