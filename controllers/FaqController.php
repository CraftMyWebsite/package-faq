<?php

namespace CMW\Controller\Faq;

use CMW\Controller\Core\CoreController;
use CMW\Controller\Menus\MenusController;
use CMW\Controller\users\UsersController;
use CMW\Manager\Lang\LangManager;
use CMW\Model\faq\FaqModel;
use CMW\Model\users\UsersModel;
use CMW\Router\Link;
use CMW\Utils\Response;
use CMW\Manager\Views\View;
use JetBrains\PhpStorm\NoReturn;
use CMW\Utils\Redirect;

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
    #[Link("/manage", Link::GET, [], "/cmw-admin/faq")]
    public function faqList(): void
    {
        UsersController::redirectIfNotHavePermissions("core.dashboard", "faq.show");


        $faqList = $this->faqModel->getFaqs();


        //Include the view file ("views/manage.admin.view.php").
        View::createAdminView('faq', 'manage')
            ->addStyle("admin/resources/vendors/simple-datatables/style.css","admin/resources/assets/css/pages/simple-datatables.css")
            ->addScriptAfter("admin/resources/vendors/simple-datatables/umd/simple-datatables.js",
                "admin/resources/assets/js/pages/simple-datatables.js")
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

        Response::sendAlert("success", LangManager::translate("core.toaster.success"),
            LangManager::translate("faq.dashboard.edit.toaster.success", vars: ["faq" => $question]));

        Redirect::redirect("cmw-admin/faq/manage");
    }

    #[Link("/manage", Link::GET, [], "/cmw-admin/faq")]
    public function faqAdd(): void
    {
        UsersController::redirectIfNotHavePermissions("core.dashboard", "faq.create");

        View::createAdminView('faq', 'manage')
            ->view();
    }

    #[Link("/manage", Link::POST, [], "/cmw-admin/faq")]
    public function faqAddPost(): void
    {
        UsersController::redirectIfNotHavePermissions("core.dashboard", "faq.create");

        $question = htmlspecialchars(filter_input(INPUT_POST, "question"));
        $response = htmlspecialchars(filter_input(INPUT_POST, "response"));

        //Get the author pseudo
        $user = new UsersModel;
        $userEntity = $user->getUserById($_SESSION['cmwUserId']);
        $userId = $userEntity?->getId();

        $this->faqModel->createFaq($question, $response, $userId);

        Response::sendAlert("success", LangManager::translate("core.toaster.success"),
            LangManager::translate("faq.dashboard.add.toaster.success"));

        Redirect::redirect("cmw-admin/faq/manage");
    }

    #[Link("/delete/:id", Link::GET, ["id" => "[0-9]+"], "/cmw-admin/faq")]
    #[NoReturn] public function faqDelete(int $id): void
    {
        UsersController::redirectIfNotHavePermissions("core.dashboard", "faq.delete");

        $faqQuestion = $this->faqModel->getFaqById($id)?->getQuestion();

        $this->faqModel->deleteFaq($id);

        Response::sendAlert("success", LangManager::translate("core.toaster.success"),
            LangManager::translate("faq.dashboard.delete.toaster.success", vars: ["faq" => $faqQuestion]));

        Redirect::redirect("cmw-admin/faq/manage");
    }


    /* //////////////////// FRONT PUBLIC //////////////////// */

    #[Link('/faq', Link::GET)]
    public function frontFaqPublic(): void
    {
        $faq = new FaqModel();
        $faqList = $faq->getFaqs();

        //Include the public view file ("public/themes/$themePath/views/faq/main.view.php")
        $view = new View('faq', 'main');
        $view->addVariableList(["faq" => $faq, "faqList" => $faqList]);
        $view->view();
    }
}
