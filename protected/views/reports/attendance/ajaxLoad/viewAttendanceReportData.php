<div class="row mb-30">
    <div class="col-md-12">
        <div class="card">

            <div class="card-header">
                <div class="row">
                    <h1 class="col-md-4">Attendance </h1>
                    <div class="col-md-8 text-right">
                        <button type="button" class="btn btn-primary">Download</button>
                    </div>
                </div>
            </div>

            <div class="card-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-scroll-x scroll-table">
                            <table class="table table-bordered cm-table">
                                <thead>
                                <tr>
                                    <?php
                                    foreach ($headersLabels as $headersLabel) {
                                        ?>
                                        <th><?php echo $headersLabel; ?></th>
                                        <?php
                                    }
                                    ?>
                                </tr>
                                </thead>

                                <tbody>
                                <?php
                                foreach ($attendanceData as $attendance) {
                                    ?>
                                    <tr>
                                        <?php
                                        foreach ($attendance as $att) {
                                            ?>
                                            <td><?php echo $att; ?></td>
                                            <?php
                                        }
                                        ?>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mt-15 mb-15" id="pagination">
                        <?php
                        Paginations::setLimit($pageSize);
                        Paginations::setPage($page);
                        Paginations::setJSCallback("searchData");
                        Paginations::setTotalPages($count);
                        Paginations::makePagination();
                        Paginations::drawPagination();
                        ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    $(function () {
        $(".scroll-table").mCustomScrollbar({
            theme: "dark-3",
            axis: "x"
        });
    });
</script>