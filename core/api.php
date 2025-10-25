<?php
require_once 'config.php';

header('Content-Type: application/json');


$action = $_GET['action'] ?? $_POST['action'];

switch ($action){
    case 'getAllPositions' :
        $stmt = $pdo->prepare("SELECT * FROM `position`");
        $stmt->execute();
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
        break;
    case 'getPositionByElection' :
        $id_election = $_GET['id_election'];

        $stmt = $pdo->prepare("SELECT * FROM `position` WHERE id_election = ?");
        $stmt->execute([$id_election]);
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
        break;
    case 'getCandidatesByPosition' :
        $id_position = $_GET['id_position'];

        $stmt = $pdo->prepare("SELECT * FROM `candidates` WHERE id_position = ?");
        $stmt->execute([$id_position]);
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
        break;
    case '':
        break;
    default:
        echo json_encode(["error" => "Unknown action"]);
        break;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    function clean_input($data) {
        return trim(htmlspecialchars($data, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'));
    }
    function scan_files_allow($file, $type, $name) {
        $filename = basename($file['name']);
        $allowed = ['jpg', 'jpeg', 'png'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if (!in_array($ext, $allowed)) {
            echo json_encode(["error" => "Image format is not valid"]);
            exit();
        }

        $candidates_dir =  'assets\images\\' . $type . '\\';

        if (!is_dir($candidates_dir)) {
            mkdir($candidates_dir, 0755, true);
        }

        $new_file_name = $name . '_' . uniqid() . '_' . time() . '.' . $ext;
        $destination = $candidates_dir . $new_file_name;

        if (!move_uploaded_file($file['tmp_name'], '..\\'.$destination)) {
            echo json_encode(["error" => "Failed to move uploaded file"]);
            exit();
        }

        return $destination;
    }


    switch ($action){
        case 'stopElection' :
            $id_Election = clean_input($_POST['id_Election']);

            try {
                $stmt = $pdo->prepare("UPDATE `election` SET `status`= 0 WHERE id = ?");
                $stmt->execute([$id_Election]);
                echo json_encode(["success" => "Election Was Stoped successfully"]);
            } catch (PDOException $e) {
                echo json_encode(["error" => $e->getMessage()]);
            }
            break;
        case 'addElection' :
            $ar_organizer = clean_input($_POST['ar_organizer']);
            $en_organizer = clean_input($_POST['en_organizer']);
            $fr_organizer = clean_input($_POST['fr_organizer']);
            $year = clean_input($_POST['year']);
            $date_start = clean_input($_POST['date_start']);
            $date_end = clean_input($_POST['date_end']);

            try {
                $stmt = $pdo->prepare("INSERT INTO `election`(`en_organizer`, `fr_organizer`, `ar_organizer`, `year`, `start_date`, `end_date`) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->execute([$en_organizer, $fr_organizer, $ar_organizer, $year, $date_start, $date_end]);
                echo json_encode(["success" => "Election added successfully"]);
            } catch (PDOException $e) {
                echo json_encode(["error" => $e->getMessage()]);
            }
            break;
        case 'addPosition' :
            $ar_name = clean_input($_POST['ar_name']);
            $en_name = clean_input($_POST['en_name']);
            $fr_name = clean_input($_POST['fr_name']);
            $id_election = clean_input($_POST['id_election']);

            try {
                $stmt = $pdo->prepare("INSERT INTO `position`(`fr_name`, `en_name`, `ar_name`, `id_Election`) VALUES (?, ?, ?, ?)");
                $stmt->execute([$fr_name, $en_name, $ar_name, $id_election]);
                echo json_encode(["success" => "Position added successfully"]);
            } catch (PDOException $e) {
                echo json_encode(["error" => $e->getMessage()]);
            }
            break;
        case 'addCandidate' :
            $ar_name = clean_input($_POST['ar_name']);
            $name = clean_input($_POST['name']);
            $ar_description = clean_input($_POST['ar_description']);
            $fr_description = clean_input($_POST['fr_description']);
            $en_description = clean_input($_POST['en_description']);
            $supporting_party = clean_input($_POST['supporting_party']);
            $id_position = (int) $_POST['id_position'];
            $nominate_at = date('Y-m-d');

            $photo_candidate_path = scan_files_allow($_FILES['photo_candidate'], 'candidates', $name);
            $logo_supporting_path = scan_files_allow($_FILES['logo_supporting'], 'supportings', $name);

            try {
                $stmt = $pdo->prepare("INSERT INTO `candidates`(`name`, `ar_name`, `photo_path`, `fr_description`, `en_description`, `ar_description`, `nominated_at`, `Supporting_party`, `path_supporting_party_logo`, `id_position`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([$name, $ar_name, $photo_candidate_path, $fr_description, $en_description, $ar_description, $nominate_at, $supporting_party, $logo_supporting_path, $id_position]);
                echo json_encode(["success" => "Candidate added successfully"]);
            } catch (PDOException $e) {
                echo json_encode(["error" => $e->getMessage()]);
            }
            break;
        case 'publishResults' :
            $id_Election = clean_input($_POST['id_election']);

            try {
                $stmt = $pdo->prepare("UPDATE `election` SET `results`= 'publish' WHERE id = ?");
                $stmt->execute([$id_Election]);
                echo json_encode(["success" => "Election Results Was Publish successfully"]);
            } catch (PDOException $e) {
                echo json_encode(["error" => $e->getMessage()]);
            }
            break;
        case 'stopPublishingResults' :
            $id_Election = clean_input($_POST['id_election']);

            try {
                $stmt = $pdo->prepare("UPDATE `election` SET `results`= 'nopublish' WHERE id = ?");
                $stmt->execute([$id_Election]);
                echo json_encode(["success" => "Election Results Was Publish successfully"]);
            } catch (PDOException $e) {
                echo json_encode(["error" => $e->getMessage()]);
            }
            break;
        default:
            echo json_encode(["error" => "Unknown action"]);
            break;
    }
} 