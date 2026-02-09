<?php
require_once 'core.php';
$mysqli = getDatebaseConnection();
header('Content-Type: application/json');

if ($mysqli->connect_error) {
  http_response_code(500);
  echo json_encode(['error' => 'Ошибка подключения: ' . $mysqli->connect_error]);
  exit;
}

$input = file_get_contents('php://input');
$data = $input ? json_decode($input, true) : [];

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  if (isset($_GET['action']) && $_GET['action'] === 'load') {
    $result = $mysqli->query("SELECT * FROM products");
    if ($result) {
      $products = $result->fetch_all(MYSQLI_ASSOC);
      echo json_encode($products);
    } else {
      http_response_code(500);
      echo json_encode(['error' => 'Ошибка загрузки товаров: ' . $mysqli->error]);
    }
    exit;
  } elseif (isset($_GET['action']) && $_GET['action'] === 'load_brands') {
    $result = $mysqli->query("SELECT id, name FROM brands");
    if ($result) {
      $brands = $result->fetch_all(MYSQLI_ASSOC);
      echo json_encode($brands);
    } else {
      http_response_code(500);
      echo json_encode(['error' => 'Ошибка загрузки брендов: ' . $mysqli->error]);
    }
    exit;
  } elseif (isset($_GET['action']) && $_GET['action'] === 'load_product_types') {
    $result = $mysqli->query("SELECT id, name FROM product_types");
    if ($result) {
      $types = $result->fetch_all(MYSQLI_ASSOC);
      echo json_encode($types);
    } else {
      http_response_code(500);
      echo json_encode(['error' => 'Ошибка загрузки типов продуктов: ' . $mysqli->error]);
    }
    exit;
  } elseif (isset($_GET['action']) && $_GET['action'] === 'load_attributes') {
    $result = $mysqli->query("SELECT pa.id, pa.type_id, pa.name, pt.name AS product_type_name FROM product_attrybutes pa LEFT JOIN product_types pt ON pa.type_id = pt.id");
    if ($result) {
      $attributes = $result->fetch_all(MYSQLI_ASSOC);
      echo json_encode($attributes);
    } else {
      http_response_code(500);
      echo json_encode(['error' => 'Ошибка загрузки атрибутов: ' . $mysqli->error]);
    }
    exit;
  } elseif (isset($_GET['action']) && $_GET['action'] === 'get_attributes_by_type' && isset($_GET['id'])) {
    $stmt = $mysqli->prepare("SELECT pa.id, pa.name FROM product_attrybutes pa WHERE pa.type_id = ?");
    $stmt->bind_param("i", $_GET['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $attributes = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($attributes);
    $stmt->close();
    exit;
  } elseif (isset($_GET['action']) && $_GET['action'] === 'get_brand_name' && isset($_GET['id'])) {
    $stmt = $mysqli->prepare("SELECT name FROM brands WHERE id = ?");
    $stmt->bind_param("i", $_GET['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $brand = $result->fetch_assoc();
    echo json_encode($brand ?: ['name' => 'Неизвестно']);
    $stmt->close();
    exit;
  } elseif (isset($_GET['action']) && $_GET['action'] === 'get_type_name' && isset($_GET['id'])) {
    $stmt = $mysqli->prepare("SELECT name FROM product_types WHERE id = ?");
    $stmt->bind_param("i", $_GET['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $type = $result->fetch_assoc();
    echo json_encode($type ?: ['name' => 'Неизвестно']);
    $stmt->close();
    exit;
  } elseif (isset($_GET['action']) && $_GET['action'] === 'get_product_attributes' && isset($_GET['id'])) {
    $stmt = $mysqli->prepare("SELECT pav.id, pav.product_id, pav.attribute_id, pav.value, pa.name FROM product_attrybute_values pav JOIN product_attrybutes pa ON pav.attribute_id = pa.id WHERE pav.product_id = ?");
    $stmt->bind_param("i", $_GET['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $attributes = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($attributes);
    $stmt->close();
    exit;
  } elseif (isset($_GET['action']) && $_GET['action'] === 'load_roles') {
    $result = $mysqli->query("SELECT id, name FROM role");
    if ($result) {
      $roles = $result->fetch_all(MYSQLI_ASSOC);
      echo json_encode($roles);
    } else {
      http_response_code(500);
      echo json_encode(['error' => 'Ошибка загрузки ролей: ' . $mysqli->error]);
    }
    exit;
  } elseif (isset($_GET['action']) && $_GET['action'] === 'load_users') {
    $result = $mysqli->query("SELECT * FROM users");
    if ($result) {
      $users = $result->fetch_all(MYSQLI_ASSOC);
      echo json_encode($users);
    } else {
      http_response_code(500);
      echo json_encode(['error' => 'Ошибка загрузки пользователей: ' . $mysqli->error]);
    }
    exit;
  } elseif (isset($_GET['action']) && $_GET['action'] === 'get_role_name' && isset($_GET['id'])) {
    $stmt = $mysqli->prepare("SELECT name FROM role WHERE id = ?");
    $stmt->bind_param("i", $_GET['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $role = $result->fetch_assoc();
    echo json_encode($role ?: ['name' => 'Неизвестно']);
    $stmt->close();
    exit;
  }
}

if ($data && isset($data['action'])) {
  switch ($data['action']) {
    case 'add':
      $short_description = $data['short_description'] ?? '';
      $stmt = $mysqli->prepare("INSERT INTO products (name, price, status, brand_id, types_id, description, short_description, quantity) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
      if ($stmt) {
        $stmt->bind_param("sisiissi", $data['name'], $data['price'], $data['status'], $data['brand_id'], $data['types_id'], $data['description'], $short_description, $data['quantity']);
        $success = $stmt->execute();
        $productId = $mysqli->insert_id;
        if ($mysqli->affected_rows > 0) {

          $stmt->prepare("INSERT INTO img (img_name, product_id) VALUES (?,?)");
          $stmt->bind_param('si', $data['img'], $productId);
          $img_succes = $stmt->execute();
        }
        if ($success && isset($data['attributes'])) {
          foreach ($data['attributes'] as $attributeId => $value) {
            $attrStmt = $mysqli->prepare("INSERT INTO product_attrybute_values (product_id, attribute_id, value) VALUES (?, ?, ?)");
            $attrStmt->bind_param("iis", $productId, $attributeId, $value);
            $attrStmt->execute();
            $attrStmt->close();
          }
        }
        echo json_encode(['success' => $success, 'error' => $success ? '' : 'Ошибка добавления: ' . $mysqli->error]);
      } else {
        http_response_code(500);
        echo json_encode(['error' => 'Ошибка подготовки запроса: ' . $mysqli->error]);
      }
      break;

    case 'update':
      $short_description = $data['short_description'] ?? '';
      $stmt = $mysqli->prepare("UPDATE products SET name = ?, price = ?, status = ?, brand_id = ?, types_id = ?, description = ?, short_description = ?, quantity = ? WHERE id = ?");
      if ($stmt) {
        $stmt->bind_param("sisiisssi", $data['name'], $data['price'], $data['status'], $data['brand_id'], $data['types_id'], $data['description'], $short_description, $data['quantity'], $data['id']);
        $success = $stmt->execute();
        if ($success && isset($data['attributes'])) {
          $mysqli->query("DELETE FROM product_attrybute_values WHERE product_id = " . $data['id']);
          foreach ($data['attributes'] as $attr) {
            $attrStmt = $mysqli->prepare("INSERT INTO product_attrybute_values (product_id, attribute_id , value) VALUES (?, ?, ?)");
            $attrStmt->bind_param("iis", $data['id'], $attr['attribute_id'], $attr['value']);
            $attrStmt->execute();
            $attrStmt->close();
          }
        }
        echo json_encode(['success' => $success, 'error' => $success ? '' : 'Ошибка обновления: ' . $mysqli->error]);
      } else {
        http_response_code(500);
        echo json_encode(['error' => 'Ошибка подготовки запроса: ' . $mysqli->error]);
      }
      break;

    case 'delete':
      $stmt = $mysqli->prepare("DELETE FROM product_attrybute_values WHERE product_id = ?");
      $stmt->bind_param('i', $data['id']);
      $stmt->execute();
      $stmt = $mysqli->prepare("DELETE FROM cart WHERE product_id = ?");
      $stmt->bind_param('i', $data['id']);
      $stmt->execute();
      $stmt = $mysqli->prepare("DELETE FROM img WHERE product_id = ?");
      $stmt->bind_param('i', $data['id']);
      $stmt->execute();
      $stmt = $mysqli->prepare("DELETE FROM wishlist WHERE product_id = ?");
      $stmt->bind_param('i', $data['id']);
      $stmt->execute();
      $stmt = $mysqli->prepare("DELETE FROM order_items WHERE product_id = ?");
      $stmt->bind_param('i', $data['id']);
      $stmt->execute();
      $stmt = $mysqli->prepare("DELETE FROM products WHERE id = ?");
      if ($stmt) {
        $stmt->bind_param("i", $data['id']);
        $success = $stmt->execute();
        echo json_encode(['success' => $success, 'error' => $success ? '' : 'Ошибка удаления: ' . $mysqli->error]);
      } else {
        http_response_code(500);
        echo json_encode(['error' => 'Ошибка подготовки запроса: ' . $mysqli->error]);
      }
      break;

    case 'add_brand':
      $stmt = $mysqli->prepare("INSERT INTO brands (name) VALUES (?)");
      if ($stmt) {
        $stmt->bind_param("s", $data['name']);
        $success = $stmt->execute();
        echo json_encode(['success' => $success, 'error' => $success ? '' : 'Ошибка добавления бренда: ' . $mysqli->error]);
      } else {
        http_response_code(500);
        echo json_encode(['error' => 'Ошибка подготовки запроса: ' . $mysqli->error]);
      }
      break;

    case 'update_brand':
      $stmt = $mysqli->prepare("UPDATE brands SET name = ? WHERE id = ?");
      if ($stmt) {
        $stmt->bind_param("si", $data['name'], $data['id']);
        $success = $stmt->execute();
        echo json_encode(['success' => $success, 'error' => $success ? '' : 'Ошибка обновления бренда: ' . $mysqli->error]);
      } else {
        http_response_code(500);
        echo json_encode(['error' => 'Ошибка подготовки запроса: ' . $mysqli->error]);
      }
      break;

    case 'delete_brand':
      $stmt = $mysqli->prepare("DELETE FROM brands WHERE id = ?");
      if ($stmt) {
        $stmt->bind_param("i", $data['id']);
        $success = $stmt->execute();
        echo json_encode(['success' => $success, 'error' => $success ? '' : 'Ошибка удаления бренда: ' . $mysqli->error]);
      } else {
        http_response_code(500);
        echo json_encode(['error' => 'Ошибка подготовки запроса: ' . $mysqli->error]);
      }
      break;

    case 'add_product_type':
      $stmt = $mysqli->prepare("INSERT INTO product_types (name) VALUES (?)");
      if ($stmt) {
        $stmt->bind_param("s", $data['name']);
        $success = $stmt->execute();
        echo json_encode(['success' => $success, 'error' => $success ? '' : 'Ошибка добавления типа товара: ' . $mysqli->error]);
      } else {
        http_response_code(500);
        echo json_encode(['error' => 'Ошибка подготовки запроса: ' . $mysqli->error]);
      }
      break;

    case 'update_product_type':
      $stmt = $mysqli->prepare("UPDATE product_types SET name = ? WHERE id = ?");
      if ($stmt) {
        $stmt->bind_param("si", $data['name'], $data['id']);
        $success = $stmt->execute();
        echo json_encode(['success' => $success, 'error' => $success ? '' : 'Ошибка обновления типа товара: ' . $mysqli->error]);
      } else {
        http_response_code(500);
        echo json_encode(['error' => 'Ошибка подготовки запроса: ' . $mysqli->error]);
      }
      break;

    case 'delete_product_type':
      $stmt = $mysqli->prepare("DELETE FROM product_types WHERE id = ?");
      if ($stmt) {
        $stmt->bind_param("i", $data['id']);
        $success = $stmt->execute();
        echo json_encode(['success' => $success, 'error' => $success ? '' : 'Ошибка удаления типа товара: ' . $mysqli->error]);
      } else {
        http_response_code(500);
        echo json_encode(['error' => 'Ошибка подготовки запроса: ' . $mysqli->error]);
      }
      break;

    case 'add_attribute':
      $stmt = $mysqli->prepare("INSERT INTO product_attrybutes (type_id, name) VALUES (?, ?)");
      if ($stmt) {
        $stmt->bind_param("is", $data['product_type_id'], $data['name']);
        $success = $stmt->execute();
        echo json_encode(['success' => $success, 'error' => $success ? '' : 'Ошибка добавления атрибута: ' . $mysqli->error]);
      } else {
        http_response_code(500);
        echo json_encode(['error' => 'Ошибка подготовки запроса: ' . $mysqli->error]);
      }
      break;

    case 'update_attribute':
      $stmt = $mysqli->prepare("UPDATE product_attrybutes SET type_id = ?, name = ? WHERE id = ?");
      if ($stmt) {
        $stmt->bind_param("isi", $data['product_type_id'], $data['name'], $data['id']);
        $success = $stmt->execute();
        echo json_encode(['success' => $success, 'error' => $success ? '' : 'Ошибка обновления атрибута: ' . $mysqli->error]);
      } else {
        http_response_code(500);
        echo json_encode(['error' => 'Ошибка подготовки запроса: ' . $mysqli->error]);
      }
      break;

    case 'delete_attribute':
      $stmt = $mysqli->prepare("DELETE FROM product_attrybutes WHERE id = ?");
      if ($stmt) {
        $stmt->bind_param("i", $data['id']);
        $success = $stmt->execute();
        echo json_encode(['success' => $success, 'error' => $success ? '' : 'Ошибка удаления атрибута: ' . $mysqli->error]);
      } else {
        http_response_code(500);
        echo json_encode(['error' => 'Ошибка подготовки запроса: ' . $mysqli->error]);
      }
      break;

    case 'add_user':
      $stmt = $mysqli->prepare("INSERT INTO users (name, email, password, role_id) VALUES (?, ?, ?, ?)");
      if ($stmt) {
        $stmt->bind_param("sssi", $data['name'], $data['email'], $data['password'], $data['role_id']);
        $success = $stmt->execute();
        echo json_encode(['success' => $success, 'error' => $success ? '' : 'Ошибка добавления пользователя: ' . $mysqli->error]);
      } else {
        http_response_code(500);
        echo json_encode(['error' => 'Ошибка подготовки запроса: ' . $mysqli->error]);
      }
      break;

    case 'update_user':
      $stmt = $mysqli->prepare("UPDATE users SET name = ?, email = ?, password = ?, role_id = ? WHERE id = ?");
      if ($stmt) {
        $stmt->bind_param("sssii", $data['name'], $data['email'], $data['password'], $data['role_id'], $data['id']);
        $success = $stmt->execute();
        echo json_encode(['success' => $success, 'error' => $success ? '' : 'Ошибка обновления пользователя: ' . $mysqli->error]);
      } else {
        http_response_code(500);
        echo json_encode(['error' => 'Ошибка подготовки запроса: ' . $mysqli->error]);
      }
      break;

    case 'delete_user':
      $stmt = $mysqli->prepare("DELETE FROM users WHERE id = ?");
      if ($stmt) {
        $stmt->bind_param("i", $data['id']);
        $success = $stmt->execute();
        echo json_encode(['success' => $success, 'error' => $success ? '' : 'Ошибка удаления пользователя: ' . $mysqli->error]);
      } else {
        http_response_code(500);
        echo json_encode(['error' => 'Ошибка подготовки запроса: ' . $mysqli->error]);
      }
      break;

    default:
      http_response_code(400);
      echo json_encode(['error' => 'Недопустимое действие']);
  }
  if (isset($stmt)) $stmt->close();
}

$mysqli->close();
