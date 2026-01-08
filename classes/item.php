<?php

class Product {
    public $connect;

    public function __construct($connect) {
        $this->connect = $connect;
    }

    public function getAll() {
        return $this->connect->query("SELECT * FROM products")->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->connect->prepare("SELECT * FROM products WHERE product_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($title, $description, $price, $category_id, $image) {
        $stmt = $this->connect->prepare("
            INSERT INTO products (title, descirption, price, category_id, image)
            VALUES (?, ?, ?, ?, ?)
        ");
        return $stmt->execute([$title, $description, $price, $category_id, $image]);
    }

    public function update($id, $title, $description, $price, $category_id, $image) {
        $stmt = $this->connect->prepare("
            UPDATE products
            SET title = ?, descirption = ?, price = ?, category_id = ?, image = ?
            WHERE product_id = ?
        ");
        return $stmt->execute([$title, $description, $price, $category_id, $image, $id]);
    }

    public function delete($id) {
        $stmt = $this->connect->prepare("DELETE FROM products WHERE product_id = ?");
        return $stmt->execute([$id]);
    }

public function getFiltered($category_id = null, $search = null) {
    $sql = "SELECT * FROM products WHERE 1=1";
    $params = [];

    if ($category_id) {
        $sql .= " AND category_id = ?";
        $params[] = $category_id;
    }

    if ($search) {
        $sql .= " AND title LIKE ?";
        $params[] = "%$search%";
    }

    $stmt = $this->connect->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function getOne($id) {
    $stmt = $this->connect->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}}