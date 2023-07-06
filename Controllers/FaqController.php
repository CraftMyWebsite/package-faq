<?php

namespace CMW\Controller\Faq;

use CMW\Controller\users\UsersController;
use CMW\Manager\Flash\Alert;
use CMW\Manager\Flash\Flash;
use CMW\Manager\Lang\LangManager;
use CMW\Manager\Package\AbstractController;
use CMW\Manager\Requests\Request;
use CMW\Manager\Router\Link;
use CMW\Model\faq\FaqModel;
use CMW\Model\users\UsersModel;
use CMW\Manager\Views\View;
use JetBrains\PhpStorm\NoReturn;
use CMW\Utils\Redirect;

/**
 * Class: @FaqController
 * @package faq
 * @author Teyir
 * @version 1.0
 */
class FaqController extends AbstractController
{
    #[Link(path: "/", method: Link::GET, scope: "/cmw-admin/faq")]
    #[Link("/manage", Link::GET, [], "/cmw-admin/faq")]
    public function faqList(): void
    {
        UsersController::redirectIfNotHavePermissions("core.dashboard", "faq.show");


        $faqList = faqModel::getInstance()->getFaqs();


        //Include the view file ("views/manage.admin.view.php").
        View::createAdminView('Faq', 'manage')
            ->addStyle("Admin/Resources/Vendors/Simple-datatables/style.css","Admin/Resources/Assets/Css/Pages/simple-datatables.css")
            ->addScriptAfter("Admin/Resources/Vendors/Simple-datatables/Umd/simple-datatables.js",
                "Admin/Resources/Assets/Js/Pages/simple-datatables.js")
            ->addVariableList(["faqList" => $faqList])
            ->view();
    }

    #[Link("/edit/:id", Link::GET, ["id" => "[0-9]+"], "/cmw-admin/faq")]
    public function faqEdit(Request $request, int $id): void
    {
        UsersController::redirectIfNotHavePermissions("core.dashboard", "faq.edit");

        $faq = faqModel::getInstance()->getFaqById($id);

        View::createAdminView('Faq', 'edit')
            ->addVariableList(["faq" => $faq])
            ->view();
    }

    #[Link("/edit/:id", Link::POST, ["id" => "[0-9]+"], "/cmw-admin/faq")]
    #[NoReturn] public function faqEditPost(Request $request, int $id): void
    {
        UsersController::redirectIfNotHavePermissions("core.dashboard", "faq.edit");

        $question = htmlspecialchars(filter_input(INPUT_POST, "question"));
        $response = htmlspecialchars(filter_input(INPUT_POST, "response"));

        faqModel::getInstance()->updateFaq($id, $question, $response);

        Flash::send(Alert::SUCCESS, LangManager::translate("core.toaster.success"),
            LangManager::translate("faq.dashboard.edit.toaster.success", vars: ["faq" => $question]));

        Redirect::redirectToAdmin("faq/manage");
    }

    #[Link("/manage", Link::GET, [], "/cmw-admin/faq")]
    public function faqAdd(): void
    {
        UsersController::redirectIfNotHavePermissions("core.dashboard", "faq.create");

        View::createAdminView('Faq', 'manage')
            ->view();
    }

    #[Link("/manage", Link::POST, [], "/cmw-admin/faq")]
    public function faqAddPost(): void
    {
        UsersController::redirectIfNotHavePermissions("core.dashboard", "faq.create");

        $question = htmlspecialchars(filter_input(INPUT_POST, "question"));
        $response = htmlspecialchars(filter_input(INPUT_POST, "response"));
        $userId = UsersModel::getCurrentUser()?->getId();

        faqModel::getInstance()->createFaq($question, $response, $userId);

        Flash::send(Alert::SUCCESS, LangManager::translate("core.toaster.success"),
            LangManager::translate("faq.dashboard.add.toaster.success"));

        Redirect::redirectToAdmin("faq/manage");
    }

    #[Link("/delete/:id", Link::GET, ["id" => "[0-9]+"], "/cmw-admin/faq")]
    #[NoReturn] public function faqDelete(Request $request, int $id): void
    {
        UsersController::redirectIfNotHavePermissions("core.dashboard", "faq.delete");

        $faqQuestion = faqModel::getInstance()->getFaqById($id)?->getQuestion();

        faqModel::getInstance()->deleteFaq($id);

        Flash::send(Alert::SUCCESS, LangManager::translate("core.toaster.success"),
            LangManager::translate("faq.dashboard.delete.toaster.success", vars: ["faq" => $faqQuestion]));

        Redirect::redirectToAdmin("faq/manage");
    }


    /* //////////////////// FRONT PUBLIC //////////////////// */

    #[Link('/faq', Link::GET)]
    public function frontFaqPublic(): void
    {
        $faq = new FaqModel();
        $faqList = $faq->getFaqs();

        //Include the Public view file ("Public/Themes/$themePath/Views/Faq/main.view.php")
        $view = new View('Faq', 'main');
        $view->addVariableList(["faq" => $faq, "faqList" => $faqList]);
        $view->view();
    }
}
