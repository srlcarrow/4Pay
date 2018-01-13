<table class="table table-bordered">
    <thead>
        <tr>
            <th>Day</th>
            <th>Date In</th>
            <th>Punch In</th>
            <th>Date Out</th>
            <th>Punch Out</th>
        </tr>
    </thead>

    <tbody>
        <?php
        foreach ($attendanceData as $attendance) {
            ?>
            <tr>
                <td><?php echo $attendance['day']; ?></td>
                <td><?php echo $attendance['date_in']; ?></td>
                <td><?php echo $attendance['punch_in']; ?></td>
                <td><?php echo $attendance['date_out']; ?></td>
                <td><?php echo $attendance['punch_out']; ?></td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>