<?php

namespace CMW\Controller\Faq;

use CMW\Controller\Core\CoreController;
use CMW\Controller\Menus\MenusController;
use CMW\Controller\users\UsersController;
use CMW\Model\faq\FaqModel;
use CMW\Model\users\UsersModel;
use CMW\Router\Link;
use CMW\Utils\View;
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

    #[Link(path: "/", method: Link::GET, scope: "/cmw-admin/faq")]
    #[Link("/list", Link::GET, [], "/cmw-admin/faq")]
    public function faqList(): void
    {
        UsersController::redirectIfNotHavePermissions("core.dashboard", "faq.show");


        $faqList = $this->faqModel->getFaqs();


        //Include the view file ("views/list.admin.view.php").
        View::createAdminView('faq', 'list')
            ->addScriptBefore("admin/resources/vendors/bootstrap/js/bootstrap.bundle.min.js",
                "admin/resources/vendors/datatables/jquery.dataTables.min.js",
                "admin/resources/vendors/datatables-bs4/js/dataTables.bootstrap4.min.js",
                "admin/resources/vendors/datatables-responsive/js/dataTables.responsive.min.js",
                "admin/resources/vendors/datatables-responsive/js/responsive.bootstrap4.min.js",
                "admin/resources/vendors/datatables-buttons/js/dataTables.buttons.min.js")
            ->addStyle("admin/resources/vendors/datatables-bs4/css/dataTables.bootstrap4.min.css",
                "admin/resources/vendors/datatables-responsive/css/responsive.bootstrap4.min.css")
            ->addVariableList(["faqList" => $faqList])
            ->view();
    }

    #[Link("/edit/:id", Link::GET, ["id" => "[0-9]+"], "/cmw-admin/faq")]
    public function faqEdit(int $id): void
    {
        UsersController::redirectIfNotHavePermissions("core.dashboard", "faq.edit");

        $faq = $this->faqModel->getFaqById($id);

        View::createAdminView('faq', 'edit')
            ->addVariableList(["faq" => $faq])
            ->view();
    }

    #[Link("/edit/:id", Link::POST, ["id" => "[0-9]+"], "/cmw-admin/faq")]
    #[NoReturn] public function faqEditPost(int $id): void
    {
        UsersController::redirectIfNotHavePermissions("core.dashboard", "faq.edit");


        $question = htmlspecialchars(filter_input(INPUT_POST, "question"));
        $response = htmlspecialchars(filter_input(INPUT_POST, "response"));

        $this->faqModel->updateFaq($id, $question, $response);

        header("location: ../edit/" . $id);
    }

    #[Link("/add", Link::GET, [], "/cmw-admin/faq")]
    public function faqAdd(): void
    {
        UsersController::redirectIfNotHavePermissions("core.dashboard", "faq.create");

        View::createAdminView('faq', 'add')
            ->view();
    }

    #[Link("/add", Link::POST, [], "/cmw-admin/faq")]
    public function faqAddPost(): void
    {
        UsersController::redirectIfNotHavePermissions("core.dashboard", "faq.create");

        $question = htmlspecialchars(filter_input(INPUT_POST, "question"));
        $response = htmlspecialchars(filter_input(INPUT_POST, "response"));

        //Get the author pseudo
        $user = new UsersModel;
        $userEntity = $user->getUserById($_SESSION['cmwUserId']);
        $userId = $userEntity->getId();

        $this->faqModel->createFaq($question, $response, $userId);

        header("location: ../faq/list");
    }

    #[Link("/delete/:id", Link::GET, ["id" => "[0-9]+"], "/cmw-admin/faq")]
    #[NoReturn] public function faqDelete(int $id): void
    {
        UsersController::redirectIfNotHavePermissions("core.dashboard", "faq.delete");

        $this->faqModel->deleteFaq($id);

        header("location: ../../faq/list");
    }


    /* //////////////////// FRONT PUBLIC //////////////////// */

    #[Link('/faq', Link::GET)]
    public function frontFaqPublic(): void
    {

        //Default controllers (important)
        $core = new CoreController();
        $menu = new MenusController();

        $faq = new FaqModel();
        $faqList = $faq->getFaqs();

        //Include the public view file ("public/themes/$themePath/views/faq/main.view.php")
        $view = new View('faq', 'main');
        $view->addVariableList(["faq" => $faq, "faqList" => $faqList, "core" => $core, "menu" => $menu]);
        $view->view();
    }
}
