<?php

namespace CMW\Controller\Faq;

use CMW\Controller\users\UsersController;
use CMW\Manager\Filter\FilterManager;
use CMW\Manager\Flash\Alert;
use CMW\Manager\Flash\Flash;
use CMW\Manager\Lang\LangManager;
use CMW\Manager\Package\AbstractController;
use CMW\Manager\Router\Link;
use CMW\Manager\Views\View;
use CMW\Model\faq\FaqModel;
use CMW\Model\users\UsersModel;
use CMW\Utils\Redirect;
use JetBrains\PhpStorm\NoReturn;

/**
 * Class: @FaqController
 * @package Faq
 * @author Teyir
 * @version 0.0.1
 */
class FaqController extends AbstractController
{
    #[Link(path: '/', method: Link::GET, scope: '/cmw-admin/faq')]
    #[Link('/manage', Link::GET, [], '/cmw-admin/faq')]
    private function faqList(): void
    {
        UsersController::redirectIfNotHavePermissions('core.dashboard', 'faq.show');

        $faqList = faqModel::getInstance()->getFaqs();

        // Include the view file ("views/manage.admin.view.php").
        View::createAdminView('Faq', 'manage')
            ->addStyle('Admin/Resources/Assets/Css/simple-datatables.css')
            ->addScriptAfter('Admin/Resources/Vendors/Simple-datatables/simple-datatables.js',
                'Admin/Resources/Vendors/Simple-datatables/config-datatables.js')
            ->addVariableList(['faqList' => $faqList])
            ->view();
    }

    #[Link('/edit/:id', Link::GET, ['id' => '[0-9]+'], '/cmw-admin/faq')]
    private function faqEdit(int $id): void
    {
        UsersController::redirectIfNotHavePermissions('core.dashboard', 'faq.edit');

        $faq = faqModel::getInstance()->getFaqById($id);

        if (!$faq){
            Redirect::errorPage(404);
        }

        View::createAdminView('Faq', 'edit')
            ->addVariableList(['faq' => $faq])
            ->view();
    }

    #[Link('/edit/:id', Link::POST, ['id' => '[0-9]+'], '/cmw-admin/faq')]
    #[NoReturn]
    private function faqEditPost(int $id): void
    {
        UsersController::redirectIfNotHavePermissions('core.dashboard', 'faq.edit');

        $question = FilterManager::filterInputStringPost("question");
        $response = FilterManager::filterInputStringPost("response");

        faqModel::getInstance()->updateFaq($id, $question, $response);

        Flash::send(Alert::SUCCESS, LangManager::translate('core.toaster.success'),
            LangManager::translate('faq.dashboard.edit.toaster.success', vars: ['faq' => $question]));

        Redirect::redirectToAdmin('faq/manage');
    }

    #[Link('/manage', Link::GET, [], '/cmw-admin/faq')]
    private function faqAdd(): void
    {
        UsersController::redirectIfNotHavePermissions('core.dashboard', 'faq.create');

        View::createAdminView('Faq', 'manage')
            ->view();
    }

    #[NoReturn] #[Link('/manage', Link::POST, [], '/cmw-admin/faq')]
    private function faqAddPost(): void
    {
        UsersController::redirectIfNotHavePermissions('core.dashboard', 'faq.create');

        $question = FilterManager::filterInputStringPost("question");
        $response = FilterManager::filterInputStringPost("response");

        $userId = UsersModel::getCurrentUser()?->getId();

        faqModel::getInstance()->createFaq($question, $response, $userId);

        Flash::send(Alert::SUCCESS, LangManager::translate('core.toaster.success'),
            LangManager::translate('faq.dashboard.add.toaster.success'));

        Redirect::redirectToAdmin('faq/manage');
    }

    #[NoReturn] #[Link('/delete/:id', Link::GET, ['id' => '[0-9]+'], '/cmw-admin/faq')]
    private function faqDelete(int $id): void
    {
        UsersController::redirectIfNotHavePermissions('core.dashboard', 'faq.delete');

        $faqQuestion = faqModel::getInstance()->getFaqById($id)?->getQuestion();

        faqModel::getInstance()->deleteFaq($id);

        Flash::send(Alert::SUCCESS, LangManager::translate('core.toaster.success'),
            LangManager::translate('faq.dashboard.delete.toaster.success', vars: ['faq' => $faqQuestion]));

        Redirect::redirectToAdmin('faq/manage');
    }

    /* //////////////////// FRONT PUBLIC //////////////////// */

    #[Link('/faq', Link::GET)]
    private function frontFaqPublic(): void
    {
        $faq = new FaqModel();
        $faqList = $faq->getFaqs();

        // Include the Public view file ("Public/Themes/$themePath/Views/Faq/main.view.php")
        $view = new View('Faq', 'main');
        $view->addVariableList(['faq' => $faq, 'faqList' => $faqList]);
        $view->view();
    }
}
