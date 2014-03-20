<div class="container">
    <div class="row">
        <div class="span12">
            <section>
                <form id="group-form" class="form-horizontal" action="/page/save" method="post">
                    <div class="control-group">
                        <label class="control-label">URL</label>
                        <div class="controls">
                            <input type="text" name="url" class="input-xxlarge" placeholder="URL">
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <button type="submit" class="btn btn-inverse">分享</button>
                        </div>
                    </div>
                </form>
            </section>
            
            <section>
                <?php 
                $keys = array_keys($list[0]);
                ?>
                <table id="widgets_table" class="table table-striped table-bordered table-condensed" style="width:100%">
                    <thead>
                        <tr>
                        <?php 
                        foreach ($keys as $key) {
                            if ($key == 'content') {
                                continue;
                            }
                            echo '<th>'.$key.'</th>';
                        }
                        ?>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    foreach ($list as $item) {
                        echo '<tr>';
                        foreach ($keys as $key) {
                            if ($key == 'content') {
                                continue;
                            }
                            echo '<td>'.$item[$key].'</td>';
                        }
                        echo '</tr>';
                    }
                    ?>
                    </tbody>
                </table>
            </section>
        </div>
    </div>
</div>