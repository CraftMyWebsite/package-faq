<?php

use CMW\Manager\Lang\LangManager;

$title = LangManager::translate("faq.dashboard.title");
$description = LangManager::translate("faq.dashboard.desc");
?>

<?php $scripts = '
<script>
    $(function () {
        $("#faq_table").DataTable({
            "responsive": true, 
            "lengthChange": false, 
            "autoWidth": false,
            language: {
                processing:     "' . LangManager::translate("core.datatables.list.processing") . '",
                search:         "' . LangManager::translate("core.datatables.list.search") . '",
                lengthMenu:     "' . LangManager::translate("core.datatables.list.lenghtmenu") . '",
                info:           "' . LangManager::translate("core.datatables.list.info") . '",
                infoEmpty:      "' . LangManager::translate("core.datatables.list.info_empty") . '",
                infoFiltered:   "' . LangManager::translate("core.datatables.list.info_filtered") . '",
                infoPostFix:    "' . LangManager::translate("core.datatables.list.info_postfix") . '",
                loadingRecords: "' . LangManager::translate("core.datatables.list.loadingrecords") . '",
                zeroRecords:    "' . LangManager::translate("core.datatables.list.zerorecords") . '",
                emptyTable:     "' . LangManager::translate("core.datatables.list.emptytable") . '",
                paginate: {
                    first:      "' . LangManager::translate("core.datatables.list.first") . '",
                    previous:   "' . LangManager::translate("core.datatables.list.previous") . '",
                    next:       "' . LangManager::translate("core.datatables.list.next") . '",
                    last:       "' . LangManager::translate("core.datatables.list.last") . '"
                },
                aria: {
                    sortAscending:  "' . LangManager::translate("core.datatables.list.sort.ascending") . '",
                    sortDescending: "' . LangManager::translate("core.datatables.list.sort.descending") . '"
                }
            },
        });
    });
</script>'; ?>

    <div class="content">

        <div class="container-fluid">
            <div class="row">

                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h3 class="card-title"><?= LangManager::translate("faq.dashboard.table.title") ?></h3>
                        </div>

                        <div class="card-body">

                            <table id="faq_table" class="table table-bordered table-striped">

                                <thead>
                                <tr>
                                    <th><?= LangManager::translate("faq.dashboard.table.question") ?></th>
                                    <th><?= LangManager::translate("faq.dashboard.table.response") ?></th>
                                    <th><?= LangManager::translate("faq.dashboard.table.author") ?></th>
                                    <th><?= LangManager::translate("faq.dashboard.table.editing") ?></th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php /** @var \CMW\Entity\Faq\FaqEntity[] $faqList */
                                foreach ($faqList as $faq) : ?>
                                    <tr>
                                        <td><?= $faq->getQuestion() ?></td>
                                        <td><?= $faq->getResponse() ?></td>
                                        <td><?= $faq->getAuthor()->getUsername() ?></td>
                                        <td class="text-center">

                                            <a href="../faq/edit/<?= $faq->getFaqId() ?>" class="btn btn-warning"><i
                                                        class="fas fa-edit"></i></a>

                                            <a href="../faq/delete/<?= $faq->getFaqId() ?>" class="btn btn-danger"><i
                                                        class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>

                                <tfoot>
                                <tr>
                                    <th><?= LangManager::translate("faq.dashboard.table.question") ?></th>
                                    <th><?= LangManager::translate("faq.dashboard.table.response") ?></th>
                                    <th><?= LangManager::translate("faq.dashboard.table.author") ?></th>
                                    <th><?= LangManager::translate("faq.dashboard.table.editing") ?></th>
                                </tr>
                                </tfoot>

                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>