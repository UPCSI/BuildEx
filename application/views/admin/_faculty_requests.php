<h3> Faculty Requests 
    <?php if(isset($requests)): ?>
        (<?php echo count($requests); ?>)
    <?php endif; ?>
</h3>
<?php if(isset($requests)): ?>
    <table>
        <thead>
            <tr>
                <th width="200">Name</th>
                <th width="150">Username</th>
                <th width="150">Faculty No.</th>
                <th width="150">Joined</th>
                <th width="100">Confirm</th>
                <th width="100">Reject</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($requests as $request): ?>
            <tr>
                <td>
                    <a href = "<?php echo site_url('faculty/view/'.$request->username); ?>">
                        <?php echo strtoupper($request->last_name).', '.ucwords($request->first_name).', '.ucfirst($request->middle_name); ?>
                    </a>
                </td>
                <td><?php echo $request->username; ?></td>
                <td><?php echo $request->faculty_num; ?></td>
                <td> mm-dd-yyyy </td>
                <td><a href="<?php echo site_url('faculty/confirm_faculty/'.$request->fid); ?>" class="button tiny"> &#x2713; </a> </td>
                <td><a href="<?php echo site_url('faculty/reject_faculty/'.$request->fid); ?>" class="button tiny"> &#x2717; </a> </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    </p> There are no pending requests.</p>
<?php endif; ?>