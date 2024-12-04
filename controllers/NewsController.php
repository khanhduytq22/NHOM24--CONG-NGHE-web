<?php
    require_once(__DIR__ . '/../models/News.php');
    class NewsController {
        public function add() {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $title = $_POST['title'];
                $content = $_POST['content'];
                
                $dateCreated = $_POST['dateCreated'] ?? '';
                $categoryId = $_POST['categoryId'] ?? '';

                $image = '';
                if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                    $imageTmpPath = $_FILES['image']['tmp_name'];
                    $imageName = $_FILES['image']['name'];
                    $imagePath = 'uploads/' . $imageName;

                    if (move_uploaded_file($imageTmpPath, $imagePath)) {
                        $image = $imagePath;
                    }
                }

                $news = new News();
                $news->addNews($title, $content, $image, $dateCreated, $categoryId);

                header("Location: views/admin/dashboard.php");
                exit();
            }
            
            include __DIR__ . '/views/admin/news/add.php';
        }
          
        public function getEditNews() {
            if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
                $id = $_GET['id'];
                $news = new News();
                $newsEdit = $news->getNewsById($id);

                return $newsEdit;
            }
        }

        public function update() {
            if (isset($_GET['id'])) {
                $id = intval($_GET['id']);
                $title = trim($_POST['title']);
                $content = trim($_POST['content']);
                $dateCreated = $_POST['dateCreated'];
                $categoryId = intval($_POST['categoryId']);

                $image = '';
                if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                    $imageTmpPath = $_FILES['image']['tmp_name'];
                    $imageName = $_FILES['image']['name'];
                    $imagePath = 'uploads/' . $imageName;

                    if (move_uploaded_file($imageTmpPath, $imagePath)) {
                        $image = $imagePath;
                    }
                }
        
                $news = new News();
                $updateStatus = $news->updateNews($id, $title, $content, $dateCreated, $categoryId, $image);
        
                if ($updateStatus) {
                    header('Location: views/admin/dashboard.php');
                    exit;
                } else {
                    die('Failed to update news!');
                }
            } else {
                die('Invalid request!');
            }
        }

        public function delete() {
            if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
                $id = $_GET['id'];
        
                $news = new News();
                $news->deleteNews($id);
        
                header("Location: views/admin/dashboard.php");
                exit();
            }
            echo "Yêu cầu không hợp lệ.";
        }
    }
?>