<?php

namespace CMW\Controller\Faq;

use CMW\Controller\CoreController;
use CMW\Controller\Menus\MenusController;
use CMW\Controller\users\UsersController;
use CMW\Entity\Users\UserEntity;
use CMW\Model\faq\FaqModel;
use CMW\Model\users\UsersModel;

/**
 * Class: @faqController
 * @package faq
 * @author Teyir
 * @version 1.0
 */
class FaqController extends CoreController
{

    public static string $themePath;

    public function __construct($themePath = null)
    {
        parent::__construct($themePath);
    }

    public function faqList(): void
    {
        UsersController::isUserHasPermission("faq.show");

        $faq = new FaqModel();
        $faqList = $faq->fetchAll();

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

        $faq = new FaqModel();
        $faq->fetch($id);


        view('faq', 'edit.admin', ["faq" => $faq], 'admin', []);
    }

    public function faqEditPost($id): void
    {
        UsersController::isUserHasPermission("faq.edit");

        $faq = new FaqModel();
        $faq->faqId = $id;
        $faq->question = filter_input(INPUT_POST, "question");
        $faq->response = filter_input(INPUT_POST, "response");
        $faq->update();

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

        $faq = new FaqModel();
        $faq->question = filter_input(INPUT_POST, "question");
        $faq->response = filter_input(INPUT_POST, "response");

        //Get the author pseudo
        $user = new UsersModel;
        $userEntity = $user->getUserById($_SESSION['cmwUserId']);
        $faq->author = $userEntity->getId();

        $faq->faqCreate();

        header("location: ../faq/list");

    }

    public function faqDelete(): void
    {
        UsersController::isUserHasPermission("faq.delete");

        $faq = new FaqModel();
        $faq->faqId = filter_input(INPUT_POST, "id");
        $faq->delete();

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
        $faqList = $faq->fetchAll();

        //Include the public view file ("public/themes/$themePath/views/faq/main.view.php")
        view('faq', 'main', ["faq" => $faq, "faqList" => $faqList, "core" => $core, "menu" => $menu], 'public', []);
    }
}
