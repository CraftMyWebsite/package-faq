<?php

namespace CMW\Controller\Faq;

use CMW\Controller\CoreController;
use CMW\Controller\Menus\MenusController;
use CMW\Controller\users\UsersController;
use CMW\Model\faq\FaqModel;
use CMW\Model\users\UsersModel;
use JetBrains\PhpStorm\NoReturn;

/**
 * Class: @faqController
 * @package faq
 * @author Teyir
 * @version 1.0
 */
class FaqController extends CoreController
{

    public static string $themePath;
    private FaqModel $faqModel;

    public function __construct($themePath = null)
    {
        parent::__construct($themePath);
        $this->faqModel = new FaqModel();

    }

    public function faqList(): void
    {
        UsersController::isUserHasPermission("faq.show");


        $faqList = $this->faqModel->getFaqs();

        $includes = array(
            "scripts" => [
                "before" => [
                    "admin/resources/vendors/bootstrap/js/bootstrap.bundle.min.js",
                    "admin/resources/vendors/datatables/jquery.dataTables.min.js",
                    "admin/resources/vendors/datatables-bs4/js/dataTables.bootstrap4.min.js",
                    "admin/resources/vendors/datatables-responsive/js/dataTables.responsive.min.js",
                    "admin/resources/vendors/datatables-responsive/js/responsive.bootstrap4.min.js",
                    "admin/resources/vendors/datatables-buttons/js/dataTables.buttons.min.js",

                ],
            ],
            "styles" => [
                "admin/resources/vendors/datatables-bs4/css/dataTables.bootstrap4.min.css",
                "admin/resources/vendors/datatables-responsive/css/responsive.bootstrap4.min.css"
            ]);

        //Include the view file ("views/list.admin.view.php").
        view('faq', 'list.admin', ["faqList" => $faqList], 'admin', $includes);
    }

    public function faqEdit($id): void
    {
        UsersController::isUserHasPermission("faq.edit");


        $faq = $this->faqModel->getFaqById($id);


        view('faq', 'edit.admin', ["faq" => $faq], 'admin', []);
    }

    #[NoReturn] public function faqEditPost($id): void
    {
        UsersController::isUserHasPermission("faq.edit");


        $question = filter_input(INPUT_POST, "question", FILTER_SANITIZE_STRING);
        $response = filter_input(INPUT_POST, "response", FILTER_SANITIZE_STRING);

        $this->faqModel->updateFaq($id, $question, $response);

        header("location: ../edit/" . $id);
        die();
    }

    public function faqAdd(): void
    {
        UsersController::isUserHasPermission("faq.create");

        view('faq', 'add.admin', [], 'admin', []);
    }

    public function faqAddPost(): void
    {
        UsersController::isUserHasPermission("faq.create");

        $question = filter_input(INPUT_POST, "question", FILTER_SANITIZE_STRING);
        $response = filter_input(INPUT_POST, "response", FILTER_SANITIZE_STRING);

        //Get the author pseudo
        $user = new UsersModel;
        $userEntity = $user->getUserById($_SESSION['cmwUserId']);
        $userId = $userEntity->getId();

        $this->faqModel->createFaq($question, $response, $userId);

        header("location: ../faq/list");

    }

    #[NoReturn] public function faqDelete(): void
    {
        UsersController::isUserHasPermission("faq.delete");


        $faqId = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);
        $this->faqModel->deleteFaq($faqId);

        header("location: ../faq/list");
        die();
    }


    /* //////////////////// FRONT PUBLIC //////////////////// */

    public function frontFaqPublic(): void
    {

        //Default controllers (important)
        $core = new CoreController();
        $menu = new MenusController();

        $faq = new FaqModel();
        $faqList = $faq->getFaqs();

        //Include the public view file ("public/themes/$themePath/views/faq/main.view.php")
        view('faq', 'main', ["faq" => $faq, "faqList" => $faqList, "core" => $core, "menu" => $menu], 'public', []);
    }
}
