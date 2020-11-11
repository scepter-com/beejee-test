<div class="document_title">
    <h1>

        <?php
        echo $title . '<br>';
        ?>

    </h1>
</div>

<div>
    <div class="bj-form form-group">

        <label for="exampleInputEmail1">User name &#10033</label>
        <input class="form-control" type="text" maxlength="254" id="admin" placeholder="">

        <div class="separator"></div>

        <label for="exampleInputEmail1">Password &#10033</label>
        <input type="password" class="form-control" id="password" maxlength="254">
        <!--<small id="emailHelp" class="form-text text-muted"></small>-->


        <div class="separator"></div>

        <div class="bj-send-button btn btn-primary mb-2" onclick="login('#admin', '#password')">Login</div>
    </div>
</div>
