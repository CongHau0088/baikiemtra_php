<?php
require_once 'app/config/database.php';

function getNganhHocs() {
    $db = new Database();
    $conn = $db->getConnection();
    $query = "SELECT MaNganh, TenNganh FROM nganhhoc";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}
?>