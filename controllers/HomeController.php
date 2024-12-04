<?php
    require_once(__DIR__ . '/../models/News.php');
    class HomeController {
        public function getDetails() {
            if (isset($_GET['id'])) {
                $id = $_GET['id'];

                $news = new News();
                $newsDetails = $news->getNewsById($id);

                return $newsDetails;
            } else {
                header('Location: index.php');
                exit();
            }
        }
        public function search() {
            if (isset($_POST['query']) && !empty(trim($_POST['query']))) {
                $query = trim($_POST['query']);
        
                header('Location: views/news/search.php?query=' . urlencode($query));
                exit();
            } else {
                header('Location: index.php');
                exit();
            }
        }
    }
?>