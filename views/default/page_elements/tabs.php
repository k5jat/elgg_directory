<script>
    $(document).ready(function() {
        var loader = '<div class="ajax_loader"></div>'
        $('ul#tabbed_nav li').each(function() {
            $(this).click(function(){
                selected.removeClass('selected');
                selected = $(this);
                selected.addClass('selected');
                $('#tabs_content').html(loader);
                $.ajax ({
                    url: '<?php echo $vars['url'] ?>mod/eCompanies/views/default/ajax/tabs.php',
                    type: 'POST',
                    dataType: 'html',
                    data: {
                        tab_id: $(this).attr('id'),
                        tab_view: $(this).attr('view')
                    },
                    success: function(data) {
                        $('#tabs_content').html(data);
                    }
                });
            });
        });
        var selected = $('ul#tabbed_nav li:first');
        selected.addClass('selected');
        selected.trigger('click');
    });
</script>
<div id="tabs_wrapper">
    <div id="elgg_horizontal_tabbed_nav">
        <ul id="tabbed_nav">
            <?php
            $mainTabsArray = $vars['tabs'];
            foreach ($mainTabsArray as $tabs) {
                echo '<li id="' . $tabs['id'] . '" class="' . $tabs['class'] . '" view="' . $tabs['view'] . '"><a>' . $tabs['name'] . '</a></li>';
                $_SESSION['tabs'][$tabs['id']] = $tabs['vars'];
            }
            ?>
        </ul>
    </div>
    <div id="tabs_content">
    </div>
</div>