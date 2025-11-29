<?php
// helper functions

// check if user logged in
function isLoggedIn() {
    return isset($_SESSION['admin_id']);
}

// redirect to login if not logged in
function requireLogin() {
    if(!isLoggedIn()) {
        header('Location: ' . BASE_PATH . '/login.php');
        exit;
    }
}

// clean input data
function clean($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// handle image upload
function uploadImage($file) {
    $err = [];
    
    // check if file uploaded
    if($file['error'] !== UPLOAD_ERR_OK) {
        $err[] = 'upload failed';
        return ['success' => false, 'errors' => $err];
    }
    
    // check file size (5mb max)
    if($file['size'] > 5000000) {
        $err[] = 'file too large';
        return ['success' => false, 'errors' => $err];
    }
    
    // allowed types
    $allowed = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
    if(!in_array($file['type'], $allowed)) {
        $err[] = 'invalid file type';
        return ['success' => false, 'errors' => $err];
    }
    
    // generate unique filename
    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = uniqid() . '.' . $ext;
    $destination = UPLOAD_PATH . $filename;
    
    // move file
    if(move_uploaded_file($file['tmp_name'], $destination)) {
        return ['success' => true, 'filename' => $filename];
    } else {
        $err[] = 'failed to save file';
        return ['success' => false, 'errors' => $err];
    }
}

// delete image file
function deleteImage($filename) {
    $path = UPLOAD_PATH . $filename;
    if(file_exists($path)) {
        unlink($path);
    }
}
?>