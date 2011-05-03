<?php
    if (!$vars['defaultvalue']) {
        $defaultvalue = elgg_echo('eCompanies:filtertext');
    } else {
        $defaultvalue = $vars['defaultvalue'];
    }
?>
<script>
    //filter results based on query
    function filter(selector, query) {
        query =   $.trim(query); //trim white space
        query = query.replace(/ /gi, '|'); //add OR for regex query

        selector.each(function() {
            var text = $('div.filter_area', $(this));
            (text.text().search(new RegExp(query, "i")) < 0) ? $(this).hide().removeClass('visible') : $(this).show().addClass('visible');
        });
    }

    $(document).ready(function(){
        var parent = $('.search_listing');
        var filter_name = '<?php echo $defaultvalue ?>';
        parent.addClass('visible');
        $('#filter').click(function(){
           if ($(this).val() == filter_name) {
               $(this).val('')
           }
        }).blur(function(){
           if ($(this).val() == '') {
               $(this).val(filter_name)
           }
        });

        $('#filter').keyup(function(event) {
            //if esc is pressed or nothing is entered

            if (event.keyCode == 27 || $(this).val() == '') {
                //if esc is pressed we want to clear the value of search box
                //we want each row to be visible because if nothing
                //is entered then all rows are matched.
                parent.removeClass('visible').show().addClass('visible');
            }

            //if there is text, lets filter
            else {
                filter(parent, $(this).val());
            }
        });
    });

</script>
<?php
    echo '<div class="filter_input">' . elgg_view('input/text', array('internalid' => 'filter', 'value' => $defaultvalue)) . '</div>';

?>