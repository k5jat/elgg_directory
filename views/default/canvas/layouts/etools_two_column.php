<div id="one_column">
    <div id="eTools_header">
        <?php if (isset($vars['area1']))
                echo $vars['area1']; ?>
    </div>
    <div>
        <div id="eTools_leftcolumn" class="left">
            <?php if (isset($vars['area3']))
                echo $vars['area3']; ?>
        </div>

        <div id="eTools_body" class="right">
            <?php if (isset($vars['area2']))
                echo $vars['area2']; ?>
        </div>
    </div>
    <div class="clearfloat"></div>
    <div id="eTools_footer">
        <?php if (isset($vars['area4']))
                echo $vars['area4']; ?>
    </div>

    <div class="clearfloat"></div>
</div>