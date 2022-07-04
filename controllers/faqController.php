<?php

namespace CMW\Controller\Faq;

use CMW\Controller\CoreController;
use CMW\Controller\Menus\MenusController;
use CMW\Controller\users\UsersController;
use CMW\Model\faq\faqModel;
use CMW\Model\users\UsersModel;

/**
 * Class: @faqController
 * @package faq
 * @author Teyir
 * @version 1.0
 */
class faqController extends CoreController
{

    public static string $themePath;

    public function __construct($themePath = null)
    {
        parent::__construct($themePath);
    }

    public function faqList(): void
    {
        UsersController::isUserHasPermission("faq.show");

        $faq = new faqModel();
        $faqList = $faq->fetchAll();

        //Include the view file ("views/list.admin.view.php").
        view('faq', 'list.admin', ["faqList" => $faqList], 'admin');
    }

    public function faqEdit($id): void
    {
        UsersController::isUserHasPermission("faq.edit");

        $faq = new faqModel();
        $faq->fetch($id);


        view('faq', 'edit.admin', ["faq" => $faq], 'admin');
    }

    public function faqEditPost($id): void
    {
        UsersController::isUserHasPermission("faq.edit");

        $faq = new faqModel();
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

        view('faq', 'add.admin', [], 'admin');
    }

    public function faqAddPost(): void
    {
        UsersController::isUserHasPermission("faq.create");

        $faq = new faqModel();
        $faq->question = filter_input(INPUT_POST, "question");
        $faq->response = filter_input(INPUT_POST, "response");

        //Get the author pseudo
        $user = new UsersModel;
        $user->fetch($_SESSION['cmwUserId']);
        $faq->author = $user->userPseudo;

        $faq->faqCreate();

        header("location: ../faq/list");

    }

    public function faqDelete(): void
    {
        UsersController::isUserHasPermission("faq.delete");

        $faq = new faqModel();
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

        $faq = new faqModel();
        $faqList = $faq->fetchAll();

        //Include the public view file ("public/themes/$themePath/views/faq/main.view.php")
        view('faq', 'main', ["faq" => $faq, "faqList" => $faqList, "core" => $core, "menu" => $menu], 'public');
    }
}
