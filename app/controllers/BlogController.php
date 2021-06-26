<?php


namespace app\controllers;

use app\core\Controller;
use app\core\View;
use app\models\BlogModel;
use app\models\CommentsModel;

class BlogController extends Controller
{
    const PAGES = 4;

    public function indexAction()
    {
        if (!isset($_GET["id"])) {
            $blogRecords = BlogModel::paginate(self::PAGES);
            $blogNumPage = ceil(BlogModel::getNumRow() / self::PAGES);

            $this->view->render("Новости", [
                "menuIndex" => 10,
                "blogRecords" => $blogRecords,
                "blogNumPage" => $blogNumPage
            ]);
        } else {
            $this->showBlogContentPage($_GET["id"]);
        }
    }

    public function addCommentAction(){
        $comment = new CommentsModel();

        $comment->comment_text = $_POST["text"];
        $comment->blog_id = (int)$_POST["id"];
        $last_comment_num = (int)$_POST['last_comment_num'];

        try {
            $comment->save();
            echo "<div class=\"comments__item\">
                        <p class=\"comments__num\">Комментарий #". ($last_comment_num + 1) ."</p>
                        <span>
                            $comment->comment_text
                        </span>
                    </div>";
        } catch (\Exception $e) {
            echo json_encode([
                "icon" => "error",
                "title" => "При добавлении произошла ошибка"
            ]);
        }
    }

    public function showBlogContentPage($id)
    {
        $blogData = BlogModel::find($id);
        $comments = CommentsModel::findAll($id, "blog_id");

        $this->view->render("Мой блог", [
            "menuIndex" => 10,
            "blogData" => $blogData,
            "comments" => $comments
        ], "blog/blogContent");
    }

    public function editAction()
    {

        AdminPanelController::authenticate();

        $blogRecords = BlogModel::paginate(self::PAGES);
        $blogNumPage = ceil(BlogModel::getNumRow() / self::PAGES);



        $this->view->render("Редактирование новости", [
            "menuIndex" => 10,
            "blogRecords" => $blogRecords,
            "blogNumPage" => $blogNumPage
        ]);
    }

    public function editRecordAction()
    {
        AdminPanelController::authenticate();
        if (empty($_POST)) View::errorCode(404);

        $blog = BlogModel::find($_POST["blog_id"]);

        $blog->title = $_POST["title"];
        $blog->text = $_POST["text"];
        $blog->title = $_POST["img"];

        try {
            $blog->update();
            echo json_encode([
                "icon" => "success",
                "title" => "Данные успешно изменены",
                "blogTitle" => $_POST["title"],
                "blogText" => $_POST["text"]
            ]);
        } catch (\Exception $e) {
            echo json_encode([
                "icon" => "error",
                "title" => "При изменении произошла ошибка"
            ]);
        }
    }
    public function deleteRecordAction()
    {
        AdminPanelController::authenticate();
        if (empty($_POST)) View::errorCode(404);
        $blog = BlogModel::find($_POST["blog_id"]);
        try {
            $blog->delete();
            echo json_encode([
                "icon" => "success",
                "title" => "Данные удалены",
            ]);
        } catch (\Exception $e) {
            echo json_encode([
                "icon" => "error",
                "title" => "При изменении произошла ошибка"
            ]);
        }
    }

    public function loadAction()
    {
        AdminPanelController::authenticate();

        if (!empty($_FILES)) {
            $filename = "public/" . $_FILES["file"]["name"];

            if (file_exists($filename) && !is_dir($filename)) {
                $messages = BlogModel::getCSVData($filename);
                $this->saveCSV($messages);
            } else $errors[] = "Файл не существует";
        }

        $this->view->render("Загрузка сообщений блога", [
            "menuIndex" => 10,
            "messages" => BlogModel::all("created_at", "ASC")
        ]);
    }

    function saveCSV($messages)
    {
        foreach ($messages as $message) {
            $blog = new BlogModel();

            $blog->title = $message[0];
            $blog->text = $message[1];
            $blog->img = $message[2];
            $blog->created_at = $message[3];

            $blog->save();
        }
    }

    function save()
    {
        $blog = new BlogModel();

        $blog->created_at = date('Y-m-d H:i:s');
        $blog->title = $_POST["title"];
        $blog->img = $_POST["img"];
        $blog->text = $_POST["text"];

        $blog->save();
    }
}