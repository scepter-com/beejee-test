<?php
$current_page_value = $data['page'];
$pages = (int)$data['pages'];
?>
<div class="document_title">
    <h1>
        <?php
            echo $title . '<br>';
        ?>
    </h1>
</div>

<div class="filter-menu">

    <a href="http://scepter.bridgetown.com.ua/home/index/@page=1&sortby=username&ordertype=desc">
        <div class="filter-item">По имени | desc</div>
    </a>
    <a href="http://scepter.bridgetown.com.ua/home/index/@page=1&sortby=username&ordertype=asc">
        <div class="filter-item">По имени | asc</div>
    </a>
    <a href="http://scepter.bridgetown.com.ua/home/index/@page=1&sortby=email&ordertype=desc">
        <div class="filter-item">По email | desc</div>
    </a>
    <a href="http://scepter.bridgetown.com.ua/home/index/@page=1&sortby=email&ordertype=asc">
        <div class="filter-item">По email | asc</div>
    </a>
    <a href="http://scepter.bridgetown.com.ua/home/index/@page=1&sortby=fulfilled_status&ordertype=desc">
        <div class="filter-item">По статусу | desc</div>
    </a>
    <a href="http://scepter.bridgetown.com.ua/home/index/@page=1&sortby=fulfilled_status&ordertype=asc">
        <div class="filter-item">По статусу | asc</div>
    </a>

</div>

<!--Tasks-->
<div class="tasks-container container">
    <div class="separator"></div>
<?php
    if(isset($data['admin']))
    {

        foreach ($data['rows'] as $row)
        {
            $status = $row['fulfilled_status'] == 0 ? 'Не выполнено.' : 'Выполнено.';
            $updated_at = empty($row['updated_at']) ? '' : 'updated_at : ' . $row['updated_at'];
?>

            <div class="task">
                <div class="row task-row">
                    <div class="col-md-2 task-col task-id-col">
                        task #<?php echo $row['id'] . '<br>'; ?>
                    </div>
                    <div class="col-md-4 task-col username-col">
                        <?php echo $row['username'] . '<br>'; ?>
                    </div>
                    <div class="col-md-3 task-col email-col">
                        <?php echo $row['email'] . '<br>'; ?>
                        <div class="ff-status-adm"><?php echo $status; ?></div>
                    </div>
                    <div class="col-md-3 task-col fulfill-status-col">

                        <select class="ff-select form-control" id="<?php echo "fulfilled" . $row['id']; ?>">
                            <option value="0">Не выполнено</option>
                            <option value="1">Выполнено</option>
                        </select>
                        <div class="update-fulfill-status-button bj-home-page-button btn btn-primary mb-2" onclick="updateFulfilledStatus('#fulfilled<?php echo $row['id']; ?>', <?php echo $row['id']; ?>)">Save</div>
                    </div>
                    <div class="col-md-12 task-col task-text-col">
                        <textarea class="form-control" id="<?php echo "task" . $row['id']; ?>" rows="7"><?php echo $row['task']; ?></textarea>
                    </div>
                    <div class="col-md-5 created-at-col">
                        created at : <?php echo $row['created_at']; ?>
                    </div>
                    <div class="col-md-5 updated-at-col">
                        <?php echo $updated_at; ?>
                    </div>
                    <div class="col-md-2 updated-at-col">
                        <div class="update-task-button bj-home-page-button btn btn-primary mb-2" onclick="updateTask('#task<?php echo $row['id']; ?>', <?php echo $row['id']; ?>)">Save</div>
                    </div>
                </div>
            </div>
            <div class="separator"></div>

<?php
        }
    }
    else
    {
        foreach ($data['rows'] as $row)
        {
            $status = $row['fulfilled_status'] == 0 ? 'Не выполнено.' : 'Выполнено.';
            $updated_at = empty($row['updated_at']) ? '' : 'updated_at : ' . $row['updated_at'];
?>

            <div class="task">
                <div class="row task-row">
                    <div class="col-md-2 task-col task-id-col">
                        task #<?php echo $row['id']; ?>
                    </div>
                    <div class="col-md-4 task-col username-col">
                        <?php echo $row['username']; ?>
                    </div>
                    <div class="col-md-4 task-col email-col">
                        <?php echo $row['email']; ?>
                    </div>
                    <div class="col-md-2 task-col fulfill-status-col">
                        <?php echo $status; ?>
                    </div>
                    <div class="col-md-12 task-col task-text-col">
                        <p class="task-paragraph">
                            <?php echo $row['task']; ?>
                        </p>
                    </div>
                    <div class="col-md-6 created-at-col">
                        created at : <?php echo $row['created_at']; ?>
                    </div>
                    <div class="col-md-6 updated-at-col">
                        <?php echo $updated_at; ?>
                    </div>
                </div>
            </div>
            <div class="separator"></div>

<?php
        }
    }

?>







</div>

<!--Tasks-->

<!--Pages-->
<div class="pagination_block">
    <div class="current_page_row">
        <?php echo 'Current page : ' . $current_page_value . '<br>'; ?>
    </div>
    <div class="pages_collection">
        <?php
        if(isset($data['sortby']))
        {
            for($i = 1; $i < $pages + 1; $i++)
            {
                ?>

                <a href="<?php echo "http://scepter.bridgetown.com.ua/home/index/@page=".$i."&sortby=".$data['sortby']."&ordertype=".$data['ordertype']; ?>">
                    <div class="page_item">
                        <?php echo $i; ?>
                    </div>
                </a>

                <?php
            }
        }
        else
        {
            for($i = 1; $i < $pages + 1; $i++)
            {
                ?>

                <a href="http://scepter.bridgetown.com.ua/home/index/@page=<?php echo $i; ?>">
                    <div class="page_item">
                        <?php echo $i; ?>
                    </div>
                </a>

                <?php
            }
        }

        ?>
    </div>
</div>
<!--Pages-->

<div>
    <div class="bj-form form-group">

        <label for="exampleInputEmail1">User name &#10033</label>
        <input class="form-control" type="text" maxlength="254" id="username" placeholder="">

        <div class="separator"></div>

        <label for="exampleInputEmail1">Email address &#10033</label>
        <input type="email" class="form-control" id="email" maxlength="254" aria-describedby="emailHelp">
        <!--<small id="emailHelp" class="form-text text-muted"></small>-->

        <div class="separator"></div>

        <label for="exampleFormControlTextarea1">Task &#10033</label>
        <textarea class="form-control" maxlength="999" id="task" rows="5"></textarea>

        <div class="separator"></div>

        <div class="bj-send-button btn btn-primary mb-2" onclick="createTask('#username','#email','#task')">Create task</div>
    </div>
</div>

