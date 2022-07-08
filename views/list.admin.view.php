<?php
$title = FAQ_DASHBOARD_TITLE;
$description = FAQ_DASHBOARD_DESC;
/** @var faqModel[] $faq_list */
?>

<?php $scripts = '
<script>
    $(function () {
        $("#faq_table").DataTable({
            "responsive": true, 
            "lengthChange": false, 
            "autoWidth": false,
            language: {
                processing:     "'.CORE_DATATABLES_LIST_PROCESSING.'",
                search:         "'.CORE_DATATABLES_LIST_SEARCH.'",
                lengthMenu:     "'.CORE_DATATABLES_LIST_LENGTHMENU.'",
                info:           "'.CORE_DATATABLES_LIST_INFO.'",
                infoEmpty:      "'.CORE_DATATABLES_LIST_INFOEMPTY.'",
                infoFiltered:   "'.CORE_DATATABLES_LIST_INFOFILTERED.'",
                infoPostFix:    "'.CORE_DATATABLES_LIST_INFOPOSTFIX.'",
                loadingRecords: "'.CORE_DATATABLES_LIST_LOADINGRECORDS.'",
                zeroRecords:    "'.CORE_DATATABLES_LIST_ZERORECORDS.'",
                emptyTable:     "'.CORE_DATATABLES_LIST_EMPTYTABLE.'",
                paginate: {
                    first:      "'.CORE_DATATABLES_LIST_FIRST.'",
                    previous:   "'.CORE_DATATABLES_LIST_PREVIOUS.'",
                    next:       "'.CORE_DATATABLES_LIST_NEXT.'",
                    last:       "'.CORE_DATATABLES_LIST_LAST.'"
                },
                aria: {
                    sortAscending:  "'.CORE_DATATABLES_LIST_SORTASCENDING.'",
                    sortDescending: "'.CORE_DATATABLES_LIST_SORTDESCENDING.'"
                }
            },
        });
    });
</script>';?>

<?php ob_start(); ?>

<div class="content">

    <div class="container-fluid">
        <div class="row">

            <div class="col-12">
                <div class="card">

                    <div class="card-header">
                        <h3 class="card-title"><?= FAQ_DASHBOARD_TABLE_TITLE ?></h3>
                    </div>

                    <div class="card-body">

                        <table id="faq_table" class="table table-bordered table-striped">

                            <thead>
                                <tr>
                                    <th><?= FAQ_DASHBOARD_TABLE_QUESTION ?></th>
                                    <th><?= FAQ_DASHBOARD_TABLE_RESPONSE ?></th>
                                    <th><?= FAQ_DASHBOARD_TABLE_AUTHOR ?></th>
                                    <th><?= FAQ_DASHBOARD_TABLE_EDITING ?></th>
                                </tr>
                            </thead>

                            <tbody>
                            <?php /** @var faqModel[] $faqList */
                            foreach ($faqList as $faq) : ?>
                                <tr>
                                    <td><?= $faq['question'] ?></td>
                                    <td><?= $faq['response'] ?></td>
                                    <td><?= $faq['author'] ?></td>
                                    <td class="text-center">

                                        <button onclick="window.location.href='../faq/edit/<?= $faq['faq_id'] ?>'" class="btn btn-warning"><i class="fas fa-edit"></i></button>

                                        <form action="../faq/delete" method="post" class="d-inline-block">
                                            <input type="hidden" value="<?= $faq['faq_id'] ?>" name="id">
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th><?= FAQ_DASHBOARD_TABLE_QUESTION ?></th>
                                    <th><?= FAQ_DASHBOARD_TABLE_RESPONSE ?></th>
                                    <th><?= FAQ_DASHBOARD_TABLE_AUTHOR ?></th>
                                    <th><?= FAQ_DASHBOARD_TABLE_EDITING ?></th>
                                </tr>
                            </tfoot>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php $content = ob_get_clean(); ?>