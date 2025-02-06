<?php

session_start();

class Note {
    private $notes = [];

    public function __construct() {
        if(isset($_SESSION['notes'])) {
            $this->notes = $_SESSION['notes'];
        }
    }

    public function add($note) {
        $this->notes[] = $note;
        $_SESSION['notes'] = $this->notes;
    }

    public function getAll() {
        return $this->notes;
    }

    public function edit($index, $newNote) {
        if(isset($this->notes[$index])) {
            $this->notes[$index] = $newNote;
            $_SESSION['notes'] = $this->notes;
        }
    }

    public function delete($index) {
        if(isset($this->notes[$index])) {
            array_splice($this->notes, $index, 1);
            $_SESSION['notes'] = $this->notes;
        }
    }
}

$note = new Note();

if(isset($_POST['action'])) {
    if($_POST['action'] == 'add') {
        $note->add($_POST['note']);
    } elseif($_POST['action'] == 'edit') {
        $note->edit($_POST['index'], $_POST['new_note']);
    } elseif($_POST['action'] == 'delete') {
        $note->delete($_POST['index']);
    }
}

$allNotes = $note->getAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP OOP Notes App</title>
</head>
<body>
    <h1>PHP OOP Notes App</h1>
    <form method="post">
        <input type="text" name="note" placeholder="Enter your note">
        <button type="submit" name="action" value="add">Add Note</button>
    </form>
    <h2>Notes:</h2>
    <ul>
        <?php foreach($allNotes as $index => $note): ?>
            <li>
                <?= $note ?>
                <form method="post" style="display: inline;">
                    <input type="hidden" name="index" value="<?= $index ?>">
                    <input type="text" name="new_note" placeholder="Enter new note">
                    <button type="submit" name="action" value="edit">Edit</button>
                    <button type="submit" name="action" value="delete">Delete</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
